<?php

namespace App\Http\Controllers\Api\V1;

use App\Group;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminController extends Controller
{

    public function store(Request $request)
    {

        // password and logo may not be not provided during edit
        $ifFilled = [];
        if ($request->password) {
            $ifFilled['password'] = bcrypt($request->password);
        }

        $create = [
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->is_admin == 'true' ? 1 : 2,
            'group_id' => $request->group_id
        ];

        $data = array_merge($create, $ifFilled);

        if (!$request->update) {
            $user = User::create($data);
        } else {
            $user = User::where('id', $request->id)->first();
            $user->update($data);
        }

        return response()->json(['status' => 'ok', 'user' => $user->load('group', 'role')], Response::HTTP_OK);
    }


    public function storeCompany(Request $request)
    {
        if ($request->company_id) {
            $company = Campaign::find($request->company_id);
        } else {
            $company = new Campaign();
            $company->is_active = 1;
        }

        $company->name = $request->campaign_name;
        $company->user_id = $request->selected_user;
        $company->description = $request->description;
        $company->save();

        return response()->json('ok', Response::HTTP_OK);
    }

    public function getUsers(Request $request)
    {
        $users = User::with('campaigns');

        if ($request->select) {
            $users = $users->where('role_id', 2);
        }

        return $users->get()->toArray();
    }

    public function getUser($id)
    {
        $user = User::where('id', $id)
            ->select('name', 'email', 'role_id', 'group_id')
            ->get()->toArray();

        return response()->json($user, Response::HTTP_OK);

    }

    public function getGroups(Request $request)
    {
        $group = Group::get();
        return \response()->json($group);
    }

    public function getGroup($id)
    {
        $user = Group::where('id', $id)
            ->select('id', 'name')
            ->first()->toArray();

        return response()->json($user, Response::HTTP_OK);
    }

    public function storeGroup(Request $request)
    {

        $logo = null;

        if ($request->file('logo')) {

            $logo = time() . uniqid() . '.' . $request->file('logo')->getClientOriginalExtension();

            $request->file('logo')->move(public_path('images/logo'), $logo);

        }

        $create = [
            'name' => $request->name,
            'logo' => $logo,
        ];

        $group = Group::query()
            ->create($create);

        return \response()->json($group);

    }

    public function editGroup($id, Request $request)
    {
        $logo = null;
        $update = [
            'name' => $request->name,
        ];

        if ($request->file('logo')) {
            $logo = time() . uniqid() . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(public_path('images/logo'), $logo);
            $update['logo'] = $logo;
        }
        $group = Group::query()->findOrFail($id);
        $group->update($update);

        return \response()->json($group, Response::HTTP_OK);

    }

    public function getCompanies()
    {
        $companies = null;

        if (auth()->user()->role_id == 1) {
            $companies = Campaign::with('user')->get();
        } else {
            $companies = Campaign::where('user_id', auth()->user()->id)
                ->with('user')
                ->get();
        }

        return response()->json($companies->toArray(), Response::HTTP_OK);
    }


    public function getGroupFilter()
    {
        $companies = null;

        if (auth()->user()->role_id == 1) {
            $companies = Group::whereHas('users', function ($user) {
                $user->where('role_id', '!=', 1);
            })->with(['users' => function ($user) {
                $user->where('role_id', '!=', 1)->with('campaigns');
            }])->get();
        } else {
            $companies = Group::whereHas('users', function ($user) {
                $user->where('id', auth()->user()->id);
            })->with(['users' => function ($user) {
                $user->with('campaigns');
            }])->get();
        }

        return response()->json($companies->toArray(), Response::HTTP_OK);
    }

    public function getCompany($id)
    {
        return Campaign::find($id)->toArray();
    }


    public function toggleShow(Request $request)
    {
        // This will work if all clients should be hidden,
        // If we need to hide certain campaign from user (client in our case), then we need to change this, or put in loop
        $hiddenFromArray = [];

        $hiddenFromString = Campaign::select('hidden_from')->first()->hidden_from;
        $hiddenFromArray = explode(',', $hiddenFromString);

        // delete default null value
        $hiddenFromArray = array_filter($hiddenFromArray);



        if ($request->value == false) {
            $hiddenFromArray = $this->deleteFromArray($request->id, $hiddenFromArray);
        } else {
            $hiddenFromArray[] = $request->id;
        }

        // delete duplicates
        $hiddenFromArray = array_unique($hiddenFromArray);

      // return response()->json($hiddenFromArray, Response::HTTP_OK);


//        if(!empty($hiddenFromArray))
//        {
            $hiddenFromString = implode(',', $hiddenFromArray);
//        }

        Campaign::where('id','>',0)->update(['hidden_from' => $hiddenFromString]);

        return response()->json('ok', Response::HTTP_OK);

    }

    private function deleteFromArray($id, $array)
    {
        if (($key = array_search($id, $array)) !== false) {
            unset($array[$key]);
        }

       // return $array;

        if(empty($array))
        {
            return [];
        }

        return $array;
    }

    public function downloadCSV(Request $request)
    {
        $date = $request->from.'-'.$request->to;

        return \Maatwebsite\Excel\Facades\Excel::download(
            new \App\Exports\MetricsExport($request), "data-{$date}.csv",
            \Maatwebsite\Excel\Excel::CSV
        );

    }


}
