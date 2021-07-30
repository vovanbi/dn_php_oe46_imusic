<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Song;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SongTest extends TestCase
{
    public function testFillableCategory()
    {
        $columns = [
           'name',
           'cate_id',
           'artist_id',
           'link',
           'image'
        ];
        $song = new Song();

        $this->assertEquals($columns, $song->getFillable());
    }

    public function testHasManyComments()
    {
        $song = new Song();

        $relation = $song->comments();

        $this->assertInstanceOf(HasMany::class, $relation);

        $this->assertEquals('song_id', $relation->getForeignKeyName());

        $this->assertEquals('songs.id', $relation->getQualifiedParentKeyName());
    }

    public function testBelongsToArtist()
    {
        $song = new Song();

        $relation = $song->artist();

        $this->assertInstanceOf(BelongsTo::class, $relation);

        $this->assertEquals('id', $relation->getOwnerKeyName());

        $this->assertEquals('artist_id', $relation->getForeignKeyName());
    }

    public function testBelongsToManyAlbums()
    {
        $song = new Song();

        $relation = $song->albums();

        $this->assertInstanceOf(BelongsToMany::class, $relation);

        $this->assertEquals('album_song.song_id', $relation->getQualifiedForeignPivotKeyName());

        $this->assertEquals('album_song.album_id', $relation->getQualifiedRelatedPivotKeyName());
    }

    public function testHasOneLyrics()
    {
        $song = new Song();

        $relation = $song->lyrics();

        $this->assertInstanceOf(HasOne::class, $relation);

        $this->assertEquals('song_id', $relation->getForeignKeyName());

        $this->assertEquals('songs.id', $relation->getQualifiedParentKeyName());
    }

    public function testBelongsToCategory()
    {
        $song = new Song();

        $relation = $song->category();

        $this->assertInstanceOf(BelongsTo::class, $relation);

        $this->assertEquals('id', $relation->getOwnerKeyName());

        $this->assertEquals('cate_id', $relation->getForeignKeyName());
    }

    public function testBelogsToManyPlayLists()
    {
        $song = new Song();

        $relation = $song->playLists();

        $this->assertInstanceOf(BelongsToMany::class, $relation);

        $this->assertEquals('playlist_song.song_id', $relation->getQualifiedForeignPivotKeyName());

        $this->assertEquals('playlist_song.playlist_id', $relation->getQualifiedRelatedPivotKeyName());
    }
}
