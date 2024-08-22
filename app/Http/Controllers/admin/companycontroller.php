<?php



namespace App\Http\Controllers\admin;

use Auth;

use Validator,Redirect,Response;

use App\User;

use App\Company;

use DataTables;

use DB;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;



class companycontroller extends Controller

{

	public function index(){

		return view("company");

	}



    public function getallcompanies(Request $request){



        if($request->ajax())

        {

            $company = Company::all();

            return DataTables::of($company)->make(true);

        }

    }



    public function selectcompany($companyid){

        $bdata = Company::where("id",$companyid)->first();



        if($bdata == null){

            return json_encode(['success'=>"0","error"=>"There is something wrong please try again later."]);

        }

        else{

            return json_encode(['success'=>"1","response"=>$bdata]);

        }

    }



    public function addcompany(Request $request){

        if($request->ajax())

        {

            $company = new Company();

            $company->companyname = $request->companyname;



            if($company->save()){

                return response()->json(['success'=>"1",'response'=>"Company added successfully."]);

            }   

            else

            {

                return response()->json(['success'=>"0",'error'=>"There is something wrong please try again later."]);

            }

        }

    }



    public function updatecompany(Request $request){

        $company = Company::where("companyname",$request->updatecompanyname)->first();

        if($company == null) {

            $company = Company::find($request->companyid);

            $company->companyname = strtolower($request->updatecompanyname);

            if($company->update()){

                return response()->json(['success'=>"1",'response'=>"Company updated successfully."]);

            }

            else

            {

                return response()->json(['success'=>"0",'error'=>"There is something wrong please try again later."]);

            }

        }

        else{

            return response()->json(['success'=>"0",'error'=>"Company name is already available please use a different name."]);

        }



    }

    public function deletecompany($companyid){
        $company = Company::find($companyid);
        if($company->delete()){
            return response()->json(["success"=>"1","response"=>"Company deleted successfully."]);
        }
        else
        {
            return response()->json(["success"=>"0","error"=>"There is something wrong please try again later."]);
        }
    }

}