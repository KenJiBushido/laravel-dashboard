<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Study;

class SumController extends Controller
{
    //
    public function result(){
        // $data = Student::with('studies', 'studies.subject')->get();
        $data = Study::all();
        // dd($data);
        
        return view('try', compact('data'));
    }
}
