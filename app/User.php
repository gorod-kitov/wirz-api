<?php

namespace App;

use App\Models\Campaign;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'logo', 'role_id', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }


    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function getAccountData($user_id)
    {
        return $this->where('id', $user_id)
            ->select('id', 'name', 'email')
            ->with(['campaigns' => function ($c) {
                $c->select('id', 'name', 'user_id');
            }])
            ->first();
    }



    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    protected $appends = [
        'image'
    ];

    public function getImageAttribute()
    {
        return $this->logo ? asset('images/logo/' . $this->logo) : null;
    }

}
