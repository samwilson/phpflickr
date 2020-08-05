<?php

namespace Samwilson\PhpFlickr;

class PhotosCommentsApi extends ApiMethodGroup
{
    /**
     * Add comment to a photo as the currently authenticated user.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.comments.addComment.html
     * @param string $photoId The id of the photo to add a comment to.
     * @param string $commentText Text of the comment
     * @return
     */
    public function addComment($photoId, $commentText)
    {
        $params = [
            'photo_id' => $photoId,
            'comment_text' => $commentText
        ];
        return $this->flickr->request('flickr.photos.comments.addComment', $params);
    }

    /**
     * Delete a comment as the currently authenticated user.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.comments.deleteComment.html
     * @param string $commentId The id of the comment to edit.
     * @return
     */
    public function deleteComment($commentId)
    {
        $params = [
            'comment_id' => $commentId
        ];
        return $this->flickr->request('flickr.photos.comments.deleteComment', $params);
    }

    /**
     * Edit the text of a comment as the currently authenticated user.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.comments.editComment.html
     * @param string $commentId The id of the comment to edit.
     * @param string $commentText Update the comment to this text.
     * @return
     */
    public function editComment($commentId, $commentText)
    {
        $params = [
            'comment_id' => $commentId,
            'comment_text' => $commentText
        ];
        return $this->flickr->request('flickr.photos.comments.editComment', $params);
    }

    /**
     * Returns the comments for a photo
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.comments.getList.html
     * @param string $photoId The id of the photo to fetch comments for.
     * @param string $minCommentDate Minimum date that a a comment was added. The date
     * should be in the form of a unix timestamp.
     * @param string $maxCommentDate Maximum date that a comment was added. The date
     * should be in the form of a unix timestamp.
     * @return
     */
    public function getList($photoId, $minCommentDate = null, $maxCommentDate = null)
    {
        $params = [
            'photo_id' => $photoId,
            'min_comment_date' => $minCommentDate,
            'max_comment_date' => $maxCommentDate
        ];
        return $this->flickr->request('flickr.photos.comments.getList', $params);
    }

    /**
     * Return the list of photos belonging to your contacts that have been commented on
     * recently.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.comments.getRecentForContacts.html
     * @param string $dateLastcomment Limits the resultset to photos that have been
     * commented on since this date. The date should be in the form of a Unix
     * timestamp.<br /><br /> The default, and maximum, offset is (1) hour.
     * @param string $contactsFilter A comma-separated list of contact NSIDs to limit
     * the scope of the query to.
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
    public function getRecentForContacts(
        $dateLastcomment = null,
        $contactsFilter = null,
        $extras = null,
        $perPage = null,
        $page = null
    ) {
        $params = [
            'date_lastcomment' => $dateLastcomment,
            'contacts_filter' => $contactsFilter,
            'extras' => $extras,
            'per_page' => $perPage,
            'page' => $page
        ];
        return $this->flickr->request('flickr.photos.comments.getRecentForContacts', $params);
    }
}
