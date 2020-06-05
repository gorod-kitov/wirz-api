<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller {

	
	public function authenticate(Request $request)
	{
		$user = User::where('email', $request->get('email'))->first();
        if ($user) {
            $hasher = app('hash');
            if ($hasher->check($request->get('password'), $user->password)) {
                return ['api_token' => $user->api_token];
            } else {
                return response()->json(['message' => __('Invalid email or password.')], 422);
            }
        } else {
            return response()->json(['message' => __('Invalid email or password.')], 422);
        }
	}

	public function signup(Request $request)
	{
		$request->validate([
			'email' => 'string|required',
			'password' => 'string|required'
		]);

		$user = User::where('email', $request->get('email'))->first();

		if ($user) {
			return response()->json(['message' => __('Account with current email already registerd.')], 422);
		} else {
			$created = User::create([
				'email' => $request->get('email'),
				'password' => Hash::make($request->get('password')),
				'api_token' => Str::random(60),
			]);
			if ($created) {
				return ['api_token' => $created->api_token];
			} else {
				return respose()->json(['message' => __('Server error.')], 500);
			}
		}
	}

}