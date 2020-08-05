<?php

namespace Samwilson\PhpFlickr;

class ActivityApi extends ApiMethodGroup
{
    /**
     * Returns a list of recent activity on photos commented on by the calling user.
     * <b>Do not poll this method more than once an hour</b>.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.activity.userComments.html
     * @param string $perPage Number of items to return per page. If this argument is
     * omitted, it defaults to 10. The maximum allowed value is 50.
     * @param string $page The page of results to return. If this argument is omitted,
     * it defaults to 1.
     * @return
     */
    public function userComments($perPage = null, $page = null)
    {
        $params = [
            'per_page' => $perPage,
            'page' => $page
        ];
        return $this->flickr->request('flickr.activity.userComments', $params);
    }

    /**
     * Returns a list of recent activity on photos belonging to the calling user. <b>Do
     * not poll this method more than once an hour</b>.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.activity.userPhotos.html
     * @param string $timeframe The timeframe in which to return updates for. This can
     * be specified in days (<code>'2d'</code>) or hours (<code>'4h'</code>). The
     * default behavoir is to return changes since the beginning of the previous user
     * session.
     * @param string $perPage Number of items to return per page. If this argument is
     * omitted, it defaults to 10. The maximum allowed value is 50.
     * @param string $page The page of results to return. If this argument is omitted,
     * it defaults to 1.
     * @return
     */
    public function userPhotos($timeframe = null, $perPage = null, $page = null)
    {
        $params = [
            'timeframe' => $timeframe,
            'per_page' => $perPage,
            'page' => $page
        ];
        return $this->flickr->request('flickr.activity.userPhotos', $params);
    }
}
