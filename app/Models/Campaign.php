<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Metric;

class Campaign extends Model
{
	public function addMetrics1($id, $data)
	{
		$clicks = new Metric();
		$clicks->name = 'clicks';
		$clicks->value = $data['clicks'];
		$clicks->campaign_id = $id;
		$clicks->is_active = $data['clicksIsActive'];
		$clicks->date = $data['date'];
		$clicks->save();

		$clicks = new Metric();
		$clicks->name = 'total_reach';
		$clicks->value = $data['totalReach'];
		$clicks->campaign_id = $id;
		$clicks->is_active = $data['totalReachIsActive'];
		$clicks->date = $data['date'];
		$clicks->save();

		$clicks = new Metric();
		$clicks->name = 'ad_engagement';
		$clicks->value = $data['adEngagement'];
		$clicks->campaign_id = $id;
		$clicks->is_active = $data['adEngagementIsActive'];
		$clicks->date = $data['date'];
		$clicks->save();

		$clicks = new Metric();
		$clicks->name = 'page_engagement';
		$clicks->value = $data['pageEngagement'];
		$clicks->campaign_id = $id;
		$clicks->is_active = $data['pageEngagementIsActive'];
		$clicks->date = $data['date'];
		$clicks->save();

		$clicks = new Metric();
		$clicks->name = 'active_length';
		$clicks->value = $data['activeLength'];
		$clicks->campaign_id = $id;
		$clicks->is_active = $data['activeLengthIsActive'];
		$clicks->date = $data['date'];
		$clicks->save();

		$clicks = new Metric();
		$clicks->name = 'clickouts';
		$clicks->value = $data['clickouts'];
		$clicks->campaign_id = $id;
		$clicks->is_active = $data['clickoutsIsActive'];
		$clicks->date = $data['date'];
		$clicks->save();

		$clicks = new Metric();
		$clicks->name = 'sales';
		$clicks->value = $data['sales'];
		$clicks->campaign_id = $id;
		$clicks->is_active = $data['salesIsActive'];
		$clicks->date = $data['date'];
		$clicks->save();

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

	public function getMetrics1($id, $data)
	{
		$from = $data['date_from']; 
		$to = $data['date_to'];
		
		$fields_arr = [
			'clicks', 'total_reach', 
			'ad_engagement', 'page_engagement',
			'active_length', 'clickouts', 'sales'
		];

		$response;
		foreach($fields_arr as $field) {
			$response[$field] = 0;
			$metrics = Metric::where('campaign_id', $id)
							->where('name', $field)
							->whereBetween('date', [$from, $to])->get();
			foreach ($metrics as $m) {
				$response[$field] += floatval($m->value);
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
