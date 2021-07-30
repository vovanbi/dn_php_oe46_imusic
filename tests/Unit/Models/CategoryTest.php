<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CategoryTest extends TestCase
{
    public function testFillableCategory()
    {
        $columns = [
            'name',
            'parent_id',
        ];
        $category = new Category();

        $this->assertEquals($columns, $category->getFillable());
    }

    public function testHasManySong()
    {
        $category = new Category();

        $relation = $category->songs();

        $this->assertInstanceOf(HasMany::class, $relation);

        $this->assertEquals('cate_id', $relation->getForeignKeyName());

        $this->assertEquals('categories.id', $relation->getQualifiedParentKeyName());
    }

    public function testHasManyChilden()
    {
        $category = new Category();

        $relation = $category->children();

        $this->assertInstanceOf(HasMany::class, $relation);

        $this->assertEquals('parent_id', $relation->getForeignKeyName());

        $this->assertEquals('categories.id', $relation->getQualifiedParentKeyName());
    }

    public function testCategorybelongsToparentCategory()
    {
        $category = new Category();

        $relation = $category->parent();

        $this->assertInstanceOf(BelongsTo::class, $relation);

        $this->assertEquals('id', $relation->getOwnerKeyName());

        $this->assertEquals('parent_id', $relation->getForeignKeyName());
    }
}
