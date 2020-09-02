<?php

namespace App\Exports;

use App\Models\Campaign;
use App\models\Engagements;
use App\Models\MetricAccess;
use App\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class MetricsExport implements FromView
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function getData()
    {
        return MetricAccess::where('campaign_id', $this->request->campaign_id)
            ->whereBetween('date', [$this->request->from, $this->request->to])
            ->where('engagement', $this->request->selected)
            ->groupBy('metric_name')
            ->select(
                'number_description', 'metric_name', 'campaign_id', 'kpi', 'date', 'description', 'percent_text', 'percent',
                DB::raw('SUM(kpi) as total')
            )
            ->get();
    }

    public function view(): View
    {
//        dd($this->request->all());

        return view('exports.metrics', [
            'rows' => $this->getData(),
            'campaign' => Campaign::find($this->request->campaign_id)->name,
            'from' => $this->request->from,
            'to' => $this->request->to,
            'engagement' => Engagements::find($this->request->selected)->name
        ]);
    }

}
