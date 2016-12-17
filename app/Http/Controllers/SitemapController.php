<?php

namespace Barryvanveen\Http\Controllers;

use Barryvanveen\Jobs\Sitemap\GetSitemapXml;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Response;

class SitemapController extends Controller
{
    use DispatchesJobs;

    /**
     * generate and output a sitemap.xml file.
     *
     * @see http://www.sitemaps.org/protocol.html
     *
     * @return string
     */
    public function index()
    {
        $xml = $this->dispatch(
            new GetSitemapXml()
        );

        return Response::make($xml, 200, ['Content-Type', 'text/xml']);
    }
}
