<?php

namespace Samwilson\PhpFlickr;

class PhotosetsCommentsApi extends ApiMethodGroup
{
    /**
     * Add a comment to a photoset.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photosets.comments.addComment.html
     * @param string $photosetId The id of the photoset to add a comment to.
     * @param string $commentText Text of the comment
     * @return
     */
    public function addComment($photosetId, $commentText)
    {
        $params = [
            'photoset_id' => $photosetId,
            'comment_text' => $commentText
        ];
        return $this->flickr->request('flickr.photosets.comments.addComment', $params);
    }

    /**
     * Delete a photoset comment as the currently authenticated user.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photosets.comments.deleteComment.html
     * @param string $commentId The id of the comment to delete from a photoset.
     * @return
     */
    public function deleteComment($commentId)
    {
        $params = [
            'comment_id' => $commentId
        ];
        return $this->flickr->request('flickr.photosets.comments.deleteComment', $params);
    }

    /**
     * Edit the text of a comment as the currently authenticated user.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photosets.comments.editComment.html
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
        return $this->flickr->request('flickr.photosets.comments.editComment', $params);
    }

    /**
     * Returns the comments for a photoset.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photosets.comments.getList.html
     * @param string $photosetId The id of the photoset to fetch comments for.
     * @return
     */
    public function getList($photosetId)
    {
        $params = [
            'photoset_id' => $photosetId
        ];
        return $this->flickr->request('flickr.photosets.comments.getList', $params);
    }
}
