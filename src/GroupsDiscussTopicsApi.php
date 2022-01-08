<?php

namespace Samwilson\PhpFlickr;

class GroupsDiscussTopicsApi extends ApiMethodGroup
{
    /**
     * Post a new discussion topic to a group.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.groups.discuss.topics.add.html
     * @param string $groupId The NSID or path alias of the group to add a topic to.
     * @param string $subject The topic subject.
     * @param string $message The topic message.
     * @return
     */
    public function add($groupId, $subject, $message)
    {
        $params = [
            'group_id' => $groupId,
            'subject' => $subject,
            'message' => $message
        ];
        return $this->flickr->request('flickr.groups.discuss.topics.add', $params);
    }

    /**
     * Get information about a group discussion topic.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.groups.discuss.topics.getInfo.html
     * @param string $groupId NSID or group alias of the group to which the topic
     * belongs. Making this parameter optional for legacy reasons, but it is highly
     * recommended to pass this in to get better performance.
     * @param string $topicId The ID for the topic to edit.
     * @return
     */
    public function getInfo($groupId, $topicId)
    {
        $params = [
            'group_id' => $groupId,
            'topic_id' => $topicId
        ];
        return $this->flickr->request('flickr.groups.discuss.topics.getInfo', $params);
    }

    /**
     * Get a list of discussion topics in a group.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.groups.discuss.topics.getList.html
     * @param string $groupId The NSID or path alias of the group to fetch information
     * for.
     * @param string $perPage Number of photos to return per page. If this argument is
     * omitted, it defaults to 100. The maximum allowed value is 500.
     * @param string $page The page of results to return. If this argument is omitted,
     * it defaults to 1.
     * @return
     */
    public function getList($groupId, $perPage = null, $page = null)
    {
        $params = [
            'group_id' => $groupId,
            'per_page' => $perPage,
            'page' => $page
        ];
        return $this->flickr->request('flickr.groups.discuss.topics.getList', $params);
    }
}
