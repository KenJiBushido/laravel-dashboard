<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;
use App\Person_detail;

class WhatController extends Controller
{
    //
    public function alldb(){
        $this->db1();
        $this->db2();

        foreach($this->db2() as $d2){
            $data2[] = $d2;

        }

        // $collection = collect([
        //     ['product_id' => $data2, 'name' => 'Desk'],
        //     ['product_id' => 'prod-200', 'name' => 'Chair'],
        // ]);
        
        // $keyed = $collection->keyBy('name');
        
        // $keyed->all();
        // // dd($keyed->all());

        // return view('what', compact('d2'));

    }

    public function db1(){
        return $person = Person::all();

    }

    public function db2(){
        return $person_detail = Person_detail::all();

    }

    // public function alldb(){
    //     $collection = collect([
    //         ['product_id' => 'prod-100', 'name' => 'Desk'],
    //         ['product_id' => 'prod-200', 'name' => 'Chair'],
    //     ]);
        
    //     $keyed = $collection->keyBy('name');
        
    //     $keyed->all();
    //     dd($keyed->all());
    // }
}
