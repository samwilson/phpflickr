<?php

namespace Samwilson\PhpFlickr;

class FavoritesApi extends ApiMethodGroup
{
    /**
     * Adds a photo to a user's favorites list.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.favorites.add.html
     * @param string $photoId The id of the photo to add to the user's favorites.
     * @return
     */
    public function add($photoId)
    {
        $params = [
            'photo_id' => $photoId
        ];
        return $this->flickr->request('flickr.favorites.add', $params);
    }

    /**
     * Returns next and previous favorites for a photo in a user's favorites.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.favorites.getContext.html
     * @param string $photoId The id of the photo to fetch the context for.
     * @param string $userId The user who counts the photo as a favorite.
     * @return
     */
    public function getContext($photoId, $userId)
    {
        $params = [
            'photo_id' => $photoId,
            'user_id' => $userId
        ];
        return $this->flickr->request('flickr.favorites.getContext', $params);
    }

    /**
     * Returns a list of the user's favorite photos. Only photos which the calling user
     * has permission to see are returned.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.favorites.getList.html
     * @param string $userId The NSID of the user to fetch the favorites list for. If
     * this argument is omitted, the favorites list for the calling user is returned.
     * @param string $minFaveDate Minimum date that a photo was favorited on. The date
     * should be in the form of a unix timestamp.
     * @param string $maxFaveDate Maximum date that a photo was favorited on. The date
     * should be in the form of a unix timestamp.
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
    public function getList(
        $userId = null,
        $minFaveDate = null,
        $maxFaveDate = null,
        $extras = null,
        $perPage = null,
        $page = null
    ) {
        $params = [
            'user_id' => $userId,
            'min_fave_date' => $minFaveDate,
            'max_fave_date' => $maxFaveDate,
            'extras' => $extras,
            'per_page' => $perPage,
            'page' => $page
        ];
        return $this->flickr->request('flickr.favorites.getList', $params);
    }

    /**
     * Returns a list of favorite public photos for the given user.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.favorites.getPublicList.html
     * @param string $userId The user to fetch the favorites list for.
     * @param string $minFaveDate Minimum date that a photo was favorited on. The date
     * should be in the form of a unix timestamp.
     * @param string $maxFaveDate Maximum date that a photo was favorited on. The date
     * should be in the form of a unix timestamp.
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
    public function getPublicList(
        $userId,
        $minFaveDate = null,
        $maxFaveDate = null,
        $extras = null,
        $perPage = null,
        $page = null
    ) {
        $params = [
            'user_id' => $userId,
            'min_fave_date' => $minFaveDate,
            'max_fave_date' => $maxFaveDate,
            'extras' => $extras,
            'per_page' => $perPage,
            'page' => $page
        ];
        return $this->flickr->request('flickr.favorites.getPublicList', $params);
    }

    /**
     * Removes a photo from a user's favorites list.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.favorites.remove.html
     * @param string $photoId The id of the photo to remove from the user's favorites.
     * @return
     */
    public function remove($photoId)
    {
        $params = [
            'photo_id' => $photoId
        ];
        return $this->flickr->request('flickr.favorites.remove', $params);
    }
}
