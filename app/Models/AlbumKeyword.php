<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumKeyword extends Model
{
    use HasFactory;

    protected $table = 'album_keywords';

     protected $fillable = [
        'album_id',
        'keyword_id',
    ];

    public function album()
    {
        return $this->belongsTo(Albums::class);
    }
    
    public function keyword()
    {
        return $this->belongsTo(Albums::class);
    }

}
