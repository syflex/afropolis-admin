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

}
