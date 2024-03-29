<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasSlug;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $fillable = [
        'name',
        'slug',
        'email',
        'email_verified_at','password','phone','avatar','cover','about','website',
        'skill','profession','status','birthday','active','activation_token',
        'banned_untill','is_admin','last_login','country_id','city_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function followers()
    {
        return $this->hasMany(Follow::class, 'follow_id', 'id');
    }

    public function following()
    {
        return $this->hasMany(Follow::class, 'user_id', 'id');
    }

    public function followed()
    {
        return $this->hasMany(Follow::class, 'user_id', 'id')->where('user_id', auth()->user()->id);
    }

    public function post()
    {
        return $this->hasMany(Post::class);
    }

     public function interest()
    {
        return $this->hasMany(UserInterest::class,);
    }

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }


     public function artist()
    {
        return $this->hasMany(SongArtist::class);
    }

     public function verifyAccount()
    {
        return $this->hasOne(VerifiedUser::class);
    }


     public function event()
    {
        return $this->hasMany(Events::class);
    }

      public function like()
    {
        return $this->hasMany(Like::class, 'likeable_id');
    }

      public function eventSubscription()
    {
        return $this->hasMany(EventSubscription::class);
    }
}
