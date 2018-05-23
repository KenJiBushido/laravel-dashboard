<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Members;
use Illuminate\Support\Facades\DB;
use Excel;
use PDF;
use App\Exports\InvoicesExport;
use Cookie;
use Illuminate\Cookie\CookieJar;

class MainController extends Controller
{
    //
    public function index(Request $request){
        
        $s = $request->input('s');

		$member = Members::latest()
                        ->search($s)
                        ->paginate(5);
  
    	return view('home',compact('member', 's'));
    }

    public function insert(Request $request){

    	$member = new Members;
    	$member->name = $request->firstname;
    	$member->surname = $request->lastname;
    	$member->email = $request->email;
    	$member->phone = $request->phonenumber;

        $member->save();

        session()->flash('notif', 'Success to save member');

    	return redirect()->route('home.input');
    }

    public function searchBetween(Request $request){

        $from = $request->input('from');
		$to = $request->input('to');

        // die($member = Members::whereBetween('created_at', [$from, $to])->toSql());

        $member = Members::whereBetween('created_at', [$from, $to])
                            ->orwhere('created_at', 'like', '%' .$to. '%')
                            ->paginate(5);
		return view('home', compact('member', 'from', 'to'));
    }

    public function update(Request $request , $id){

        $member = Members::find($id);
        $member->name = $request->firstname;
        $member->surname = $request->lastname;
        $member->email = $request->email;
        $member->phone = $request->phone;

        $member->save();

        session()->flash('notif2', 'Success to edit member');

        return redirect()->route('home.input');
    }

    public function delete($id){

        $member = Members::find($id);

        $member->delete();
            
        session()->flash('notif3', 'Success to delete member');

        return redirect()->route('home.input');
    }

    public function export(Request $request){
        if($request->excel == ''){
            
            return $this->memberExpdf($request);

        }
        else{
            return $this->memberExport($request);
        }
    }

    public function memberExport(Request $request){
        return Excel::download(new InvoicesExport($request->check, $request->search, $request->from, $request->to), 'Members.xlsx');
    }

    public function memberExpdf(Request $request){

        $check = $request->check;
        $search = $request->search;
        $from = $request->from;
        $to = $request->to;

        if($check == ''){
            if(!empty($search)){
                $members = Members::search($search)->get();

            }
            elseif(!empty($from)){
                $members = Members::whereBetween('created_at', [$from, $to])
                ->orwhere('created_at', 'like', '%' .$to. '%')
                ->get();

            }
            else{
                $members = Members::all();

            }
        }
        else{
            $members = Members::query()->whereIn('id' , $check)->get();

        }
        $pdf = PDF::loadView('pdf', ['members'=>$members]);
        return @$pdf->stream();

    }

}
