<?php

namespace Samwilson\PhpFlickr;

class PhotosTransformApi extends ApiMethodGroup
{
    /**
     * Rotate a photo.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.transform.rotate.html
     * @param string $photoId The id of the photo to rotate.
     * @param string $degrees The amount of degrees by which to rotate the photo
     * (clockwise) from it's current orientation. Valid values are 90, 180 and 270.
     * @return
     */
    public function rotate($photoId, $degrees)
    {
        $params = [
            'photo_id' => $photoId,
            'degrees' => $degrees
        ];
        return $this->flickr->request('flickr.photos.transform.rotate', $params);
    }
}
