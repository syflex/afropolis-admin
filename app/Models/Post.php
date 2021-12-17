<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'video',
        'user_id',
        'description',
        'image_url',
    ];

    /**
     * Get the user that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function UserPost()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

   public function comments()
    {
        return $this->hasMany(Comment::class, 'commentable_id')->where('commentable_type', 'post');
    }

    public function getThreadedComments()
    {
        return $this->comments()->with('user:id, name,avatar, slug', 'user.status')->get()->threaded();
    }

    public function liked()
    {
        return $this->hasOne(Like::class, 'likeable_id')
            ->where('likeable_type', 'post')
            ->where('user_id', \Auth::user()->id);
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'likeable_id')->where('likeable_type', 'post');
    }

    public function commented()
    {
        return $this->hasMany(Comment::class)->where('user_id', \Auth::user()->id);
    }
    

}
