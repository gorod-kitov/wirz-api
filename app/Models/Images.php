<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Images extends Model
{
    protected $fillable = [
        'path'
    ] ;

    protected $appends = [
        'image'
    ];

    protected $hidden = [
        'path'
    ];

    public function getImageAttribute( ) {
        return asset('images/'.$this->path);
    }
}
