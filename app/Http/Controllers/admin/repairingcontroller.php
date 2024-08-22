<?php

namespace App\Http\Controllers\admin;
use Auth;
use Validator,Redirect,Response;
use App\User;
use App\Repairing;
use App\Company;
use App\Issues;
use DataTables;
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
            $data = Repairing::orderby('id','desc')->select('*')->get();
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

	public function addentry(Request $request){
        $entry = new Repairing();
        $entry->name = $request->name;
        $entry->phone_no = $request->phone_no;
        $entry->company = $request->company;
        $entry->model = $request->model;
        $entry->imei = $request->imei;
        $entry->issue = $request->issue;
        $entry->other_issue = $request->other_issue;
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
