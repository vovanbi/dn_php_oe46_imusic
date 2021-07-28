<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Playlist;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PlaylistTest extends TestCase
{
    public function testBelongsToUser()
    {
        $playlist = new Playlist();

        $relation = $playlist->user();

        $this->assertInstanceOf(BelongsTo::class, $relation);

        $this->assertEquals('id', $relation->getOwnerKeyName());

        $this->assertEquals('user_id', $relation->getForeignKeyName());
    }

    public function testBelongsToManySongs()
    {
        $playlist = new Playlist();

        $relation = $playlist->songs();

        $this->assertInstanceOf(BelongsToMany::class, $relation);

        $this->assertEquals('playlist_song.playlist_id', $relation->getQualifiedForeignPivotKeyName());

        $this->assertEquals('playlist_song.song_id', $relation->getQualifiedRelatedPivotKeyName());
    }
}
