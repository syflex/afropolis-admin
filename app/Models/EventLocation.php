<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventLocation extends Model
{
    use HasFactory;
    protected $table = 'event_locations';


    protected $fillable = [
        'address',
        'country_id',
        'city_id',
        'event_id',
    ];

     public function event_location()
    {
        return $this->belongsTo(Event::class);
    }
}
