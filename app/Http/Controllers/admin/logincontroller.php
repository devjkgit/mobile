<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class logincontroller extends Controller
{
	public function login(Request $request){
		$input = $request->all();
		$fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
		$user = User::where($fieldType,$input['username'])->where('active',"0")->first();
		if($user){
            return response()->json(['success'=>"1","error"=>"Account is deactivated please contact admin."]);
		}
		else{
			if(auth()->attempt(array($fieldType => $input['username'], 'password' => $input['password'],'active'=>'1'))){
				return response()->json(['success'=>"1","usertype"=>Auth::user()->is_admin,"response"=>"Logged in."]);
			}
			else{
				return response()->json(['success'=>"1","error"=>"Wrong username/password."]);
			}
		}
	}

	public function logout(){
		Auth::logout();
		return redirect('/');
	}
}

?>