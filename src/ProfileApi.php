<?php

namespace Samwilson\PhpFlickr;

class ProfileApi extends ApiMethodGroup
{
    /**
     * Returns specified user's profile info, respecting profile privacy settings
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.profile.getProfile.html
     * @param string $userId The NSID of the user to fetch profile information for.
     * @return
     */
    public function getProfile($userId)
    {
        $params = [
            'user_id' => $userId
        ];
        return $this->flickr->request('flickr.profile.getProfile', $params);
    }
}
