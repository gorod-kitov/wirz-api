<?php

namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\Campaign;
use App\Models\Metric;
use App\User;

class CampaignController extends Controller {

	private $metrics, $campaigns, $users;

	public function __construct(Metric $METRIC, Campaign $CAMPAIGN, User $USER)
	{
		$this->metrics = $METRIC; 
		$this->campaigns = $CAMPAIGN;
		$this->users = $USER;
	}

	public function addMetrics1(Request $request)
	{
		$campaign = $this->campaigns->where('user_id', $request->user_id)
									->where('name', $request->get('campaign'))
									->first();
		if ($campaign) {
			return $this->campaigns->addMetrics1($campaign->id, $request->all());
		} else {
			return response()->json(['message' => __('Campaing not found.'), 404]);
		}
	}

	public function addMetrics2(Request $request)
	{
		return $this->campaigns->addMetrics2($request->all());
	}

	public function getMetrics1($id, Request $request)
	{
		$request->validate([
			'date_from' => 'required|string',
			'date_to' => 'required|string',
		]);
		$campaign = $this->campaigns->where('user_id', $request->user_id)
									->where('id', $id)
									->first();
		if ($campaign) {
			return $this->campaigns->getMetrics1($request->user_id, $id, $request->all());
		} else {
			return response()->json(['message' => __('Campaing not found.'), 404]);
		}
	}

	public function getMetrics2($id, Request $request)
	{
		$request->validate([
			'date_from' => 'required|string',
			'date_to' => 'required|string',
		]);
		$campaign = $this->campaigns->where('user_id', $request->user_id)
									->where('id', $id)
									->first();
		if ($campaign) {
			return $this->campaigns->getMetrics2($id, $request->all());
		} else {
			return response()->json(['message' => __('Campaing not found.'), 404]);
		}
	}

}