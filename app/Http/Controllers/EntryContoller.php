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

		$entries = Entry::get();

		$pay_types = Entry::payTypes();
		$hours = Entry::hours();

		$data['success'] = true;
		$data['entries'] = $entries;
		$data['pay_types'] = $pay_types;
		$data['hours'] = $hours;
		return Response::json($data, 200, []);
	}	
	
	public function editEntry($id){
		$sitting_entry = Entry::where('id', $id)->first();

		$data['success'] = true;
		$data['sitting_entry'] = $sitting_entry;
		return Response::json($data, 200, []);
	}

	public function updateEntry($request){

		$cre = [
			''=>$request->,
		];

		$rules = [
			''=>'required',
		];

		$validator = Validator::make($cre,$rules);

		if($validator->passes()){

			if($request->id){
				$group_id = $request->id;
				
				$entry = Entry::find($request->id);;
				$message = "Updated Successfully!";
			} else {
				$entry = new Entry;
				$message = "Stored Successfully!";
			}

			$entry->save();
			$data['success'] = true;
		} else {
			$data['success'] = false;
			$message = $validator->errors()->first();
		}

		return Response::json($data, 200, []);

	}		

}
