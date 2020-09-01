<?php

namespace App\Exports;

use App\MetricAccess;
use Maatwebsite\Excel\Concerns\FromCollection;

class MetricsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return MetricAccess::all();
    }
}
