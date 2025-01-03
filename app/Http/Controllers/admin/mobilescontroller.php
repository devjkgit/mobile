<?php

namespace App\Http\Controllers\admin;
use Auth;
use Validator,Redirect,Response;
use App\Models\User;
use App\Models\Mobiles;
use App\Models\Company;
use App\Models\Issues;
use DataTables;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class mobilescontroller extends Controller
{
	public function index(){
        $company = Company::all();
        return view("mobiles",compact('company'));
	}

	public function getall(Request $request){
		if ($request->ajax())
        {
            $data = Mobiles::orderby('id','desc');
            if($request->start_date && $request->end_date){
                $data->whereBetween(DB::raw('DATE(created_at)'), [$request->start_date, $request->end_date]);
            }
            $data->get();
            return Datatables::of($data)->make(true);
        }
	}

	public function addentry(Request $request){
        $entry = new Mobiles();
        $entry->name = $request->name;
        $entry->phone_no = $request->phone_no;
        $entry->company = $request->company;
        $entry->model = $request->model;
        $entry->battery_health = $request->battery_health;
        $entry->imei = $request->imei;
        $entry->id_proof = $request->id_proof;
        $entry->purchase_price = $request->purchase_price;
        $entry->sell_price = $request->sell_price;
        $entry->profit = $request->purchase_price-$request->sell_price;

        if($entry->save()){
        	return response()->json(['success'=>"1",'response'=>"Entry added successfully."]);
        }	
        else
        {
        	return response()->json(['success'=>"0",'error'=>"There is something wrong please try again later."]);
        }
	}

    public function updateentry(Request $request){

        $entry = Mobiles::find($request->entryid);
        $entry->name = $request->name;
        $entry->phone_no = $request->phone_no;
        $entry->company = $request->company;
        $entry->model = $request->model;
        $entry->battery_health = $request->battery_health;
        $entry->imei = $request->imei;
        $entry->id_proof = $request->id_proof;
        $entry->purchase_price = $request->purchase_price;
        $entry->sell_price = $request->sell_price;
        $entry->profit = $request->purchase_price-$request->sell_price;

        if($entry->update()){
            return response()->json(['success'=>"1",'response'=>"Entry updated successfully."]);
        }
        else
        {
            return response()->json(['success'=>"0",'error'=>"There is something wrong please try again later."]);
        }
    }

    public function deleteentry($mobile_id){
        $entry = Mobiles::find($mobile_id);
        if($entry->delete()){
            return response()->json(["success"=>"1","response"=>"Entry deleted successfully."]);
        }
        else
        {
            return response()->json(["success"=>"0","error"=>"There is something wrong please try again later."]);
        }
    }

    public function selectentry($mobile_id){
        $entry = Mobiles::find($mobile_id);
        if($entry){
            return response()->json(["success"=>"1","response"=>$entry]);
        }
        else
        {
            return response()->json(["success"=>"0","error"=>"There is something wrong please try again later."]);
        }
    }
}
