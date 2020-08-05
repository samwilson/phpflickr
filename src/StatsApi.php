<?php

namespace Samwilson\PhpFlickr;

class StatsApi extends ApiMethodGroup
{
    /**
     * Get a list of referring domains for a collection
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.stats.getCollectionDomains.html
     * @param string $date Stats will be returned for this date. This should be in
     * either be in YYYY-MM-DD or unix timestamp format.  A day according to Flickr
     * Stats starts at midnight GMT for all users, and timestamps will automatically be
     * rounded down to the start of the day.
     * @param string $collectionId The id of the collection to get stats for. If not
     * provided, stats for all collections will be returned.
     * @param string $perPage Number of domains to return per page. If this argument is
     * omitted, it defaults to 25. The maximum allowed value is 100.
     * @param string $page The page of results to return. If this argument is omitted,
     * it defaults to 1.
     * @return
     */
    public function getCollectionDomains($date, $collectionId = null, $perPage = null, $page = null)
    {
        $params = [
            'date' => $date,
            'collection_id' => $collectionId,
            'per_page' => $perPage,
            'page' => $page
        ];
        return $this->flickr->request('flickr.stats.getCollectionDomains', $params);
    }

    /**
     * Get a list of referrers from a given domain to a collection
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.stats.getCollectionReferrers.html
     * @param string $date Stats will be returned for this date. This should be in
     * either be in YYYY-MM-DD or unix timestamp format.  A day according to Flickr
     * Stats starts at midnight GMT for all users, and timestamps will automatically be
     * rounded down to the start of the day.
     * @param string $domain The domain to return referrers for. This should be a
     * hostname (eg: "flickr.com") with no protocol or pathname.
     * @param string $collectionId The id of the collection to get stats for. If not
     * provided, stats for all collections will be returned.
     * @param string $perPage Number of referrers to return per page. If this argument
     * is omitted, it defaults to 25. The maximum allowed value is 100.
     * @param string $page The page of results to return. If this argument is omitted,
     * it defaults to 1.
     * @return
     */
    public function getCollectionReferrers($date, $domain, $collectionId = null, $perPage = null, $page = null)
    {
        $params = [
            'date' => $date,
            'domain' => $domain,
            'collection_id' => $collectionId,
            'per_page' => $perPage,
            'page' => $page
        ];
        return $this->flickr->request('flickr.stats.getCollectionReferrers', $params);
    }

    /**
     * Get the number of views on a collection for a given date.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.stats.getCollectionStats.html
     * @param string $date Stats will be returned for this date. This should be in
     * either be in YYYY-MM-DD or unix timestamp format.  A day according to Flickr
     * Stats starts at midnight GMT for all users, and timestamps will automatically be
     * rounded down to the start of the day.
     * @param string $collectionId The id of the collection to get stats for.
     * @return
     */
    public function getCollectionStats($date, $collectionId)
    {
        $params = [
            'date' => $date,
            'collection_id' => $collectionId
        ];
        return $this->flickr->request('flickr.stats.getCollectionStats', $params);
    }

    /**
     * Returns a list of URLs for text files containing <i>all</i> your stats data
     * (from November 26th 2007 onwards) for the currently auth'd user.

<b>Please
     * note, these files will only be available until June 1, 2010 Noon PDT.</b>
For
     * more information <a href="/help/stats/#1369409">please check out this FAQ</a>,
     * or just <a href="/photos/me/stats/downloads/">go download your files</a>.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.stats.getCSVFiles.html
     *
     * @return
     */
    public function getCSVFiles()
    {
        return $this->flickr->request('flickr.stats.getCSVFiles');
    }

    /**
     * Get a list of referring domains for a photo
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.stats.getPhotoDomains.html
     * @param string $date Stats will be returned for this date. This should be in
     * either be in YYYY-MM-DD or unix timestamp format.  A day according to Flickr
     * Stats starts at midnight GMT for all users, and timestamps will automatically be
     * rounded down to the start of the day.
     * @param string $photoId The id of the photo to get stats for. If not provided,
     * stats for all photos will be returned.
     * @param string $perPage Number of domains to return per page. If this argument is
     * omitted, it defaults to 25. The maximum allowed value is 100.
     * @param string $page The page of results to return. If this argument is omitted,
     * it defaults to 1.
     * @return
     */
    public function getPhotoDomains($date, $photoId = null, $perPage = null, $page = null)
    {
        $params = [
            'date' => $date,
            'photo_id' => $photoId,
            'per_page' => $perPage,
            'page' => $page
        ];
        return $this->flickr->request('flickr.stats.getPhotoDomains', $params);
    }

    /**
     * Get a list of referrers from a given domain to a photo
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.stats.getPhotoReferrers.html
     * @param string $date Stats will be returned for this date. This should be in
     * either be in YYYY-MM-DD or unix timestamp format.  A day according to Flickr
     * Stats starts at midnight GMT for all users, and timestamps will automatically be
     * rounded down to the start of the day.
     * @param string $domain The domain to return referrers for. This should be a
     * hostname (eg: "flickr.com") with no protocol or pathname.
     * @param string $photoId The id of the photo to get stats for. If not provided,
     * stats for all photos will be returned.
     * @param string $perPage Number of referrers to return per page. If this argument
     * is omitted, it defaults to 25. The maximum allowed value is 100.
     * @param string $page The page of results to return. If this argument is omitted,
     * it defaults to 1.
     * @return
     */
    public function getPhotoReferrers($date, $domain, $photoId = null, $perPage = null, $page = null)
    {
        $params = [
            'date' => $date,
            'domain' => $domain,
            'photo_id' => $photoId,
            'per_page' => $perPage,
            'page' => $page
        ];
        return $this->flickr->request('flickr.stats.getPhotoReferrers', $params);
    }

    /**
     * Get a list of referring domains for a photoset
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.stats.getPhotosetDomains.html
     * @param string $date Stats will be returned for this date. This should be in
     * either be in YYYY-MM-DD or unix timestamp format.  A day according to Flickr
     * Stats starts at midnight GMT for all users, and timestamps will automatically be
     * rounded down to the start of the day.
     * @param string $photosetId The id of the photoset to get stats for. If not
     * provided, stats for all sets will be returned.
     * @param string $perPage Number of domains to return per page. If this argument is
     * omitted, it defaults to 25. The maximum allowed value is 100.
     * @param string $page The page of results to return. If this argument is omitted,
     * it defaults to 1.
     * @return
     */
    public function getPhotosetDomains($date, $photosetId = null, $perPage = null, $page = null)
    {
        $params = [
            'date' => $date,
            'photoset_id' => $photosetId,
            'per_page' => $perPage,
            'page' => $page
        ];
        return $this->flickr->request('flickr.stats.getPhotosetDomains', $params);
    }

    /**
     * Get a list of referrers from a given domain to a photoset
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.stats.getPhotosetReferrers.html
     * @param string $date Stats will be returned for this date. This should be in
     * either be in YYYY-MM-DD or unix timestamp format.  A day according to Flickr
     * Stats starts at midnight GMT for all users, and timestamps will automatically be
     * rounded down to the start of the day.
     * @param string $domain The domain to return referrers for. This should be a
     * hostname (eg: "flickr.com") with no protocol or pathname.
     * @param string $photosetId The id of the photoset to get stats for. If not
     * provided, stats for all sets will be returned.
     * @param string $perPage Number of referrers to return per page. If this argument
     * is omitted, it defaults to 25. The maximum allowed value is 100.
     * @param string $page The page of results to return. If this argument is omitted,
     * it defaults to 1.
     * @return
     */
    public function getPhotosetReferrers($date, $domain, $photosetId = null, $perPage = null, $page = null)
    {
        $params = [
            'date' => $date,
            'domain' => $domain,
            'photoset_id' => $photosetId,
            'per_page' => $perPage,
            'page' => $page
        ];
        return $this->flickr->request('flickr.stats.getPhotosetReferrers', $params);
    }

    /**
     * Get the number of views on a photoset for a given date.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.stats.getPhotosetStats.html
     * @param string $date Stats will be returned for this date. This should be in
     * either be in YYYY-MM-DD or unix timestamp format.  A day according to Flickr
     * Stats starts at midnight GMT for all users, and timestamps will automatically be
     * rounded down to the start of the day.
     * @param string $photosetId The id of the photoset to get stats for.
     * @return
     */
    public function getPhotosetStats($date, $photosetId)
    {
        $params = [
            'date' => $date,
            'photoset_id' => $photosetId
        ];
        return $this->flickr->request('flickr.stats.getPhotosetStats', $params);
    }

    /**
     * Get the number of views, comments and favorites on a photo for a given date.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.stats.getPhotoStats.html
     * @param string $date Stats will be returned for this date. This should be in
     * either be in YYYY-MM-DD or unix timestamp format.  A day according to Flickr
     * Stats starts at midnight GMT for all users, and timestamps will automatically be
     * rounded down to the start of the day.
     * @param string $photoId The id of the photo to get stats for.
     * @return
     */
    public function getPhotoStats($date, $photoId)
    {
        $params = [
            'date' => $date,
            'photo_id' => $photoId
        ];
        return $this->flickr->request('flickr.stats.getPhotoStats', $params);
    }

    /**
     * Get a list of referring domains for a photostream
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.stats.getPhotostreamDomains.html
     * @param string $date Stats will be returned for this date. This should be in
     * either be in YYYY-MM-DD or unix timestamp format.  A day according to Flickr
     * Stats starts at midnight GMT for all users, and timestamps will automatically be
     * rounded down to the start of the day.
     * @param string $perPage Number of domains to return per page. If this argument is
     * omitted, it defaults to 25. The maximum allowed value is 100
     * @param string $page The page of results to return. If this argument is omitted,
     * it defaults to 1.
     * @return
     */
    public function getPhotostreamDomains($date, $perPage = null, $page = null)
    {
        $params = [
            'date' => $date,
            'per_page' => $perPage,
            'page' => $page
        ];
        return $this->flickr->request('flickr.stats.getPhotostreamDomains', $params);
    }

    /**
     * Get a list of referrers from a given domain to a user's photostream
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.stats.getPhotostreamReferrers.html
     * @param string $date Stats will be returned for this date. This should be in
     * either be in YYYY-MM-DD or unix timestamp format.  A day according to Flickr
     * Stats starts at midnight GMT for all users, and timestamps will automatically be
     * rounded down to the start of the day.
     * @param string $domain The domain to return referrers for. This should be a
     * hostname (eg: "flickr.com") with no protocol or pathname.
     * @param string $perPage Number of referrers to return per page. If this argument
     * is omitted, it defaults to 25. The maximum allowed value is 100.
     * @param string $page The page of results to return. If this argument is omitted,
     * it defaults to 1.
     * @return
     */
    public function getPhotostreamReferrers($date, $domain, $perPage = null, $page = null)
    {
        $params = [
            'date' => $date,
            'domain' => $domain,
            'per_page' => $perPage,
            'page' => $page
        ];
        return $this->flickr->request('flickr.stats.getPhotostreamReferrers', $params);
    }

    /**
     * Get the number of views on a user's photostream for a given date.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.stats.getPhotostreamStats.html
     * @param string $date Stats will be returned for this date. This should be in
     * either be in YYYY-MM-DD or unix timestamp format.  A day according to Flickr
     * Stats starts at midnight GMT for all users, and timestamps will automatically be
     * rounded down to the start of the day.
     * @return
     */
    public function getPhotostreamStats($date)
    {
        $params = [
            'date' => $date
        ];
        return $this->flickr->request('flickr.stats.getPhotostreamStats', $params);
    }

    /**
     * List the photos with the most views, comments or favorites
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.stats.getPopularPhotos.html
     * @param string $date Stats will be returned for this date. This should be in
     * either be in YYYY-MM-DD or unix timestamp format.  A day according to Flickr
     * Stats starts at midnight GMT for all users, and timestamps will automatically be
     * rounded down to the start of the day.  If no date is provided, all time view
     * counts will be returned.
     * @param string $sort The order in which to sort returned photos. Defaults to
     * views. The possible values are views, comments and favorites.  Other sort
     * options are available through <a
     * href="/services/api/flickr.photos.search.html">flickr.photos.search</a>.
     * @param string $perPage Number of referrers to return per page. If this argument
     * is omitted, it defaults to 25. The maximum allowed value is 100.
     * @param string $page The page of results to return. If this argument is omitted,
     * it defaults to 1.
     * @return
     */
    public function getPopularPhotos($date = null, $sort = null, $perPage = null, $page = null)
    {
        $params = [
            'date' => $date,
            'sort' => $sort,
            'per_page' => $perPage,
            'page' => $page
        ];
        return $this->flickr->request('flickr.stats.getPopularPhotos', $params);
    }

    /**
     * Get the overall view counts for an account
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.stats.getTotalViews.html
     * @param string $date Stats will be returned for this date. This should be in
     * either be in YYYY-MM-DD or unix timestamp format.  A day according to Flickr
     * Stats starts at midnight GMT for all users, and timestamps will automatically be
     * rounded down to the start of the day.  If no date is provided, all time view
     * counts will be returned.
     * @return
     */
    public function getTotalViews($date = null)
    {
        $params = [
            'date' => $date
        ];
        return $this->flickr->request('flickr.stats.getTotalViews', $params);
    }
}
