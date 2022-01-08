<?php

namespace Samwilson\PhpFlickr;

class PhotosPeopleApi extends ApiMethodGroup
{
    /**
     * Add a person to a photo. Coordinates and sizes of boxes are optional; they are
     * measured in pixels, based on the 500px image size shown on individual photo
     * pages.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.people.add.html
     * @param string $photoId The id of the photo to add a person to.
     * @param string $userId The NSID of the user to add to the photo.
     * @param string $personX The left-most pixel co-ordinate of the box around the
     * person.
     * @param string $personY The top-most pixel co-ordinate of the box around the
     * person.
     * @param string $personW The width (in pixels) of the box around the person.
     * @param string $personH The height (in pixels) of the box around the person.
     * @return
     */
    public function add($photoId, $userId, $personX = null, $personY = null, $personW = null, $personH = null)
    {
        $params = [
            'photo_id' => $photoId,
            'user_id' => $userId,
            'person_x' => $personX,
            'person_y' => $personY,
            'person_w' => $personW,
            'person_h' => $personH
        ];
        return $this->flickr->request('flickr.photos.people.add', $params);
    }

    /**
     * Remove a person from a photo.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.people.delete.html
     * @param string $photoId The id of the photo to remove a person from.
     * @param string $userId The NSID of the person to remove from the photo.
     * @return
     */
    public function delete($photoId, $userId)
    {
        $params = [
            'photo_id' => $photoId,
            'user_id' => $userId
        ];
        return $this->flickr->request('flickr.photos.people.delete', $params);
    }

    /**
     * Remove the bounding box from a person in a photo
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.people.deleteCoords.html
     * @param string $photoId The id of the photo to edit a person in.
     * @param string $userId The NSID of the person whose bounding box you want to
     * remove.
     * @return
     */
    public function deleteCoords($photoId, $userId)
    {
        $params = [
            'photo_id' => $photoId,
            'user_id' => $userId
        ];
        return $this->flickr->request('flickr.photos.people.deleteCoords', $params);
    }

    /**
     * Edit the bounding box of an existing person on a photo.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.people.editCoords.html
     * @param string $photoId The id of the photo to edit a person in.
     * @param string $userId The NSID of the person to edit in a photo.
     * @param string $personX The left-most pixel co-ordinate of the box around the
     * person.
     * @param string $personY The top-most pixel co-ordinate of the box around the
     * person.
     * @param string $personW The width (in pixels) of the box around the person.
     * @param string $personH The height (in pixels) of the box around the person.
     * @return
     */
    public function editCoords($photoId, $userId, $personX, $personY, $personW, $personH)
    {
        $params = [
            'photo_id' => $photoId,
            'user_id' => $userId,
            'person_x' => $personX,
            'person_y' => $personY,
            'person_w' => $personW,
            'person_h' => $personH
        ];
        return $this->flickr->request('flickr.photos.people.editCoords', $params);
    }

    /**
     * Get a list of people in a given photo.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.people.getList.html
     * @param string $photoId The id of the photo to get a list of people for.
     * @return
     */
    public function getList($photoId)
    {
        $params = [
            'photo_id' => $photoId
        ];
        return $this->flickr->request('flickr.photos.people.getList', $params);
    }
}
