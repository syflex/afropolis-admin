<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaylistKeyword extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'playlist_keywords';

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'keyword_id',
        'playlist_id',
    ];

    public function playlists()
    {
        return $this->belongsTo(Playlists::class);
    }

     public function keyword()
    {
        return $this->belongsTo(Keywords::class);
    }
}
