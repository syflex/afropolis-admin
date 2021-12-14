<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','commentable_id','parent_id','content','commentable_type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function liked()
    {
        return $this->hasOne(Like::class, 'likeable_id')
        ->where('likeable_type','comment')
        ->where('user_id', \Auth::user()->id);
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'likeable_id')->where('likeable_type','comment');
    }

     public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
