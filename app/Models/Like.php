<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'likeable_id', 'likeable_type'
    ];

   public function post()
    {
        return $this->belongsTo(Post::class);
    }

     public function video()
    {
        return $this->belongsTo(Video::class);
    }
     public function like()
    {
        return $this->belongsTo(Video::class);
    }

}
