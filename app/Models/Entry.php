<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

use DB;

class Entry extends Model
{

    protected $table = 'entries';

    public static function payTypes(){
        $ar = [];
        $ar[] = ['value'=>1,'label'=>'Cash'];
        $ar[] = ['value'=>2,'label'=>'UPI'];


        return $ar;
    }

    public static function showPayTypes(){
        return [1=>'Cash',2=>"UPI"];
    }

}