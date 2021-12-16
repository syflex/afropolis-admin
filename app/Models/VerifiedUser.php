<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifiedUser extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'verified_users';

     protected $fillable = [
        'user_id'
    ];

     public function user()
    {
        return $this->belongsTo(User::class);
    }
}
