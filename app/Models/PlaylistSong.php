<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaylistSong extends Model
{
    use HasFactory;

      /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'playlist_songs';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'song_id',
        'playlist_id',
    ];

     public function song()
    {
        return $this->belongsTo(Songs::class);
    }
    
    public function playlist()
    {
        return $this->belongsTo(Playlists::class);
    }
}
