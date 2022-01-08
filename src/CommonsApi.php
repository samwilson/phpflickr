<?php

namespace Samwilson\PhpFlickr;

class CommonsApi extends ApiMethodGroup
{
    /**
     * Retrieves a list of the current Commons institutions.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.commons.getInstitutions.html
     *
     * @return
     */
    public function getInstitutions()
    {
        return $this->flickr->request('flickr.commons.getInstitutions');
    }
}
