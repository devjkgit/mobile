<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;

class logincontroller extends Controller
{
	public function login(Request $request){
		$input = $request->all();
		$fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
		if(auth()->attempt(array($fieldType => $input['username'], 'password' => $input['password']))){
            return response()->json(['success'=>"1","usertype"=>Auth::user()->is_admin,"response"=>"Logged in."]);
        }
        else{
            return response()->json(['success'=>"1","error"=>"Please use correct credentials."]);
        }
	}

	public function logout(){
		Auth::logout();
		return redirect('/');
	}
}

?>