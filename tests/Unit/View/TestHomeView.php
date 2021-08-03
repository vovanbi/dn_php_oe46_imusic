<?php

namespace Tests\Unit\View;

use Tests\TestCase;

class TestHomeView extends TestCase
{
    public function testVariableinHomePage()
    {
        $response = $this->get('/');

        $data = $response->getOriginalContent()->getData();

        $response->assertViewIs('home');

        $this->assertTrue($data['categories']->count() > 0);

        $this->assertTrue($data['artists']->count() > 0);

        $this->assertTrue($data['albums']->count() > 0);

        $response->assertViewHas('categories', 'artists', 'albums');

        $response->assertSuccessful();
    }

    public function testComponentInHomePage()
    {
        $response = $this->get('/');

        $response->assertSee('box_main');
        $response->assertSee('nav_bar_main');
        $response->assertSee('music');

        $response->assertSeeText(trans('homePage.newestMusic'));
        $response->assertSeeText(trans('homePage.albumSong'));
        $response->assertSeeText(trans('homePage.artistSong'));
    }
}
