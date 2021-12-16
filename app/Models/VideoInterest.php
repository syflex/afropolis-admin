<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoInterest extends Model
{
    use HasFactory;

    protected $table = 'video_interests';


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'video_id',
        'interest_id',
    ];

    /**
     * Get the user that owns the VideoCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    /**
     * Get the user that owns the VideoCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function interest()
    {
        return $this->belongsTo(Interest::class);
    }
}
