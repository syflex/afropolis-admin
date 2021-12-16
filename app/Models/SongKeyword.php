<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SongKeyword extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'song_keywords';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'song_id',
        'keyword_id',
    ];

     public function keyword()
    {
        return $this->belongsTo(Keywords::class);
    }

     public function song()
    {
        return $this->belongsTo(Songs::class);
    }
}
