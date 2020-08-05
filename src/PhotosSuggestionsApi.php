<?php

namespace Samwilson\PhpFlickr;

class PhotosSuggestionsApi extends ApiMethodGroup
{
    /**
     * Approve a suggestion for a photo.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.suggestions.approveSuggestion.html
     * @param string $suggestionId The unique ID for the location suggestion to
     * approve.
     * @return
     */
    public function approveSuggestion($suggestionId)
    {
        $params = [
            'suggestion_id' => $suggestionId
        ];
        return $this->flickr->request('flickr.photos.suggestions.approveSuggestion', $params);
    }

    /**
     * Return a list of suggestions for a user that are pending approval.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.suggestions.getList.html
     * @param string $photoId Only show suggestions for a single photo.
     * @param string $statusId Only show suggestions with a given status.  <ul>
     * <li><strong>0</strong>, pending</li> <li><strong>1</strong>, approved</li>
     * <li><strong>2</strong>, rejected</li> </ul>  The default is pending (or "0").
     * @return
     */
    public function getList($photoId = null, $statusId = null)
    {
        $params = [
            'photo_id' => $photoId,
            'status_id' => $statusId
        ];
        return $this->flickr->request('flickr.photos.suggestions.getList', $params);
    }

    /**
     * Reject a suggestion for a photo.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.suggestions.rejectSuggestion.html
     * @param string $suggestionId The unique ID of the suggestion to reject.
     * @return
     */
    public function rejectSuggestion($suggestionId)
    {
        $params = [
            'suggestion_id' => $suggestionId
        ];
        return $this->flickr->request('flickr.photos.suggestions.rejectSuggestion', $params);
    }

    /**
     * Remove a suggestion, made by the calling user, from a photo.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.suggestions.removeSuggestion.html
     * @param string $suggestionId The unique ID for the location suggestion to
     * approve.
     * @return
     */
    public function removeSuggestion($suggestionId)
    {
        $params = [
            'suggestion_id' => $suggestionId
        ];
        return $this->flickr->request('flickr.photos.suggestions.removeSuggestion', $params);
    }

    /**
     * Suggest a geotagged location for a photo.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.suggestions.suggestLocation.html
     * @param string $photoId The photo whose location you are suggesting.
     * @param string $lat The latitude whose valid range is -90 to 90. Anything more
     * than 6 decimal places will be truncated.
     * @param string $lon The longitude whose valid range is -180 to 180. Anything more
     * than 6 decimal places will be truncated.
     * @param string $accuracy Recorded accuracy level of the location information.
     * World level is 1, Country is ~3, Region ~6, City ~11, Street ~16. Current range
     * is 1-16. Defaults to 16 if not specified.
     * @param string $woeId The WOE ID of the location used to build the location
     * hierarchy for the photo.
     * @param string $placeId The Flickr Places ID of the location used to build the
     * location hierarchy for the photo.
     * @param string $note A short note or history to include with the suggestion.
     * @return
     */
    public function suggestLocation(
        $photoId,
        $lat,
        $lon,
        $accuracy = null,
        $woeId = null,
        $placeId = null,
        $note = null
    ) {
        $params = [
            'photo_id' => $photoId,
            'lat' => $lat,
            'lon' => $lon,
            'accuracy' => $accuracy,
            'woe_id' => $woeId,
            'place_id' => $placeId,
            'note' => $note
        ];
        return $this->flickr->request('flickr.photos.suggestions.suggestLocation', $params);
    }
}
