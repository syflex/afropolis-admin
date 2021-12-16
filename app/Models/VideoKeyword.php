<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoKeyword extends Model
{
    use HasFactory;

    protected $table = 'video_keywords';


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'keyword_id',
        'video_id',
    ];

     public function video()
    {
        return $this->belongsTo(Video::class);
    }


     public function keyword()
    {
        return $this->belongsTo(Keywords::class);
    }
}
