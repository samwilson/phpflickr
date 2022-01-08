<?php

namespace Samwilson\PhpFlickr;

class ReflectionApi extends ApiMethodGroup
{
    /**
     * Returns information for a given flickr API method.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.reflection.getMethodInfo.html
     * @param string $methodName The name of the method to fetch information for.
     * @return
     */
    public function getMethodInfo($methodName)
    {
        $params = [
            'method_name' => $methodName
        ];
        return $this->flickr->request('flickr.reflection.getMethodInfo', $params);
    }

    /**
     * Returns a list of available flickr API methods.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.reflection.getMethods.html
     *
     * @return
     */
    public function getMethods()
    {
        return $this->flickr->request('flickr.reflection.getMethods');
    }
}
