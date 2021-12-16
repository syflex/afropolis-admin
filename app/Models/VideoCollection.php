<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoCollection extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'video_collections';


     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'video_id',
        'collection_id'
    ];

    public function video()
    {
        return $this->belongsTo(Video::class);
    } 
    
    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }
}
