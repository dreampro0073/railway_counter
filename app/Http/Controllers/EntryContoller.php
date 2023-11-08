<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Redirect, Validator, Hash, Response, Session, DB;
use App\Models\Entry, App\Models\User;

use Crypt;

use Dompdf\Dompdf;
use Dompdf\Options;

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

		$date_ar = [date("Y-m-d",strtotime('-1 day')),date("Y-m-d",strtotime("now"))];
		$entries = $entries->orderBy('id', "DESC")->whereBetween('date',$date_ar)->get();

		$total_shift_cash = 0;
		$total_shift_upi = 0;		

		$last_hour_cash_total = 0;
		$last_hour_upi_total = 0;

		$from_time = date('h:00:00 A');
		$to_time = date('h:59:59 A');

		if($check_shift != "C"){
			$total_shift_upi = Entry::where('date',date("Y-m-d"))->where('pay_type',2)->where('shift', $check_shift)->sum("paid_amount");

			$total_shift_cash = Entry::where('date',date("Y-m-d"))->where('pay_type',1)->where('shift', $check_shift)->sum("paid_amount");	

			$last_hour_upi_total = Entry::where('date',date("Y-m-d"))->where('pay_type',2)->where('shift', $check_shift)->whereBetween('check_in', [$from_time, $to_time])->sum("paid_amount");

			$last_hour_cash_total = Entry::where('date',date("Y-m-d"))->where('pay_type',1)->where('shift', $check_shift)->whereBetween('check_in', [$from_time, $to_time])->sum("paid_amount");	

		}
		
		if($check_shift == "C"){

			$total_shift_upi = Entry::whereBetween('date',[date("Y-m-d",strtotime("-1 day")),date("Y-m-d")])->where('shift', $check_shift)->where('pay_type',2)->sum("paid_amount");

			$total_shift_cash = Entry::whereBetween('date',[date("Y-m-d",strtotime("-1 day")),date("Y-m-d")])->where('shift', $check_shift)->where('pay_type',1)->sum("paid_amount");
			$last_hour_upi_total = Entry::whereBetween('date',[date("Y-m-d",strtotime("-1 day")),date("Y-m-d")])->where('shift', $check_shift)->where('pay_type',2)->whereBetween('check_in', [$from_time, $to_time])->sum("paid_amount"); 
			$last_hour_cash_total = Entry::whereBetween('date',[date("Y-m-d",strtotime("-1 day")),date("Y-m-d")])->where('shift', $check_shift)->where('pay_type',1)->whereBetween('check_in', [$from_time, $to_time])->sum("paid_amount");
			
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

		$data['last_hour_upi_total'] = $last_hour_upi_total;
		$data['last_hour_cash_total'] = $last_hour_cash_total;
		$data['last_hour_total'] = $last_hour_upi_total + $last_hour_cash_total;

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
	// public function calCheck(Request $request){
		
	// 	$check_in = $request->check_in;
	// 	$hours_occ = $request->hours_occ;


	// 	$ss_time = strtotime(date("H:i:s",strtotime($check_in)));
	// 	$new_time = date("H:i:s", strtotime('+'.$hours_occ.' hours', $ss_time));

	// 	$data['success'] = true;
	// 	$data['check_out'] = $new_time;
	// 	return Response::json($data, 200, []);
	// }

	public function calCheck(Request $request){
		
		$check_in = $request->check_in;
		$hours_occ = $request->hours_occ;

		$ss_time = strtotime(date("h:i A",strtotime($check_in)));

		$new_time = date("h:i A", strtotime('+'.$hours_occ.' hours', $ss_time));

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
			$entry->check_in = date("h:i A",strtotime($request->check_in));
			$entry->check_out = date("h:i A",strtotime($request->check_out));
			// $entry->check_in = date("H:i:s",strtotime($request->check_in));
			// $entry->check_out = date("H:i:s",strtotime($request->check_out));
			
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
			$data['id'] = $entry->id;
			$data['success'] = true;
		} else {
			$data['success'] = false;
			$message = $validator->errors()->first();
		}

		return Response::json($data, 200, []);

	}		
	public function printPost($id = 0){

        $print_data = DB::table('sitting_entries')->where('id', $id)->first();
        $print_data->total_member = $print_data->no_of_adults + $print_data->no_of_children + $print_data->no_of_baby_staff;
        $print_data->adult_first_hour_amount = 0;
        $print_data->children_first_hour_amount = 0;
        $hours = $print_data->hours_occ - 1;
        $print_data->adult_other_hour_amount = 0;
        $print_data->children_other_hour_amount = 0; 

        if($print_data->hours_occ > 0) {
            $print_data->adult_first_hour_amount = $print_data->no_of_adults * 30;
            $print_data->children_first_hour_amount = $print_data->no_of_children * 20;
        }      
        
        if($hours > 0){
            $print_data->adult_other_hour_amount = $print_data->no_of_adults * 20 * $hours;
            $print_data->children_other_hour_amount = $print_data->no_of_children * 10 * $hours; 
        }       

        $options = new Options();
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);

        define("DOMPDF_UNICODE_ENABLED", true);
        
        // return view('admin.print_page',compact('print_data'));


        $html = view('admin.print_page', compact('print_data'));

        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        // $dompdf->setPaper('A4',);
        $dompdf->setPaper([0,0,230,450]);

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream(date("dmY",strtotime("now")).'.pdf',array("Attachment" => false));

        
        // return view('admin.print_page1');
    }

}
