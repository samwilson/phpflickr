<?php

namespace Samwilson\PhpFlickr;

class PrefsApi extends ApiMethodGroup
{
    /**
     * Returns the default content type preference for the user.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.prefs.getContentType.html
     *
     * @return
     */
    public function getContentType()
    {
        return $this->flickr->request('flickr.prefs.getContentType');
    }

    /**
     * Returns the default privacy level for geographic information attached to the
     * user's photos and whether or not the user has chosen to use geo-related EXIF
     * information to automatically geotag their photos.

Possible values, for viewing
     * geotagged photos, are:

<ul>
<li>0 : <i>No default set</i></li>
<li>1 :
     * Public</li>
<li>2 : Contacts only</li>
<li>3 : Friends and Family
     * only</li>
<li>4 : Friends only</li>
<li>5 : Family only</li>
<li>6 :
     * Private</li>
</ul>

Users can edit this preference at <a
     * href="http://www.flickr.com/account/geo/privacy/">http://www.flickr.com/account/geo/privacy/</a>.
<br
     * /><br />
Possible values for whether or not geo-related EXIF information will be
     * used to geotag a photo are:

<ul>
<li>0: Geo-related EXIF information will be
     * ignored</li>
<li>1: Geo-related EXIF information will be used to try and geotag
     * photos on upload</li>
</ul>

Users can edit this preference at <a
     * href="http://www.flickr.com/account/geo/exif/?from=privacy">http://www.flickr.com/account/geo/exif/?from=privacy</a>
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.prefs.getGeoPerms.html
     *
     * @return
     */
    public function getGeoPerms()
    {
        return $this->flickr->request('flickr.prefs.getGeoPerms');
    }

    /**
     * Returns the default hidden preference for the user.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.prefs.getHidden.html
     *
     * @return
     */
    public function getHidden()
    {
        return $this->flickr->request('flickr.prefs.getHidden');
    }

    /**
     * Returns the default privacy level preference for the user.

Possible values
     * are:
<ul>
<li>1 : Public</li>
<li>2 : Friends only</li>
<li>3 : Family
     * only</li>
<li>4 : Friends and Family</li>
<li>5 : Private</li>
</ul>
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.prefs.getPrivacy.html
     *
     * @return
     */
    public function getPrivacy()
    {
        return $this->flickr->request('flickr.prefs.getPrivacy');
    }

    /**
     * Returns the default safety level preference for the user.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.prefs.getSafetyLevel.html
     *
     * @return
     */
    public function getSafetyLevel()
    {
        return $this->flickr->request('flickr.prefs.getSafetyLevel');
    }
}
