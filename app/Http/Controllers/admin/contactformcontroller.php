<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail,Validator;
use App\User;

class contactformcontroller extends Controller
{
	public function contactform(Request $request){
        $data["firstname"] = $request->firstname;
        $data["lastname"] = $request->lastname;
        $data["email"] = $request->email;
        $data["phone"] = $request->phone;
        $data["msg"] = $request->message;

        try{
            Mail::send('mail', $data, function($message) use ($data) {
                $message->to("info@watsdoc.com")->subject('Contact Us');
                $message->from('mailer@watsdoc.com','Watsdoc - Inquiry');
            });
        }
        catch(\Exception $e){
            return response()->json(['success'=>"0",'error'=>$e]);
        }   

        return response()->json(['success'=>"1",'response'=>"Thank you! Your request has been sent to Watsdoc team successfully. We will contact you shortly."]);
    }

    public function checkotp(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'otp' => 'required|digits:4',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $user = User::where("email",$request->email)->first();
        
        if(!$user) {
            return response()->json(['success'=>"0",'error'=>"This email address is not registered with us."]);
        }
        else {
            if($request->otp == $user->passotp){
                User::where("email",$request->email)->update(['passotp'=>null]);
                return response()->json(['success'=>"1","userid"=>$user->id,'response'=>"Code is valid."]);
            }
            else{
                return response()->json(['success'=>"0","userid"=>$user->id,'error'=>"The OTP you've entered is incorrect. Please try again."]);
            }
        }

    }

    public function forgetpassword(Request $request){
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6',
            'confirm-password' => 'required|same:password',
            'userid' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $user = User::find($request->userid);
        if(!$user) {
            return response()->json(['success'=>"0",'error'=>"User does'nt exist. Please try again later."]);
        }
        else {
            $newpassword = Hash::make($request->password);
            $update = User::where("id",$request->userid)->update(['password'=> $newpassword]);
            if($update){
                return response()->json(['success'=>"1","response"=>"Password updated successfully."]);
            }
            else{
                return response()->json(["success"=>"0","error"=>"There is something wrong please try again later."]);
            }
        }
    }
}