<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSession extends Model
{
    use HasFactory;

        protected $table = 'event_sessions';


      protected $fillable = [
        'start','end','price','discount','title','event_id', 'time'
    ];

    public function event_session()
    {
        return $this->belongsTo(Event::class);
    }
}
