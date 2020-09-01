<?php

namespace App\Models;

use App\Models\Metric;
use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Support\Facades\DB;

class Campaign extends Model
{
    protected $guarded = [];


    public function metrics2()
    {
        return $this->hasMany(Metric::class)
            ->whereNull('metrics.engagement');
    }

    public function addMetrics1($campaign, $data)
    {
        $id = $campaign->id;


        foreach ($data['kpiData'] as $kpi) {
            $kpiData = [
                'metric_name' => $kpi['metric_name'],
                'is_active' => $kpi['is_active'],
                'number_description' => $kpi['number_description'],
                'description' => $kpi['description'],
                'kpi' => $kpi['kpi'],
                'percent' => $kpi['percent'],
                'percent_text' => $kpi['percent_text'],
                'user_id' => 2,
                'campaign_id' => $id,
                'date' => $data['date'],
                'engagement' => $data['selected'],

            ];

            $metricAccess = MetricAccess::updateOrCreate(
                ['campaign_id' => $id, 'id' => $kpi['id'] ?? 0, 'date' => $data['date']],
                $kpiData
            );


            // $metricAccess = MetricAccess::create($kpiData);
        }


//        $metric = Metric::query()->updateOrCreate([
//            'name' => 'adImpressions',
//            'date' => $data['date'],
//            'campaign_id' => $id,
//            'engagement' => $data['engagement']
//        ],
//            [
//                'value' => $data['adImpressions']
//            ]
//        );

//        $metric_access = MetricAccess::where('metric_name', 'adImpressions')->where('user_id', 2)->first();
//
//        if ($metric_access) {
//            $metric_access->is_active = $data['adImpressionsIsActive'];
//            $metric_access->save();
//        } else {
//            $metric_access = new MetricAccess();
//            $metric_access->metric_name = 'adImpressions';
//            $metric_access->user_id = 2;
//            $metric_access->is_active = $data['adImpressionsIsActive'];
//            $metric_access->save();
//        }
//
//        $metric = Metric::query()->updateOrCreate(['name' => 'clicks', 'date' => $data['date'], 'campaign_id' => $id, 'engagement' => $data['engagement']],
//            ['value' => $data['clicks']]);
//
//        $metric_access = MetricAccess::where('metric_name', 'clicks')->where('user_id', 2)->first();
//        if ($metric_access) {
//            $metric_access->is_active = $data['clicksIsActive'];
//            $metric_access->save();
//        } else {
//            $metric_access = new MetricAccess();
//            $metric_access->metric_name = 'clicks';
//            $metric_access->user_id = 2;
//            $metric_access->is_active = $data['clicksIsActive'];
//            $metric_access->save();
//        }
//
//        $metric = Metric::query()->updateOrCreate(['name' => 'besucher', 'date' => $data['date'], 'campaign_id' => $id, 'engagement' => $data['engagement']],
//            ['value' => $data['besucher']]);
//
//        $metric_access = MetricAccess::where('metric_name', 'besucher')->where('user_id', 2)->first();
//        if ($metric_access) {
//            $metric_access->is_active = $data['besucherIsActive'];
//            $metric_access->save();
//        } else {
//            $metric_access = new MetricAccess();
//            $metric_access->metric_name = 'besucher';
//            $metric_access->user_id = 2;
//            $metric_access->is_active = $data['besucherIsActive'];
//            $metric_access->save();
//        }
//
//        $metric = Metric::query()->updateOrCreate(['name' => 'clickouts', 'date' => $data['date'], 'campaign_id' => $id, 'engagement' => $data['engagement']],
//            ['value' => $data['clickouts']]);
//
//        $metric_access = MetricAccess::where('metric_name', 'clickouts')->where('user_id', 2)->first();
//        if ($metric_access) {
//            $metric_access->is_active = $data['clickoutsIsActive'];
//            $metric_access->save();
//        } else {
//            $metric_access = new MetricAccess();
//            $metric_access->metric_name = 'clickouts';
//            $metric_access->user_id = 2;
//            $metric_access->is_active = $data['clickoutsIsActive'];
//            $metric_access->save();
//        }
//        $metric = Metric::query()->updateOrCreate(['name' => 'benutzer', 'date' => $data['date'], 'campaign_id' => $id, 'engagement' => $data['engagement']],
//            ['value' => $data['benutzer']]);
//
//        $metric_access = MetricAccess::where('metric_name', 'benutzer')->where('user_id', 2)->first();
//        if ($metric_access) {
//            $metric_access->is_active = $data['benutzerIsActive'];
//            $metric_access->save();
//        } else {
//            $metric_access = new MetricAccess();
//            $metric_access->metric_name = 'benutzer';
//            $metric_access->user_id = 2;
//            $metric_access->is_active = $data['benutzerIsActive'];
//            $metric_access->save();
//        }
//
//        $metric = Metric::query()->updateOrCreate(['name' => 'sekunden', 'date' => $data['date'], 'campaign_id' => $id, 'engagement' => $data['engagement']],
//            ['value' => $data['sekunden']]);
//
//        $metric_access = MetricAccess::where('metric_name', 'sekunden')->where('user_id', 2)->first();
//        if ($metric_access) {
//            $metric_access->is_active = $data['sekundenIsActive'];
//            $metric_access->save();
//        } else {
//            $metric_access = new MetricAccess();
//            $metric_access->metric_name = 'sekunden';
//            $metric_access->user_id = 2;
//            $metric_access->is_active = $data['sekundenIsActive'];
//            $metric_access->save();
//        }
//
//        $metric = Metric::query()->updateOrCreate(['name' => 'postClickSales', 'date' => $data['date'], 'campaign_id' => $id, 'engagement' => $data['engagement']],
//            ['value' => $data['postClickSales']]);
//
//
//        $metric_access = MetricAccess::where('metric_name', 'postClickSales')->where('user_id', 2)->first();
//        if ($metric_access) {
//            $metric_access->is_active = $data['postClickSalesIsActive'];
//            $metric_access->save();
//        } else {
//            $metric_access = new MetricAccess();
//            $metric_access->metric_name = 'postClickSales';
//            $metric_access->user_id = 2;
//            $metric_access->is_active = $data['postClickSalesIsActive'];
//            $metric_access->save();
//        }


        return response()->json([
            'message' => __('Data saved successfully.'),
            'data' => $metricAccess
        ]);
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


        //return [$from, $to];

       return MetricAccess::where('campaign_id',$campaign_id)
            ->whereBetween('date',[$from, $to])
            ->where('engagement', $engagement)
            ->groupBy('metric_name')
            ->select(
                '*',
                DB::raw('SUM(kpi) as total')
            )
            ->get();


//        return MetricAccess::where('is_active', 1)
//            ->where('user_id', 2)
//            ->where('engagement', $engagement)
//            ->get();


//        return $matricAccesses;
//        $fields_arr = [
//            'adImpressions',
//            'clicks',
//            'besucher',
//            'clickouts',
//            'benutzer',
//            'sekunden',
//            'postClickSales'
//        ];
//
//        foreach ($fields_arr as $field) {
//            $access = MetricAccess::where('metric_name', $field)->where('user_id', 2)->first();
//            $response["{$field}"]['active'] = $access->is_active;
//
//            if ($access->is_active || $user_id !== 2) {
//                $response[$field]['value'] = 0;
//
//                $metrics = Metric::where('campaign_id', $campaign_id)
//                    ->where('name', $field)
//                    ->where('engagement', $engagement)
//                    ->whereBetween('date', [$from, $to])->get();
//                foreach ($metrics as $m) {
//                    $response[$field]['value'] += floatval($m->value);
//                }
//            } else {
//                $response[$field]['value'] = -1;
//            }
//        }
//
//        return $response;

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

    public function engagements()
    {
        return $this->hasMany(Engagements::class);
    }

}
