<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetricAccess extends Model
{
    protected $fillable = [
        'metric_name',
        'is_active',
        'number_description',
        'description',
        'kpi',
        'percent',
        'percent_text',
        'campaign_id',
        'user_id',
        'engagement',
        'date',
        'campaign_id',
    ];
}
