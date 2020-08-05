<?php

namespace Samwilson\PhpFlickr;

class PeopleApi extends ApiMethodGroup
{
    /**
     * Return a user's NSID, given their email address
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.people.findByEmail.html
     * @param string $findEmail The email address of the user to find (may be primary or secondary).
     * @return string|bool
     */
    public function findByEmail($findEmail)
    {
        $response = $this->flickr->request(
            'flickr.people.findByEmail',
            ['find_email' => $findEmail]
        );
        return isset($response['user']) ? $response['user'] : false;
    }

    /**
     * Return a user's NSID, given their username.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.people.findByUsername.html
     * @param string $username The username of the user to lookup.
     * @return string|bool
     */
    public function findByUsername($username)
    {
        $response = $this->flickr->request(
            'flickr.people.findByUsername',
            ['username' => $username]
        );
        return isset($response['user']) ? $response['user'] : false;
    }

    /**
     * Returns the list of groups a user is a member of.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.people.getGroups.html
     * @param string $userId The NSID of the user to fetch groups for.
     * @param string $extras A comma-delimited list of extra information to fetch for
     * each returned record. Currently supported fields are: <code>privacy</code>,
     * <code>throttle</code>, <code>restrictions</code>
     * @return
     */
    public function getGroups($userId, $extras = null)
    {
        $params = [
            'user_id' => $userId,
            'extras' => $extras
        ];
        return $this->flickr->request('flickr.people.getGroups', $params);
    }

    /**
     * Get information about a user.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.people.getInfo.html
     * @param string $userId The NSID of the user to fetch information about.
     * @return
     */
    public function getInfo($userId)
    {
        $params = [
            'user_id' => $userId
        ];
        return $this->flickr->request('flickr.people.getInfo', $params);
    }

    /**
     * Returns the photo and video limits that apply to the calling user account.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.people.getLimits.html
     *
     * @return
     */
    public function getLimits()
    {
        return $this->flickr->request('flickr.people.getLimits');
    }

    /**
     * Return photos from the given user's photostream.
     * Only photos visible to the calling user will be returned.
     * This method must be authenticated;
     * to return public photos for a user, use self::getPublicPhotos().
     * @link https://www.flickr.com/services/api/flickr.people.getPhotos.html
     * @param string $userId The NSID of the user who's photos to return. A value of
     * "me" will return the calling user's photos.
     * @param int $safeSearch Safe search setting: 1 for safe. 2 for moderate. 3 for
     * restricted. (Please note: Un-authed calls can only see Safe content.)
     * @param string $minUploadDate Minimum upload date. Photos with an upload date greater than or
     * equal to this value will be returned. The date should be in the form of a unix timestamp.
     * @param string $maxUploadDate Maximum upload date. Photos with an upload date less than or
     * equal to this value will be returned. The date should be in the form of a unix timestamp.
     * @param string $minTakenDate Minimum taken date. Photos with an taken date greater than or
     * equal to this value will be returned. The date should be in the form of a mysql datetime.
     * @param string $maxTakenDate Maximum taken date. Photos with an taken date less than or equal
     * to this value will be returned. The date should be in the form of a mysql datetime.
     * @param int $contentType Content Type setting:
     * 1 for photos only.
     * 2 for screenshots only.
     * 3 for 'other' only.
     * 4 for photos and screenshots.
     * 5 for screenshots and 'other'.
     * 6 for photos and 'other'.
     * 7 for photos, screenshots, and 'other' (all).
     * @param int $privacyFilter Return photos only matching a certain privacy level. This only
     * applies when making an authenticated call to view photos you own. Valid values are:
     * 1 public photos
     * 2 private photos visible to friends
     * 3 private photos visible to family
     * 4 private photos visible to friends & family
     * 5 completely private photos
     * @param string $extras A comma-delimited list of extra information to fetch for each
     * returned record. Currently supported fields are: description, license, date_upload,
     * date_taken, owner_name, icon_server, original_format, last_update, geo, tags, machine_tags,
     * o_dims, views, media, path_alias, url_sq, url_t, url_s, url_q, url_m, url_n, url_z, url_c,
     * url_l, url_o
     * @param int $perPage Number of photos to return per page. The maximum allowed value is 500.
     * @param int $page The page of results to return.
     * @return string[]|bool Photo information, or false if none.
     */
    public function getPhotos(
        $userId = 'me',
        $safeSearch = null,
        $minUploadDate = null,
        $maxUploadDate = null,
        $minTakenDate = null,
        $maxTakenDate = null,
        $contentType = null,
        $privacyFilter = null,
        $extras = null,
        $perPage = 100,
        $page = 1
    ) {
        $params = [
            'user_id' => $userId,
            'safe_search' => $safeSearch,
            'min_upload_date' => $minUploadDate,
            'max_upload_date' => $maxUploadDate,
            'min_taken_date' => $minTakenDate,
            'max_taken_date' => $maxTakenDate,
            'content_type' => $contentType,
            'privacy_filter' => $privacyFilter,
            'extras' => $extras,
            'per_page' => $perPage,
            'page' => $page,
        ];
        $photos = $this->flickr->request('flickr.people.getPhotos', $params);
        return isset($photos['photos']) ? $photos['photos'] : false;
    }

    /**
     * Returns a list of photos containing a particular Flickr member.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.people.getPhotosOf.html
     * @param string $userId The NSID of the user you want to find photos of. A value
     * of "me" will search against photos of the calling user, for authenticated calls.
     * @param string $ownerId An NSID of a Flickr member. This will restrict the list
     * of photos to those taken by that member.
     * @param string $extras A comma-delimited list of extra information to fetch for
     * each returned record. Currently supported fields are: <code>description</code>,
     * <code>license</code>, <code>date_upload</code>, <code>date_taken</code>,
     * <code>date_person_added</code>, <code>owner_name</code>,
     * <code>icon_server</code>, <code>original_format</code>,
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
    public function getPhotosOf($userId, $ownerId = null, $extras = null, $perPage = null, $page = null)
    {
        $params = [
            'user_id' => $userId,
            'owner_id' => $ownerId,
            'extras' => $extras,
            'per_page' => $perPage,
            'page' => $page,
        ];
        return $this->flickr->request('flickr.people.getPhotosOf', $params);
    }

    /**
     * Returns the list of public groups a user is a member of.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.people.getPublicGroups.html
     * @param string $userId The NSID of the user to fetch groups for.
     * @param string $invitationOnly Include public groups that require <a
     * href="http://www.flickr.com/help/groups/#10">an invitation</a> or administrator
     * approval to join.
     * @return
     */
    public function getPublicGroups($userId, $invitationOnly = null)
    {
        $params = [
            'user_id' => $userId,
            'invitation_only' => $invitationOnly
        ];
        return $this->flickr->request('flickr.people.getPublicGroups', $params);
    }

    /**
     * Get a list of public photos for the given user.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.people.getPublicPhotos.html
     * @param string $userId The NSID of the user who's photos to return.
     * @param string $safeSearch Safe search setting:  <ul> <li>1 for safe.</li> <li>2
     * for moderate.</li> <li>3 for restricted.</li> </ul>  (Please note: Un-authed
     * calls can only see Safe content.)
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
    public function getPublicPhotos($userId, $safeSearch = null, $extras = null, $perPage = null, $page = null)
    {
        $params = [
            'user_id' => $userId,
            'safe_search' => $safeSearch,
            'extras' => $extras,
            'per_page' => $perPage,
            'page' => $page
        ];
        return $this->flickr->request('flickr.people.getPublicPhotos', $params);
    }

    /**
     * Returns information for the calling user related to photo uploads.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.people.getUploadStatus.html
     *
     * @return
     */
    public function getUploadStatus()
    {
        return $this->flickr->request('flickr.people.getUploadStatus');
    }
}
