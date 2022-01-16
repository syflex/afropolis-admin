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
        'user_id',
        'category_id',
        'interest_id',
        'sub_title',
    ];

    public function videoCategory()
    {
        return $this->hasMany(VideoCategory::class);
    }


    public function videoCollection()
    {
        return $this->hasMany(VideoCollection::class);
    }

     public function videoKeyword()
    {
        return $this->hasMany(VideoKeyword::class);
    }

     public function videoInterest()
    {
        return $this->hasMany(VideoInterest::class);
    }

     public function view()
    {
        return $this->hasMany(View::class);
    }

      public function like()
    {
        return $this->hasMany(Like::class, 'likeable_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function interest()
    {
        return $this->belongsTo(Interest::class);
    }

}
