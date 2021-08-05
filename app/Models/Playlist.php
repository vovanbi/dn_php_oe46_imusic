<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    protected $table = 'playlists';

    protected $fillable = [
        'name',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(Playlist::class);
    }

    public function songs()
    {
        return $this->belongsToMany(Song::class, 'playlist_song', 'playlist_id', 'song_id');
    }
}
