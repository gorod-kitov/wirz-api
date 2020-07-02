<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminController extends Controller
{

    public function store(Request $request)
    {
        $logo = null;

        if ($request->file('logo')) {

            $logo = time() . uniqid() . '.' . $request->file('logo')->getClientOriginalExtension();

            $request->file('logo')->move(public_path('images/logo'), $logo);

        }

        // password and logo may not be not provided during edit
        $ifFilled = [];
        if ($request->password) {
            $ifFilled['password'] = bcrypt($request->password);
        }

        if ($request->logo) {
            $ifFilled['logo'] = $logo;
        }
        $create = [
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => 2,
        ];

        $data = array_merge($create, $ifFilled);

        if (!$request->update) {
            User::create($data);
        } else {
            User::where('id', $request->id)->update($data);
        }

        return response()->json('ok', Response::HTTP_OK);
    }


    public function getUsers()
    {
        $users = User::with('campaigns')->get();

        return $users->toArray();
    }

    public function getUser($id)
    {
        $user = User::where('id', $id)
            ->select('name', 'email')
            ->get()->toArray();

        return response()->json($user, Response::HTTP_OK);

    }
}
