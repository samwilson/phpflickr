<?php

namespace Samwilson\PhpFlickr;

class GroupsMembersApi extends ApiMethodGroup
{
    /**
     * Get a list of the members of a group.  The call must be signed on behalf of a
     * Flickr member, and the ability to see the group membership will be determined by
     * the Flickr member's group privileges.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.groups.members.getList.html
     * @param string $groupId Return a list of members for this group.  The group must
     * be viewable by the Flickr member on whose behalf the API call is made.
     * @param string $membertypes Comma separated list of member types <ul> <li>2:
     * member</li> <li>3: moderator</li> <li>4: admin</li> </ul> By default returns all
     * types.  (Returning super rare member type "1: narwhal" isn't supported by this
     * API method)
     * @param string $perPage Number of members to return per page. If this argument is
     * omitted, it defaults to 100. The maximum allowed value is 500.
     * @param string $page The page of results to return. If this argument is omitted,
     * it defaults to 1.
     * @return
     */
    public function getList($groupId, $membertypes = null, $perPage = null, $page = null)
    {
        $params = [
            'group_id' => $groupId,
            'membertypes' => $membertypes,
            'per_page' => $perPage,
            'page' => $page
        ];
        return $this->flickr->request('flickr.groups.members.getList', $params);
    }
}
