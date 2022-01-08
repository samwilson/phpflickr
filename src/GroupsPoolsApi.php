<?php

namespace Samwilson\PhpFlickr;

class GroupsPoolsApi extends ApiMethodGroup
{
    /**
     * Add a photo to a group's pool.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.groups.pools.add.html
     * @param string $photoId The id of the photo to add to the group pool. The photo
     * must belong to the calling user.
     * @param string $groupId The NSID of the group who's pool the photo is to be added
     * to.
     * @return
     */
    public function add($photoId, $groupId)
    {
        $params = [
            'photo_id' => $photoId,
            'group_id' => $groupId
        ];
        return $this->flickr->request('flickr.groups.pools.add', $params);
    }

    /**
     * Returns next and previous photos for a photo in a group pool.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.groups.pools.getContext.html
     * @param string $photoId The id of the photo to fetch the context for.
     * @param string $groupId The nsid of the group who's pool to fetch the photo's
     * context for.
     * @return
     */
    public function getContext($photoId, $groupId)
    {
        $params = [
            'photo_id' => $photoId,
            'group_id' => $groupId
        ];
        return $this->flickr->request('flickr.groups.pools.getContext', $params);
    }

    /**
     * Returns a list of groups to which you can add photos.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.groups.pools.getGroups.html
     * @param string $page The page of results to return. If this argument is omitted,
     * it defaults to 1.
     * @param string $perPage Number of groups to return per page. If this argument is
     * omitted, it defaults to 400. The maximum allowed value is 400.
     * @return
     */
    public function getGroups($page = null, $perPage = null)
    {
        $params = [
            'page' => $page,
            'per_page' => $perPage
        ];
        return $this->flickr->request('flickr.groups.pools.getGroups', $params);
    }

    /**
     * Returns a list of pool photos for a given group, based on the permissions of the
     * group and the user logged in (if any).
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.groups.pools.getPhotos.html
     * @param string $groupId The id of the group who's pool you which to get the photo
     * list for.
     * @param string $tags A tag to filter the pool with. At the moment only one tag at
     * a time is supported.
     * @param string $userId The nsid of a user. Specifiying this parameter will
     * retrieve for you only those photos that the user has contributed to the group
     * pool.
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
    public function getPhotos($groupId, $tags = null, $userId = null, $extras = null, $perPage = null, $page = null)
    {
        $params = [
            'group_id' => $groupId,
            'tags' => $tags,
            'user_id' => $userId,
            'extras' => $extras,
            'per_page' => $perPage,
            'page' => $page
        ];
        return $this->flickr->request('flickr.groups.pools.getPhotos', $params);
    }

    /**
     * Remove a photo from a group pool.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.groups.pools.remove.html
     * @param string $photoId The id of the photo to remove from the group pool. The
     * photo must either be owned by the calling user of the calling user must be an
     * administrator of the group.
     * @param string $groupId The NSID of the group who's pool the photo is to removed
     * from.
     * @return
     */
    public function remove($photoId, $groupId)
    {
        $params = [
            'photo_id' => $photoId,
            'group_id' => $groupId
        ];
        return $this->flickr->request('flickr.groups.pools.remove', $params);
    }
}
