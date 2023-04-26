<?php

/* phpFlickr
 * Written by Dan Coulter (dan@dancoulter.com).
 * Forked by Sam Wilson, 2017.
 * Project Home Page: https://github.com/samwilson/phpflickr
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace Samwilson\PhpFlickr;

use DateInterval;
use OAuth\Common\Consumer\Credentials;
use OAuth\Common\Http\Client\CurlClient;
use OAuth\Common\Http\Uri\Uri;
use OAuth\Common\Storage\Memory;
use OAuth\Common\Storage\TokenStorageInterface;
use OAuth\OAuth1\Service\Flickr;
use OAuth\OAuth1\Token\StdOAuth1Token;
use OAuth\OAuth2\Token\TokenInterface;
use OAuth\ServiceFactory;
use Psr\Cache\CacheItemPoolInterface;
use Samwilson\PhpFlickr\Oauth\PhpFlickrService;

class PhpFlickr
{
    /** PhpFlickr version. */
    public const VERSION = '5.1.0';

    /** @param string */
    protected $api_key;

    /** @param string|null */
    protected $secret;

    /** @var string The base URL of a Flickr API proxy service. */
    protected $proxyBaseUrl;

    protected $response;

    /** @var string[]|bool */
    protected $parsed_response;

    /** @var CacheItemPoolInterface|null */
    protected $cachePool;

    /** @var int|DateInterval */
    protected $cacheDefaultExpiry = 600;

    protected $token;

    /** @var string The Flickr-API service to connect to; must be either 'flickr' or '23'. */
    protected $service;

    /** @var PhpFlickrService */
    protected $oauthService;

    /** @var TokenInterface */
    protected $oauthRequestToken;

    /** @var TokenStorageInterface */
    protected $oauthTokenStorage;

    /** @var string The User Agent string to send to the Flickr API. */
    protected $userAgent;

    /**
     * @param string $apiKey
     * @param string|null $secret
     */
    public function __construct(string $apiKey, string $secret = null)
    {
        $this->api_key = $apiKey;
        $this->secret = $secret;
        $this->userAgent = 'PhpFlickr/' . self::VERSION . ' https://github.com/samwilson/phpflickr';
    }

    /**
     * Set the cache pool (and in doing so, enable caching).
     * @param CacheItemPoolInterface $pool
     */
    public function setCache(CacheItemPoolInterface $pool)
    {
        $this->cachePool = $pool;
    }

    /**
     * Set the cache time-to-live. This value is used for all cache items. Defaults to 10 minutes.
     * @param int|DateInterval|null $time
     */
    public function setCacheDefaultExpiry($time)
    {
        $this->cacheDefaultExpiry = $time;
    }

    /**
     * Get a cached request.
     * @param string[] $request Array of request parameters ('api_sig' will be discarded).
     * @return string[]
     */
    public function getCached($request)
    {
        //Checks for a cached result to the request.
        //If there is no cache result, it returns a value of false. If it finds one,
        //it returns the unparsed XML.
        unset($request['api_sig']);
        foreach ($request as $key => $value) {
            if (empty($value)) {
                unset($request[$key]);
            } else {
                $request[$key] = (string) $request[$key];
            }
        }
        $cacheKey = md5(serialize($request));

        if ($this->cachePool instanceof CacheItemPoolInterface) {
            $item = $this->cachePool->getItem($cacheKey);
            if ($item->isHit()) {
                return $item->get();
            } else {
                return false;
            }
        }
        return false;
    }

    /**
     * Cache a request's response.
     * @param string[] $request API request parameters.
     * @param mixed $response The value to cache.
     * @return bool Whether the cache was saved or not.
     */
    protected function cache($request, $response)
    {
        //Caches the unparsed response of a request.
        unset($request['api_sig']);
        foreach ($request as $key => $value) {
            if (empty($value)) {
                unset($request[$key]);
            } else {
                $request[$key] = (string) $request[$key];
            }
        }
        $cacheKey = md5(serialize($request));
        if ($this->cachePool instanceof CacheItemPoolInterface) {
            $item = $this->cachePool->getItem($cacheKey);
            $item->set($response);
            $item->expiresAfter($this->cacheDefaultExpiry);
            return $this->cachePool->save($item);
        }
        return false;
    }

    /**
     * Set the User Agent string that will be sent to Flickr.
     * Should be of the form `product/product-version comment`.
     * @param string $userAgent
     */
    public function setUserAgent(string $userAgent): void
    {
        $this->userAgent = $userAgent;
    }

    /**
     * Get the User Agent string.
     */
    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    /**
     * Send a POST request to the Flickr API.
     * @param string $command The API endpoint to call.
     * @param string[] $args The API request arguments.
     * @param bool $nocache Whether to cache the response or not.
     * @return bool|mixed[]
     * @throws FlickrException If the request fails.
     */
    public function request($command, $args = array(), $nocache = false)
    {
        // Make sure the API method begins with 'flickr.'.
        if (substr($command, 0, 7) !== "flickr.") {
            $command = "flickr." . $command;
        }

        // See if there's a cached response.
        $request = array_merge([$command], $args);
        $this->response = $this->getCached($request);
        if (!($this->response) || $nocache) {
            $args = array_filter($args);
            $oauthService = $this->getOauthService();
            $extraHeaders = [
                'User-Agent' => $this->getUserAgent(),
            ];
            $this->response = $oauthService->requestJson($command, 'POST', $args, $extraHeaders);
            if (!$nocache) {
                $this->cache($request, $this->response);
            }
        }

        $jsonResponse = json_decode($this->response, true);
        if (null === $jsonResponse) {
            throw new FlickrException("Unable to decode Flickr response to $command request: " . $this->response);
        }
        $this->parsed_response = $this->cleanTextNodes($jsonResponse);
        if ($this->parsed_response['stat'] === 'fail') {
             throw new FlickrException($this->parsed_response['message'], $this->parsed_response['code']);
        }
        return $this->parsed_response;
    }

    /**
     * Normalize text nodes in API results.
     * @param mixed $arr The node to normalize.
     * @return mixed
     */
    protected function cleanTextNodes($arr)
    {
        if (!is_array($arr)) {
            return $arr;
        } elseif (count($arr) == 0) {
            return $arr;
        } elseif (count($arr) == 1 && array_key_exists('_content', $arr)) {
            return $arr['_content'];
        } else {
            foreach ($arr as $key => $element) {
                $arr[$key] = $this->cleanTextNodes($element);
            }
            return($arr);
        }
    }

    /**
     * Set a proxy server through which all requests will be made.
     * @param string $baseUrl The base URL.
     */
    public function setProxyBaseUrl($baseUrl)
    {
        $this->proxyBaseUrl = rtrim($baseUrl, '/');
    }

    /**
     * Get an uploader with which to upload photos to (or replace photos on) Flickr.
     * @return Uploader
     */
    public function uploader()
    {
        return new Uploader($this);
    }

    /**
     * @param string $callbackUrl The URL to return to when authenticating with Flickr. Only
     * required if you're going to be retrieving an access token.
     * @return PhpFlickrService
     */
    public function getOauthService($callbackUrl = 'oob')
    {
        if ($this->oauthService instanceof Flickr) {
            return $this->oauthService;
        }
        $credentials = new Credentials($this->api_key, $this->secret, $callbackUrl);
        $factory = new ServiceFactory();
        // Replace the Flickr service with our own (of the same name), using the proxy URL if it's set.
        if ($this->proxyBaseUrl) {
            PhpFlickrService::setBaseUrl($this->proxyBaseUrl);
        }
        $factory->registerService('Flickr', PhpFlickrService::class);
        $factory->setHttpClient(new CurlClient());
        $storage = $this->getOauthTokenStorage();
        /** @var PhpFlickrService $flickrService */
        $this->oauthService = $factory->createService('Flickr', $credentials, $storage);
        return $this->oauthService;
    }

    /**
     * Get the initial authorization URL to which to redirect users.
     *
     * This method submits a request to Flickr, so only use it at the request of the user
     * so as to not slow things down or perform unexpected actions.
     *
     * @param string $perm One of 'read', 'write', or 'delete'.
     * @param string $callbackUrl Defaults to 'oob' ('out-of-band') for when no callback is
     * required, for example for console usage.
     * @return Uri
     */
    public function getAuthUrl($perm = 'read', $callbackUrl = 'oob')
    {
        $service = $this->getOauthService($callbackUrl);
        $this->oauthRequestToken = $service->requestRequestToken();
        $url = $service->getAuthorizationUri([
            'oauth_token' => $this->oauthRequestToken->getAccessToken(),
            'perms' => $perm,
        ]);
        return $url;
    }

    /**
     * Get an access token for the current user, that you can store in order to authenticate as
     * for this user in the future.
     *
     * @param string $verifier The verification code.
     * @param string $requestToken The request token. Can be left out if this is being called on
     * the same object that started the authentication (i.e. it already has access to the request
     * token).
     * @return \OAuth\Common\Token\TokenInterface|\OAuth\OAuth1\Token\TokenInterface|string
     */
    public function retrieveAccessToken($verifier, $requestToken = null)
    {
        $service = $this->getOauthService('oob');
        $storage = $this->getOauthTokenStorage();
        /** @var \OAuth\OAuth1\Token\TokenInterface $token */
        $token = $storage->retrieveAccessToken('Flickr');

        // If no request token is provided, try to get it from this object.
        if (is_null($requestToken) && $this->oauthRequestToken instanceof TokenInterface) {
            $requestToken = $this->oauthRequestToken->getAccessToken();
        }

        $secret = $token->getAccessTokenSecret();
        $accessToken = $service->requestAccessToken($requestToken, $verifier, $secret);
        $storage->storeAccessToken('Flickr', $accessToken);
        return $accessToken;
    }

    /**
     * @param TokenStorageInterface $tokenStorage The storage object to use.
     */
    public function setOauthStorage(TokenStorageInterface $tokenStorage)
    {
        $this->oauthTokenStorage = $tokenStorage;
    }

    /**
     * @return TokenStorageInterface
     * @throws FlickrException If the token storage has not been set yet.
     */
    public function getOauthTokenStorage()
    {
        if (!$this->oauthTokenStorage instanceof TokenStorageInterface) {
            // If no storage has yet been set, create an in-memory one with an empty token.
            // This will be suitable for un-authenticated API calls.
            $this->oauthTokenStorage = new Memory();
            $this->oauthTokenStorage->storeAccessToken('Flickr', new StdOAuth1Token());
        }
        return $this->oauthTokenStorage;
    }

    public function blogs()
    {
        return new BlogsApi($this);
    }

    public function cameras()
    {
        return new CamerasApi($this);
    }

    public function collections()
    {
        return new CollectionsApi($this);
    }

    public function commons()
    {
        return new CommonsApi($this);
    }

    public function contacts()
    {
        return new ContactsApi($this);
    }

    public function favorites()
    {
        return new FavoritesApi($this);
    }

    public function galleries()
    {
        return new GalleriesApi($this);
    }

    public function groups()
    {
        return new GroupsApi($this);
    }

    public function groupsDiscussReplies()
    {
        return new GroupsDiscussRepliesApi($this);
    }

    public function groupsDiscussTopics()
    {
        return new GroupsDiscussTopicsApi($this);
    }

    public function groupsMembers()
    {
        return new GroupsMembersApi($this);
    }

    public function groupsPools()
    {
        return new GroupsPoolsApi($this);
    }

    public function interestingness()
    {
        return new InterestingnessApi($this);
    }

    public function machinetags()
    {
        return new MachinetagsApi($this);
    }

    public function panda()
    {
        return new PandaApi($this);
    }

    public function people()
    {
        return new PeopleApi($this);
    }

    public function photos()
    {
        return new PhotosApi($this);
    }

    public function photosComments()
    {
        return new PhotosCommentsApi($this);
    }

    public function photosets()
    {
        return new PhotosetsApi($this);
    }

    public function photosetsComments()
    {
        return new PhotosetsCommentsApi($this);
    }

    public function photosGeo()
    {
        return new PhotosGeoApi($this);
    }

    public function photosLicenses()
    {
        return new PhotosLicensesApi($this);
    }

    public function photosNotes()
    {
        return new PhotosNotesApi($this);
    }

    public function photosPeople()
    {
        return new PhotosPeopleApi($this);
    }

    public function photosSuggestions()
    {
        return new PhotosSuggestionsApi($this);
    }

    public function photosTransform()
    {
        return new PhotosTransformApi($this);
    }

    public function photosUpload()
    {
        return new PhotosUploadApi($this);
    }

    public function places()
    {
        return new PlacesApi($this);
    }

    public function prefs()
    {
        return new PrefsApi($this);
    }

    public function profile()
    {
        return new ProfileApi($this);
    }

    public function push()
    {
        return new PushApi($this);
    }

    public function reflection()
    {
        return new ReflectionApi($this);
    }

    public function stats()
    {
        return new StatsApi($this);
    }

    public function tags()
    {
        return new TagsApi($this);
    }

    public function test()
    {
        return new TestApi($this);
    }

    public function testimonials()
    {
        return new TestimonialsApi($this);
    }

    public function urls()
    {
        return new UrlsApi($this);
    }
}
