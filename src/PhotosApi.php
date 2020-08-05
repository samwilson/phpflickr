<?php

namespace Samwilson\PhpFlickr;

use DateTime;

class PhotosApi extends ApiMethodGroup
{
    /** Size s: small square 75x75 */
    const SIZE_SMALL_SQUARE = 's';

    /** Size q: large square 150x150 */
    const SIZE_LARGE_SQUARE = 'q';

    /** Size t: 100 on longest side */
    const SIZE_THUMBNAIL = 't';

    /** Size m: 240 on longest side */
    const SIZE_SMALL_240 = 'm';

    /** Size n: 320 on longest side */
    const SIZE_SMALL_320 = 'n';

    /** Size -: 500 on longest side */
    const SIZE_MEDIUM_500 = '-';

    /** Size z: 640 on longest side */
    const SIZE_MEDIUM_640 = 'z';

    /** Size c: 800 on longest side. Only exist after 1 March 2012. */
    const SIZE_MEDIUM_800 = 'c';

    /**
     * Size b: 1024 on longest side. Before May 25th 2010 large photos only exist for very large
     * original images.
     */
    const SIZE_LARGE_1024 = 'b';

    /** Size h: 1600 on longest side. Only exist after 1 March 2012. */
    const SIZE_LARGE_1600 = 'h';

    /** Size k: 2048 on longest side. Only exist after 1 March 2012. */
    const SIZE_LARGE_2048 = 'k';

    /** Size o: original image, either a jpg, gif or png, depending on source format. */
    const SIZE_ORIGINAL = 'o';

    /**
     * Add tags to a photo.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.addTags.html
     * @param string $photoId The photo to add tags to.
     * @param string|string[] $tags A space-separated string of tags (double-quoted, where
     * a tag contains a space), or an array of strings (no quoting necessary). Any double quotes
     * within tag names will be removed.
     * @return bool True if no error occured.
     */
    public function addTags($photoId, $tags)
    {
        $tagString = $tags;
        if (is_array($tags)) {
            $quotedTags = array_map(function ($tag) {
                // It's not possible to have double quotes in a tag.
                $cleanTag = str_replace('"', '', $tag);
                // Wrap any tag with spaces in it inside double quotes.
                return strpos($cleanTag, ' ') ? '"' . $cleanTag . '"' : $cleanTag;
            }, $tags);
            $tagString = implode(' ', $quotedTags);
        }
        return (bool)$this->flickr->request('flickr.photos.addTags', [
            'photo_id' => $photoId,
            'tags' => $tagString,
        ], true);
    }

    /**
     * Delete a photo from flickr.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.delete.html
     * @param $photoId string The ID of the photo to delete.
     * @return bool
     */
    public function delete($photoId)
    {
        return (bool)$this->flickr->request('flickr.photos.delete', ['photo_id' => $photoId], true);
    }

    /**
     * Returns all visible sets and pools the photo belongs to.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.getAllContexts.html
     * @param $photoId string The photo to return information for.
     * @return bool
     */
    public function getAllContexts($photoId)
    {
        return $this->flickr->request('flickr.photos.getAllContexts', ['photo_id' => $photoId]);
    }

    /**
     * Fetch a list of recent photos from the calling users' contacts.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.getContactsPhotos.html
     * @param $count int|null Number of photos to return. Defaults to 10, maximum 50. This is only used if single_photo
     * is not passed.
     * @param $justFriends bool|null Set as 1 to only show photos from friends and family (excluding regular contacts).
     * @param $singlePhoto bool|null Only fetch one photo (the latest) per contact, instead of all photos in
     * chronological order.
     * @param $includeSelf bool|null Whether to include photos from the calling user.
     * @param $extras string|string[] An array or comma-delimited list of extra information to fetch for each returned
     * record. Currently supported fields include: license, date_upload, date_taken, owner_name, icon_server,
     * original_format, last_update. For more information see extras under flickr.photos.search.
     * @return mixed
     */
    public function getContactsPhotos(
        $count = null,
        $justFriends = null,
        $singlePhoto = null,
        $includeSelf = null,
        $extras = null
    ) {
        if (is_array($extras)) {
            $extras = join(',', $extras);
        }
        $params = [
            'count' => $count,
            'just_friends' => $justFriends,
            'single_photo' => $singlePhoto,
            'include_self' => $includeSelf,
            'extras' => $extras
        ];
        $response = $this->flickr->request('flickr.photos.getContactsPhotos', $params);
        return isset($response['photos']['photo']) ? $response['photos']['photo'] : false;
    }

    /**
     * Fetch a list of recent public photos from a users' contacts.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.getContactsPublicPhotos.html
     * @param $userId string The NSID of the user to fetch photos for.
     * @param $count int|null Number of photos to return. Defaults to 10, maximum 50. This is only used if $singlePhoto
     * is false.
     * @param $justFriends bool|null Whether to only show photos from friends and family (excluding regular contacts).
     * @param $singlePhoto bool|null Only fetch one photo (the latest) per contact, instead of all photos in
     * chronological order.
     * @param $includeSelf bool|null Whether to include photos from the user specified by $userId.
     * @param $extras string|string[]|null Array or comma-delimited list of extra information to fetch for each returned
     * record. Currently supported fields are: license, date_upload, date_taken, owner_name, icon_server,
     * original_format, last_update.
     * @return mixed
     */
    public function getContactsPublicPhotos(
        $userId,
        $count = null,
        $justFriends = null,
        $singlePhoto = null,
        $includeSelf = null,
        $extras = null
    ) {
        if (is_array($extras)) {
            $extras = join(',', $extras);
        }
        $params = [
            'user_id' => $userId,
            'count' => $count,
            'just_friends' => $justFriends,
            'single_photo' => $singlePhoto,
            'include_self' => $includeSelf,
            'extras' => $extras
        ];
        $response = $this->flickr->request('flickr.photos.getContactsPublicPhotos', $params);
        return isset($response['photos']['photo']) ? $response['photos']['photo'] : false;
    }

    /**
     * Returns next and previous photos for a photo in a photostream.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.getContext.html
     * @param $photoId string The ID of the photo to fetch the context for.
     * @return mixed
     */
    public function getContext($photoId)
    {
        return $this->flickr->request('flickr.photos.getContext', ['photo_id' => $photoId]);
    }

    /**
     * Gets a list of photo counts for the given date ranges for the calling user.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.getCounts.html
     * @param $dates string|string[]|null Array or comma-delimited list of unix timestamps, denoting the periods to
     * return counts for. They should be specified smallest first.
     * @param $takenDates string|string[]|null Array or comma-delimited list of MySQL datetimes, denoting the periods to
     * return counts for. They should be specified smallest first.
     * @return bool
     */
    public function getCounts($dates = null, $takenDates = null)
    {
        if (is_array($dates)) {
            $dates = join(',', $dates);
        }
        if (is_array($takenDates)) {
            $takenDates = join(',', $takenDates);
        }
        $params = ['dates' => $dates, 'taken_dates' => $takenDates];
        $response = $this->flickr->request('flickr.photos.getCounts', $params);
        return isset($response['photocounts']['photocount']) ? $response['photocounts']['photocount'] : false;
    }

    /**
     * Retrieve a list of EXIF/TIFF/GPS tags for a given photo. The calling user must have permission to view the photo.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.getExif.html
     * @param $photoId string The ID of the photo to fetch information for.
     * @param $secret string|null The secret for the photo. If the correct secret is passed then permissions-checking is
     * skipped. This enables the 'sharing' of individual photos by passing around the ID and secret.
     * @return mixed
     */
    public function getExif($photoId, $secret = null)
    {
        $response = $this->flickr->request('flickr.photos.getExif', ['photo_id' => $photoId, 'secret' => $secret]);
        return isset($response['photo']) ? $response['photo'] : false;
    }

    /**
     * Returns the list of people who have favorited a given photo.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.getFavorites.html
     * @param $photoId string The ID of the photo to fetch the favoriters list for.
     * @param $page int|null The page of results to return. If this argument is omitted, it defaults to 1.
     * @param $perPage int|null Number of users to return per page. If this argument is omitted, it defaults to 10. The
     * maximum allowed value is 50.
     * @return mixed
     */
    public function getFavorites($photoId, $page = null, $perPage = null)
    {
        $params = ['photo_id' => $photoId, 'page' => $page, 'per_page' => $perPage];
        $response = $this->flickr->request('flickr.photos.getFavorites', $params);
        return isset($response['photo']) ? $response['photo'] : false;
    }

    /**
     * Get information about a photo. The calling user must have permission to view the photo.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.getInfo.html
     * @param string $photoId The ID of the photo to get information for.
     * @param string $secret The secret for the photo. If the correct secret is passed then
     * permissions checking is skipped. This enables the 'sharing' of individual photos by passing
     * around the id and secret.
     * @return string[]|bool
     */
    public function getInfo($photoId, $secret = null)
    {
        $params = ['photo_id' => $photoId, 'secret' => $secret];
        $response = $this->flickr->request('flickr.photos.getInfo', $params);
        return isset($response['photo']) ? $response['photo'] : false;
    }

    /**
     * Returns a list of your photos that are not part of any sets.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.getNotInSet.html
     * @param string $maxUploadDate Maximum upload date. Photos with an upload date
     * less than or equal to this value will be returned. The date can be in the form
     * of a unix timestamp or mysql datetime.
     * @param string $minTakenDate Minimum taken date. Photos with an taken date
     * greater than or equal to this value will be returned. The date can be in the
     * form of a mysql datetime or unix timestamp.
     * @param string $maxTakenDate Maximum taken date. Photos with an taken date less
     * than or equal to this value will be returned. The date can be in the form of a
     * mysql datetime or unix timestamp.
     * @param string $privacyFilter Return photos only matching a certain privacy
     * level. Valid values are:
    <ul>
    <li>1 public photos</li>
    <li>2 private photos
     * visible to friends</li>
    <li>3 private photos visible to family</li>
    <li>4
     * private photos visible to friends &amp; family</li>
    <li>5 completely private
     * photos</li>
    </ul>

     * @param string $media Filter results by media type. Possible values are
     * <code>all</code> (default), <code>photos</code> or <code>videos</code>
     * @param string $minUploadDate Minimum upload date. Photos with an upload date
     * greater than or equal to this value will be returned. The date can be in the
     * form of a unix timestamp or mysql datetime.
     * @param string $extras A comma-delimited list of extra information to fetch for
     * each returned record. Currently supported fields are: <code>description</code>,
     * <code>license</code>, <code>date_upload</code>, <code>date_taken</code>,
     * <code>owner_name</code>, <code>icon_server</code>, <code>original_format</code>,
     * <code>last_update</code>, <code>geo</code>, <code>tags</code>,
     * <code>machine_tags</code>, <code>o_dims</code>, <code>views</code>,
     * <code>media</code>, <code>path_alias</code>, <code>url_sq</code>,
     * <code>url_t</code>, <code>url_s</code>, <code>url_q</code>, <code>url_m</code>,
     * <code>url_n</code>, <code>url_z</code>, <code>url_c</code>, <code>url_l</code>,
     * <code>url_o</code>
     * @param string $perPage Number of photos to return per page. If this argument is
     * omitted, it defaults to 100. The maximum allowed value is 500.
     * @param string $page The page of results to return. If this argument is omitted,
     * it defaults to 1.
     * @return
     */
    public function getNotInSet(
        $maxUploadDate = null,
        $minTakenDate = null,
        $maxTakenDate = null,
        $privacyFilter = null,
        $media = null,
        $minUploadDate = null,
        $extras = null,
        $perPage = null,
        $page = null
    ) {
        $params = [
            'max_upload_date' => $maxUploadDate,
            'min_taken_date' => $minTakenDate,
            'max_taken_date' => $maxTakenDate,
            'privacy_filter' => $privacyFilter,
            'media' => $media,
            'min_upload_date' => $minUploadDate,
            'extras' => $extras,
            'per_page' => $perPage,
            'page' => $page
        ];
        return $this->flickr->request('flickr.photos.getNotInSet', $params);
    }

    /**
     * Get permissions for a photo.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.getPerms.html
     * @param string $photoId The id of the photo to get permissions for.
     * @return
     */
    public function getPerms($photoId)
    {
        $params = [
            'photo_id' => $photoId
        ];
        return $this->flickr->request('flickr.photos.getPerms', $params);
    }

    /**
     * Returns a list of popular photos
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.getPopular.html
     * @param string $userId The NSID of the user to get a galleries list for. If none
     * is specified, the calling user is assumed.
     * @param string $sort The sort order. One of <code>faves</code>,
     * <code>views</code>, <code>comments</code> or <code>interesting</code>. Deafults
     * to <code>interesting</code>.
     * @param string $extras A comma-delimited list of extra information to fetch for
     * each returned record. Currently supported fields are: <code>description</code>,
     * <code>license</code>, <code>date_upload</code>, <code>date_taken</code>,
     * <code>owner_name</code>, <code>icon_server</code>, <code>original_format</code>,
     * <code>last_update</code>, <code>geo</code>, <code>tags</code>,
     * <code>machine_tags</code>, <code>o_dims</code>, <code>views</code>,
     * <code>media</code>, <code>path_alias</code>, <code>url_sq</code>,
     * <code>url_t</code>, <code>url_s</code>, <code>url_q</code>, <code>url_m</code>,
     * <code>url_n</code>, <code>url_z</code>, <code>url_c</code>, <code>url_l</code>,
     * <code>url_o</code>
     * @param string $perPage Number of photos to return per page. If this argument is
     * omitted, it defaults to 100. The maximum allowed value is 500.
     * @param string $page The page of results to return. If this argument is omitted,
     * it defaults to 1.
     * @return
     */
    public function getPopular($userId = null, $sort = null, $extras = null, $perPage = null, $page = null)
    {
        $params = [
            'user_id' => $userId,
            'sort' => $sort,
            'extras' => $extras,
            'per_page' => $perPage,
            'page' => $page
        ];
        return $this->flickr->request('flickr.photos.getPopular', $params);
    }

    /**
     * Returns a list of the latest public photos uploaded to flickr.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.getRecent.html
     * @param string $extras A comma-delimited list of extra information to fetch for
     * each returned record. Currently supported fields are: <code>description</code>,
     * <code>license</code>, <code>date_upload</code>, <code>date_taken</code>,
     * <code>owner_name</code>, <code>icon_server</code>, <code>original_format</code>,
     * <code>last_update</code>, <code>geo</code>, <code>tags</code>,
     * <code>machine_tags</code>, <code>o_dims</code>, <code>views</code>,
     * <code>media</code>, <code>path_alias</code>, <code>url_sq</code>,
     * <code>url_t</code>, <code>url_s</code>, <code>url_q</code>, <code>url_m</code>,
     * <code>url_n</code>, <code>url_z</code>, <code>url_c</code>, <code>url_l</code>,
     * <code>url_o</code>
     * @param string $perPage Number of photos to return per page. If this argument is
     * omitted, it defaults to 100. The maximum allowed value is 500.
     * @param string $page The page of results to return. If this argument is omitted,
     * it defaults to 1.
     * @return
     */
    public function getRecent($extras = [], $perPage = null, $page = null)
    {
        if (is_array($extras)) {
            $extras = implode(",", $extras);
        }
        $args = ['extras' => $extras, 'per_page' => $perPage, 'page' => $page ];
        $result = $this->flickr->request('flickr.photos.getRecent', $args);
        return isset($result['photos']['photo']) ? $result['photos']['photo'] : false;
    }

    /**
     * Get information about the sets to which the given photos belong.
     * @param int[] $photoIds The photo IDs to look for.
     * @param string $userId The user who owns the photos (if not set, will default to the
     * current calling user).
     * @return string[][]|bool Set information, or false if none found (or an error occured).
     */
    public function getSets($photoIds, $userId = null)
    {
        $out = [];
        $photoIdsString = join(',', $photoIds);
        $sets = $this->flickr->photosets()->getList(
            $userId,
            null,
            null,
            null,
            $photoIdsString
        );
        if (!isset($sets['photoset'])) {
            return false;
        }

        // for users with more than 500 albums, we must search the photoId page by page (thanks, Flickr...)
        foreach (range(1, $sets['pages']) as $pageNum) {
            if ($pageNum > 1) {
                // download the next page of photosets to search
                $sets = $this->flickr->photosets()->getList(
                    $userId,
                    $pageNum,
                    null,
                    null,
                    $photoIdsString
                );
            }
            foreach ($sets['photoset'] as $photoset) {
                foreach ($photoIds as $photoId) {
                    if (in_array($photoId, $photoset['has_requested_photos'])) {
                        $out[] = $photoset;
                    }
                }
            }
        }
        return $out;
    }

    /**
     * Returns the available sizes for a photo. The calling user must have permission to view the photo.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.getSizes.html
     * @param int $photoId The ID of the photo to fetch size information for.
     * @return string[]|bool
     */
    public function getSizes($photoId)
    {
        $response = $this->flickr->request(
            'flickr.photos.getSizes',
            ['photo_id' => $photoId]
        );
        return isset($response['sizes']) ? $response['sizes'] : false;
    }

    /**
     * A convenience wrapper for self::getSizes() to get information about largest available size.
     * @link https://www.flickr.com/services/api/flickr.photos.getSizes.html
     * @link https://www.flickr.com/services/api/misc.urls.html
     * @param int $photoId The ID of the photo to fetch size information for.
     * @return string[]|bool
     */
    public function getLargestSize($photoId)
    {
        $sizes = $this->getSizes($photoId);
        if (!$sizes) {
            return false;
        }
        $areas = [];
        foreach ($sizes['size'] as $size) {
            // Use original if available.
            if ($size['label'] === 'Original') {
                return $size;
            }
            // Otherwise record the area for later calculation of maximum.
            $areas[$size['label']] = $size['width'] * $size['height'];
        }
        // Now find the largest.
        $largestAreaLabel = array_search(max($areas), $areas);
        foreach ($sizes['size'] as $size) {
            if ($size['label'] === $largestAreaLabel) {
                return $size;
            }
        }
        return false;
    }

    /**
     * Returns a list of your photos with no tags.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.getUntagged.html
     * @param string $minUploadDate Minimum upload date. Photos with an upload date
     * greater than or equal to this value will be returned. The date can be in the
     * form of a unix timestamp or mysql datetime.
     * @param string $maxUploadDate Maximum upload date. Photos with an upload date
     * less than or equal to this value will be returned. The date can be in the form
     * of a unix timestamp or mysql datetime.
     * @param string $minTakenDate Minimum taken date. Photos with an taken date
     * greater than or equal to this value will be returned. The date should be in the
     * form of a mysql datetime or unix timestamp.
     * @param string $maxTakenDate Maximum taken date. Photos with an taken date less
     * than or equal to this value will be returned. The date can be in the form of a
     * mysql datetime or unix timestamp.
     * @param string $privacyFilter Return photos only matching a certain privacy
     * level. Valid values are: <ul> <li>1 public photos</li> <li>2 private photos
     * visible to friends</li> <li>3 private photos visible to family</li> <li>4
     * private photos visible to friends &amp; family</li> <li>5 completely private
     * photos</li> </ul>
     * @param string $media Filter results by media type. Possible values are
     * <code>all</code> (default), <code>photos</code> or <code>videos</code>
     * @param string $extras A comma-delimited list of extra information to fetch for
     * each returned record. Currently supported fields are: <code>description</code>,
     * <code>license</code>, <code>date_upload</code>, <code>date_taken</code>,
     * <code>owner_name</code>, <code>icon_server</code>, <code>original_format</code>,
     * <code>last_update</code>, <code>geo</code>, <code>tags</code>,
     * <code>machine_tags</code>, <code>o_dims</code>, <code>views</code>,
     * <code>media</code>, <code>path_alias</code>, <code>url_sq</code>,
     * <code>url_t</code>, <code>url_s</code>, <code>url_q</code>, <code>url_m</code>,
     * <code>url_n</code>, <code>url_z</code>, <code>url_c</code>, <code>url_l</code>,
     * <code>url_o</code>
     * @param string $perPage Number of photos to return per page. If this argument is
     * omitted, it defaults to 100. The maximum allowed value is 500.
     * @param string $page The page of results to return. If this argument is omitted,
     * it defaults to 1.
     * @return
     */
    public function getUntagged(
        $minUploadDate = null,
        $maxUploadDate = null,
        $minTakenDate = null,
        $maxTakenDate = null,
        $privacyFilter = null,
        $media = null,
        $extras = null,
        $perPage = null,
        $page = null
    ) {
        $params = [
            'min_upload_date' => $minUploadDate,
            'max_upload_date' => $maxUploadDate,
            'min_taken_date' => $minTakenDate,
            'max_taken_date' => $maxTakenDate,
            'privacy_filter' => $privacyFilter,
            'media' => $media,
            'extras' => $extras,
            'per_page' => $perPage,
            'page' => $page
        ];
        return $this->flickr->request('flickr.photos.getUntagged', $params);
    }

    /**
     * Returns a list of your geo-tagged photos.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.getWithGeoData.html
     * @param string $minUploadDate Minimum upload date. Photos with an upload date
     * greater than or equal to this value will be returned. The date should be in the
     * form of a unix timestamp.
     * @param string $maxUploadDate Maximum upload date. Photos with an upload date
     * less than or equal to this value will be returned. The date should be in the
     * form of a unix timestamp.
     * @param string $minTakenDate Minimum taken date. Photos with an taken date
     * greater than or equal to this value will be returned. The date should be in the
     * form of a mysql datetime.
     * @param string $maxTakenDate Maximum taken date. Photos with an taken date less
     * than or equal to this value will be returned. The date should be in the form of
     * a mysql datetime.
     * @param string $privacyFilter Return photos only matching a certain privacy
     * level. Valid values are: <ul> <li>1 public photos</li> <li>2 private photos
     * visible to friends</li> <li>3 private photos visible to family</li> <li>4
     * private photos visible to friends & family</li> <li>5 completely private
     * photos</li> </ul>
     * @param string $sort The order in which to sort returned photos. Deafults to
     * date-posted-desc. The possible values are: date-posted-asc, date-posted-desc,
     * date-taken-asc, date-taken-desc, interestingness-desc, and interestingness-asc.
     * @param string $media Filter results by media type. Possible values are
     * <code>all</code> (default), <code>photos</code> or <code>videos</code>
     * @param string $extras A comma-delimited list of extra information to fetch for
     * each returned record. Currently supported fields are: <code>description</code>,
     * <code>license</code>, <code>date_upload</code>, <code>date_taken</code>,
     * <code>owner_name</code>, <code>icon_server</code>, <code>original_format</code>,
     * <code>last_update</code>, <code>geo</code>, <code>tags</code>,
     * <code>machine_tags</code>, <code>o_dims</code>, <code>views</code>,
     * <code>media</code>, <code>path_alias</code>, <code>url_sq</code>,
     * <code>url_t</code>, <code>url_s</code>, <code>url_q</code>, <code>url_m</code>,
     * <code>url_n</code>, <code>url_z</code>, <code>url_c</code>, <code>url_l</code>,
     * <code>url_o</code>
     * @param string $perPage Number of photos to return per page. If this argument is
     * omitted, it defaults to 100. The maximum allowed value is 500.
     * @param string $page The page of results to return. If this argument is omitted,
     * it defaults to 1.
     * @return
     */
    public function getWithGeoData(
        $minUploadDate = null,
        $maxUploadDate = null,
        $minTakenDate = null,
        $maxTakenDate = null,
        $privacyFilter = null,
        $sort = null,
        $media = null,
        $extras = null,
        $perPage = null,
        $page = null
    ) {
        $params = [
            'min_upload_date' => $minUploadDate,
            'max_upload_date' => $maxUploadDate,
            'min_taken_date' => $minTakenDate,
            'max_taken_date' => $maxTakenDate,
            'privacy_filter' => $privacyFilter,
            'sort' => $sort,
            'media' => $media,
            'extras' => $extras,
            'per_page' => $perPage,
            'page' => $page
        ];
        return $this->flickr->request('flickr.photos.getWithGeoData', $params);
    }

    /**
     * Returns a list of your photos which haven't been geo-tagged.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.getWithoutGeoData.html
     * @param string $maxUploadDate Maximum upload date. Photos with an upload date
     * less than or equal to this value will be returned. The date should be in the
     * form of a unix timestamp.
     * @param string $minTakenDate Minimum taken date. Photos with an taken date
     * greater than or equal to this value will be returned. The date can be in the
     * form of a mysql datetime or unix timestamp.
     * @param string $maxTakenDate Maximum taken date. Photos with an taken date less
     * than or equal to this value will be returned. The date can be in the form of a
     * mysql datetime or unix timestamp.
     * @param string $privacyFilter Return photos only matching a certain privacy
     * level. Valid values are: <ul> <li>1 public photos</li> <li>2 private photos
     * visible to friends</li> <li>3 private photos visible to family</li> <li>4
     * private photos visible to friends &amp; family</li> <li>5 completely private
     * photos</li> </ul>
     * @param string $sort The order in which to sort returned photos. Deafults to
     * date-posted-desc. The possible values are: date-posted-asc, date-posted-desc,
     * date-taken-asc, date-taken-desc, interestingness-desc, and interestingness-asc.
     * @param string $media Filter results by media type. Possible values are
     * <code>all</code> (default), <code>photos</code> or <code>videos</code>
     * @param string $minUploadDate Minimum upload date. Photos with an upload date
     * greater than or equal to this value will be returned. The date can be in the
     * form of a unix timestamp or mysql datetime.
     * @param string $extras A comma-delimited list of extra information to fetch for
     * each returned record. Currently supported fields are: <code>description</code>,
     * <code>license</code>, <code>date_upload</code>, <code>date_taken</code>,
     * <code>owner_name</code>, <code>icon_server</code>, <code>original_format</code>,
     * <code>last_update</code>, <code>geo</code>, <code>tags</code>,
     * <code>machine_tags</code>, <code>o_dims</code>, <code>views</code>,
     * <code>media</code>, <code>path_alias</code>, <code>url_sq</code>,
     * <code>url_t</code>, <code>url_s</code>, <code>url_q</code>, <code>url_m</code>,
     * <code>url_n</code>, <code>url_z</code>, <code>url_c</code>, <code>url_l</code>,
     * <code>url_o</code>
     * @param string $perPage Number of photos to return per page. If this argument is
     * omitted, it defaults to 100. The maximum allowed value is 500.
     * @param string $page The page of results to return. If this argument is omitted,
     * it defaults to 1.
     * @return
     */
    public function getWithoutGeoData(
        $maxUploadDate = null,
        $minTakenDate = null,
        $maxTakenDate = null,
        $privacyFilter = null,
        $sort = null,
        $media = null,
        $minUploadDate = null,
        $extras = null,
        $perPage = null,
        $page = null
    ) {
        $params = [
            'max_upload_date' => $maxUploadDate,
            'min_taken_date' => $minTakenDate,
            'max_taken_date' => $maxTakenDate,
            'privacy_filter' => $privacyFilter,
            'sort' => $sort,
            'media' => $media,
            'min_upload_date' => $minUploadDate,
            'extras' => $extras,
            'per_page' => $perPage,
            'page' => $page
        ];
        return $this->flickr->request('flickr.photos.getWithoutGeoData', $params);
    }

    /**
     * Return a list of your photos that have been recently created or which have
     * been recently modified. Recently modified may mean that the photo's
     * metadata (title, description, tags) may have been changed or a comment has been
     * added (or just modified somehow).
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.recentlyUpdated.html
     * @param string $minDate A Unix timestamp or any English textual datetime
     * description indicating the date from which modifications should be compared.
     * @param string $extras A comma-delimited list of extra information to fetch for
     * each returned record. Currently supported fields are: <code>description</code>,
     * <code>license</code>, <code>date_upload</code>, <code>date_taken</code>,
     * <code>owner_name</code>, <code>icon_server</code>, <code>original_format</code>,
     * <code>last_update</code>, <code>geo</code>, <code>tags</code>,
     * <code>machine_tags</code>, <code>o_dims</code>, <code>views</code>,
     * <code>media</code>, <code>path_alias</code>, <code>url_sq</code>,
     * <code>url_t</code>, <code>url_s</code>, <code>url_q</code>, <code>url_m</code>,
     * <code>url_n</code>, <code>url_z</code>, <code>url_c</code>, <code>url_l</code>,
     * <code>url_o</code>
     * @param string $perPage Number of photos to return per page. If this argument is
     * omitted, it defaults to 100. The maximum allowed value is 500.
     * @param string $page The page of results to return. If this argument is omitted,
     * it defaults to 1.
     * @return
     */
    public function recentlyUpdated($minDate, $extras = null, $perPage = null, $page = null)
    {
        $params = [
            'min_date' => $minDate,
            'extras' => $extras,
            'per_page' => $perPage,
            'page' => $page
        ];
        return $this->flickr->request('flickr.photos.recentlyUpdated', $params);
    }

    /**
     * Remove a tag from a photo.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.removeTag.html
     * @param string $tagId The tag to remove from the photo. This parameter should
     * contain a tag id, as returned by <a
     * href="/services/api/flickr.photos.getInfo.html">flickr.photos.getInfo</a>.
     * @return
     */
    public function removeTag($tagId)
    {
        $params = [
            'tag_id' => $tagId
        ];
        return $this->flickr->request('flickr.photos.removeTag', $params);
    }

    /**
     * Return a list of photos matching some criteria. Only photos visible to the calling user will be returned. To
     * return private or semi-private photos, the caller must be authenticated with 'read' permissions, and have
     * permission to view the photos. Unauthenticated calls will only return public photos.
     * @link https://www.flickr.com/services/api/flickr.photos.search.html
     * @param array $args See the Flickr API link above for details of the permitted keys of this array.
     * @return array|bool
     */
    public function search($args)
    {
        $result = $this->flickr->request('flickr.photos.search', $args);
        return isset($result['photos']) ? $result['photos'] : false;
    }

    /**
     * Set the content type of a photo.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.setContentType.html
     * @param string $photoId The id of the photo to set the content type of.
     * @param string $contentType The content type of the photo. Must be one of: 1 for
     * Photo, 2 for Screenshot, and 3 for Other.
     * @return
     */
    public function setContentType($photoId, $contentType)
    {
        $params = [
            'photo_id' => $photoId,
            'content_type' => $contentType
        ];
        return $this->flickr->request('flickr.photos.setContentType', $params);
    }

    /**
     * Set one or both of the dates for a photo.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.setDates.html
     * @param int $photoId The ID of the photo to edit dates for.
     * @param DateTime|null $dateTaken The date the photo was taken.
     * @param int $dateTakenGranularity The granularity of the $dateTaken parameter.
     * One of the Util::DATE_GRANULARITY_* constants.
     * @param DateTime|null $datePosted The date the photo was uploaded to Flickr.
     * @return bool True on success.
     */
    public function setDates(
        $photoId,
        DateTime $dateTaken = null,
        $dateTakenGranularity = null,
        DateTime $datePosted = null
    ) {
        $args = ['photo_id' => $photoId];
        if (!empty($dateTaken)) {
            $args['date_taken'] = $dateTaken->format('Y-m-d H:i:s');
        }
        if (!empty($dateTakenGranularity)) {
            $args['date_taken_granularity'] = $dateTakenGranularity;
        }
        if (!empty($datePosted)) {
            $args['date_posted'] = $datePosted->format('U');
        }
        $result = $this->flickr->request('flickr.photos.setDates', $args, true);
        return isset($result['stat']) && $result['stat'] === 'ok';
    }

    /**
     * Set the meta information for a photo.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.setMeta.html
     * @param int $photoId The ID of the photo to set information for.
     * @param string $title The title for the photo. At least one of title or description must be set.
     * @param string $description The description for the photo. At least one of title or description must be set.
     * @return bool True on success.
     * @throws FlickrException If neither $title or $description is set.
     */
    public function setMeta($photoId, $title = null, $description = null)
    {
        if (empty($title) && empty($description)) {
            throw new FlickrException('$title or $description must be set');
        }
        $args = ['photo_id' => $photoId];
        if (!empty($title)) {
            $args['title'] = $title;
        }
        if (!empty($description)) {
            $args['description'] = $description;
        }
        $result = $this->flickr->request('flickr.photos.setMeta', $args, true);
        return isset($result['stat']) && $result['stat'] === 'ok';
    }

    /**
     * Set permissions for a photo.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.setPerms.html
     * @param string $photoId The id of the photo to set permissions for.
     * @param string $isPublic 1 to set the photo to public, 0 to set it to private.
     * @param string $isFriend 1 to make the photo visible to friends when private, 0
     * to not.
     * @param string $isFamily 1 to make the photo visible to family when private, 0 to
     * not.
     * @param string $permComment who can add comments to the photo and it's notes. one
     * of:<br /> <code>0</code>: nobody<br /> <code>1</code>: friends &amp; family<br
     * /> <code>2</code>: contacts<br /> <code>3</code>: everybody
     * @param string $permAddmeta who can add notes and tags to the photo. one of:<br
     * /> <code>0</code>: nobody / just the owner<br /> <code>1</code>: friends &amp;
     * family<br /> <code>2</code>: contacts<br /> <code>3</code>: everybody
     * @return
     */
    public function setPerms($photoId, $isPublic, $isFriend, $isFamily, $permComment = null, $permAddmeta = null)
    {
        $params = [
            'photo_id' => $photoId,
            'is_public' => $isPublic,
            'is_friend' => $isFriend,
            'is_family' => $isFamily,
            'perm_comment' => $permComment,
            'perm_addmeta' => $permAddmeta
        ];
        return $this->flickr->request('flickr.photos.setPerms', $params);
    }

    /**
     * Set the safety level of a photo.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.setSafetyLevel.html
     * @param string $photoId The id of the photo to set the adultness of.
     * @param string $safetyLevel The safety level of the photo.  Must be one of:  1
     * for Safe, 2 for Moderate, and 3 for Restricted.
     * @param string $hidden Whether or not to additionally hide the photo from public
     * searches.  Must be either 1 for Yes or 0 for No.
     * @return
     */
    public function setSafetyLevel($photoId, $safetyLevel = null, $hidden = null)
    {
        $params = [
            'photo_id' => $photoId,
            'safety_level' => $safetyLevel,
            'hidden' => $hidden
        ];
        return $this->flickr->request('flickr.photos.setSafetyLevel', $params);
    }

    /**
     * Set all of the tags for a photo, replacing any that are already there.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.setTags.html
     * @param int $photoId The photo ID.
     * @param string $tags All tags for the photo (as a single space-delimited string; tags with spaces in them should
     * be quoted).
     * @return bool
     */
    public function setTags($photoId, $tags)
    {
        $result = $this->flickr->request('flickr.photos.setTags', ['photo_id' => $photoId, 'tags' => $tags], true);
        return isset($result['stat']) && $result['stat'] === 'ok';
    }
}
