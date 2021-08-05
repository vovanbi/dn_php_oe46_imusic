<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    protected $table = 'artists';

    protected $fillable = [
        'name',
        'info',
        'avatar',
    ];

    public function songs()
    {
        return $this->hasMany(Song::class);
    }
    public function scopegetAll($query)
    {
        return $query->orderBy('name', 'desc');
    }

    public function scopeSearchName($query, $search)
    {
        return $query->where('name', 'like', '%'.$search.'%');
    }

    public function scopeorderByid($query)
    {
        return $query->orderBy('id');
    }
}
