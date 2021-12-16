<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SongArtist extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'song_artists';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'song_id',
        'user_id',
    ];

     public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function song()
    {
        return $this->belongsTo(Songs::class);
    }
}
