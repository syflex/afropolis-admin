<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name','description','avatar','is_featured'
    ];


     public function videoCategory()
    {
        return $this->hasMany(VideoCategory::class);
    }

      public function videoInterest()
    {
        return $this->hasMany(VideoInterest::class);
    }

    
}
