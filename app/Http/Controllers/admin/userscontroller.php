<?php

namespace App\Http\Controllers\admin;
use Auth;
use Validator,Redirect,Response;
use App\Models\User;
use DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class userscontroller extends Controller
{
	public function index(){
		return view("users");
	}

	public function getallusers(Request $request){
		if ($request->ajax())
        {
            $data = User::orderby('id','asc')->select('*')->get();
            return Datatables::of($data)->make(true);
        }
	}

    public function profile(Request $request)
    {
        $userdata = Auth::user()->all();
        return view('profile',compact('userdata'));
    }

    public function profilename(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            // 'username' => ['unique:users'],
                'username' => 'unique:users,username,' . Auth::user()->id
        ]);

        if ($validator->fails())
        {
             return response()->json(['success'=>"0",'error'=>$validator->errors()->messages()]);
        }

        $user = User::find($request->id);

        $user->username = $request->username;
        // $user->update();

        if($user->update()){
            return response()->json(['success'=>"1",'response'=>"Username updated successfully."]);
        }   
        else
        {
            return response()->json(['success'=>"0",'error'=>"There is something wrong please try again later."]);
        }
    }

    public function changeimage(Request $request)
    {
        $user = User::find($request->id);

        if(!empty($request->profileimage))
        {
            ($user->profileimage != "")?@unlink(public_path('/assets/images/profileimage/'.$user->profileimage)):"";
            $path = public_path().'/assets/images/profileimage';
            $image = $request->profileimage;
            $filename = strtolower(time().$image->getClientOriginalName());
            $image->move($path, $filename);
            $user->profileimage = $filename;
        }

        if($user->update()){
            return response()->json(['success'=>"1",'response'=>"User profile updated successfully."]);
        }   
        else
        {
            return response()->json(['success'=>"0",'error'=>"There is something wrong please try again later."]);
        }
    }

    public function removeprofile(){
        $user = User::find(Auth::user()->id);
        ($user->profileimage != "")?@unlink(public_path('/assets/images/profileimage/'.$user->profileimage)):"";
        $user->profileimage = "";
        if($user->update()){
            return response()->json(['success'=>"1",'response'=>"User profile updated successfully."]);
        }   
        else
        {
            return response()->json(['success'=>"0",'error'=>"There is something wrong please try again later."]);
        }
    }

    public function changepwd(Request $request)
    {
        // dd($request->all());
        $authpwd = Auth::user()->password;

        if(Hash::check($request->oldpwd, $authpwd)) 
        {
            $user = User::find($request->id);

            $user->password = Hash::make($request->newpwd);

            if($user->update()){
                return response()->json(['success'=>"1",'response'=>"User password updated successfully."]);
            }   
            else
            {
                return response()->json(['success'=>"0",'error'=>"There is something wrong please try again later."]);
            }
        }
        else
        {
            return response()->json(['success'=>"0",'error'=>"Old password is wrong please try again."]);
        }

    }

	public function adduser(Request $request){
		$validator =  Validator::make($request->all(), [
			'email' => ['unique:users'],
			'username' => ['unique:users'],
		]);

		if ($validator->fails())
        {
             return response()->json(['success'=>"0",'error'=>$validator->errors()->messages()]);
        }

        $usertable = new User();
        $usertable->username = strtolower($request->username);
        $usertable->email = strtolower($request->email);
        $usertable->role = $request->role;
        $usertable->active = $request->status;
        
        // $usertable->is_admin = ($request->role == "Admin")?"1":"0";
        $usertable->is_admin = ($request->role == "Admin") ? "1" : ( ($request->role == "Subadmin") ? "2" : "0" );
        // ($request->role == "Admin") ? "1" : (($request->role == "Subadmin") ? "2" : "0")

        $usertable->password = Hash::make($request->password);

        if(!empty($request->profileimage))
        {
           	$path = public_path().'/assets/images/profileimage';
            $image = $request->profileimage;
            $filename = strtolower(time().$image->getClientOriginalName());
            $image->move($path, $filename);
            $usertable->profileimage = $filename;
        }

        if($usertable->save()){
        	return response()->json(['success'=>"1",'response'=>"User added successfully."]);
        }	
        else
        {
        	return response()->json(['success'=>"0",'error'=>"There is something wrong please try again later."]);
        }
	}

    public function updateuser(Request $request){
        $validator =  Validator::make($request->all(), [
            'email' => 'unique:users,email,'.$request->userid,
            'username' => 'unique:users,username,'.$request->userid,
        ]);

        if ($validator->fails())
        {
             return response()->json(['success'=>"0",'error'=>$validator->errors()->messages()]);
        }

        $table = User::find($request->userid);
        $table->username = strtolower($request->username);
        $table->email = strtolower($request->email);
        $table->role = $request->role;
        $table->active = $request->status;

        // $table->is_admin = ($request->role == "Admin")?"1":"0";
        $table->is_admin = ($request->role == "Admin") ? "1" : ( ($request->role == "Subadmin") ? "2" : "0" );
        if($request->password != "")
        {
            $table->password = Hash::make($request->password);
        }

        if(!empty($request->profileimage))
        {
            ($table->profileimage != "")?@unlink(public_path('/assets/images/profileimage/'.$table->profileimage)):"";
            $path = public_path().'/assets/images/profileimage/';
            $image = $request->profileimage;
            $filename = strtolower(time().$image->getClientOriginalName());
            $image->move($path, $filename);
            $table->profileimage = $filename;
        }
        else{
            ($table->profileimage != "")?@unlink(public_path('/assets/images/profileimage/'.$table->profileimage)):"";
            $table->profileimage = "";
        }

        if($table->update()){
            return response()->json(['success'=>"1",'response'=>"User updated successfully."]);
        }
        else
        {
            return response()->json(['success'=>"0",'error'=>"There is something wrong please try again later."]);
        }
    }

    public function deleteuser($userid){
        $userrecord = User::find($userid);
        if($userrecord->profileimage != ""){ @unlink(public_path('/assets/images/profileimage/'.$userrecord->profileimage)); }
        if($userrecord->delete()){
            return response()->json(["success"=>"1","response"=>"User deleted successfully."]);
        }
        else
        {
            return response()->json(["success"=>"0","error"=>"There is something wrong please try again later."]);
        }
    }

    public function selectuser($userid){
        $userrecord = User::find($userid);
        // dd($userrecord);
        if($userrecord){
            return response()->json(["success"=>"1","response"=>$userrecord]);
        }
        else
        {
            return response()->json(["success"=>"0","error"=>"There is something wrong please try again later."]);
        }
    }
}
