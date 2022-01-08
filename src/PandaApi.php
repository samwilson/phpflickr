<?php

namespace Samwilson\PhpFlickr;

class PandaApi extends ApiMethodGroup
{
    /**
     * Return a list of <a href="http://www.flickr.com/explore/panda">Flickr
     * pandas</a>, from whom you can request photos using the <a
     * href="/services/api/flickr.panda.getPhotos.htm">flickr.panda.getPhotos</a> API
     * method.
<br/><br/>
More information about the pandas can be found on the <a
     * href="http://code.flickr.com/blog/2009/03/03/panda-tuesday-the-history-of-the-panda-new-apis-explore-and-you/">dev
     * blog</a>.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.panda.getList.html
     *
     * @return
     */
    public function getList()
    {
        return $this->flickr->request('flickr.panda.getList');
    }

    /**
     * Ask the <a href="http://www.flickr.com/explore/panda">Flickr Pandas</a> for a
     * list of recent public (and "safe") photos.
<br/><br/>
More information about the
     * pandas can be found on the <a
     * href="http://code.flickr.com/blog/2009/03/03/panda-tuesday-the-history-of-the-panda-new-apis-explore-and-you/">dev
     * blog</a>.
     *
     * This method does not require authentication.
     *
     * @link https://www.flickr.com/services/api/flickr.panda.getPhotos.html
     * @param string $pandaName The name of the panda to ask for photos from. There are
     * currently three pandas named:<br /><br />  <ul> <li><strong><a
     * href="http://flickr.com/photos/ucumari/126073203/">ling ling</a></strong></li>
     * <li><strong><a href="http://flickr.com/photos/lynnehicks/136407353">hsing
     * hsing</a></strong></li> <li><strong><a
     * href="http://flickr.com/photos/perfectpandas/1597067182/">wang
     * wang</a></strong></li> </ul>  <br />You can fetch a list of all the current
     * pandas using the <a
     * href="/services/api/flickr.panda.getList.html">flickr.panda.getList</a> API
     * method.
     * @param string $extras A comma-delimited list of extra information to fetch for
     * each returned record. Currently supported fields are: <code>description</code>,
     * <code>license</code>, <code>date_upload</code>, <code>date_taken</code>,
     * <code>owner_name</code>, <code>icon_server</code>, <code>original_format</code>,
     * <code>last_update</code>, <code>geo</code>, <code>tags</code>,
     * <code>machine_tags</code>, <code>o_dims</code>, <code>views</code>,
     * <code>media</code>, <code>path_alias</code>, <code>url_sq</code>,
     * <code>url_t</code>, <code>url_s</code>, <code>url_q</code>, <code>url_m</code>,
     * <code>url_n</code>, <code>url_z</code>, <code>url_c</code>, <code>url_l</code>,
     * <code>url_o</code>
     * @param string $perPage Number of photos to return per page. If this argument is
     * omitted, it defaults to 100. The maximum allowed value is 500.
     * @param string $page The page of results to return. If this argument is omitted,
     * it defaults to 1.
     * @return
     */
    public function getPhotos($pandaName, $extras = null, $perPage = null, $page = null)
    {
        $params = [
            'panda_name' => $pandaName,
            'extras' => $extras,
            'per_page' => $perPage,
            'page' => $page
        ];
        return $this->flickr->request('flickr.panda.getPhotos', $params);
    }
}
