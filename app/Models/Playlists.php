<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlists extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id','name','image_url','description'
    ];

     public function playlists()
    {
        return $this->hasMany(PlaylistKeyword::class);
    }

      public function playlistSong()
    {
        return $this->hasMany(PlaylistSong::class);
    }

    /**
     * Get the user that owns the Playlists
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
