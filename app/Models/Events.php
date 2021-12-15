<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'about',
        'description',
        'is_published',
        'is_featured',
    ];

     public function eventSubscription()
    {
        return $this->hasMany(EventSubscription::class);
    }

}
