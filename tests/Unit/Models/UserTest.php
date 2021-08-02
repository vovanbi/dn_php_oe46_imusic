<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UserTest extends TestCase
{
    public function testFillableProperties()
    {
        $columns = [
            'fullname',
            'email',
            'password',
            'phone',
            'avatar',
            'provider_id',
            'provider',
            'access_token',
        ];

        $this->assertEquals($columns, (new User())->getFillable());
    }

    public function testHasManyPlaylists()
    {
        $user = new User();

        $relation = $user->playLists();

        $this->assertInstanceOf(HasMany::class, $relation);

        $this->assertEquals('user_id', $relation->getForeignKeyName());

        $this->assertEquals('users.id', $relation->getQualifiedParentKeyName());
    }

    public function testHasManyComments()
    {
        $user = new User();

        $relation = $user->comments();

        $this->assertInstanceOf(HasMany::class, $relation);

        $this->assertEquals('user_id', $relation->getForeignKeyName());

        $this->assertEquals('users.id', $relation->getQualifiedParentKeyName());
    }

    public function testHasManyLyrics()
    {
        $user = new User();

        $relation = $user->lyrics();

        $this->assertInstanceOf(HasMany::class, $relation);

        $this->assertEquals('user_id', $relation->getForeignKeyName());

        $this->assertEquals('users.id', $relation->getQualifiedParentKeyName());
    }

    public function testBelongsToManyAlbums()
    {
        $user = new User();

        $relation = $user->albums();

        $this->assertInstanceOf(BelongsToMany::class, $relation);

        $this->assertEquals('favorite_user_album.user_id', $relation->getQualifiedForeignPivotKeyName());
        
        $this->assertEquals('favorite_user_album.album_id', $relation->getQualifiedRelatedPivotKeyName());
    }
}
