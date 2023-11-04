<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use DB;

class Entry extends Model
{

    protected $table = 'sitting_entries';

    public static function payTypes(){
        $ar = [];
        $ar[] = ['value'=>1,'label'=>'Cash'];
        $ar[] = ['value'=>2,'label'=>'UPI'];

        return $ar;
    }

   

    public static function showPayTypes(){
        return [1=>'Cash',2=>"UPI"];
    }

    public static function hours(){
        $ar = [];
        for ($i=1; $i <= 24; $i++) { 
           $ar[] = ['value'=>$i,'label'=>$i];
        }
        return $ar;
    }

    public static function checkShift(){
        // $a_shift = "06:00:00-13:59:59";
        //$b_shift = "14:00:00-21:59:59";
        //$c_shift = "22:00:00-05:59:59";

        $a_shift = strtotime("06:00:00");
        $b_shift =strtotime("14:00:00");
        $c_shift =strtotime("22:00:00");


        $current_time = strtotime(date("H:i:s"));

        if($current_time > $a_shift && $current_time < $b_shift){
            return "A";
        }else if($current_time > $b_shift && $current_time < $c_shift){
            return "B";
        }else{
            return "C";
        }
    }

}