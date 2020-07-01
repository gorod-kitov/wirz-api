<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Metric;
use App\Models\MetricAccess;

class Campaign extends Model
{
	public function addMetrics1($id, $data)
	{
		$metric = new Metric();
		$metric->name = 'clicks';
		$metric->value = $data['clicks'];
		$metric->campaign_id = $id;
		$metric->date = $data['date'];
		$metric->engagement = $data['engagement'];
		$metric->save();

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

		$metric = new Metric();
		$metric->name = 'total_reach';
		$metric->value = $data['totalReach'];
		$metric->campaign_id = $id;
		$metric->date = $data['date'];
        $metric->engagement = $data['engagement'];
		$metric->save();

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

		$metric = new Metric();
		$metric->name = 'ad_engagement';
		$metric->value = $data['adEngagement'];
		$metric->campaign_id = $id;
		$metric->date = $data['date'];
        $metric->engagement = $data['engagement'];
		$metric->save();

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

		$metric = new Metric();
		$metric->name = 'page_engagement';
		$metric->value = $data['pageEngagement'];
		$metric->campaign_id = $id;
		$metric->date = $data['date'];
        $metric->engagement = $data['engagement'];
		$metric->save();

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

		$metric = new Metric();
		$metric->name = 'active_length';
		$metric->value = $data['activeLength'];
		$metric->campaign_id = $id;
		$metric->date = $data['date'];
        $metric->engagement = $data['engagement'];
		$metric->save();

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

		$metric = new Metric();
		$metric->name = 'clickouts';
		$metric->value = $data['clickouts'];
		$metric->campaign_id = $id;
		$metric->date = $data['date'];
        $metric->engagement = $data['engagement'];
		$metric->save();

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

		$metric = new Metric();
		$metric->name = 'sales';
		$metric->value = $data['sales'];
		$metric->campaign_id = $id;
		$metric->date = $data['date'];
        $metric->engagement = $data['engagement'];
		$metric->save();

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
				$campaign_fields = ['display', 'native', 'search', 'social'];
				foreach ($campaign_fields as $field) {
					$metric = new Metric();
					$metric->name = $field;
					$metric->value = $data_item[$field];
					$metric->date = $data['date'];
					$metric->is_active = 1;
					$metric->campaign_id = $campaign->id;
					$metric->save();
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
		foreach($fields_arr as $field) {
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

		foreach($fields_arr as $field) {
			$metrics = Metric::where('campaign_id', $id)
							->where('name', $field)
							->whereBetween('date', [$from, $to])->get();
			foreach ($metrics as $m) {
				$response[] = $m;
			}
		}

		return $response;
	}
}
