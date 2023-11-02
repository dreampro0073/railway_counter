<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use Redirect, Validator, Hash, Response, Session, DB;

use App\Models\User, App\Models\Plan;

class AdminController extends Controller {


	public function dashboard(Request $request){        
		return view('admin.entries.index', [
            "sidebar" => "dashboard",
            "subsidebar" => "dashboard",
        ]);
	}
}