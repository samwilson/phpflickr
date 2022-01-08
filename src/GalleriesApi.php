<?php

namespace Samwilson\PhpFlickr;

class GalleriesApi extends ApiMethodGroup
{
    /**
     * Add a photo to a gallery.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.galleries.addPhoto.html
     * @param string $galleryId The ID of the gallery to add a photo to.  Note: this is
     * the compound ID returned in methods like <a
     * href="/services/api/flickr.galleries.getList.html">flickr.galleries.getList</a>,
     * and <a
     * href="/services/api/flickr.galleries.getListForPhoto.html">flickr.galleries.getListForPhoto</a>.
     * @param string $photoId The photo ID to add to the gallery
     * @param string $comment A short comment or story to accompany the photo.
     * @param string $fullResponse If specified, return updated details of the gallery
     * the photo was added to
     * @return
     */
    public function addPhoto($galleryId, $photoId, $comment = null, $fullResponse = null)
    {
        $params = [
            'gallery_id' => $galleryId,
            'photo_id' => $photoId,
            'comment' => $comment,
            'full_response' => $fullResponse
        ];
        return $this->flickr->request('flickr.galleries.addPhoto', $params);
    }

    /**
     * Create a new gallery for the calling user.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.galleries.create.html
     * @param string $title The name of the gallery
     * @param string $description A short description for the gallery
     * @param string $primaryPhotoId The first photo to add to your gallery
     * @param string $fullResult Get the result in the same format as galleries.getList
     * @return
     */
    public function create($title, $description, $primaryPhotoId = null, $fullResult = null)
    {
        $params = [
            'title' => $title,
            'description' => $description,
            'primary_photo_id' => $primaryPhotoId,
            'full_result' => $fullResult
        ];
        return $this->flickr->request('flickr.galleries.create', $params);
    }

    /**
     * Modify the meta-data for a gallery.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.galleries.editMeta.html
     * @param string $galleryId The gallery ID to update.
     * @param string $title The new title for the gallery.
     * @param string $description The new description for the gallery.
     * @return
     */
    public function editMeta($galleryId, $title, $description = null)
    {
        $params = [
            'gallery_id' => $galleryId,
            'title' => $title,
            'description' => $description
        ];
        return $this->flickr->request('flickr.galleries.editMeta', $params);
    }

    /**
     * Edit the comment for a gallery photo.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.galleries.editPhoto.html
     * @param string $galleryId The ID of the gallery to add a photo to. Note: this is
     * the compound ID returned in methods like flickr.galleries.getList, and
     * flickr.galleries.getListForPhoto.
     * @param string $photoId The photo ID to add to the gallery.
     * @param string $comment The updated comment the photo.
     * @return
     */
    public function editPhoto($galleryId, $photoId, $comment)
    {
        $params = [
            'gallery_id' => $galleryId,
            'photo_id' => $photoId,
            'comment' => $comment
        ];
        return $this->flickr->request('flickr.galleries.editPhoto', $params);
    }

    /**
     * Modify the photos in a gallery. Use this method to add, remove and re-order
     * photos.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.galleries.editPhotos.html
     * @param string $galleryId The id of the gallery to modify. The gallery must
     * belong to the calling user.
     * @param string $primaryPhotoId The id of the photo to use as the 'primary' photo
     * for the gallery. This id must also be passed along in photo_ids list argument.
     * @param string $photoIds A comma-delimited list of photo ids to include in the
     * gallery. They will appear in the set in the order sent. This list must contain
     * the primary photo id. This list of photos replaces the existing list.
     * @return
     */
    public function editPhotos($galleryId, $primaryPhotoId, $photoIds)
    {
        $params = [
            'gallery_id' => $galleryId,
            'primary_photo_id' => $primaryPhotoId,
            'photo_ids' => $photoIds
        ];
        return $this->flickr->request('flickr.galleries.editPhotos', $params);
    }

    /**
     *
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.galleries.getInfo.html
     * @param string $galleryId The gallery ID you are requesting information for.
     * @param string $primaryPhotoSize size of the primary photo
     * @param string $coverPhotosSize size of the cover photos (excluding the primary photo)
     * @param string $limit number of cover photos to fetch for galleries without a
     * primary photo. Default is 6
     * @param string $shortLimit number of cover photos to fetch (excluding primary
     * photo) for galleries with a primary photo. Default is 2.
     * @return
     */
    public function getInfo(
        $galleryId,
        $primaryPhotoSize = null,
        $coverPhotosSize = null,
        $limit = null,
        $shortLimit = null
    ) {
        $params = [
            'gallery_id' => $galleryId,
            'primary_photo_size' => $primaryPhotoSize,
            'cover_photos_size' => $coverPhotosSize,
            'limit' => $limit,
            'short_limit' => $shortLimit
        ];
        return $this->flickr->request('flickr.galleries.getInfo', $params);
    }

    /**
     * Return the list of galleries created by a user.  Sorted from newest to oldest.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.galleries.getList.html
     * @param string $userId The NSID of the user to get a galleries list for. If none
     * is specified, the calling user is assumed.
     * @param string $shortLimit number of cover photos to fetch (excluding primary
     * photo) for galleries with a primary photo. Default is 2.
     * @param string $continuation The first request must pass the "continuation"
     * parameter with the value of "0". The server responds back with a response that
     * includes the "continuation" field along with "pages" and "total" fields in the
     * response. For the subsequent requests, the client must relay the value of the
     * "continuation" response field as the value of the "continuation" request
     * parameter. On the last page of results, the server will respond with a
     * continuation value of "-1".
     * @param string $perPage Number of galleries to return per page. If this argument
     * is omitted, it defaults to 100. The maximum allowed value is 500.
     * @param string $page The page of results to return. If this argument is omitted,
     * it defaults to 1.
     * @param string $primaryPhotoExtras A comma-delimited list of extra information to
     * fetch for the primary photo. Currently supported fields are: license,
     * date_upload, date_taken, owner_name, icon_server, original_format, last_update,
     * geo, tags, machine_tags, o_dims, views, media, path_alias, url_sq, url_t, url_s,
     * url_m, url_o
     * @param string $sortGroups A comma-separated list of groups used to sort the
     * output sets. If has_photo is present, any of the calling user's galleries
     * containing photos referred to in photo_ids will be returned before other
     * galleries. If suggested is present, a number of suggested galleries will be
     * returned before other sets. The order of the sort_groups will dictate the order
     * that the groups are returned in. Only available if continuation is used. The
     * resulting output will include a "sort_group" parameter indicating the sort_group
     * that each set is part of, or null if not applicable
     * @param string $photoIds A comma-separated list of photo ids. If specified along
     * with has_photo in sort_groups, each returned gallery will include a list of
     * these photo ids that are present in the gallery as "has_requested_photos"
     * @param string $coverPhotos set to 1 if cover photos for galleries should be
     * returned. If primary photo exists, 1 primary photo and 2 other photos will be
     * returned (in order). If not, 6 photos in order will be returned
     * @param string $primaryPhotoCoverSize size of primary photo on the cover (if
     * primary photo exists in gallery). will default to 'q' if not set
     * @param string $coverPhotosSize size of cover photos (will default to 'q' if not
     * set)
     * @param string $limit number of cover photos to fetch for galleries without a
     * primary photo. Default is 6
     * @return
     */
    public function getList(
        $userId,
        $shortLimit,
        $continuation = 0,
        $perPage = null,
        $page = null,
        $primaryPhotoExtras = null,
        $sortGroups = null,
        $photoIds = null,
        $coverPhotos = null,
        $primaryPhotoCoverSize = null,
        $coverPhotosSize = null,
        $limit = null
    ) {
        $params = [
            'user_id' => $userId,
            'per_page' => $perPage,
            'page' => $page,
            'primary_photo_extras' => $primaryPhotoExtras,
            'continuation' => $continuation,
            'sort_groups' => $sortGroups,
            'photo_ids' => $photoIds,
            'cover_photos' => $coverPhotos,
            'primary_photo_cover_size' => $primaryPhotoCoverSize,
            'cover_photos_size' => $coverPhotosSize,
            'limit' => $limit,
            'short_limit' => $shortLimit
        ];
        return $this->flickr->request('flickr.galleries.getList', $params);
    }

    /**
     * Return the list of galleries to which a photo has been added.  Galleries are
     * returned sorted by date which the photo was added to the gallery.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.galleries.getListForPhoto.html
     * @param string $photoId The ID of the photo to fetch a list of galleries for.
     * @param string $perPage Number of galleries to return per page. If this argument
     * is omitted, it defaults to 100. The maximum allowed value is 500.
     * @param string $page The page of results to return. If this argument is omitted,
     * it defaults to 1.
     * @return
     */
    public function getListForPhoto($photoId, $perPage = null, $page = null)
    {
        $params = [
            'photo_id' => $photoId,
            'per_page' => $perPage,
            'page' => $page
        ];
        return $this->flickr->request('flickr.galleries.getListForPhoto', $params);
    }

    /**
     * Return the list of photos for a gallery
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.galleries.getPhotos.html
     * @param string $galleryId The ID of the gallery of photos to return
     * @param string $continuation Using this parameter indicates to the server that
     * the client is using the new, continuation based pagination rather than the older
     * page/per_page based pagination. The first request must pass the "continuation"
     * parameter with the value of "0". The server responds back with a response that
     * includes the "continuation" field along with the "per_page" field in the
     * response. For the subsequent requests, the client must relay the value of the
     * "continuation" response field as the value of the "continuation" request
     * parameter. On the last page of results, the server will respond with a
     * continuation value of "-1".
     * @param string $perPage Number of photos to return per page. If this argument is
     * omitted, it defaults to 100. The maximum allowed value is 500.
     * @param string $getUserInfo set to 1 if user details should be returned
     * @param string $getGalleryInfo if set to 1, info about the gallery is also
     * returned
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
     * @param string $page The page of results to return. If this argument is omitted,
     * it defaults to 1.
     * @return
     */
    public function getPhotos(
        $galleryId,
        $continuation = null,
        $perPage = null,
        $getUserInfo = null,
        $getGalleryInfo = null,
        $extras = null,
        $page = null
    ) {
        $params = [
            'gallery_id' => $galleryId,
            'continuation' => $continuation,
            'per_page' => $perPage,
            'get_user_info' => $getUserInfo,
            'get_gallery_info' => $getGalleryInfo,
            'extras' => $extras,
            'page' => $page
        ];
        return $this->flickr->request('flickr.galleries.getPhotos', $params);
    }

    /**
     * Remove a photo from a gallery.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.galleries.removePhoto.html
     * @param string $galleryId The ID of the gallery to remove a photo from
     * @param string $photoId The ID of the photo to remove from the gallery
     * @param string $fullResponse If specified, return updated details of the gallery
     * the photo was removed from
     * @return
     */
    public function removePhoto($galleryId, $photoId, $fullResponse)
    {
        $params = [
            'gallery_id' => $galleryId,
            'photo_id' => $photoId,
            'full_response' => $fullResponse
        ];
        return $this->flickr->request('flickr.galleries.removePhoto', $params);
    }
}
