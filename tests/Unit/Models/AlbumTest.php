<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Album;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AlbumTest extends TestCase
{
    public function testBelongsToManySongs()
    {
        $album = new Album();

        $relation = $album->songs();

        $this->assertInstanceOf(BelongsToMany::class, $relation);

        $this->assertEquals('album_song.album_id', $relation->getQualifiedForeignPivotKeyName());

        $this->assertEquals('album_song.song_id', $relation->getQualifiedRelatedPivotKeyName());
    }

    public function testBelongsManyUsers()
    {
        $album = new Album();

        $relation = $album->users();

        $this->assertInstanceOf(BelongsToMany::class, $relation);

        $this->assertEquals('favorite_user_album.album_id', $relation->getQualifiedForeignPivotKeyName());

        $this->assertEquals('favorite_user_album.user_id', $relation->getQualifiedRelatedPivotKeyName());
    }
}
