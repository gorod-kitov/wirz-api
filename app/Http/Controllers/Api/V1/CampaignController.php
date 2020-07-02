<?php

namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Metric;
use App\User;

class CampaignController extends Controller {

	private $metrics, $campaigns, $users;

	const ADD_ENGAGEMENT = 0;
	const SITE_ENGAGEMENT = 1;

	public function __construct(Metric $METRIC, Campaign $CAMPAIGN, User $USER)
	{
		$this->metrics = $METRIC;
		$this->campaigns = $CAMPAIGN;
		$this->users = $USER;
	}

	public function filterMetrics1(Request $request)
    {
        $metrics = Metric::query()->select('name','value', 'metric_accesses.is_active')->where('campaign_id', $request->campaign )
            ->where('date', $request->date)
            ->where('engagement', $request->selected)
            ->join('metric_accesses','metrics.name', 'metric_accesses.metric_name')
            ->get();

        return response()->json($metrics->toArray());
    }

    public function filterMetrics2(Request $request)
    {
        $companies = Campaign::query()->select('id','name','is_active')
            ->with(['metrics2' => function ($query) use($request) {
                $query->where('date', $request->date)
                    ->select('name','value','campaign_id');
        }])->get();
   /*     $companies = Campaign::query()
            ->join('metrics', function($join) use ($request) {
                $join->on('metrics.campaign_id', '=', 'campaigns.id')
                    ->where('metrics.date', $request->date)
                    ->whereNull('metrics.engagement');
            })
//            ->groupBy('name')
            ->select('metrics.name as metric','metrics.date', 'metrics.value' , 'campaigns.name', 'campaigns.is_active' )
            ->get();*/

        return response()->json($companies->toArray());
    }


	public function addMetrics1(Request $request)
	{

		$campaign = $this->campaigns
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
//	    return  response()->json($request->all());
		return $this->campaigns->addMetrics2($request->all());
	}

	public function getMetrics1($id, Request $request)
	{
//	    return response()->json($request->all());
		$request->validate([
			'date_from' => 'required|string',
			'date_to' => 'required|string',
		]);
//		return response()->json($id);
		$campaign = $this->campaigns
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
