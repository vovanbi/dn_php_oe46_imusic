<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lyric extends Model
{
    use HasFactory;

    protected $table = 'lyrics';

    protected $fillable = [
        'content',
        'song_id',
        'user_id',
    ];

    public function song()
    {
        return $this->belongsTo(Song::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopegetLyric($query)
    {
        return $query->orderBy('id');
    }
}
