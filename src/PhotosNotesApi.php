<?php

namespace Samwilson\PhpFlickr;

class PhotosNotesApi extends ApiMethodGroup
{
    /**
     * Add a note to a photo. Coordinates and sizes are in pixels, based on the 500px
     * image size shown on individual photo pages.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.notes.add.html
     * @param string $photoId The id of the photo to add a note to
     * @param string $noteX The left coordinate of the note
     * @param string $noteY The top coordinate of the note
     * @param string $noteW The width of the note
     * @param string $noteH The height of the note
     * @param string $noteText The description of the note
     * @return
     */
    public function add($photoId, $noteX, $noteY, $noteW, $noteH, $noteText)
    {
        $params = [
            'photo_id' => $photoId,
            'note_x' => $noteX,
            'note_y' => $noteY,
            'note_w' => $noteW,
            'note_h' => $noteH,
            'note_text' => $noteText
        ];
        return $this->flickr->request('flickr.photos.notes.add', $params);
    }

    /**
     * Delete a note from a photo.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.notes.delete.html
     * @param string $noteId The id of the note to delete
     * @return
     */
    public function delete($noteId)
    {
        $params = [
            'note_id' => $noteId
        ];
        return $this->flickr->request('flickr.photos.notes.delete', $params);
    }

    /**
     * Edit a note on a photo. Coordinates and sizes are in pixels, based on the 500px
     * image size shown on individual photo pages.

     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.photos.notes.edit.html
     * @param string $noteId The id of the note to edit
     * @param string $noteX The left coordinate of the note
     * @param string $noteY The top coordinate of the note
     * @param string $noteW The width of the note
     * @param string $noteH The height of the note
     * @param string $noteText The description of the note
     * @return
     */
    public function edit($noteId, $noteX, $noteY, $noteW, $noteH, $noteText)
    {
        $params = [
            'note_id' => $noteId,
            'note_x' => $noteX,
            'note_y' => $noteY,
            'note_w' => $noteW,
            'note_h' => $noteH,
            'note_text' => $noteText
        ];
        return $this->flickr->request('flickr.photos.notes.edit', $params);
    }
}
