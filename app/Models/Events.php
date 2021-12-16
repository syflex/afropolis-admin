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
        'user_id','category_id','interest_id','title','slug','description','about',
        'image_url','event_type','price','discount','is_published','publish_at','is_featured'
    ];

     public function eventSubscription()
    {
        return $this->hasMany(EventSubscription::class);
    }

}
