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

		$check_shift = Entry::checkShift();

		$entries = Entry::select('sitting_entries.*');
		if($request->name){
			$entries = $entries->where('sitting_entries.name', 'LIKE', '%'.$request->name.'%');
		}		
		if($request->mobile_no){
			$entries = $entries->where('sitting_entries.mobile_no', 'LIKE', '%'.$request->mobile_no.'%');
		}		
		if($request->pnr_uid){
			$entries = $entries->where('sitting_entries.pnr_uid', 'LIKE', '%'.$request->pnr_uid.'%');
		}		
		if($request->train_no){
			$entries = $entries->where('sitting_entries.train_no', 'LIKE', '%'.$request->train_no.'%');
		}
		$entries = $entries->orderBy('id', "DESC")->take(100)->get();

		$total_shift_cash = 0;
		$total_shift_upi = 0;

		if($check_shift != "C"){
			$total_shift_upi = Entry::where('date',date("Y-m-d"))->where('pay_type',2)->where('shift', $check_shift)->sum("paid_amount");

			$total_shift_cash = Entry::where('date',date("Y-m-d"))->where('pay_type',1)->where('shift', $check_shift)->sum("paid_amount");	
		}
		
		if($check_shift == "C"){

			$total_shift_upi = Entry::whereBetween('date',[date("Y-m-d",strtotime("-1 day")),date("Y-m-d")])->where('shift', $check_shift)->where('pay_type',2)->sum("paid_amount");

			$total_shift_cash = Entry::whereBetween('date',[date("Y-m-d",strtotime("-1 day")),date("Y-m-d")])->where('shift', $check_shift)->where('pay_type',1)->sum("paid_amount");
			
		}


		$total_collection = $total_shift_upi + $total_shift_cash;

		$pay_types = Entry::payTypes();
		$hours = Entry::hours();

		$show_pay_types = Entry::showPayTypes();
		if(sizeof($entries) > 0){
			foreach ($entries as $item) {
				$item->pay_by = isset($item->pay_type)?$show_pay_types[$item->pay_type]:'';
			}

		}

		$data['success'] = true;
		$data['entries'] = $entries;
		$data['pay_types'] = $pay_types;
		$data['hours'] = $hours;
		$data['total_shift_upi'] = $total_shift_upi;
		$data['total_shift_cash'] = $total_shift_cash;
		$data['total_collection'] = $total_collection;
		$data['check_shift'] = $check_shift;
		return Response::json($data, 200, []);
	}	
	
	public function editEntry(Request $request){
		$sitting_entry = Entry::where('id', $request->entry_id)->first();

		if($sitting_entry){
			$sitting_entry->mobile_no = $sitting_entry->mobile_no*1;
			$sitting_entry->train_no = $sitting_entry->train_no*1;
			$sitting_entry->pnr_uid = $sitting_entry->pnr_uid*1;
			$sitting_entry->paid_amount = $sitting_entry->paid_amount*1;
			$sitting_entry->total_amount = $sitting_entry->paid_amount*1;
			// $sitting_entry->no_of_children = $sitting_entry->no_of_children*1;
		}

		$data['success'] = true;
		$data['sitting_entry'] = $sitting_entry;
		return Response::json($data, 200, []);
	}
	public function calCheck(Request $request){
		
		$check_in = $request->check_in;
		$hours_occ = $request->hours_occ;


		$ss_time = strtotime(date("H:i:s",strtotime($check_in)));
		$new_time = date("H:i:s", strtotime('+'.$hours_occ.' hours', $ss_time));

		$data['success'] = true;
		$data['check_out'] = $new_time;
		return Response::json($data, 200, []);
	}

	public function store(Request $request){

		$check_shift = Entry::checkShift();

		$cre = [
			'name'=>$request->name,
		];

		$rules = [
			'name'=>'required',
		];

		$validator = Validator::make($cre,$rules);

		if($validator->passes()){
			$total_amount = $request->total_amount;
			if($request->id){
				$group_id = $request->id;
				$entry = Entry::find($request->id);
				$message = "Updated Successfully!";

				if(isset($entry)){
					if($check_shift != $entry->shift){
						$total_amount = $total_amount - $entry->paid_amount;
						$entry = new Entry;
						$message = "Stored Successfully!";
					}
				}

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
			$entry->check_in = date("H:i:s",strtotime($request->check_in));
			$entry->check_out = date("H:i:s",strtotime($request->check_out));
			// $entry->check_in = $request->check_in;
			// $entry->check_in = $request->check_in;
			// $entry->check_out = date("Y-m-d H:i:s",strtotme($request->check_out));
			$entry->seat_no = $request->seat_no;
			$entry->paid_amount = $total_amount;
			$entry->pay_type = $request->pay_type;
			$entry->remarks = $request->remarks;
			$entry->shift = $check_shift;
			$entry->save();

			$check_in_time = strtotime($entry->check_in);
        	$current_time = strtotime(date("H:i:s"));
        	
        	$date = date("Y-m-d");

        	if($current_time > strtotime("00:00:00") && $current_time < strtotime("06:00:00")){
	           	$date = date("Y-m-d",strtotime("-1 day"));
	        }
	        $entry->date = $date;
			$entry->save();



			if(!$request->id ){
				// $entry->unique_id = date('Y').000000 + $entry->id;
			}
			$data['success'] = true;
		} else {
			$data['success'] = false;
			$message = $validator->errors()->first();
		}

		return Response::json($data, 200, []);

	}		

}
