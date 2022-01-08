<?php

namespace Samwilson\PhpFlickr;

class ContactsApi extends ApiMethodGroup
{
    /**
     * Get a list of contacts for the calling user.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.contacts.getList.html
     * @param string $filter An optional filter of the results. The following values
     * are valid:<br /> &nbsp; <dl>     <dt><b><code>friends</code></b></dt>    <dl>Only
     * contacts who are friends (and not family)</dl>
     *  <dt><b><code>family</code></b></dt>     <dl>Only contacts who are family (and not
     * friends)</dl>    <dt><b><code>both</code></b></dt>   <dl>Only contacts who are
     * both friends and family</dl>     <dt><b><code>neither</code></b></dt>    <dl>Only
     * contacts who are neither friends nor family</dl> </dl>
     * @param string $page The page of results to return. If this argument is omitted,
     * it defaults to 1.
     * @param string $perPage Number of photos to return per page. If this argument is
     * omitted, it defaults to 1000. The maximum allowed value is 1000.
     * @param string $sort The order in which to sort the returned contacts. Defaults
     * to name. The possible values are: name and time.
     * @return
     */
    public function getList($filter = null, $page = null, $perPage = null, $sort = null)
    {
        $params = [
            'filter' => $filter,
            'page' => $page,
            'per_page' => $perPage,
            'sort' => $sort
        ];
        return $this->flickr->request('flickr.contacts.getList', $params);
    }

    /**
     * Return a list of contacts for a user who have recently uploaded photos along
     * with the total count of photos uploaded.<br /><br />

This method is still
     * considered experimental. We don't plan for it to change or to go away but so
     * long as this notice is present you should write your code accordingly.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.contacts.getListRecentlyUploaded.html
     * @param string $dateLastupload Limits the resultset to contacts that have
     * uploaded photos since this date. The date should be in the form of a Unix
     * timestamp.  The default offset is (1) hour and the maximum (24) hours.
     * @param string $filter Limit the result set to all contacts or only those who are
     * friends or family. Valid options are:  <ul> <li><strong>ff</strong> friends and
     * family</li> <li><strong>all</strong> all your contacts</li> </ul> Default value
     * is "all".
     * @return
     */
    public function getListRecentlyUploaded($dateLastupload = null, $filter = null)
    {
        $params = [
            'date_lastupload' => $dateLastupload,
            'filter' => $filter
        ];
        return $this->flickr->request('flickr.contacts.getListRecentlyUploaded', $params);
    }

    /**
     * Get the contact list for a user.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.contacts.getPublicList.html
     * @param string $userId The NSID of the user to fetch the contact list for.
     * @param string $page The page of results to return. If this argument is omitted,
     * it defaults to 1.
     * @param string $perPage Number of photos to return per page. If this argument is
     * omitted, it defaults to 1000. The maximum allowed value is 1000.
     * @return
     */
    public function getPublicList($userId, $page = null, $perPage = null)
    {
        $params = [
            'user_id' => $userId,
            'page' => $page,
            'per_page' => $perPage
        ];
        return $this->flickr->request('flickr.contacts.getPublicList', $params);
    }

    /**
     * Get suggestions for tagging people in photos based on the calling user's
     * contacts.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.contacts.getTaggingSuggestions.html
     * @param string $perPage Number of contacts to return per page. If this argument
     * is omitted, all contacts will be returned.
     * @param string $page The page of results to return. If this argument is omitted,
     * it defaults to 1.
     * @return
     */
    public function getTaggingSuggestions($perPage = null, $page = null)
    {
        $params = [
            'per_page' => $perPage,
            'page' => $page
        ];
        return $this->flickr->request('flickr.contacts.getTaggingSuggestions', $params);
    }
}
