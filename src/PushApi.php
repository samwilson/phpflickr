<?php

namespace Samwilson\PhpFlickr;

class PushApi extends ApiMethodGroup
{
    /**
     * Returns a list of the subscriptions for the logged-in user. This method is experimental and may change.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.push.getSubscriptions.html
     *
     * @return
     */
    public function getSubscriptions()
    {
        return $this->flickr->request('flickr.push.getSubscriptions');
    }

    /**
     * All the different flavours of anteater. This method is experimental and may change.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.push.getTopics.html
     *
     * @return
     */
    public function getTopics()
    {
        return $this->flickr->request('flickr.push.getTopics');
    }

    /**
     * In ur pandas, tickling ur unicorn
<br><br>
<i>(this method is experimental and
     * may change)</i>
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.push.subscribe.html
     * @param string $topic The type of subscription. See <a
     * href="http://www.flickr.com/services/api/flickr.push.getTopics.htm">flickr.push.getTopics</a>.
     * @param string $callback The url for the subscription endpoint. Limited to 255
     * bytes, and must be unique for this user, i.e. no two subscriptions for a given
     * user may use the same callback url.
     * @param string $verify The verification mode, either <code>sync</code> or
     * <code>async</code>. See the <a
     * href="http://pubsubhubbub.googlecode.com/svn/trunk/pubsubhubbub-core-0.3.html#subscribingl">Google
     * PubSubHubbub spec</a> for details.
     * @param string $verifyToken The verification token to be echoed back to the
     * subscriber during the verification callback, as per the <a
     * href="http://pubsubhubbub.googlecode.com/svn/trunk/pubsubhubbub-core-0.3.html#subscribing">Google
     * PubSubHubbub spec</a>. Limited to 200 bytes.
     * @param string $leaseSeconds Number of seconds for which the subscription will be
     * valid. Legal values are 60 to 86400 (1 minute to 1 day). If not present, the
     * subscription will be auto-renewing.
     * @param string $woeIds A 32-bit integer for a <a
     * href="http://developer.yahoo.com/geo/geoplanet/">Where on Earth ID</a>. Only
     * valid if <code>topic</code> is <code>geo</code>. <br/><br/> The order of
     * precedence for geo subscriptions is : woe ids, place ids, radial i.e. the
     * <code>lat, lon</code> parameters will be ignored if <code>place_ids</code> is
     * present, which will be ignored if <code>woe_ids</code> is present.
     * @param string $placeIds A comma-separated list of Flickr place IDs. Only valid
     * if <code>topic</code> is <code>geo</code>. <br/><br/> The order of precedence
     * for geo subscriptions is : woe ids, place ids, radial i.e. the <code>lat,
     * lon</code> parameters will be ignored if <code>place_ids</code> is present,
     * which will be ignored if <code>woe_ids</code> is present.
     * @param string $lat A latitude value, in decimal format. Only valid if
     * <code>topic</code> is <code>geo</code>. Defines the latitude for a radial query
     * centered around (lat, lon). <br/><br/> The order of precedence for geo
     * subscriptions is : woe ids, place ids, radial i.e. the <code>lat, lon</code>
     * parameters will be ignored if <code>place_ids</code> is present, which will be
     * ignored if <code>woe_ids</code> is present.
     * @param string $lon A longitude value, in decimal format. Only valid if
     * <code>topic</code> is <code>geo</code>. Defines the longitude for a radial query
     * centered around (lat, lon). <br/><br/> The order of precedence for geo
     * subscriptions is : woe ids, place ids, radial i.e. the <code>lat, lon</code>
     * parameters will be ignored if <code>place_ids</code> is present, which will be
     * ignored if <code>woe_ids</code> is present.
     * @param string $radius A radius value, in the units defined by radius_units. Only
     * valid if <code>topic</code> is <code>geo</code>. Defines the radius of a circle
     * for a radial query centered around (lat, lon). Default is 5 km. <br/><br/> The
     * order of precedence for geo subscriptions is : woe ids, place ids, radial i.e.
     * the <code>lat, lon</code> parameters will be ignored if <code>place_ids</code>
     * is present, which will be ignored if <code>woe_ids</code> is present.
     * @param string $radiusUnits Defines the units for the radius parameter. Only
     * valid if <code>topic</code> is <code>geo</code>. Options are <code>mi</code> and
     * <code>km</code>. Default is <code>km</code>. <br/><br/> The order of precedence
     * for geo subscriptions is : woe ids, place ids, radial i.e. the <code>lat,
     * lon</code> parameters will be ignored if <code>place_ids</code> is present,
     * which will be ignored if <code>woe_ids</code> is present.
     * @param string $accuracy Defines the minimum accuracy required for photos to be
     * included in a subscription. Only valid if <code>topic</code> is <code>geo</code>
     * Legal values are 1-16, default is 1 (i.e. any accuracy level). <ul> <li>World
     * level is 1</li> <li>Country is ~3</li> <li>Region is ~6</li> <li>City is
     * ~11</li> <li>Street is ~16</li> </ul>
     * @param string $nsids A comma-separated list of nsids representing Flickr Commons
     * institutions (see <a
     * href="http://www.flickr.com/services/api/flickr.commons.getInstitutions.html">flickr.commons.getInstitutions</a>).
     * Only valid if <code>topic</code> is <code>commons</code>. If not present this
     * argument defaults to all Flickr Commons institutions.
     * @param string $tags A comma-separated list of strings to be used for tag
     * subscriptions. Photos with one or more of the tags listed will be included in
     * the subscription. Only valid if the <code>topic</code> is <code>tags</code>.
     * @return
     */
    public function subscribe(
        $topic,
        $callback,
        $verify,
        $verifyToken = null,
        $leaseSeconds = null,
        $woeIds = null,
        $placeIds = null,
        $lat = null,
        $lon = null,
        $radius = null,
        $radiusUnits = null,
        $accuracy = null,
        $nsids = null,
        $tags = null
    ) {
        $params = [
            'topic' => $topic,
            'callback' => $callback,
            'verify' => $verify,
            'verify_token' => $verifyToken,
            'lease_seconds' => $leaseSeconds,
            'woe_ids' => $woeIds,
            'place_ids' => $placeIds,
            'lat' => $lat,
            'lon' => $lon,
            'radius' => $radius,
            'radius_units' => $radiusUnits,
            'accuracy' => $accuracy,
            'nsids' => $nsids,
            'tags' => $tags
        ];
        return $this->flickr->request('flickr.push.subscribe', $params);
    }

    /**
     * Why would you want to do this?
<br><br>
<i>(this method is experimental and may
     * change)</i>
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.push.unsubscribe.html
     * @param string $topic The type of subscription. See <a
     * href="http://www.flickr.com/services/api/flickr.push.getTopics.htm">flickr.push.getTopics</a>.
     * @param string $callback The url for the subscription endpoint (must be the same
     * url as was used when creating the subscription).
     * @param string $verify The verification mode, either 'sync' or 'async'. See the
     * <a
     * href="http://pubsubhubbub.googlecode.com/svn/trunk/pubsubhubbub-core-0.3.html#subscribingl">Google
     * PubSubHubbub spec</a> for details.
     * @param string $verifyToken The verification token to be echoed back to the
     * subscriber during the verification callback, as per the <a
     * href="http://pubsubhubbub.googlecode.com/svn/trunk/pubsubhubbub-core-0.3.html#subscribing">Google
     * PubSubHubbub spec</a>. Limited to 200 bytes.
     * @return
     */
    public function unsubscribe($topic, $callback, $verify, $verifyToken = null)
    {
        $params = [
            'topic' => $topic,
            'callback' => $callback,
            'verify' => $verify,
            'verify_token' => $verifyToken
        ];
        return $this->flickr->request('flickr.push.unsubscribe', $params);
    }
}
