<?php

namespace Samwilson\PhpFlickr;

class MachinetagsApi extends ApiMethodGroup
{
    /**
     * Return a list of unique namespaces, optionally limited by a given predicate, in
     * alphabetical order.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.machinetags.getNamespaces.html
     * @param string $predicate Limit the list of namespaces returned to those that
     * have the following predicate.
     * @param string $perPage Number of photos to return per page. If this argument is
     * omitted, it defaults to 100. The maximum allowed value is 500.
     * @param string $page The page of results to return. If this argument is omitted,
     * it defaults to 1.
     * @return
     */
    public function getNamespaces($predicate = null, $perPage = null, $page = null)
    {
        $params = [
            'predicate' => $predicate,
            'per_page' => $perPage,
            'page' => $page
        ];
        return $this->flickr->request('flickr.machinetags.getNamespaces', $params);
    }

    /**
     * Return a list of unique namespace and predicate pairs, optionally limited by
     * predicate or namespace, in alphabetical order.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.machinetags.getPairs.html
     * @param string $namespace Limit the list of pairs returned to those that have the
     * following namespace.
     * @param string $predicate Limit the list of pairs returned to those that have the
     * following predicate.
     * @param string $perPage Number of photos to return per page. If this argument is
     * omitted, it defaults to 100. The maximum allowed value is 500.
     * @param string $page The page of results to return. If this argument is omitted,
     * it defaults to 1.
     * @return
     */
    public function getPairs($namespace = null, $predicate = null, $perPage = null, $page = null)
    {
        $params = [
            'namespace' => $namespace,
            'predicate' => $predicate,
            'per_page' => $perPage,
            'page' => $page
        ];
        return $this->flickr->request('flickr.machinetags.getPairs', $params);
    }

    /**
     * Return a list of unique predicates, optionally limited by a given namespace.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.machinetags.getPredicates.html
     * @param string $namespace Limit the list of predicates returned to those that
     * have the following namespace.
     * @param string $perPage Number of photos to return per page. If this argument is
     * omitted, it defaults to 100. The maximum allowed value is 500.
     * @param string $page The page of results to return. If this argument is omitted,
     * it defaults to 1.
     * @return
     */
    public function getPredicates($namespace = null, $perPage = null, $page = null)
    {
        $params = [
            'namespace' => $namespace,
            'per_page' => $perPage,
            'page' => $page
        ];
        return $this->flickr->request('flickr.machinetags.getPredicates', $params);
    }

    /**
     * Fetch recently used (or created) machine tags values.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.machinetags.getRecentValues.html
     * @param string $namespace A namespace that all values should be restricted to.
     * @param string $predicate A predicate that all values should be restricted to.
     * @param string $addedSince Only return machine tags values that have been added
     * since this timestamp, in epoch seconds.
     * @return
     */
    public function getRecentValues($namespace = null, $predicate = null, $addedSince = null)
    {
        $params = [
            'namespace' => $namespace,
            'predicate' => $predicate,
            'added_since' => $addedSince
        ];
        return $this->flickr->request('flickr.machinetags.getRecentValues', $params);
    }

    /**
     * Return a list of unique values for a namespace and predicate.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.machinetags.getValues.html
     * @param string $namespace The namespace that all values should be restricted to.
     * @param string $predicate The predicate that all values should be restricted to.
     * @param string $perPage Number of photos to return per page. If this argument is
     * omitted, it defaults to 100. The maximum allowed value is 500.
     * @param string $page The page of results to return. If this argument is omitted,
     * it defaults to 1.
     * @return
     */
    public function getValues($namespace, $predicate, $perPage = null, $page = null)
    {
        $params = [
            'namespace' => $namespace,
            'predicate' => $predicate,
            'per_page' => $perPage,
            'page' => $page
        ];
        return $this->flickr->request('flickr.machinetags.getValues', $params);
    }
}
