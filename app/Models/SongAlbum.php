<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SongAlbum extends Model
{
    use HasFactory;

      /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'song_albums';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'song_id',
        'album_id',
    ];

    /**
     * Get the song that owns the song.
     */
    public function song()
    {
        return $this->belongsTo(Songs::class);
    }

    public function album()
    {
        return $this->belongsTo(Albums::class);
    }
}
