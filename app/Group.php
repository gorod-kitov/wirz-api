<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $guarded = [];

    protected $appends = [
        'image'
    ];

    public function getImageAttribute()
    {
        return $this->logo ? asset('images/logo/' . $this->logo) : null;
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
