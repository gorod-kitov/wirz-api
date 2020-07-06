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


}
