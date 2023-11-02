<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Redirect, Validator, Hash, Response, Session, DB;
use App\Models\Entry, App\Models\User;

class EntryContoller extends Controller {
	public function initEntries(Request $request){

		// $entries = DB::table('entries')->get();
		$entries = [];

		$data['success'] = true;
		$data['entries'] = $entries;
		return Response::json($data, 200, []);
	}		

}
