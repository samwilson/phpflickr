<?php

namespace Samwilson\PhpFlickr;

class GroupsApi extends ApiMethodGroup
{
    /**
     * Browse the group category tree, finding groups and sub-categories.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.groups.browse.html
     * @param string $catId The category id to fetch a list of groups and
     * sub-categories for. If not specified, it defaults to zero, the root of the
     * category tree.
     * @return
     */
    public function browse($catId = null)
    {
        $params = [
            'cat_id' => $catId
        ];
        return $this->flickr->request('flickr.groups.browse', $params);
    }

    /**
     * Get information about a group.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.groups.getInfo.html
     * @param string $groupId The NSID of the group to fetch information for.
     * @param string $groupPathAlias The path alias of the group. One of this or the
     * group_id param is required
     * @param string $lang The language of the group name and description to fetch.  If
     * the language is not found, the primary language of the group will be returned.
     * Valid values are the same as <a href="/services/feeds/">in feeds</a>.
     * @return
     */
    public function getInfo($groupId, $groupPathAlias = null, $lang = null)
    {
        $params = [
            'group_id' => $groupId,
            'group_path_alias' => $groupPathAlias,
            'lang' => $lang
        ];
        return $this->flickr->request('flickr.groups.getInfo', $params);
    }

    /**
     * Join a public group as a member.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.groups.join.html
     * @param string $groupId The NSID of the Group in question
     * @param string $acceptRules If the group has rules, they must be displayed to the
     * user prior to joining. Passing a true value for this argument specifies that the
     * application has displayed the group rules to the user, and that the user has
     * agreed to them. (See flickr.groups.getInfo).
     * @return
     */
    public function join($groupId, $acceptRules = null)
    {
        $params = [
            'group_id' => $groupId,
            'accept_rules' => $acceptRules
        ];
        return $this->flickr->request('flickr.groups.join', $params);
    }

    /**
     * Request to join a group that is invitation-only.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.groups.joinRequest.html
     * @param string $groupId The NSID of the group to request joining.
     * @param string $message Message to the administrators.
     * @param string $acceptRules If the group has rules, they must be displayed to the
     * user prior to joining. Passing a true value for this argument specifies that the
     * application has displayed the group rules to the user, and that the user has
     * agreed to them. (See flickr.groups.getInfo).
     * @return
     */
    public function joinRequest($groupId, $message, $acceptRules)
    {
        $params = [
            'group_id' => $groupId,
            'message' => $message,
            'accept_rules' => $acceptRules
        ];
        return $this->flickr->request('flickr.groups.joinRequest', $params);
    }

    /**
     * Leave a group.

<br /><br />If the user is the only administrator left, and
     * there are other members, the oldest member will be promoted to
     * administrator.

<br /><br />If the user is the last person in the group, the
     * group will be deleted.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.groups.leave.html
     * @param string $groupId The NSID of the Group to leave
     * @param string $deletePhotos Delete all photos by this user from the group
     * @return
     */
    public function leave($groupId, $deletePhotos = null)
    {
        $params = [
            'group_id' => $groupId,
            'delete_photos' => $deletePhotos
        ];
        return $this->flickr->request('flickr.groups.leave', $params);
    }

    /**
     * Search for groups. 18+ groups will only be returned for authenticated calls
     * where the authenticated user is over 18.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.groups.search.html
     * @param string $text The text to search for.
     * @param string $perPage Number of groups to return per page. If this argument is
     * ommited, it defaults to 100. The maximum allowed value is 500.
     * @param string $page The page of results to return. If this argument is ommited,
     * it defaults to 1.
     * @return
     */
    public function search($text, $perPage = null, $page = null)
    {
        $params = [
            'text' => $text,
            'per_page' => $perPage,
            'page' => $page
        ];
        return $this->flickr->request('flickr.groups.search', $params);
    }
}
