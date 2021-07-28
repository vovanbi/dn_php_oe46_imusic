<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Lyric;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LyricTest extends TestCase
{
    public function testBelongsToSong()
    {
        $lyric = new Lyric();

        $relation = $lyric->song();

        $this->assertInstanceOf(BelongsTo::class, $relation);

        $this->assertEquals('id', $relation->getOwnerKeyName());

        $this->assertEquals('song_id', $relation->getForeignKeyName());
    }

    public function testBelongsToUser()
    {
        $lyric = new Lyric();

        $relation = $lyric->user();

        $this->assertInstanceOf(BelongsTo::class, $relation);

        $this->assertEquals('id', $relation->getOwnerKeyName());

        $this->assertEquals('user_id', $relation->getForeignKeyName());
    }
}
