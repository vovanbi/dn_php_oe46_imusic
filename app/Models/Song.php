<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $table = 'songs';

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function lyrics()
    {
        return $this->hasOne(Lyric::class);
    }

    public function albums()
    {
        return $this->belongsToMany(Album::class, 'album_song', 'album_id', 'song_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'cate_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function playLists()
    {
        return $this->belongsToMany(Playlist::class, 'playlist_song', 'playlist_id', 'song_id');
    }

    public function scopeOfCategory($query, $id)
    {
        return $query->where('cate_id', $id);
    }

    public function scopeSongHot($query)
    {
        return $query->where('hot', 1);
    }
}
