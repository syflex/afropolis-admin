<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keywords extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'word'
    ];

      public function playlistKeyword()
    {
        return $this->hasMany(PlaylistKeyword::class);
    }

       public function songKeyword()
    {
        return $this->hasMany(SongKeyword::class);
    }

     public function videoKeyword()
    {
        return $this->hasMany(VideoKeyword::class);
    }

    public function albumKeyword()
    {
        return $this->hasMany(AlbumKeyword::class);
    }
}
