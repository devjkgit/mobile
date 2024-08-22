<?php



namespace App\Http\Controllers\admin;

use Auth;

use Validator,Redirect,Response;

use App\User;

use App\Issues;

use DataTables;

use DB;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;



class issuescontroller extends Controller

{

	public function index(){

		return view("issue");

	}



    public function getallissues(Request $request){



        if($request->ajax())

        {

            $issue = Issues::all();

            return DataTables::of($issue)->make(true);

        }

    }



    public function selectissue($issueid){

        $idata = Issues::where("id",$issueid)->first();



        if($idata == null){

            return json_encode(['success'=>"0","error"=>"There is something wrong please try again later."]);

        }

        else{

            return json_encode(['success'=>"1","response"=>$idata]);

        }

    }



    public function addissue(Request $request){

        if($request->ajax())

        {

            $issue = new Issues();

            $issue->issuename = $request->issuename;



            if($issue->save()){

                return response()->json(['success'=>"1",'response'=>"Issue added successfully."]);

            }   

            else

            {

                return response()->json(['success'=>"0",'error'=>"There is something wrong please try again later."]);

            }

        }

    }



    public function updateissue(Request $request){

        $issue = Issues::where("issuename",$request->updateissuename)->first();

        if($issue == null) {

            $issue = Issues::find($request->issueid);

            $issue->issuename = $request->updateissuename;

            if($issue->update()){

                return response()->json(['success'=>"1",'response'=>"Issue updated successfully."]);

            }

            else

            {

                return response()->json(['success'=>"0",'error'=>"There is something wrong please try again later."]);

            }

        }

        else{

            return response()->json(['success'=>"0",'error'=>"Issue name is already available please use a different name."]);

        }



    }

    public function deleteissue($issueid){
        $issue = Issues::find($issueid);
        if($issue->delete()){
            return response()->json(["success"=>"1","response"=>"Issue deleted successfully."]);
        }
        else
        {
            return response()->json(["success"=>"0","error"=>"There is something wrong please try again later."]);
        }
    }

}