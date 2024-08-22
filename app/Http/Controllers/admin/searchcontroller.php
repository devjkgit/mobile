<?php

namespace App\Http\Controllers\admin;
use Auth;
use Validator,Redirect,Response;
use GuzzleHttp\Client;
use GuzzleHttp;
use App\User;
use App\Products;
use App\Settings;
use App\Company;
use DataTables;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class searchcontroller extends Controller
{

    public function searchresults($productcodekeywords=null){
        // $pdatacounts = Products::where('code', 'LIKE', "%{$productcodekeywords}%")->count(); 
        // $pdata = Products::where('code', 'LIKE', "%{$productcodekeywords}%")->paginate(10);
        $pdatacounts = Products::whereRaw("REPLACE(`code`, ' ' ,'') LIKE ?", ['%'.str_replace(' ', '', $productcodekeywords).'%'])->count(); 
        $pdata = Products::whereRaw("REPLACE(`code`, ' ' ,'') LIKE ?", ['%'.str_replace(' ', '', $productcodekeywords).'%'])->paginate(10);

        $setting = Settings::where('name',"reduce_percentage")->get();

        return view("searchresults",compact('pdata','productcodekeywords','pdatacounts','setting'));
    }

    public function searchresultsnew($productcodekeywords=null){
        $pdatacounts = Products::where('code', 'LIKE', "%{$productcodekeywords}%")->count(); 
        $pdata = Products::where('code', 'LIKE', "%{$productcodekeywords}%")->paginate(10);
        return view("searchresults-new",compact('pdata','productcodekeywords','pdatacounts'));
    }

    public function deleteproduct($productid){
        $productrecord = Products::find($productid);
        if($productrecord->image != ""){ @unlink(public_path('/assets/images/productimage/'.$productrecord->image)); }

        if($productrecord->delete()){
            return response()->json(["success"=>"1","response"=>"Product deleted successfully."]);
        }
        else
        {
            return response()->json(["success"=>"0","error"=>"There is something wrong please try again later."]);
        }
    }

    public function getallproducts(){    
        $pdata = Products::all();
        return Datatables::of($pdata)->make(true);
    }

    public function clientsview($id)
    {
        $viewdata = Clients::where('ClientID',$id)->first();
        return view('/clientsview',['viewdata' => $viewdata]);
    }

    public function addproduct(Request $request){
        $product = new Products();
        $product->producttype = $request->producttype;
        $product->code = $request->code;
        $product->company = $request->company;
        $product->PT = $request->PT;
        $product->PD = $request->PD;
        $product->RH = $request->RH;
        $product->weight = $request->weight;
        
        if(!empty($request->pimage))
        {
            $path = public_path().'/assets/images/productimage';
            $image = $request->pimage;
            $filename = strtolower(time().$image->getClientOriginalName());
            $image->move($path, $filename);
            $product->image = $filename;
        }
        
        // 28.34952
        // $ptweightoz = ($request->PT/1000)/31.104;
        // $pdweightoz = ($request->PD/1000)/31.104;
        // $rhweightoz = ($request->RH/1000)/31.104;
        // $metalsprices = $this->metalsprices(); 
        // $ptprice = $metalsprices["XPT"]*$ptweightoz;
        // $pdprice = $metalsprices["XPD"]*$pdweightoz;
        // $rhprice = $metalsprices["XRH"]*$rhweightoz;
        // $totalprice = $ptprice + $pdprice + $rhprice;
        // $product->price = $totalprice;
        if($product->save()){
            return response()->json(['success'=>"1",'response'=>"Product added successfully."]);
        }   
        else {
            return response()->json(['success'=>"0",'error'=>"There is something wrong please try again later."]);
        }
    }

    public function updateproduct(Request $request){
        $product = Products::find($request->productid);
        $product->producttype = $request->updateproducttype;
        $product->code = $request->updatecode;
        $product->company = $request->updatecompany;
        $product->PT = $request->updatePT;
        $product->PD = $request->updatePD;
        $product->RH = $request->updateRH;
        $product->weight = $request->updateweight;
        if(!empty($request->updatepimage))
        {
            ($product->image != "")?@unlink(public_path('/assets/images/productimage/'.$product->image)):"";
            $path = public_path().'/assets/images/productimage/';
            $image = $request->updatepimage;
            $filename = strtolower(time().$image->getClientOriginalName());
            $image->move($path, $filename);
            $product->image = $filename;
        }
        
        if(!empty($request->removeimage)){
            unlink(public_path('/assets/images/productimage/'.$request->removeimage));
            $product->image = "";            
        }
        
        // $ptweightoz = ($request->updatePT/1000)/31.104;
        // $pdweightoz = ($request->updatePD/1000)/31.104;
        // $rhweightoz = ($request->updateRH/1000)/31.104;
        // $metalsprices = $this->metalsprices(); 
        // $ptprice = $metalsprices["XPT"]*$ptweightoz;
        // $pdprice = $metalsprices["XPD"]*$pdweightoz;
        // $rhprice = $metalsprices["XRH"]*$rhweightoz;
        // $totalprice = $ptprice + $pdprice + $rhprice;
        // $product->price = $totalprice;
        if($product->update()){
            return response()->json(['success'=>"1",'response'=>"Product updated successfully."]);
        }   
        else {
            return response()->json(['success'=>"0",'error'=>"There is something wrong please try again later."]);
        }
    }

    public function selectproduct($productid){
        $pdata = Products::where("id",$productid)->first();
        if($pdata == null){
            return json_encode(['success'=>"0","error"=>"There is something wrong please try again later."]);
        }
        else{
            return json_encode(['success'=>"1","response"=>$pdata]);
        }
    }

    public function metalsprices(){
        $client = new Client();
        $result = (string) $client->get("https://metals-api.com/api/latest?access_key=6oj103pwzkzknt4ivbowlrnudzg2p1rez8m06arxdt586hrh651iev1tcyxg&base=USD&symbols=XPT,XPD,XRH")->getBody();
        $res = json_decode($result);
        $data['XPT'] = 1/$res->rates->XPT;
        $data['XPD'] = 1/$res->rates->XPD;
        $data['XRH'] = 1/$res->rates->XRH;
        return $data;
    }
}