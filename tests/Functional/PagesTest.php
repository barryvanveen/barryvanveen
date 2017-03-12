<?php

namespace Tests\Functional;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\BrowserKitTestCase;

class PagesTest extends BrowserKitTestCase
{
    use DatabaseTransactions;

    public function testAboutMeMusicPage()
    {
        $this->visit(route('music'))
            ->see(trans('music.page-intro'))
            ->see(trans('music.title-albums'))
            ->seeElement('div.media');
    }
}
