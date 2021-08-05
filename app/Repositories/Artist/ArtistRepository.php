<?php

namespace App\Repositories\Artist;

use App\Models\Artist;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ArtistRepository extends BaseRepository
{
    public function getModel()
    {
        return Artist::class;
    }

    public function showAll()
    {
        $artists =$this->model::orderByid()->paginate(config('app.paginate_num'));

        return $artists;
    }

    public function create($data)
    {
        $image = $data['avatar'];
        $image_path = 'image_artist/' . time() . '.' . $image->getClientOriginalExtension();
        $path = Storage::disk('public')->put($image_path, file_get_contents($image));
        $artist = $this->model::create([
            'name' => $data['name'],
            'info' => $data['info'],
            'avatar' => $image_path,
        ]);

        return $artist;
    }

    public function update($id, $data)
    {
        $artist = $this->findOrFail($id);
        if (File::exists(public_path('storage/' .  $artist->image_path))) {
            File::delete(public_path('storage/' . $artist->image_path));
        }

        $image = $data['avatar'];
        $image_path = 'image_artist/' . time() . '.' . $image->getClientOriginalExtension();
        $path = Storage::disk('public')->put($image_path, file_get_contents($image));
        $artist = $artist->update([
            'name' => $data['name'],
            'info' => $data['info'],
            'avatar' => $image_path,
        ]);

        return $artist;
    }

    public function destroy($id)
    {
        $artist =$this->findOrFail($id);
        foreach ($artist->songs as $song) {
            $song->lyrics()->delete();
            $song->comments()->delete();
            $song->albums()->wherePivot('song_id', $song->id)->detach();
            $song->playLists()->wherePivot('song_id', $song->id)->detach();
        }
        $artist->songs()->delete();
        $artist->delete();
    }
}
