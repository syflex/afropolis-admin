<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SongGenre extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'song_genres';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'song_id',
        'genre_id',
    ];

     public function song()
    {
        return $this->belongsTo(Songs::class);
    } 
    
    public function genre()
    {
        return $this->belongsTo(Songs::class);
    }
}
