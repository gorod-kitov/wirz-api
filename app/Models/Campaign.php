<?php

namespace App\Models;
use App\Models\Metric;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Campaign extends Model
{
    protected $guarded = [];


    public function metrics2() {
        return $this->hasMany(Metric::class)
            ->whereNull('metrics.engagement');
    }

	public function addMetrics1($id, $data)
	{

        $metric = Metric::query()->updateOrCreate(['name' => 'clicks', 'date' => $data['date'], 'campaign_id' => $id, 'engagement' => $data['engagement']],
            ['value' => $data['clicks']]);

        $metric_access = MetricAccess::where('metric_name', 'clicks')->where('user_id', 2)->first();
        if ($metric_access) {
            $metric_access->is_active = $data['clicksIsActive'];
            $metric_access->save();
        } else {
            $metric_access = new MetricAccess();
            $metric_access->metric_name = 'clicks';
            $metric_access->user_id = 2;
            $metric_access->is_active = $data['clicksIsActive'];
            $metric_access->save();
        }

        $metric = Metric::query()->updateOrCreate(['name' => 'total_reach', 'date' => $data['date'], 'campaign_id' => $id, 'engagement' => $data['engagement']],
            ['value' => $data['totalReach']]);

        $metric_access = MetricAccess::where('metric_name', 'total_reach')->where('user_id', 2)->first();
        if ($metric_access) {
            $metric_access->is_active = $data['totalReachIsActive'];
            $metric_access->save();
        } else {
            $metric_access = new MetricAccess();
            $metric_access->metric_name = 'total_reach';
            $metric_access->user_id = 2;
            $metric_access->is_active = $data['totalReachIsActive'];
            $metric_access->save();
        }

        $metric = Metric::query()->updateOrCreate(['name' => 'ad_engagement', 'date' => $data['date'], 'campaign_id' => $id, 'engagement' => $data['engagement']],
            ['value' => $data['adEngagement']]);

        $metric_access = MetricAccess::where('metric_name', 'ad_engagement')->where('user_id', 2)->first();
        if ($metric_access) {
            $metric_access->is_active = $data['adEngagementIsActive'];
            $metric_access->save();
        } else {
            $metric_access = new MetricAccess();
            $metric_access->metric_name = 'ad_engagement';
            $metric_access->user_id = 2;
            $metric_access->is_active = $data['adEngagementIsActive'];
            $metric_access->save();
        }

        $metric = Metric::query()->updateOrCreate(['name' => 'page_engagement', 'date' => $data['date'], 'campaign_id' => $id, 'engagement' => $data['engagement']],
            ['value' => $data['pageEngagement']]);

        $metric_access = MetricAccess::where('metric_name', 'page_engagement')->where('user_id', 2)->first();
        if ($metric_access) {
            $metric_access->is_active = $data['pageEngagementIsActive'];
            $metric_access->save();
        } else {
            $metric_access = new MetricAccess();
            $metric_access->metric_name = 'page_engagement';
            $metric_access->user_id = 2;
            $metric_access->is_active = $data['pageEngagementIsActive'];
            $metric_access->save();
        }

        $metric = Metric::query()->updateOrCreate(['name' => 'active_length', 'date' => $data['date'], 'campaign_id' => $id, 'engagement' => $data['engagement']],
            ['value' => $data['activeLength']]);


        $metric_access = MetricAccess::where('metric_name', 'active_length')->where('user_id', 2)->first();
        if ($metric_access) {
            $metric_access->is_active = $data['activeLengthIsActive'];
            $metric_access->save();
        } else {
            $metric_access = new MetricAccess();
            $metric_access->metric_name = 'active_length';
            $metric_access->user_id = 2;
            $metric_access->is_active = $data['activeLengthIsActive'];
            $metric_access->save();
        }

        $metric = Metric::query()->updateOrCreate(['name' => 'clickouts', 'date' => $data['date'], 'campaign_id' => $id, 'engagement' => $data['engagement']],
            ['value' => $data['clickouts']]);

        $metric_access = MetricAccess::where('metric_name', 'clickouts')->where('user_id', 2)->first();
        if ($metric_access) {
            $metric_access->is_active = $data['clickoutsIsActive'];
            $metric_access->save();
        } else {
            $metric_access = new MetricAccess();
            $metric_access->metric_name = 'clickouts';
            $metric_access->user_id = 2;
            $metric_access->is_active = $data['clickoutsIsActive'];
            $metric_access->save();
        }
        $metric = Metric::query()->updateOrCreate(['name' => 'sales', 'date' => $data['date'], 'campaign_id' => $id, 'engagement' => $data['engagement']],
            ['value' => $data['sales']]);


        $metric_access = MetricAccess::where('metric_name', 'sales')->where('user_id', 2)->first();
        if ($metric_access) {
            $metric_access->is_active = $data['salesIsActive'];
            $metric_access->save();
        } else {
            $metric_access = new MetricAccess();
            $metric_access->metric_name = 'sales';
            $metric_access->user_id = 2;
            $metric_access->is_active = $data['salesIsActive'];
            $metric_access->save();
        }

        return response()->json(['message' => __('Data saved successfully.')]);
    }

    public function addMetrics2($data)
    {
        foreach ($data['campaigns'] as $data_item) {
            $campaign = $this->where('name', $data_item['name'])->first();
            if ($campaign) {
                $campaign->update(['is_active' => $data_item['isActive']]);
                $campaign_fields = ['display', 'native', 'search', 'social'];
                foreach ($campaign_fields as $field) {
                    $metric = Metric::query()->updateOrCreate(['name' => $field, 'date' => $data['date'], 'campaign_id' => $campaign->id],
                        ['value' => $data_item[$field]]);

                    /*         $metric = new Metric();
                             $metric->name = $field;
                             $metric->value = $data_item[$field];
                             $metric->date = $data['date'];
                             $metric->campaign_id = $campaign->id;
                             $metric->save();*/
                }
            }
        }
        return response()->json(['message' => __('Data saved successfully.')]);
    }

    public function getMetrics1($user_id, $campaign_id, $data)
    {
        $from = $data['date_from'];
        $to = $data['date_to'];
        $engagement = $data['selected'];

        $fields_arr = [
            'clicks', 'total_reach',
            'ad_engagement', 'page_engagement',
            'active_length', 'clickouts', 'sales'
        ];
        foreach ($fields_arr as $field) {
            $access = MetricAccess::where('metric_name', $field)->where('user_id', 2)->first();
            $response["{$field}"]['active'] = $access->is_active;
            if ($access->is_active || $user_id !== 2) {
                $response[$field]['value'] = 0;
                $metrics = Metric::where('campaign_id', $campaign_id)
                    ->where('name', $field)
                    ->where('engagement', $engagement)
                    ->whereBetween('date', [$from, $to])->get();
                foreach ($metrics as $m) {
                    $response[$field]['value'] += floatval($m->value);
                }
            } else {
                $response[$field]['value'] = -1;
            }
        }

        return $response;
    }

    public function getMetrics2($id, $data)
    {
        $from = $data['date_from'];
        $to = $data['date_to'];

        $fields_arr = ['display', 'native', 'search', 'social'];

        $response = [];

        foreach ($fields_arr as $field) {
            $metrics = Metric::where('campaign_id', $id)
                ->where('metrics.name', $field)
                ->whereBetween('date', [$from, $to])
                ->join('campaigns', 'metrics.campaign_id', 'campaigns.id')
                ->select('metrics.*', 'campaigns.is_active')
                ->get();
            foreach ($metrics as $m) {
                $response[] = $m;
            }
        }

        return $response;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
