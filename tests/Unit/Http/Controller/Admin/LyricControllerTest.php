<?php

namespace Tests\Unit\Http\Controller\Admin;

use Mockery;
use Tests\TestCase;
use App\Models\Lyric;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Repositories\Lyric\ILyricRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Controllers\Admin\LyricController;
use Symfony\Component\HttpFoundation\ParameterBag;

class LyricControllerTest extends TestCase
{
    protected $lyricMock;
    protected $lyric;
    
    public function setUp(): void
    {
        $this->lyricMock = Mockery::mock(ILyricRepository::class);
        $this->lyric = Mockery::mock(Lyric::class);

        parent::setUp();
    }

    public function tearDown(): void
    {
        Mockery::close();

        parent::tearDown();
    }

    public function testShowIndexDataLyric()
    {
        $this->lyricMock
            ->shouldReceive('all')
            ->once()
            ->andReturn(new Collection);

        $controller = new LyricController($this->lyricMock);

        $result = $controller->index();

        $data = $result->getData();

        $this->assertEquals('admin.lyric.index', $result->getName());

        $this->assertArrayHasKey('lyrics', $data);
    }

    public function testShowCreatePage()
    {
        $this->lyricMock
            ->shouldReceive('getNoLyricSongs')
            ->once()
            ->andReturn(new Collection);

        $controller = new LyricController($this->lyricMock);

        $result = $controller->create();

        $data = $result->getData();

        $this->assertEquals('admin.lyric.create', $result->getName());

        $this->assertArrayHasKey('songs', $data);
    }

    public function testCreateDataLyric()
    {
        $this->lyricMock
            ->shouldReceive('create')
            ->once()
            ->andReturn(new Collection);

        $data = [
            'song_id' => '1',
            'content' => 'Test Content',
            'user_id' => '2',
        ];

        $request = new Request();
        $request->headers->set('content-type', 'application/json');
        $request->setJson(new ParameterBag($data));

        $controller = new LyricController($this->lyricMock);

        $result = $controller->store($request);

        $this->assertInstanceOf(RedirectResponse::class, $result);

        $this->assertEquals(route('lyric.index'), $result->headers->get('Location'));

        $this->assertEquals(trans('lyric.addSuccess'), $result->getSession()->get('success'));
    }

    public function testShowUpdatePage()
    {
        $this->lyricMock
            ->shouldReceive('findOrFail', 'getSongHasLyric')
            ->once()
            ->andReturn(new Collection);

        $controller = new LyricController($this->lyricMock);

        $result = $controller->edit($this->lyric);

        $data = $result->getData();

        $this->assertEquals('admin.lyric.update', $result->getName());

        $this->assertArrayHasKey('lyric', $data);
        $this->assertArrayHasKey('songs', $data);
    }

    public function testUpdateDataLyric()
    {
        $this->lyricMock
            ->shouldReceive('update')
            ->once()
            ->andReturn(new Collection);

        $data = [
            'song_id' => '1',
            'content' => 'Test Content',
            'user_id' => '2',
        ];

        $request = new Request();
        $request->headers->set('content-type', 'application/json');
        $request->setJson(new ParameterBag($data));

        $controller = new LyricController($this->lyricMock);

        $result = $controller->update($request, $this->lyric);

        $this->assertInstanceOf(RedirectResponse::class, $result);

        $this->assertEquals(route('lyric.index'), $result->headers->get('Location'));

        $this->assertEquals(trans('lyric.updatesuccess'), $result->getSession()->get('success'));
    }

    public function testActionDataLyric()
    {
        $this->lyricMock
            ->shouldReceive('setLyricStatus')
            ->once()
            ->andReturn(new Collection);

        $action = config('app.lyric_active');

        $controller = new LyricController($this->lyricMock);

        $result = $controller->action($action, $this->lyric);

        $this->assertInstanceOf(RedirectResponse::class, $result);

        $this->assertEquals(trans('lyric.active'), $result->getSession()->get('success'));
    }
}
