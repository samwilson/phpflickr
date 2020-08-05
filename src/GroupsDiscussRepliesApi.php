<?php

namespace Samwilson\PhpFlickr;

class GroupsDiscussRepliesApi extends ApiMethodGroup
{
    /**
     * Post a new reply to a group discussion topic.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.groups.discuss.replies.add.html
     * @param string $groupId Pass in the group id to where the topic belongs. Can be
     * NSID or group alias. Making this parameter optional for legacy reasons, but it
     * is highly recommended to pass this in to get faster performance.
     * @param string $topicId The ID of the topic to post a comment to.
     * @param string $message The message to post to the topic.
     * @return
     */
    public function add($groupId, $topicId, $message)
    {
        $params = [
            'group_id' => $groupId,
            'topic_id' => $topicId,
            'message' => $message
        ];
        return $this->flickr->request('flickr.groups.discuss.replies.add', $params);
    }

    /**
     * Delete a reply from a group topic.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.groups.discuss.replies.delete.html
     * @param string $groupId Pass in the group id to where the topic belongs. Can be
     * NSID or group alias. Making this parameter optional for legacy reasons, but it
     * is highly recommended to pass this in to get faster performance.
     * @param string $topicId The ID of the topic the post is in.
     * @param string $replyId The ID of the reply to delete.
     * @return
     */
    public function delete($groupId, $topicId, $replyId)
    {
        $params = [
            'group_id' => $groupId,
            'topic_id' => $topicId,
            'reply_id' => $replyId
        ];
        return $this->flickr->request('flickr.groups.discuss.replies.delete', $params);
    }

    /**
     * Edit a topic reply.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.groups.discuss.replies.edit.html
     * @param string $groupId Pass in the group id to where the topic belongs. Can be
     * NSID or group alias. Making this parameter optional for legacy reasons, but it
     * is highly recommended to pass this in to get faster performance.
     * @param string $topicId The ID of the topic the post is in.
     * @param string $replyId The ID of the reply post to edit.
     * @param string $message The message to edit the post with.
     * @return
     */
    public function edit($groupId, $topicId, $replyId, $message)
    {
        $params = [
            'group_id' => $groupId,
            'topic_id' => $topicId,
            'reply_id' => $replyId,
            'message' => $message
        ];
        return $this->flickr->request('flickr.groups.discuss.replies.edit', $params);
    }

    /**
     * Get information on a group topic reply.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.groups.discuss.replies.getInfo.html
     * @param string $groupId Pass in the group id to where the topic belongs. Can be
     * NSID or group alias. Making this parameter optional for legacy reasons, but it
     * is highly recommended to pass this in to get faster performance.
     * @param string $topicId The ID of the topic the post is in.
     * @param string $replyId The ID of the reply to fetch.
     * @return
     */
    public function getInfo($groupId, $topicId, $replyId)
    {
        $params = [
            'group_id' => $groupId,
            'topic_id' => $topicId,
            'reply_id' => $replyId
        ];
        return $this->flickr->request('flickr.groups.discuss.replies.getInfo', $params);
    }

    /**
     * Get a list of replies from a group discussion topic.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.groups.discuss.replies.getList.html
     * @param string $groupId Pass in the group id to where the topic belongs. Can be
     * NSID or group alias. Making this parameter optional for legacy reasons, but it
     * is highly recommended to pass this in to get faster performance.
     * @param string $topicId The ID of the topic to fetch replies for.
     * @param string $perPage Number of photos to return per page. If this argument is
     * omitted, it defaults to 100. The maximum allowed value is 500.
     * @param string $page The page of results to return. If this argument is omitted,
     * it defaults to 1.
     * @return
     */
    public function getList($groupId, $topicId, $perPage, $page = null)
    {
        $params = [
            'group_id' => $groupId,
            'topic_id' => $topicId,
            'per_page' => $perPage,
            'page' => $page
        ];
        return $this->flickr->request('flickr.groups.discuss.replies.getList', $params);
    }
}
