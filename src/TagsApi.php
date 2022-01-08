<?php

namespace Samwilson\PhpFlickr;

class TagsApi extends ApiMethodGroup
{
    /**
     * Returns the first 24 photos for a given tag cluster
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.tags.getClusterPhotos.html
     * @param string $tag The tag that this cluster belongs to.
     * @param string $clusterId The top three tags for the cluster, separated by dashes
     * (just like the url).
     * @return
     */
    public function getClusterPhotos($tag, $clusterId)
    {
        $params = [
            'tag' => $tag,
            'cluster_id' => $clusterId
        ];
        return $this->flickr->request('flickr.tags.getClusterPhotos', $params);
    }

    /**
     * Gives you a list of tag clusters for the given tag.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.tags.getClusters.html
     * @param string $tag The tag to fetch clusters for.
     * @return
     */
    public function getClusters($tag)
    {
        $params = [
            'tag' => $tag
        ];
        return $this->flickr->request('flickr.tags.getClusters', $params);
    }

    /**
     * Returns a list of hot tags for the given period.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.tags.getHotList.html
     * @param string $period The period for which to fetch hot tags. Valid values are
     * <code>day</code> and <code>week</code> (defaults to <code>day</code>).
     * @param string $count The number of tags to return. Defaults to 20. Maximum
     * allowed value is 200.
     * @return
     */
    public function getHotList($period = null, $count = null)
    {
        $params = [
            'period' => $period,
            'count' => $count
        ];
        return $this->flickr->request('flickr.tags.getHotList', $params);
    }

    /**
     * Get the tag list for a given photo.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.tags.getListPhoto.html
     * @param string $photoId The id of the photo to return tags for.
     * @return
     */
    public function getListPhoto($photoId)
    {
        $params = [
            'photo_id' => $photoId
        ];
        return $this->flickr->request('flickr.tags.getListPhoto', $params);
    }

    /**
     * Get the tag list for a given user (or the currently logged in user).
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.tags.getListUser.html
     * @param string $userId The NSID of the user to fetch the tag list for. If this
     * argument is not specified, the currently logged in user (if any) is assumed.
     * @return
     */
    public function getListUser($userId = null)
    {
        $params = [
            'user_id' => $userId
        ];
        return $this->flickr->request('flickr.tags.getListUser', $params);
    }

    /**
     * Get the popular tags for a given user (or the currently logged in user).
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.tags.getListUserPopular.html
     * @param string $userId The NSID of the user to fetch the tag list for. If this
     * argument is not specified, the currently logged in user (if any) is assumed.
     * @param string $count Number of popular tags to return. defaults to 10 when this
     * argument is not present.
     * @return
     */
    public function getListUserPopular($userId = null, $count = null)
    {
        $params = [
            'user_id' => $userId,
            'count' => $count
        ];
        return $this->flickr->request('flickr.tags.getListUserPopular', $params);
    }

    /**
     * Get the raw versions of a given tag (or all tags) for the currently logged-in
     * user.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.tags.getListUserRaw.html
     * @param string $tag The tag you want to retrieve all raw versions for.
     * @return
     */
    public function getListUserRaw($tag = null)
    {
        $params = [
            'tag' => $tag
        ];
        return $this->flickr->request('flickr.tags.getListUserRaw', $params);
    }

    /**
     * Returns a list of most frequently used tags for a user.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.tags.getMostFrequentlyUsed.html
     *
     * @return
     */
    public function getMostFrequentlyUsed()
    {
        return $this->flickr->request('flickr.tags.getMostFrequentlyUsed');
    }

    /**
     * Returns a list of tags 'related' to the given tag, based on clustered usage
     * analysis.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.tags.getRelated.html
     * @param string $tag The tag to fetch related tags for.
     * @return
     */
    public function getRelated($tag)
    {
        $params = [
            'tag' => $tag
        ];
        return $this->flickr->request('flickr.tags.getRelated', $params);
    }
}
