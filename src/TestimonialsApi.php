<?php

namespace Samwilson\PhpFlickr;

class TestimonialsApi extends ApiMethodGroup
{
    /**
     * Write a new testimonial
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.testimonials.addTestimonial.html
     * @param string $userId ID of the user the testimonial is about
     * @param string $testimonialText The text of the testimonial. HTML/BBCode is not
     * accepted
     * @return
     */
    public function addTestimonial($userId, $testimonialText)
    {
        $params = [
            'user_id' => $userId,
            'testimonial_text' => $testimonialText
        ];
        return $this->flickr->request('flickr.testimonials.addTestimonial', $params);
    }

    /**
     * Approve a testimonial that has been written about the currently loggedin user
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.testimonials.approveTestimonial.html
     * @param string $testimonialId ID of the testimonial to approve
     * @return
     */
    public function approveTestimonial($testimonialId)
    {
        $params = [
            'testimonial_id' => $testimonialId
        ];
        return $this->flickr->request('flickr.testimonials.approveTestimonial', $params);
    }

    /**
     * Permanently delete a testimonial. The loggedin user must be either the author or
     * recipient of the testimonial
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.testimonials.deleteTestimonial.html
     * @param string $testimonialId
     * @return
     */
    public function deleteTestimonial($testimonialId)
    {
        $params = [
            'testimonial_id' => $testimonialId
        ];
        return $this->flickr->request('flickr.testimonials.deleteTestimonial', $params);
    }

    /**
     * Change the text of a testimonial. The loggedin user must be the author of the
     * existing testimonial. Editing a testimonial will mark it as pending and will
     * require it to be re-approved by the recipient before appearing on their profile
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.testimonials.editTestimonial.html
     * @param string $userId The NSID of the user the testimonial is about
     * @param string $testimonialId The ID of the testimonial to edit
     * @param string $testimonialText The text of the testimonial. HTML/BBCode is not
     * accepted
     * @return
     */
    public function editTestimonial($userId, $testimonialId, $testimonialText)
    {
        $params = [
            'user_id' => $userId,
            'testimonial_id' => $testimonialId,
            'testimonial_text' => $testimonialText
        ];
        return $this->flickr->request('flickr.testimonials.editTestimonial', $params);
    }

    /**
     * Get all testimonials (pending and approved) written about the given user
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.testimonials.getAllTestimonialsAbout.html
     * @param string $page Page number. Default is 0
     * @param string $perPage Number of testimonials to return per page. Default is 10,
     * maximum is 50
     * @return
     */
    public function getAllTestimonialsAbout($page = null, $perPage = null)
    {
        $params = [
            'page' => $page,
            'per_page' => $perPage
        ];
        return $this->flickr->request('flickr.testimonials.getAllTestimonialsAbout', $params);
    }

    /**
     * Get the testimonial by the currently logged-in user about the given user,
     * regardless of approval status. Note that at most 1 testimonial will be returned
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.testimonials.getAllTestimonialsAboutBy.html
     * @param string $userId ID of the user to get testimonials about
     * @return
     */
    public function getAllTestimonialsAboutBy($userId)
    {
        $params = [
            'user_id' => $userId
        ];
        return $this->flickr->request('flickr.testimonials.getAllTestimonialsAboutBy', $params);
    }

    /**
     * Get all testimonials (pending and approved) written by the given user
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.testimonials.getAllTestimonialsBy.html
     * @param string $page Page number. Default is 0
     * @param string $perPage Number of testimonials to return per page. Default is 10,
     * maximum is 50
     * @return
     */
    public function getAllTestimonialsBy($page = null, $perPage = null)
    {
        $params = [
            'page' => $page,
            'per_page' => $perPage
        ];
        return $this->flickr->request('flickr.testimonials.getAllTestimonialsBy', $params);
    }

    /**
     * Get all pending testimonials written about the given user
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.testimonials.getPendingTestimonialsAbout.html
     * @param string $page Page number. Default is 0
     * @param string $perPage Number of testimonials to return per page. Default is 10,
     * maximum is 50
     * @return
     */
    public function getPendingTestimonialsAbout($page = null, $perPage = null)
    {
        $params = [
            'page' => $page,
            'per_page' => $perPage
        ];
        return $this->flickr->request('flickr.testimonials.getPendingTestimonialsAbout', $params);
    }

    /**
     * Get the pending testimonial by the currently logged-in user about the given
     * user. Note that at most 1 testimonial will be returned
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.testimonials.getPendingTestimonialsAboutBy.html
     * @param string $userId ID of the user to get testimonials about
     * @return
     */
    public function getPendingTestimonialsAboutBy($userId)
    {
        $params = [
            'user_id' => $userId
        ];
        return $this->flickr->request('flickr.testimonials.getPendingTestimonialsAboutBy', $params);
    }

    /**
     * Get all pending testimonials written by the given user
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.testimonials.getPendingTestimonialsBy.html
     * @param string $page Page number. Default is 0
     * @param string $perPage Number of testimonials to return per page. Default is 10,
     * maximum is 50
     * @return
     */
    public function getPendingTestimonialsBy($page = null, $perPage = null)
    {
        $params = [
            'page' => $page,
            'per_page' => $perPage
        ];
        return $this->flickr->request('flickr.testimonials.getPendingTestimonialsBy', $params);
    }

    /**
     * Get approved testimonials about the given user
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.testimonials.getTestimonialsAbout.html
     * @param string $userId ID of the user to get testimonials about
     * @param string $page Page number. Default is 0
     * @param string $perPage Number of testimonials to return per page. Default is 10,
     * maximum is 50
     * @return
     */
    public function getTestimonialsAbout($userId, $page = null, $perPage = null)
    {
        $params = [
            'user_id' => $userId,
            'page' => $page,
            'per_page' => $perPage
        ];
        return $this->flickr->request('flickr.testimonials.getTestimonialsAbout', $params);
    }

    /**
     * Get the approved testimonial by the currently logged-in user about the given
     * user. Note that at most 1 testimonial will be returned
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.testimonials.getTestimonialsAboutBy.html
     * @param string $userId ID of the user to get testimonials about
     * @return
     */
    public function getTestimonialsAboutBy($userId)
    {
        $params = [
            'user_id' => $userId
        ];
        return $this->flickr->request('flickr.testimonials.getTestimonialsAboutBy', $params);
    }

    /**
     * Get approved testimonials written by the given user
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.testimonials.getTestimonialsBy.html
     * @param string $userId ID of the user to get testimonials written by
     * @param string $page Page number. Default is 0
     * @param string $perPage Number of testimonials to return per page. Default is 10,
     * maximum is 50
     * @return
     */
    public function getTestimonialsBy($userId, $page = null, $perPage = null)
    {
        $params = [
            'user_id' => $userId,
            'page' => $page,
            'per_page' => $perPage
        ];
        return $this->flickr->request('flickr.testimonials.getTestimonialsBy', $params);
    }
}
