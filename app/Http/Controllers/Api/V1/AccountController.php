<?php

namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\User;

class AccountController extends Controller {

	private $userModel;

	public function __construct(User $USER)
	{
		$this->userModel = $USER; 
	}

	public function getAccountData(Request $request)
	{
		return $this->userModel->getAccountData($request->user_id);
	}

}