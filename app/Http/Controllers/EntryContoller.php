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
			'name'=>$request->name,
		];

		$rules = [
			'name'=>'required',
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

			$entry->name = $request->name;
			$entry->pnr_uid = $request->pnr_uid;
			$entry->mobile_no = $request->mobile_no;
			$entry->train_no = $request->train_no;
			$entry->address = $request->address;
			$entry->no_of_adults = $request->no_of_adults ? $request->no_of_adults : 0;
			$entry->no_of_children = $request->no_of_children ? $request->no_of_children : 0;
			$entry->no_of_baby_staff = $request->no_of_baby_staff ? $request->no_of_baby_staff : 0;
			$entry->hours_occ = $request->hours_occ ? $request->hours_occ : 0;
			$entry->check_in = date("Y-m-d H:i:s",strtotme($request->check_in));
			$entry->check_out = date("Y-m-d H:i:s",strtotme($request->check_out));
			$entry->seat_no = $request->seat_no;
			// $entry->paid_amount = $request->paid_amount;
			$entry->pay_type = $request->pay_type;
			$entry->remarks = $request->remarks;


			$entry->save();


			if(!$request->id ){
				$entry->unique_id = date('Y').000000 + $entry->id;
			}
			$data['success'] = true;
		} else {
			$data['success'] = false;
			$message = $validator->errors()->first();
		}

		return Response::json($data, 200, []);

	}		

}
