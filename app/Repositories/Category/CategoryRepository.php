<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository implements ICategoryRepository
{
    public function getModel()
    {
        return Category::class;
    }

    public function showAll()
    {
        $categories =$this->model::orderByid()->paginate(config('app.paginate_num'));

        return $categories;
    }

    public function create($data)
    {
        $category = $this->model::create([
            'name' => $data['name'],
            'parent_id' => $data['parent_id']
        ]);

        return $category;
    }

    public function getAllParentCategory()
    {
        $categories = $this->model::IsParent()->get();

        return $categories;
    }

    public function delete($id)
    {
        $category = $this->findOrFail($id);
        foreach ($category->songs as $song) {
            $song->lyrics()->delete();
            $song->comments()->delete();
            $song->albums()->wherePivot('song_id', $song->id)->detach();
            $song->playLists()->wherePivot('song_id', $song->id)->detach();
        }
        $category->songs()->delete();
        $category->delete();
    }
}
