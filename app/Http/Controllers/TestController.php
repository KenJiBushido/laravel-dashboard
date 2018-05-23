<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TestController extends Controller
{
    //
    public function long(){
        $data = DB::table('customer')
                    ->join('customer_detail', 'customer_detail.cus_id', '=', 'customer.id')
                    ->select('customer.name', 'customer_detail.phone', 'customer_detail.cus_id', 'customer_detail.email', 'customer_detail.age')
                    ->get()->toArray();

        foreach($data as $dt){
            $dt->orders = DB::table('orders')->where('cus_id', '=', $dt->id)->get()->toArray();

        }

        echo "<pre>";
        // echo $data;
        print_r($data);

    }
}
