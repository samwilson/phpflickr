<?php

namespace Samwilson\PhpFlickr;

class CamerasApi extends ApiMethodGroup
{
    /**
     * Retrieve all the models for a given camera brand.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.cameras.getBrandModels.html
     * @param string $brand The ID of the requested brand (as returned from
     * flickr.cameras.getBrands).
     * @return
     */
    public function getBrandModels($brand)
    {
        $params = [
            'brand' => $brand
        ];
        return $this->flickr->request('flickr.cameras.getBrandModels', $params);
    }

    /**
     * Returns all the brands of cameras that Flickr knows about.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.cameras.getBrands.html
     *
     * @return
     */
    public function getBrands()
    {
        return $this->flickr->request('flickr.cameras.getBrands');
    }
}
