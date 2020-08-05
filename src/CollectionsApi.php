<?php

namespace Samwilson\PhpFlickr;

class CollectionsApi extends ApiMethodGroup
{
    /**
     * Returns information for a single collection.  Currently can only be called by
     * the collection owner, this may change.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.collections.getInfo.html
     * @param string $collectionId The ID of the collection to fetch information for.
     * @return
     */
    public function getInfo($collectionId)
    {
        $params = [
            'collection_id' => $collectionId
        ];
        return $this->flickr->request('flickr.collections.getInfo', $params);
    }

    /**
     * Returns a tree (or sub tree) of collections belonging to a given user.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.collections.getTree.html
     * @param string $collectionId The ID of the collection to fetch a tree for, or
     * zero to fetch the root collection. Defaults to zero.
     * @param string $userId The ID of the account to fetch the collection tree for.
     * Deafults to the calling user.
     * @return
     */
    public function getTree($collectionId = null, $userId = null)
    {
        $params = [
            'collection_id' => $collectionId,
            'user_id' => $userId
        ];
        return $this->flickr->request('flickr.collections.getTree', $params);
    }
}
