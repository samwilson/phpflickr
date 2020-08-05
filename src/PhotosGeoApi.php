<?php

namespace Samwilson\PhpFlickr;

class PhotosGeoApi extends ApiMethodGroup
{
    /**
     * Correct the places hierarchy for all the photos for a user at a given latitude,
     * longitude and accuracy.<br /><br />

Batch corrections are processed in a
     * delayed queue so it may take a few minutes before the changes are reflected in a
     * user's photos.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.geo.batchCorrectLocation.html
     * @param string $lat The latitude of the photos to be update whose valid range is
     * -90 to 90. Anything more than 6 decimal places will be truncated.
     * @param string $lon The longitude of the photos to be updated whose valid range
     * is -180 to 180. Anything more than 6 decimal places will be truncated.
     * @param string $accuracy Recorded accuracy level of the photos to be updated.
     * World level is 1, Country is ~3, Region ~6, City ~11, Street ~16. Current range
     * is 1-16. Defaults to 16 if not specified.
     * @param string $placeId A Flickr Places ID. (While optional, you must pass either
     * a valid Places ID or a WOE ID.)
     * @param string $woeId A Where On Earth (WOE) ID. (While optional, you must pass
     * either a valid Places ID or a WOE ID.)
     * @return
     */
    public function batchCorrectLocation($lat, $lon, $accuracy, $placeId = null, $woeId = null)
    {
        $params = [
            'lat' => $lat,
            'lon' => $lon,
            'accuracy' => $accuracy,
            'place_id' => $placeId,
            'woe_id' => $woeId
        ];
        return $this->flickr->request('flickr.photos.geo.batchCorrectLocation', $params);
    }

    /**
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.geo.correctLocation.html
     * @param string $photoId The ID of the photo whose WOE location is being
     * corrected.
     * @param string $foursquareId The venue ID for a Foursquare location. (If not
     * passed in with correction, any existing foursquare venue will be removed).
     * @param string $placeId A Flickr Places ID. (While optional, you must pass either
     * a valid Places ID or a WOE ID.)
     * @param string $woeId A Where On Earth (WOE) ID. (While optional, you must pass
     * either a valid Places ID or a WOE ID.)
     * @return
     */
    public function correctLocation($photoId, $foursquareId, $placeId = null, $woeId = null)
    {
        $params = [
            'photo_id' => $photoId,
            'place_id' => $placeId,
            'woe_id' => $woeId,
            'foursquare_id' => $foursquareId
        ];
        return $this->flickr->request('flickr.photos.geo.correctLocation', $params);
    }

    /**
     * Get the geo data (latitude and longitude and the accuracy level) for a photo.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.geo.getLocation.html
     * @param string $photoId The id of the photo you want to retrieve location data
     * for.
     * @param string $extras Extra flags.
     * @return
     */
    public function getLocation($photoId, $extras = null)
    {
        $params = [
            'photo_id' => $photoId,
            'extras' => $extras
        ];
        return $this->flickr->request('flickr.photos.geo.getLocation', $params);
    }

    /**
     * Get permissions for who may view geo data for a photo.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.geo.getPerms.html
     * @param string $photoId The id of the photo to get permissions for.
     * @return
     */
    public function getPerms($photoId)
    {
        $params = [
            'photo_id' => $photoId
        ];
        return $this->flickr->request('flickr.photos.geo.getPerms', $params);
    }

    /**
     * Return a list of photos for the calling user at a specific latitude, longitude
     * and accuracy
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.geo.photosForLocation.html
     * @param string $lat The latitude whose valid range is -90 to 90. Anything more
     * than 6 decimal places will be truncated.
     * @param string $lon The longitude whose valid range is -180 to 180. Anything more
     * than 6 decimal places will be truncated.
     * @param string $accuracy Recorded accuracy level of the location information.
     * World level is 1, Country is ~3, Region ~6, City ~11, Street ~16. Current range
     * is 1-16. Defaults to 16 if not specified.
     * @param string $extras A comma-delimited list of extra information to fetch for
     * each returned record. Currently supported fields are: <code>description</code>,
     * <code>license</code>, <code>date_upload</code>, <code>date_taken</code>,
     * <code>owner_name</code>, <code>icon_server</code>, <code>original_format</code>,
     * <code>last_update</code>, <code>geo</code>, <code>tags</code>,
     * <code>machine_tags</code>, <code>o_dims</code>, <code>views</code>,
     * <code>media</code>, <code>path_alias</code>, <code>url_sq</code>,
     * <code>url_t</code>, <code>url_s</code>, <code>url_q</code>, <code>url_m</code>,
     * <code>url_n</code>, <code>url_z</code>, <code>url_c</code>, <code>url_l</code>,
     * <code>url_o</code>
     * @param string $perPage Number of photos to return per page. If this argument is
     * omitted, it defaults to 100. The maximum allowed value is 500.
     * @param string $page The page of results to return. If this argument is omitted,
     * it defaults to 1.
     * @return
     */
    public function photosForLocation($lat, $lon, $accuracy = null, $extras = null, $perPage = null, $page = null)
    {
        $params = [
            'lat' => $lat,
            'lon' => $lon,
            'accuracy' => $accuracy,
            'extras' => $extras,
            'per_page' => $perPage,
            'page' => $page
        ];
        return $this->flickr->request('flickr.photos.geo.photosForLocation', $params);
    }

    /**
     * Removes the geo data associated with a photo.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.geo.removeLocation.html
     * @param string $photoId The id of the photo you want to remove location data
     * from.
     * @return
     */
    public function removeLocation($photoId)
    {
        $params = [
            'photo_id' => $photoId
        ];
        return $this->flickr->request('flickr.photos.geo.removeLocation', $params);
    }

    /**
     * Indicate the state of a photo's geotagginess beyond latitude and longitude.<br
     * /><br />
Note : photos passed to this method must already be geotagged (using
     * the <q>flickr.photos.geo.setLocation</q> method).
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.geo.setContext.html
     * @param string $photoId The id of the photo to set context data for.
     * @param string $context Context is a numeric value representing the photo's
     * geotagginess beyond latitude and longitude. For example, you may wish to
     * indicate that a photo was taken "indoors" or "outdoors". <br /><br /> The
     * current list of context IDs is :<br /><br/> <ul> <li><strong>0</strong>, not
     * defined.</li> <li><strong>1</strong>, indoors.</li> <li><strong>2</strong>,
     * outdoors.</li> </ul>
     * @return
     */
    public function setContext($photoId, $context)
    {
        $params = [
            'photo_id' => $photoId,
            'context' => $context
        ];
        return $this->flickr->request('flickr.photos.geo.setContext', $params);
    }

    /**
     * Sets the geo data (latitude and longitude and, optionally, the accuracy level)
     * for a photo.

Before users may assign location data to a photo they must define
     * who, by default, may view that information. Users can edit this preference at <a
     * href="http://www.flickr.com/account/geo/privacy/">http://www.flickr.com/account/geo/privacy/</a>.
     * If a user has not set this preference, the API method will return an error.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.geo.setLocation.html
     * @param string $photoId The id of the photo to set location data for.
     * @param string $lat The latitude whose valid range is -90 to 90. Anything more
     * than 6 decimal places will be truncated.
     * @param string $lon The longitude whose valid range is -180 to 180. Anything more
     * than 6 decimal places will be truncated.
     * @param string $accuracy Recorded accuracy level of the location information.
     * World level is 1, Country is ~3, Region ~6, City ~11, Street ~16. Current range
     * is 1-16. Defaults to 16 if not specified.
     * @param string $context Context is a numeric value representing the photo's
     * geotagginess beyond latitude and longitude. For example, you may wish to
     * indicate that a photo was taken "indoors" or "outdoors". <br /><br /> The
     * current list of context IDs is :<br /><br/> <ul> <li><strong>0</strong>, not
     * defined.</li> <li><strong>1</strong>, indoors.</li> <li><strong>2</strong>,
     * outdoors.</li> </ul><br /> The default context for geotagged photos is 0, or
     * "not defined"
     * @return
     */
    public function setLocation($photoId, $lat, $lon, $accuracy = null, $context = null)
    {
        $params = [
            'photo_id' => $photoId,
            'lat' => $lat,
            'lon' => $lon,
            'accuracy' => $accuracy,
            'context' => $context
        ];
        return $this->flickr->request('flickr.photos.geo.setLocation', $params);
    }

    /**
     * Set the permission for who may view the geo data associated with a photo.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.geo.setPerms.html
     * @param string $isPublic 1 to set viewing permissions for the photo's location
     * data to public, 0 to set it to private.
     * @param string $isContact 1 to set viewing permissions for the photo's location
     * data to contacts, 0 to set it to private.
     * @param string $isFriend 1 to set viewing permissions for the photo's location
     * data to friends, 0 to set it to private.
     * @param string $isFamily 1 to set viewing permissions for the photo's location
     * data to family, 0 to set it to private.
     * @param string $photoId The id of the photo to get permissions for.
     * @return
     */
    public function setPerms($isPublic, $isContact, $isFriend, $isFamily, $photoId)
    {
        $params = [
            'is_public' => $isPublic,
            'is_contact' => $isContact,
            'is_friend' => $isFriend,
            'is_family' => $isFamily,
            'photo_id' => $photoId
        ];
        return $this->flickr->request('flickr.photos.geo.setPerms', $params);
    }
}
