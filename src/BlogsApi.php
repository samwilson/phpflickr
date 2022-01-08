<?php

namespace Samwilson\PhpFlickr;

class BlogsApi extends ApiMethodGroup
{
    /**
     * Get a list of configured blogs for the calling user.
     *
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.blogs.getList.html
     * @param string $service Optionally only return blogs for a given service id.  You
     * can get a list of from <a
     * href="/services/api/flickr.blogs.getServices.html">flickr.blogs.getServices()</a>.
     * @return
     */
    public function getList($service = null)
    {
        $params = [
            'service' => $service
        ];
        return $this->flickr->request('flickr.blogs.getList', $params);
    }

    /**
     * Return a list of Flickr supported blogging services
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.blogs.getServices.html
     *
     * @return
     */
    public function getServices()
    {
        return $this->flickr->request('flickr.blogs.getServices');
    }

    /**
     * This method requires authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.blogs.postPhoto.html
     * @param string $photoId The id of the photo to blog
     * @param string $title The blog post title
     * @param string $description The blog post body
     * @param string $blogPassword The password for the blog (used when the blog does
     * not have a stored password).
     * @param string $service A Flickr supported blogging service.  Instead of passing
     * a blog id you can pass a service id and we'll post to the first blog of that
     * service we find.
     * @param string $blogId The id of the blog to post to.
     * @return
     */
    public function postPhoto($photoId, $title, $description, $blogPassword = null, $service = null, $blogId = null)
    {
        $params = [
            'blog_id' => $blogId,
            'photo_id' => $photoId,
            'title' => $title,
            'description' => $description,
            'blog_password' => $blogPassword,
            'service' => $service
        ];
        return $this->flickr->request('flickr.blogs.postPhoto', $params);
    }
}
