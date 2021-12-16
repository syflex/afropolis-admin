<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'videos';


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
         'year',
        'image_url',
        'video_url',
        'description',
        'user_id'
    ];

    public function videoCategory()
    {
        return $this->hasMany(VideoCategory::class);
    }


    public function videoCollection()
    {
        return $this->hasMany(VideoCollection::class);
    }

}
