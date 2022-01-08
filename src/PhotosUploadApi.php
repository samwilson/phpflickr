<?php

namespace Samwilson\PhpFlickr;

class PhotosUploadApi extends ApiMethodGroup
{
    /**
     * Checks the status of one or more asynchronous photo upload tickets.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.upload.checkTickets.html
     * @param string $tickets A comma-delimited list of ticket ids
     * @return
     */
    public function checkTickets($tickets)
    {
        $params = [
            'tickets' => $tickets
        ];
        return $this->flickr->request('flickr.photos.upload.checkTickets', $params);
    }
}
