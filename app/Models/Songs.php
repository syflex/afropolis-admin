<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Songs extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'year',
        'image_url',
        'song_url',
        'description'
    ];

     public function playlistSong()
    {
        return $this->hasMany(PlaylistSong::class);
    }

    /**
     * Get the song album associated with the song.
     */
    public function songAlbum()
    {
        return $this->hasOne(SongAlbum::class);
    }

      public function artist()
    {
        return $this->hasMany(SongArtist::class);
    }

       public function genre()
    {
        return $this->hasMany(SongGenre::class);
    }

       public function songKeyword()
    {
        return $this->hasMany(SongKeyword::class);
    }

}
