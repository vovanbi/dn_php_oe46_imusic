<?php

namespace Tests\Unit\Http\Admin\Controller;

use Tests\TestCase;
use Mockery;
use App\Models\Song;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SongRequest;
use App\Http\Controllers\Admin\SongController;
use App\Repositories\Song\ISongRepository;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\ParameterBag;

class SongControllerTest extends TestCase
{
    protected $songMock;
    protected $song;

    public function setUp(): void
    {
        $this->songMock = Mockery::mock(ISongRepository::class);
        $this->song = Mockery::mock(Song::class);
        parent::setUp();
    }

    public function tearDown(): void
    {
        Mockery::close();

        parent::tearDown();
    }

    public function testItCanShowIndexWithDataSong()
    {
        $this->songMock
            ->shouldReceive('showAll')
            ->once()
            ->andReturn(new Collection);

        $controller = new SongController($this->songMock);

        $result = $controller->index();

        $data = $result->getData();

        $this->assertEquals('admin.song.index', $result->getName());

        $this->assertArrayHasKey('songs', $data);
    }

    public function testItCanCreateSongWithDataSong()
    {
        $this->songMock
            ->shouldReceive('getAllCategory', 'getAllArtist')
            ->once()
            ->andReturn(new Collection);
        $controller = new SongController($this->songMock);

        $result = $controller->create();

        $data = $result->getData();

        $this->assertEquals('admin.song.create', $result->getName());

        $this->assertArrayHasKey('categories', $data);

        $this->assertArrayHasKey('artists', $data);
    }

    public function testItCanStoreSongWithDataSong()
    {
        $this->songMock
            ->shouldReceive('create')
            ->once()
            ->andReturn(new Collection);

        $data = [
            'name' => 'test',
            'image' => 'test.png',
            'artist_id' => 15,
            'cate_id' => 1,
            'link' => 'abc.com.vn',
        ];

        $request = new SongRequest();

        $request->headers->set('content-type', 'application/json');

        $request->setJson(new ParameterBag($data));

        $controller = new SongController($this->songMock);

        $result = $controller->store($request);

        $this->assertInstanceOf(RedirectResponse::class, $result);

        $this->assertEquals(route('songs.index'), $result->headers->get('Location'));

        $this->assertEquals(trans('song.addSuccess'), $result->getSession()->get('success'));
    }

    public function testItCanEditSongWithDataSong()
    {
        $this->songMock->shouldReceive('findOrFail', 'getCategory', 'getArtist')
        ->once()->andReturn(new Collection);

        $controller = new SongController($this->songMock);

        $result = $controller->edit($this->song);

        $data = $result->getData();

        $this->assertEquals('admin.song.update', $result->getName());

        $this->assertArrayHasKey('categories', $data);
        $this->assertArrayHasKey('artists', $data);
        $this->assertArrayHasKey('song', $data);
    }

    public function testItCanUpdateSong()
    {
        $this->songMock
            ->shouldReceive('update')
            ->once()
            ->andReturn(new Collection);

        $data = [
            'name' => 'test',
            'image' => 'test.png',
            'artist_id' => 15,
            'cate_id' => 1,
            'link' => 'abc.com.vn',
        ];

        $request = new SongRequest();
        $request->headers->set('content-type', 'application/json');
        $request->setJson(new ParameterBag($data));

        $controller = new SongController($this->songMock);

        $result = $controller->update($request, $this->song);

        $this->assertInstanceOf(RedirectResponse::class, $result);

        $this->assertEquals(route('songs.index'), $result->headers->get('Location'));
        $this->assertEquals(trans('song.editSuccess'), $result->getSession()->get('success'));
    }

    public function testItCanActionHotSong()
    {
        $this->songMock
             ->shouldReceive('actionHot')
             ->andReturn(new Collection);

        $action  = config('app.actionHot');
        $controller = new SongController($this->songMock);

        $result = $controller->action($action, $this->song);
        $this->assertInstanceOf(RedirectResponse::class, $result);

        $this->assertEquals(trans('lyric.active'), $result->getSession()->get('success'));
    }
}
