<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';
    
    protected $fillable = [
        'name','description','avatar','is_featured'
    ];

     public function videoCategory()
    {
        return $this->hasMany(VideoCategory::class);
    }

      public function videos()
    {
        return $this->hasMany(Video::class);
    }
}
