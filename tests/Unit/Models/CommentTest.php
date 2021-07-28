<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommentTest extends TestCase
{
    public function testBelongsToUser()
    {
        $comment = new Comment();

        $relation = $comment->user();

        $this->assertInstanceOf(BelongsTo::class, $relation);

        $this->assertEquals('id', $relation->getOwnerKeyName());

        $this->assertEquals('user_id', $relation->getForeignKeyName());
    }

    public function testBelongsToSong()
    {
        $comment = new Comment();

        $relation = $comment->song();

        $this->assertInstanceOf(BelongsTo::class, $relation);

        $this->assertEquals('id', $relation->getOwnerKeyName());

        $this->assertEquals('song_id', $relation->getForeignKeyName());
    }
}
