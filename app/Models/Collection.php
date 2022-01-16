<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'description',
        'image_url',
    ];

    /**
     * Get the user that owns the Collections
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

     public function userCollection()
    {
        return $this->belongsTo(User::class);
    }

    public function videoCollection()
    {
        return $this->hasMany(VideoCollection::class);
    }
}
