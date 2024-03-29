<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSubscription extends Model
{
    use HasFactory;
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'event_subscribers';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'event_id',
        'isSubscribe',
        'name',
        'email',
    ];

    public function event()
    {
      return $this->belongsTo(Event::class);
    }

        public function subscribe()
    {
        return $this->belongsTo(User::class);
    }

}
