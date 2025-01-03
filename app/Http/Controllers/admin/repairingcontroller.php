<?php

namespace App\Http\Controllers\admin;
use Auth;
use Validator,Redirect,Response;
use App\Models\User;
use App\Models\Repairing;
use App\Models\Company;
use App\Models\Issues;
use DataTables;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class repairingcontroller extends Controller
{
	public function index(){
        $company = Company::all();
        $issues = Issues::all();
        return view("repairing",compact('company','issues'));
	}

	public function getall(Request $request){
		if ($request->ajax())
        {
            $data = Repairing::orderby('id','desc');
            $data->where('userid',Auth::user()->id);
            if($request->start_date && $request->end_date){
                $data->whereBetween(DB::raw('DATE(created_at)'), [$request->start_date, $request->end_date]);
            }
            $data->get();
            return Datatables::of($data)->make(true);
        }
	}

	public function addentry(Request $request){
        $entry = new Repairing();
        $entry->userid = Auth::user()->id;
        $entry->name = $request->name;
        $entry->phone_no = $request->phone_no;
        $entry->company = $request->company;
        $entry->model = $request->model;
        $entry->imei = $request->imei;
        $entry->issue = $request->issue;
        $entry->other_issue = $request->other_issue;
        $entry->payment = $request->payment;
        $entry->total = $request->total;
        $entry->expense = $request->expense;
        $entry->profit = $request->total-$request->expense;

        if($entry->save()){
        	return response()->json(['success'=>"1",'response'=>"Entry added successfully."]);
        }	
        else
        {
        	return response()->json(['success'=>"0",'error'=>"There is something wrong please try again later."]);
        }
	}

    public function updateentry(Request $request){

        $entry = Repairing::find($request->entryid);
        $entry->name = $request->name;
        $entry->phone_no = $request->phone_no;
        $entry->company = $request->company;
        $entry->model = $request->model;
        $entry->imei = $request->imei;
        $entry->issue = $request->issue;
        $entry->other_issue = $request->other_issue;
        $entry->payment = $request->payment;
        $entry->total = $request->total;
        $entry->expense = $request->expense;
        $entry->profit = $request->total-$request->expense;

        if($entry->update()){
            return response()->json(['success'=>"1",'response'=>"Entry updated successfully."]);
        }
        else
        {
            return response()->json(['success'=>"0",'error'=>"There is something wrong please try again later."]);
        }
    }

    public function deleteentry($repairing_id){
        $entry = Repairing::find($repairing_id);
        if($entry->delete()){
            return response()->json(["success"=>"1","response"=>"Entry deleted successfully."]);
        }
        else
        {
            return response()->json(["success"=>"0","error"=>"There is something wrong please try again later."]);
        }
    }

    public function selectentry($repairing_id){
        $entry = Repairing::find($repairing_id);
        if($entry){
            return response()->json(["success"=>"1","response"=>$entry]);
        }
        else
        {
            return response()->json(["success"=>"0","error"=>"There is something wrong please try again later."]);
        }
    }
}
