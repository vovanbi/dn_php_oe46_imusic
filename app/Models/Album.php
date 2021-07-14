<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $table = 'albums';

    public function songs()
    {
        return $this->belongsToMany(Song::class, 'album_song', 'album_id', 'song_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'favorite_user_album', 'album_id', 'user_id');
    }

    public function scopealbumHot($query)
    {
        return $query->where('hot', 1);
    }
}
