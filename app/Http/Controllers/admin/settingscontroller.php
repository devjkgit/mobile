<?php
namespace App\Http\Controllers\admin;
use Auth;
use Validator,Redirect,Response;
use App\User;
use App\Settings;
use DataTables;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class settingscontroller extends Controller
{
    public function index(){
        $settingsdata = Settings::where("name","reduce_percentage")->first();
        return view("settings",compact('settingsdata'));
    }

    public function updatesetting(Request $request){

        $setting = Settings::find($request->settingid);
        $setting->value = $request->settingvalue;
        $setting->actual_value = $request->settingactualvalue;
        $setting->pt_price = $request->settingpt;
        $setting->pd_price = $request->settingpd;
        $setting->rh_price = $request->settingrh;
        if($setting->update()){
            return response()->json(['success'=>"1",'response'=>"Setting updated successfully."]);
        }
        else
        {
            return response()->json(['success'=>"0",'error'=>"There is something wrong please try again later."]);
        }
    }
}