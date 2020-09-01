<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Engagements extends Model
{
    protected $table = 'engagements';

    public $timestamps = false;

    protected $fillable = ['name','campaign_id'];

}
