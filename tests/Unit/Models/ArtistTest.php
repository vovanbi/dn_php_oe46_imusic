<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Artist;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ArtistTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testHasManySong()
    {
        $artist = new Artist();

        $relation = $artist->songs();

        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('artist_id', $relation->getForeignKeyName());
        $this->assertEquals('artists.id', $relation->getQualifiedParentKeyName());
    }
}
