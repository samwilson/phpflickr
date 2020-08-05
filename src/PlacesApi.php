<?php

namespace Samwilson\PhpFlickr;

class PlacesApi extends ApiMethodGroup
{
    /**
     * Return a list of place IDs for a query string.<br /><br />
The
     * flickr.places.find method is <b>not</b> a geocoder. It will round <q>up</q> to
     * the nearest place type to which place IDs apply. For example, if you pass it a
     * street level address it will return the city that contains the address rather
     * than the street, or building, itself.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.places.find.html
     * @param string $query The query string to use for place ID lookups
     * @return
     */
    public function find($query)
    {
        $params = [
            'query' => $query
        ];
        return $this->flickr->request('flickr.places.find', $params);
    }

    /**
     * Return a place ID for a latitude, longitude and accuracy triple.<br /><br />
The
     * flickr.places.findByLatLon method is not meant to be a (reverse) geocoder in the
     * traditional sense. It is designed to allow users to find photos for "places" and
     * will round up to the nearest place type to which corresponding place IDs
     * apply.<br /><br />
For example, if you pass it a street level coordinate it will
     * return the city that contains the point rather than the street, or building,
     * itself.<br /><br />
It will also truncate latitudes and longitudes to three
     * decimal points.


     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.places.findByLatLon.html
     * @param string $lat The latitude whose valid range is -90 to 90. Anything more
     * than 4 decimal places will be truncated.
     * @param string $lon The longitude whose valid range is -180 to 180. Anything more
     * than 4 decimal places will be truncated.
     * @param string $accuracy Recorded accuracy level of the location information.
     * World level is 1, Country is ~3, Region ~6, City ~11, Street ~16. Current range
     * is 1-16. The default is 16.
     * @return
     */
    public function findByLatLon($lat, $lon, $accuracy = null)
    {
        $params = [
            'lat' => $lat,
            'lon' => $lon,
            'accuracy' => $accuracy
        ];
        return $this->flickr->request('flickr.places.findByLatLon', $params);
    }

    /**
     * Return a list of locations with public photos that are parented by a Where on
     * Earth (WOE) or Places ID.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.places.getChildrenWithPhotosPublic.html
     * @param string $placeId A Flickr Places ID. (While optional, you must pass either
     * a valid Places ID or a WOE ID.)
     * @param string $woeId A Where On Earth (WOE) ID. (While optional, you must pass
     * either a valid Places ID or a WOE ID.)
     * @return
     */
    public function getChildrenWithPhotosPublic($placeId = null, $woeId = null)
    {
        $params = [
            'place_id' => $placeId,
            'woe_id' => $woeId
        ];
        return $this->flickr->request('flickr.places.getChildrenWithPhotosPublic', $params);
    }

    /**
     * Get informations about a place.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.places.getInfo.html
     * @param string $placeId A Flickr Places ID. <span
     * style="font-style:italic;">(While optional, you must pass either a valid Places
     * ID or a WOE ID.)</span>
     * @param string $woeId A Where On Earth (WOE) ID. <span
     * style="font-style:italic;">(While optional, you must pass either a valid Places
     * ID or a WOE ID.)</span>
     * @return
     */
    public function getInfo($placeId = null, $woeId = null)
    {
        $params = [
            'place_id' => $placeId,
            'woe_id' => $woeId
        ];
        return $this->flickr->request('flickr.places.getInfo', $params);
    }

    /**
     * Lookup information about a place, by its flickr.com/places URL.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.places.getInfoByUrl.html
     * @param string $url A flickr.com/places URL in the form of /country/region/city.
     * For example: /Canada/Quebec/Montreal
     * @return
     */
    public function getInfoByUrl($url)
    {
        $params = [
            'url' => $url
        ];
        return $this->flickr->request('flickr.places.getInfoByUrl', $params);
    }

    /**
     * Fetches a list of available place types for Flickr.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.places.getPlaceTypes.html
     *
     * @return
     */
    public function getPlaceTypes()
    {
        return $this->flickr->request('flickr.places.getPlaceTypes');
    }

    /**
     * Return an historical list of all the shape data generated for a Places or Where
     * on Earth (WOE) ID.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.places.getShapeHistory.html
     * @param string $placeId A Flickr Places ID. <span
     * style="font-style:italic;">(While optional, you must pass either a valid Places
     * ID or a WOE ID.)</span>
     * @param string $woeId A Where On Earth (WOE) ID. <span
     * style="font-style:italic;">(While optional, you must pass either a valid Places
     * ID or a WOE ID.)</span>
     * @return
     */
    public function getShapeHistory($placeId = null, $woeId = null)
    {
        $params = [
            'place_id' => $placeId,
            'woe_id' => $woeId
        ];
        return $this->flickr->request('flickr.places.getShapeHistory', $params);
    }

    /**
     * Return the top 100 most geotagged places for a day.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.places.getTopPlacesList.html
     * @param string $placeTypeId The numeric ID for a specific place type to cluster
     * photos by. <br /><br />  Valid place type IDs are :  <ul>
     * <li><strong>22</strong>: neighbourhood</li> <li><strong>7</strong>:
     * locality</li> <li><strong>8</strong>: region</li> <li><strong>12</strong>:
     * country</li> <li><strong>29</strong>: continent</li> </ul>
     * @param string $date A valid date in YYYY-MM-DD format. The default is yesterday.
     * @param string $woeId Limit your query to only those top places belonging to a
     * specific Where on Earth (WOE) identifier.
     * @param string $placeId Limit your query to only those top places belonging to a
     * specific Flickr Places identifier.
     * @return
     */
    public function getTopPlacesList($placeTypeId, $date = null, $woeId = null, $placeId = null)
    {
        $params = [
            'place_type_id' => $placeTypeId,
            'date' => $date,
            'woe_id' => $woeId,
            'place_id' => $placeId
        ];
        return $this->flickr->request('flickr.places.getTopPlacesList', $params);
    }

    /**
     * Return all the locations of a matching place type for a bounding box.<br /><br
     * />

The maximum allowable size of a bounding box (the distance between the SW
     * and NE corners) is governed by the place type you are requesting. Allowable
     * sizes are as follows:

<ul>
<li><strong>neighbourhood</strong>: 3km
     * (1.8mi)</li>
<li><strong>locality</strong>: 7km
     * (4.3mi)</li>
<li><strong>county</strong>: 50km
     * (31mi)</li>
<li><strong>region</strong>: 200km
     * (124mi)</li>
<li><strong>country</strong>: 500km
     * (310mi)</li>
<li><strong>continent</strong>: 1500km (932mi)</li>
</ul>
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.places.placesForBoundingBox.html
     * @param string $bbox A comma-delimited list of 4 values defining the Bounding Box
     * of the area that will be searched. The 4 values represent the bottom-left corner
     * of the box and the top-right corner, minimum_longitude, minimum_latitude,
     * maximum_longitude, maximum_latitude.
     * @param string $placeType The name of place type to using as the starting point
     * to search for places in a bounding box. Valid placetypes are:  <ul>
     * <li>neighbourhood</li> <li>locality</li> <li>county</li> <li>region</li>
     * <li>country</li> <li>continent</li> </ul> <br /> <span
     * style="font-style:italic;">The "place_type" argument has been deprecated in
     * favor of the "place_type_id" argument. It won't go away but it will not be added
     * to new methods. A complete list of place type IDs is available using the <a
     * href="http://www.flickr.com/services/api/flickr.places.getPlaceTypes.html">flickr.places.getPlaceTypes</a>
     * method. (While optional, you must pass either a valid place type or place type
     * ID.)</span>
     * @param string $placeTypeId The numeric ID for a specific place type to cluster
     * photos by. <br /><br />  Valid place type IDs are :  <ul>
     * <li><strong>22</strong>: neighbourhood</li> <li><strong>7</strong>:
     * locality</li> <li><strong>8</strong>: region</li> <li><strong>12</strong>:
     * country</li> <li><strong>29</strong>: continent</li> </ul> <br /><span
     * style="font-style:italic;">(While optional, you must pass either a valid place
     * type or place type ID.)</span>
     * @return
     */
    public function placesForBoundingBox($bbox, $placeType = null, $placeTypeId = null)
    {
        $params = [
            'bbox' => $bbox,
            'place_type' => $placeType,
            'place_type_id' => $placeTypeId
        ];
        return $this->flickr->request('flickr.places.placesForBoundingBox', $params);
    }

    /**
     * Return a list of the top 100 unique places clustered by a given placetype for a
     * user's contacts.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.places.placesForContacts.html
     * @param string $placeType A specific place type to cluster photos by. <br /><br
     * />  Valid place types are :  <ul> <li><strong>neighbourhood</strong> (and
     * neighborhood)</li> <li><strong>locality</strong></li>
     * <li><strong>region</strong></li> <li><strong>country</strong></li>
     * <li><strong>continent</strong></li> </ul> <br /> <span
     * style="font-style:italic;">The "place_type" argument has been deprecated in
     * favor of the "place_type_id" argument. It won't go away but it will not be added
     * to new methods. A complete list of place type IDs is available using the <a
     * href="http://www.flickr.com/services/api/flickr.places.getPlaceTypes.html">flickr.places.getPlaceTypes</a>
     * method. (While optional, you must pass either a valid place type or place type
     * ID.)</span>
     * @param string $placeTypeId The numeric ID for a specific place type to cluster
     * photos by. <br /><br />  Valid place type IDs are :  <ul>
     * <li><strong>22</strong>: neighbourhood</li> <li><strong>7</strong>:
     * locality</li> <li><strong>8</strong>: region</li> <li><strong>12</strong>:
     * country</li> <li><strong>29</strong>: continent</li> </ul> <br /><span
     * style="font-style:italic;">(While optional, you must pass either a valid place
     * type or place type ID.)</span>
     * @param string $woeId A Where on Earth identifier to use to filter photo
     * clusters. For example all the photos clustered by <strong>locality</strong> in
     * the United States (WOE ID <strong>23424977</strong>).<br /><br /> <span
     * style="font-style:italic;">(While optional, you must pass either a valid Places
     * ID or a WOE ID.)</span>
     * @param string $placeId A Flickr Places identifier to use to filter photo
     * clusters. For example all the photos clustered by <strong>locality</strong> in
     * the United States (Place ID <strong>4KO02SibApitvSBieQ</strong>). <br /><br />
     * <span style="font-style:italic;">(While optional, you must pass either a valid
     * Places ID or a WOE ID.)</span>
     * @param string $threshold The minimum number of photos that a place type must
     * have to be included. If the number of photos is lowered then the parent place
     * type for that place will be used.<br /><br />  For example if your contacts only
     * have <strong>3</strong> photos taken in the locality of Montreal</strong> (WOE
     * ID 3534) but your threshold is set to <strong>5</strong> then those photos will
     * be "rolled up" and included instead with a place record for the region of Quebec
     * (WOE ID 2344924).
     * @param string $contacts Search your contacts. Either 'all' or 'ff' for just
     * friends and family. (Default is all)
     * @param string $minUploadDate Minimum upload date. Photos with an upload date
     * greater than or equal to this value will be returned. The date should be in the
     * form of a unix timestamp.
     * @param string $maxUploadDate Maximum upload date. Photos with an upload date
     * less than or equal to this value will be returned. The date should be in the
     * form of a unix timestamp.
     * @param string $minTakenDate Minimum taken date. Photos with an taken date
     * greater than or equal to this value will be returned. The date should be in the
     * form of a mysql datetime.
     * @param string $maxTakenDate Maximum taken date. Photos with an taken date less
     * than or equal to this value will be returned. The date should be in the form of
     * a mysql datetime.
     * @return
     */
    public function placesForContacts(
        $placeType = null,
        $placeTypeId = null,
        $woeId = null,
        $placeId = null,
        $threshold = null,
        $contacts = null,
        $minUploadDate = null,
        $maxUploadDate = null,
        $minTakenDate = null,
        $maxTakenDate = null
    ) {
        $params = [
            'place_type' => $placeType,
            'place_type_id' => $placeTypeId,
            'woe_id' => $woeId,
            'place_id' => $placeId,
            'threshold' => $threshold,
            'contacts' => $contacts,
            'min_upload_date' => $minUploadDate,
            'max_upload_date' => $maxUploadDate,
            'min_taken_date' => $minTakenDate,
            'max_taken_date' => $maxTakenDate
        ];
        return $this->flickr->request('flickr.places.placesForContacts', $params);
    }

    /**
     * Return a list of the top 100 unique places clustered by a given placetype for
     * set of tags or machine tags.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.places.placesForTags.html
     * @param string $placeTypeId The numeric ID for a specific place type to cluster
     * photos by. <br /><br />  Valid place type IDs are :  <ul>
     * <li><strong>22</strong>: neighbourhood</li> <li><strong>7</strong>:
     * locality</li> <li><strong>8</strong>: region</li> <li><strong>12</strong>:
     * country</li> <li><strong>29</strong>: continent</li> </ul>
     * @param string $woeId A Where on Earth identifier to use to filter photo
     * clusters. For example all the photos clustered by <strong>locality</strong> in
     * the United States (WOE ID <strong>23424977</strong>). <br /><br /> <span
     * style="font-style:italic;">(While optional, you must pass either a valid Places
     * ID or a WOE ID.)</span>
     * @param string $placeId A Flickr Places identifier to use to filter photo
     * clusters. For example all the photos clustered by <strong>locality</strong> in
     * the United States (Place ID <strong>4KO02SibApitvSBieQ</strong>). <br /><br />
     * <span style="font-style:italic;">(While optional, you must pass either a valid
     * Places ID or a WOE ID.)</span>
     * @param string $threshold The minimum number of photos that a place type must
     * have to be included. If the number of photos is lowered then the parent place
     * type for that place will be used.<br /><br />  For example if you only have
     * <strong>3</strong> photos taken in the locality of Montreal</strong> (WOE ID
     * 3534) but your threshold is set to <strong>5</strong> then those photos will be
     * "rolled up" and included instead with a place record for the region of Quebec
     * (WOE ID 2344924).
     * @param string $tags A comma-delimited list of tags. Photos with one or more of
     * the tags listed will be returned. <br /><br /> <span
     * style="font-style:italic;">(While optional, you must pass either a valid tag or
     * machine_tag</span>
     * @param string $tagMode Either 'any' for an OR combination of tags, or 'all' for
     * an AND combination. Defaults to 'any' if not specified.
     * @param string $machineTags Aside from passing in a fully formed machine tag,
     * there is a special syntax for searching on specific properties :  <ul>
     * <li>Find photos using the 'dc' namespace :    <code>"machine_tags" =>
     * "dc:"</code></li>    <li> Find photos with a title in the 'dc' namespace :
     * <code>"machine_tags" => "dc:title="</code></li>    <li>Find photos titled "mr.
     * camera" in the 'dc' namespace : <code>"machine_tags" => "dc:title=\"mr.
     * camera\"</code></li>    <li>Find photos whose value is "mr. camera" :
     * <code>"machine_tags" => "*:*=\"mr. camera\""</code></li>    <li>Find photos that
     * have a title, in any namespace : <code>"machine_tags" => "*:title="</code></li>
     *   <li>Find photos that have a title, in any namespace, whose value is "mr.
     * camera" : <code>"machine_tags" => "*:title=\"mr. camera\""</code></li>
     * <li>Find photos, in the 'dc' namespace whose value is "mr. camera" :
     * <code>"machine_tags" => "dc:*=\"mr. camera\""</code></li>   </ul>  Multiple
     * machine tags may be queried by passing a comma-separated list. The number of
     * machine tags you can pass in a single query depends on the tag mode (AND or OR)
     * that you are querying with. "AND" queries are limited to (16) machine tags. "OR"
     * queries are limited to (8). <br /><br /> <span style="font-style:italic;">(While
     * optional, you must pass either a valid tag or machine_tag)</span>
     * @param string $machineTagMode Either 'any' for an OR combination of tags, or
     * 'all' for an AND combination. Defaults to 'any' if not specified.
     * @param string $minUploadDate Minimum upload date. Photos with an upload date
     * greater than or equal to this value will be returned. The date should be in the
     * form of a unix timestamp.
     * @param string $maxUploadDate Maximum upload date. Photos with an upload date
     * less than or equal to this value will be returned. The date should be in the
     * form of a unix timestamp.
     * @param string $minTakenDate Minimum taken date. Photos with an taken date
     * greater than or equal to this value will be returned. The date should be in the
     * form of a mysql datetime.
     * @param string $maxTakenDate Maximum taken date. Photos with an taken date less
     * than or equal to this value will be returned. The date should be in the form of
     * a mysql datetime.
     * @return
     */
    public function placesForTags(
        $placeTypeId,
        $woeId = null,
        $placeId = null,
        $threshold = null,
        $tags = null,
        $tagMode = null,
        $machineTags = null,
        $machineTagMode = null,
        $minUploadDate = null,
        $maxUploadDate = null,
        $minTakenDate = null,
        $maxTakenDate = null
    ) {
        $params = [
            'place_type_id' => $placeTypeId,
            'woe_id' => $woeId,
            'place_id' => $placeId,
            'threshold' => $threshold,
            'tags' => $tags,
            'tag_mode' => $tagMode,
            'machine_tags' => $machineTags,
            'machine_tag_mode' => $machineTagMode,
            'min_upload_date' => $minUploadDate,
            'max_upload_date' => $maxUploadDate,
            'min_taken_date' => $minTakenDate,
            'max_taken_date' => $maxTakenDate
        ];
        return $this->flickr->request('flickr.places.placesForTags', $params);
    }

    /**
     * Return a list of the top 100 unique places clustered by a given placetype for a
     * user.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.places.placesForUser.html
     * @param string $placeTypeId The numeric ID for a specific place type to cluster
     * photos by. <br /><br />  Valid place type IDs are :  <ul>
     * <li><strong>22</strong>: neighbourhood</li> <li><strong>7</strong>:
     * locality</li> <li><strong>8</strong>: region</li> <li><strong>12</strong>:
     * country</li> <li><strong>29</strong>: continent</li> </ul> <br /> <span
     * style="font-style:italic;">The "place_type" argument has been deprecated in
     * favor of the "place_type_id" argument. It won't go away but it will not be added
     * to new methods. A complete list of place type IDs is available using the <a
     * href="http://www.flickr.com/services/api/flickr.places.getPlaceTypes.html">flickr.places.getPlaceTypes</a>
     * method. (While optional, you must pass either a valid place type or place type
     * ID.)</span>
     * @param string $placeType A specific place type to cluster photos by. <br /><br
     * />  Valid place types are :  <ul> <li><strong>neighbourhood</strong> (and
     * neighborhood)</li> <li><strong>locality</strong></li>
     * <li><strong>region</strong></li> <li><strong>country</strong></li>
     * <li><strong>continent</strong></li> </ul> <br /><span
     * style="font-style:italic;">(While optional, you must pass either a valid place
     * type or place type ID.)</span>
     * @param string $woeId A Where on Earth identifier to use to filter photo
     * clusters. For example all the photos clustered by <strong>locality</strong> in
     * the United States (WOE ID <strong>23424977</strong>).<br /><br /> <span
     * style="font-style:italic;">(While optional, you must pass either a valid Places
     * ID or a WOE ID.)</span>
     * @param string $placeId A Flickr Places identifier to use to filter photo
     * clusters. For example all the photos clustered by <strong>locality</strong> in
     * the United States (Place ID <strong>4KO02SibApitvSBieQ</strong>).<br /><br />
     * <span style="font-style:italic;">(While optional, you must pass either a valid
     * Places ID or a WOE ID.)</span>
     * @param string $threshold The minimum number of photos that a place type must
     * have to be included. If the number of photos is lowered then the parent place
     * type for that place will be used.<br /><br />  For example if you only have
     * <strong>3</strong> photos taken in the locality of Montreal</strong> (WOE ID
     * 3534) but your threshold is set to <strong>5</strong> then those photos will be
     * "rolled up" and included instead with a place record for the region of Quebec
     * (WOE ID 2344924).
     * @param string $minUploadDate Minimum upload date. Photos with an upload date
     * greater than or equal to this value will be returned. The date should be in the
     * form of a unix timestamp.
     * @param string $maxUploadDate Maximum upload date. Photos with an upload date
     * less than or equal to this value will be returned. The date should be in the
     * form of a unix timestamp.
     * @param string $minTakenDate Minimum taken date. Photos with an taken date
     * greater than or equal to this value will be returned. The date should be in the
     * form of a mysql datetime.
     * @param string $maxTakenDate Maximum taken date. Photos with an taken date less
     * than or equal to this value will be returned. The date should be in the form of
     * a mysql datetime.
     * @return
     */
    public function placesForUser(
        $placeTypeId = null,
        $placeType = null,
        $woeId = null,
        $placeId = null,
        $threshold = null,
        $minUploadDate = null,
        $maxUploadDate = null,
        $minTakenDate = null,
        $maxTakenDate = null
    ) {
        $params = [
            'place_type_id' => $placeTypeId,
            'place_type' => $placeType,
            'woe_id' => $woeId,
            'place_id' => $placeId,
            'threshold' => $threshold,
            'min_upload_date' => $minUploadDate,
            'max_upload_date' => $maxUploadDate,
            'min_taken_date' => $minTakenDate,
            'max_taken_date' => $maxTakenDate
        ];
        return $this->flickr->request('flickr.places.placesForUser', $params);
    }

    /**
     * Return a list of the top 100 unique tags for a Flickr Places or Where on Earth
     * (WOE) ID
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.places.tagsForPlace.html
     * @param string $woeId A Where on Earth identifier to use to filter photo
     * clusters.<br /><br /> <span style="font-style:italic;">(While optional, you must
     * pass either a valid Places ID or a WOE ID.)</span>
     * @param string $placeId A Flickr Places identifier to use to filter photo
     * clusters.<br /><br /> <span style="font-style:italic;">(While optional, you must
     * pass either a valid Places ID or a WOE ID.)</span>
     * @param string $minUploadDate Minimum upload date. Photos with an upload date
     * greater than or equal to this value will be returned. The date should be in the
     * form of a unix timestamp.
     * @param string $maxUploadDate Maximum upload date. Photos with an upload date
     * less than or equal to this value will be returned. The date should be in the
     * form of a unix timestamp.
     * @param string $minTakenDate Minimum taken date. Photos with an taken date
     * greater than or equal to this value will be returned. The date should be in the
     * form of a mysql datetime.
     * @param string $maxTakenDate Maximum taken date. Photos with an taken date less
     * than or equal to this value will be returned. The date should be in the form of
     * a mysql datetime.
     * @return
     */
    public function tagsForPlace(
        $woeId = null,
        $placeId = null,
        $minUploadDate = null,
        $maxUploadDate = null,
        $minTakenDate = null,
        $maxTakenDate = null
    ) {
        $params = [
            'woe_id' => $woeId,
            'place_id' => $placeId,
            'min_upload_date' => $minUploadDate,
            'max_upload_date' => $maxUploadDate,
            'min_taken_date' => $minTakenDate,
            'max_taken_date' => $maxTakenDate
        ];
        return $this->flickr->request('flickr.places.tagsForPlace', $params);
    }
}
