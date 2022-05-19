<?php

namespace Samwilson\PhpFlickr\Tests;

use OAuth\OAuth1\Token\StdOAuth1Token;
use PHPUnit\Framework\TestCase as PhpUnitTestCase;
use Samwilson\PhpFlickr\FlickrException;
use Samwilson\PhpFlickr\PhpFlickr;

abstract class TestCase extends PhpUnitTestCase
{
    /** @var PhpFlickr[] */
    private $flickrs = [];

    /**
     * Get an instance of PhpFlickr, configured by the config.php file in the tests directory.
     * @param bool $authenticate Whether to authenticate the user with the access token, if it's
     * available in tests/config.php.
     * @return PhpFlickr
     */
    public function getFlickr(bool $authenticate = false): PhpFlickr
    {
        $authed = $authenticate ? 'authed' : 'notauthed';
        if (isset($this->flickrs[$authed])) {
            return $this->flickrs[$authed];
        }

        // Get config values from env vars or the tests/config.php file.
        $apiKey = getenv('FLICKR_API_KEY');
        $apiSecret = getenv('FLICKR_API_SECRET');
        $accessToken = getenv('FLICKR_ACCESS_TOKEN');
        $accessTokenSecret = getenv('FLICKR_ACCESS_SECRET');
        if (empty($apiKey) && file_exists(__DIR__ . '/config.php')) {
            require __DIR__ . '/config.php';
        }
        if (empty($apiKey)) {
            // Skip if no key found, so PRs from forks can still be run in CI.
            static::markTestSkipped('No Flickr API key set.');
        }
        try {
            $this->flickrs[$authed] = new PhpFlickr($apiKey, $apiSecret);
        } catch (FlickrException $ex) {
            static::markTestSkipped($ex->getMessage());
        }

        // Authenticate?
        if ($authenticate && !empty($accessToken) && !empty($accessTokenSecret)) {
            $token = new StdOAuth1Token();
            $token->setAccessToken($accessToken);
            $token->setAccessTokenSecret($accessTokenSecret);
            $this->flickrs[$authed]->getOauthTokenStorage()->storeAccessToken('Flickr', $token);
            try {
                $authenticated = $this->flickrs[$authed]->test()->login();
            } catch (FlickrException $e) {
                $authenticated = false;
            }
            if (!$authenticated) {
                static::markTestSkipped('Unable to authenticate with provided access token.');
            }
        }
        if ($authenticate && empty($accessToken)) {
            static::markTestSkipped(
                'Access token required for this test. '
                . 'Please use examples/get_auth_token.php to get token to add to tests/config.php.'
            );
        }

        return $this->flickrs[$authed];
    }
}
