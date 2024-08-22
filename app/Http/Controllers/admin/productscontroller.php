<?php

namespace App\Http\Controllers\admin;
use Auth;
use Validator,Redirect,Response;
use GuzzleHttp\Client;
use GuzzleHttp;
use App\User;
use App\Products;
use App\Company;
use App\Settings;
use DataTables;
use DB;
use Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class productscontroller extends Controller
{
    public function index(){
        $company = Company::all();
        return view("products",compact('company'));
    }

    public function productcodesforautocomplete(Request $request){
        //$pdata = Products::where('code', 'LIKE', "%{$request->term}%")->get(); 
        $pdata = Products::whereRaw("REPLACE(`code`, ' ' ,'') LIKE ?", ['%'.str_replace(' ', '', $request->term).'%'])->get(); 
        return json_encode($pdata);
    }

    public function deleteproduct($productid){
        $productrecord = Products::find($productid);
        $pimage = explode('^^', $productrecord->image);

        if($productrecord->image != ""){
            foreach($pimage as $img){  
                @unlink(public_path('/assets/images/productimage/'.$img)); 
            }
        }

        if($productrecord->delete()){
            return response()->json(["success"=>"1","response"=>"Product deleted successfully."]);
        }
        else
        {
            return response()->json(["success"=>"0","error"=>"There is something wrong please try again later."]);
        }
    }

    public function singleproddetails($productcode){
        
        $productdata = Products::where('code',$productcode)->get();
        $setting = Settings::where('name',"reduce_percentage")->get();
        $reduce_percentage = $setting[0]->value;
        $reduce_percentage_actual = $setting[0]->actual_value;

        $metalpricePT = $setting[0]->pt_price;
        $metalpricePD = $setting[0]->pd_price;
        $metalpriceRH = $setting[0]->rh_price;
        $company = Company::all();
        if($productdata->count() == 0){
             return abort(404);
        }
        else{
        	if($productdata[0]->subproduct == 0){
        		$weight = $productdata[0]->weight;
        		$ptweightoz = (( $productdata[0]->PT*$weight )/1000000);
            	$pdweightoz = (( $productdata[0]->PD*$weight )/1000000);
            	$rhweightoz = (( $productdata[0]->RH*$weight )/1000000);

            	$ptprice = ( $metalpricePT*$ptweightoz )/31.104;
            	$pdprice = ( $metalpricePD*$pdweightoz )/31.104;
            	$rhprice = ( $metalpriceRH*$rhweightoz )/31.104;

            	$totalprice = $ptprice + $pdprice + $rhprice;
            	$actualprice = round($totalprice,2);

                $productdata[0]->price = round($actualprice-($actualprice*$reduce_percentage_actual/100),2);
                $productdata[0]->reducedprice = round($actualprice-($actualprice*$reduce_percentage/100),2);	
        	}else{
        		$productdata[0]->totalweight = $productdata[0]->weight + $productdata[0]->weight1 + $productdata[0]->weight2 + $productdata[0]->weight3;
                $productdata[0]->totalpt = (($productdata[0]->PT * $productdata[0]->weight) + ($productdata[0]->PT1 * $productdata[0]->weight1) + ($productdata[0]->PT2 * $productdata[0]->weight2) + ($productdata[0]->PT3 * $productdata[0]->weight3))/$productdata[0]->totalweight;
                $productdata[0]->totalpd = (($productdata[0]->PD * $productdata[0]->weight) + ($productdata[0]->PD1 * $productdata[0]->weight1) + ($productdata[0]->PD2 * $productdata[0]->weight2) + ($productdata[0]->PD3 * $productdata[0]->weight3))/$productdata[0]->totalweight;
                $productdata[0]->totalrh = (($productdata[0]->RH * $productdata[0]->weight) + ($productdata[0]->RH1 * $productdata[0]->weight1) + ($productdata[0]->RH2 * $productdata[0]->weight2) + ($productdata[0]->RH3 * $productdata[0]->weight3))/$productdata[0]->totalweight;

        		$ptweightoz = (( $productdata[0]->totalpt*$productdata[0]->totalweight )/1000000);
            	$pdweightoz = (( $productdata[0]->totalpd*$productdata[0]->totalweight )/1000000);
            	$rhweightoz = (( $productdata[0]->totalrh*$productdata[0]->totalweight )/1000000);

            	$ptprice = ( $metalpricePT*$ptweightoz )/31.104;
            	$pdprice = ( $metalpricePD*$pdweightoz )/31.104;
            	$rhprice = ( $metalpriceRH*$rhweightoz )/31.104;

            	$totalprice = $ptprice + $pdprice + $rhprice;
                $actualprice = round($totalprice,2);

            	$productdata[0]->price = round($actualprice-($actualprice*$reduce_percentage_actual/100),2);
            	$productdata[0]->reducedprice = round($actualprice-($actualprice*$reduce_percentage/100),2);		
        	}
            return view("singleproduct",compact('productdata','company','setting'));
        }
    }

    public function singleproddetailsnew($productcode){
        $metalsprices = $this->metalsprices();
        dd($metalsprices);
        die();
        $productdata = Products::where('code',$productcode)->get();
        $setting = Settings::where('name',"reduce_percentage")->get();
        $reduce_percentage = $setting[0]->value;
        $company = Company::all();
        if($productdata->count() == 0){
             return abort(404);
        }
        else{
            $ptweightoz = ($productdata[0]->PT/1000)/31.104;
            $pdweightoz = ($productdata[0]->PD/1000)/31.104;
            $rhweightoz = ($productdata[0]->RH/1000)/31.104;
            $metalsprices = $this->metalsprices(); 
            $ptprice = $metalsprices["XPT"]*$ptweightoz;
            $pdprice = $metalsprices["XPD"]*$pdweightoz;
            $rhprice = $metalsprices["XRH"]*$rhweightoz;
            $totalprice = $ptprice + $pdprice + $rhprice;
            $productdata[0]->price = round($totalprice,2);
            $productdata[0]->reducedprice = round($totalprice-($totalprice*$reduce_percentage/100),2);
            return view("singleproduct-new",compact('productdata','company'));
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

    	//dd($request->all());
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
                //------------ simple upload image code -------------//
                // $path = public_path().'/assets/images/productimage';
                // $image = $request->pimage;
                // $filename = strtolower(time().$image->getClientOriginalName());
                // $image->move($path, $filename);

                //------------- -watermark code ----------------//
                // $files = $request->pimage;
                // $image = Image::make($request->pimage);
                // $image->insert(public_path('/assets/images/productimage/watermark.png'), 'bottom-right', 10, 10);
                // $filename = strtolower(time().$files->getClientOriginalName());
                // $path = public_path().'/assets/images/productimage/'.$filename;
                // $image->save($path);
                // $product->image = $filename;

            if($files = $request->file('pimage'))
            {
                foreach($files as $file)
                {
                    $image = Image::make($file);
                    $image->insert(public_path('/assets/images/productimage/watermark.png'), 'bottom-right', 10, 10);
                    $filename = strtolower(time().$file->getClientOriginalName());
                    $path = public_path().'/assets/images/productimage/'.$filename;
                    $image->save($path);
                    $pimages[] = $filename;  
                }
            }
            $product->image = implode("^^",$pimages);
        }
        
        if($request->subproductcheck == "1"){
            $product->subproduct = $request->subproductcheck;

            //sub-product 1
            $product->PT1 = $request->PT1;
            $product->PD1 = $request->PD1;
            $product->RH1 = $request->RH1;
            $product->weight1 = $request->weight1;

            //sub-product 2
            $product->PT2 = $request->PT2;
            $product->PD2 = $request->PD2;
            $product->RH2 = $request->RH2;
            $product->weight2 = $request->weight2;

            //sub-product 3
            $product->PT3 = $request->PT3;
            $product->PD3 = $request->PD3;
            $product->RH3 = $request->RH3;
            $product->weight3 = $request->weight3;
            
            // if(!empty($request->pimage1))
            // {
            //     $path = public_path().'/assets/images/productimage';
            //     $image = $request->pimage;
            //     $filename = strtolower(time().$image->getClientOriginalName());
            //     $image->move($path, $filename);
            //     $product->image1 = $filename;
            // }
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

        //dd($request->pimage_list);
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
            //------------ image remove code --------------//
            //($product->image != "")?@unlink(public_path('/assets/images/productimage/'.$product->image)):"";

            //------------ simple upload image code -------------//
            // $path = public_path().'/assets/images/productimage/';
            // $image = $request->updatepimage;
            // $filename = strtolower(time().$image->getClientOriginalName());
            // $image->move($path, $filename);

            //------------ watermark code -------------//
            // $files = $request->updatepimage;
            // $image = Image::make($request->updatepimage);
            // $image->insert(public_path('/assets/images/productimage/watermark.png'), 'bottom-right', 10, 10);
            // $filename = strtolower(time().$files->getClientOriginalName());
            // $path = public_path().'/assets/images/productimage/'.$filename;
            // $image->save($path);
            // $product->image = $filename;

            if($files = $request->file('updatepimage'))
            {
                foreach($files as $file)
                {
                    $image = Image::make($file);
                    $image->insert(public_path('/assets/images/productimage/watermark.png'), 'bottom-right', 10, 10);
                    $filename = strtolower(time().$file->getClientOriginalName());
                    $path = public_path().'/assets/images/productimage/'.$filename;
                    $image->save($path);
                    $pimages[] = $filename;  
                }
            }
            if($product->image != "" || $product->image != null){
                $pimage = explode('^^', $product->image);
                if(count($pimage) >= 1 ){
                    $product->image = implode("^^",array_merge($pimage,$pimages));      
                }
                else{
                    $product->image =  implode("^^",$pimages);
                }
            }
            else{
                $product->image =  implode("^^",$pimages);
            }  
        }

        if($request->updatesubproductcheck == "1"){
            $product->subproduct = $request->updatesubproductcheck;
            //edit sub-product 1
            $product->PT1 = $request->updatePT1;
            $product->PD1 = $request->updatePD1;
            $product->RH1 = $request->updateRH1;
            $product->weight1 = $request->updateweight1;

            //edit sub-product 2
            $product->PT2 = $request->updatePT2;
            $product->PD2 = $request->updatePD2;
            $product->RH2 = $request->updateRH2;
            $product->weight2 = $request->updateweight2;

            //edit sub-product 3
            $product->PT3 = $request->updatePT3;
            $product->PD3 = $request->updatePD3;
            $product->RH3 = $request->updateRH3;
            $product->weight3 = $request->updateweight3;

            // if(!empty($request->updatepimage1))
            // {
            //     ($product->image != "")?@unlink(public_path('/assets/images/productimage/'.$product->image1)):"";
            //     $path = public_path().'/assets/images/productimage/';
            //     $image = $request->updatepimage1;
            //     $filename = strtolower(time().$image->getClientOriginalName());
            //     $image->move($path, $filename);
            //     $product->image1 = $filename;
            // }

            if( $request->updatePT1 == "" && $request->updatePD1 == "" && $request->updateRH1 == "" && $request->updateweight1 == ""&&$request->updatePT2 == "" && $request->updatePD2 == "" && $request->updateRH2 == "" && $request->updateweight2 == ""&& $request->updatePT3 == "" && $request->updatePD3 == "" && $request->updateRH3 == "" && $request->updateweight3 == "" )
            {
                $product->subproduct = "0";
            }
        }
        
        if(!empty($request->removeimage)){
            $pimage = explode('^^', $request->removeimage);
            foreach($pimage as $img){
                @unlink(public_path('/assets/images/productimage/'.$img));   
            }
            $product->image = null;
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
        $result = (string) $client->get("https://metals-api.com/api/latest?access_key=ney4ch91m5xsw3br8c15tv67v32bajxe2k7pfln3dk0y55b9vuk1ta59pn72&base=USD&symbols=XPT,XPD,XRH")->getBody();
        $res = json_decode($result);
        if($res->success){
            $data['XPT'] = 1/$res->rates->XPT;
            $data['XPD'] = 1/$res->rates->XPD;
            $data['XRH'] = 1/$res->rates->XRH;
            return $data;
        }
        return array(
            'XPT' => 0,
            'XPD' => 0,
            'XRH' => 0,
        );
    }

    public function Product_actual1(Request $request)
    {
        $id = $request->id;
        $productdata = Products::where('id',$id)->first();
        $setting = Settings::where('name',"reduce_percentage")->get();
        $reduce_percentage = $setting[0]->value;
        $metalpricePT = $setting[0]->pt_price;
        $metalpricePD = $setting[0]->pd_price;
        $metalpriceRH = $setting[0]->rh_price;

        $company = Company::all();
        if($productdata->count() == 0){
             return abort(404);
        }
        else{
        	$weight = $productdata->weight;

            $ptweightoz = (( $productdata->PT*$weight )/1000000);
            $pdweightoz = (( $productdata->PD*$weight )/1000000);
            $rhweightoz = (( $productdata->RH*$weight )/1000000);

            // $metalsprices = $this->metalsprices();
            // $ptprice = ( $metalsprices["XPT"]*$ptweightoz )/31.104;
            // $pdprice = ( $metalsprices["XPD"]*$pdweightoz )/31.104;
            // $rhprice = ( $metalsprices["XRH"]*$rhweightoz )/31.104;
            $ptprice = ( $metalpricePT*$ptweightoz )/31.104;
            $pdprice = ( $metalpricePD*$pdweightoz )/31.104;
            $rhprice = ( $metalpriceRH*$rhweightoz )/31.104;

            $totalprice = $ptprice + $pdprice + $rhprice;
            $ActualPrice = round($totalprice,2);
            return response()->json(['success'=>"1",'response'=>$ActualPrice]);     
            //$productdata->reducedprice = round($totalprice-($totalprice*$reduce_percentage/100),2);
            // if($ActualPrice != "")
            // {   
            //     return response()->json(['success'=>"1",'response'=>$ActualPrice]);
            // }
            // else
            // {
            //     return response()->json(['success'=>"0",'response'=>'0']);
            // }
        }
    }

    public function Product_price1(Request $request)
    {
        $id = $request->id;
        $productdata = Products::where('id',$id)->first();
        $setting = Settings::where('name',"reduce_percentage")->get();
        $reduce_percentage = $setting[0]->value;
        $metalpricePT = $setting[0]->pt_price;
        $metalpricePD = $setting[0]->pd_price;
        $metalpriceRH = $setting[0]->rh_price;

        $company = Company::all();
        if($productdata->count() == 0){
             return abort(404);
        }
        else{
            $weight = $productdata->weight;

            $ptweightoz = (( $productdata->PT*$weight )/1000000);
            $pdweightoz = (( $productdata->PD*$weight )/1000000);
            $rhweightoz = (( $productdata->RH*$weight )/1000000);

            // $metalsprices = $this->metalsprices();
            // $ptprice = ( $metalsprices["XPT"]*$ptweightoz )/31.104;
            // $pdprice = ( $metalsprices["XPD"]*$pdweightoz )/31.104;
            // $rhprice = ( $metalsprices["XRH"]*$rhweightoz )/31.104;
            $ptprice = ( $metalpricePT*$ptweightoz )/31.104;
            $pdprice = ( $metalpricePD*$pdweightoz )/31.104;
            $rhprice = ( $metalpriceRH*$rhweightoz )/31.104;

            $totalprice = $ptprice + $pdprice + $rhprice;
            $ActualPrice = round($totalprice,2);
            $Price = round($totalprice-($totalprice*$reduce_percentage/100),2);
            return response()->json(['success'=>"1",'response'=>$Price]);
        }
    }

    public function Product_actual2(Request $request)
    {
        $id = $request->id;
        $productdata = Products::where('id',$id)->first();
        $setting = Settings::where('name',"reduce_percentage")->get();
        $reduce_percentage = $setting[0]->value;
        $metalpricePT = $setting[0]->pt_price;
        $metalpricePD = $setting[0]->pd_price;
        $metalpriceRH = $setting[0]->rh_price;

        $company = Company::all();
        if($productdata->count() == 0){
             return abort(404);
        }
        else{
        	$weight = $productdata->weight1;

            $ptweightoz = (( $productdata->PT1*$weight )/1000000);
            $pdweightoz = (( $productdata->PD1*$weight )/1000000);
            $rhweightoz = (( $productdata->RH1*$weight )/1000000);

            // $metalsprices = $this->metalsprices();
            // $ptprice = ( $metalsprices["XPT"]*$ptweightoz )/31.104;
            // $pdprice = ( $metalsprices["XPD"]*$pdweightoz )/31.104;
            // $rhprice = ( $metalsprices["XRH"]*$rhweightoz )/31.104;
            $ptprice = ( $metalpricePT*$ptweightoz )/31.104;
            $pdprice = ( $metalpricePD*$pdweightoz )/31.104;
            $rhprice = ( $metalpriceRH*$rhweightoz )/31.104;

            $totalprice = $ptprice + $pdprice + $rhprice;
            $ActualPrice = round($totalprice,2);
            return response()->json(['success'=>"1",'response'=>$ActualPrice]);
        }
    }

    public function Product_price2(Request $request)
    {
        $id = $request->id;
        $productdata = Products::where('id',$id)->first();
        $setting = Settings::where('name',"reduce_percentage")->get();
        $reduce_percentage = $setting[0]->value;
        $metalpricePT = $setting[0]->pt_price;
        $metalpricePD = $setting[0]->pd_price;
        $metalpriceRH = $setting[0]->rh_price;

        $company = Company::all();
        if($productdata->count() == 0){
             return abort(404);
        }
        else{
            $weight = $productdata->weight1;

            $ptweightoz = (( $productdata->PT1*$weight )/1000000);
            $pdweightoz = (( $productdata->PD1*$weight )/1000000);
            $rhweightoz = (( $productdata->RH1*$weight )/1000000);

            // $metalsprices = $this->metalsprices();
            // $ptprice = ( $metalsprices["XPT"]*$ptweightoz )/31.104;
            // $pdprice = ( $metalsprices["XPD"]*$pdweightoz )/31.104;
            // $rhprice = ( $metalsprices["XRH"]*$rhweightoz )/31.104;
            $ptprice = ( $metalpricePT*$ptweightoz )/31.104;
            $pdprice = ( $metalpricePD*$pdweightoz )/31.104;
            $rhprice = ( $metalpriceRH*$rhweightoz )/31.104;

            $totalprice = $ptprice + $pdprice + $rhprice;
            $ActualPrice = round($totalprice,2);
            $Price = round($totalprice-($totalprice*$reduce_percentage/100),2);
            return response()->json(['success'=>"1",'response'=>$Price]);
        }
    }

    public function Product_actual3(Request $request)
    {
        $id = $request->id;
        $productdata = Products::where('id',$id)->first();
        $setting = Settings::where('name',"reduce_percentage")->get();
        $reduce_percentage = $setting[0]->value;
        $metalpricePT = $setting[0]->pt_price;
        $metalpricePD = $setting[0]->pd_price;
        $metalpriceRH = $setting[0]->rh_price;

        $company = Company::all();
        if($productdata->count() == 0){
             return abort(404);
        }
        else{
            $weight = $productdata->weight2;

            $ptweightoz = (( $productdata->PT2*$weight )/1000000);
            $pdweightoz = (( $productdata->PD2*$weight )/1000000);
            $rhweightoz = (( $productdata->RH2*$weight )/1000000);

            // $metalsprices = $this->metalsprices();
            // $ptprice = ( $metalsprices["XPT"]*$ptweightoz )/31.104;
            // $pdprice = ( $metalsprices["XPD"]*$pdweightoz )/31.104;
            // $rhprice = ( $metalsprices["XRH"]*$rhweightoz )/31.104;
            $ptprice = ( $metalpricePT*$ptweightoz )/31.104;
            $pdprice = ( $metalpricePD*$pdweightoz )/31.104;
            $rhprice = ( $metalpriceRH*$rhweightoz )/31.104;

            $totalprice = $ptprice + $pdprice + $rhprice;
            $ActualPrice = round($totalprice,2);
            return response()->json(['success'=>"1",'response'=>$ActualPrice]);
        }
    }

    public function Product_price3(Request $request)
    {
        $id = $request->id;
        $productdata = Products::where('id',$id)->first();
        $setting = Settings::where('name',"reduce_percentage")->get();
        $reduce_percentage = $setting[0]->value;
        $metalpricePT = $setting[0]->pt_price;
        $metalpricePD = $setting[0]->pd_price;
        $metalpriceRH = $setting[0]->rh_price;

        $company = Company::all();
        if($productdata->count() == 0){
             return abort(404);
        }
        else{
            $weight = $productdata->weight2;

            $ptweightoz = (( $productdata->PT2*$weight )/1000000);
            $pdweightoz = (( $productdata->PD2*$weight )/1000000);
            $rhweightoz = (( $productdata->RH2*$weight )/1000000);

            // $metalsprices = $this->metalsprices();
            // $ptprice = ( $metalsprices["XPT"]*$ptweightoz )/31.104;
            // $pdprice = ( $metalsprices["XPD"]*$pdweightoz )/31.104;
            // $rhprice = ( $metalsprices["XRH"]*$rhweightoz )/31.104;
            $ptprice = ( $metalpricePT*$ptweightoz )/31.104;
            $pdprice = ( $metalpricePD*$pdweightoz )/31.104;
            $rhprice = ( $metalpriceRH*$rhweightoz )/31.104;

            $totalprice = $ptprice + $pdprice + $rhprice;
            $ActualPrice = round($totalprice,2);
            $Price = round($totalprice-($totalprice*$reduce_percentage/100),2);
            return response()->json(['success'=>"1",'response'=>$Price]);
        }
    }

    public function Product_actual4(Request $request)
    {
        $id = $request->id;
        $productdata = Products::where('id',$id)->first();
        $setting = Settings::where('name',"reduce_percentage")->get();
        $reduce_percentage = $setting[0]->value;
        $metalpricePT = $setting[0]->pt_price;
        $metalpricePD = $setting[0]->pd_price;
        $metalpriceRH = $setting[0]->rh_price;

        $company = Company::all();
        if($productdata->count() == 0){
             return abort(404);
        }
        else{
            $weight = $productdata->weight3;

            $ptweightoz = (( $productdata->PT3*$weight )/1000000);
            $pdweightoz = (( $productdata->PD3*$weight )/1000000);
            $rhweightoz = (( $productdata->RH3*$weight )/1000000);

            // $metalsprices = $this->metalsprices();
            // $ptprice = ( $metalsprices["XPT"]*$ptweightoz )/31.104;
            // $pdprice = ( $metalsprices["XPD"]*$pdweightoz )/31.104;
            // $rhprice = ( $metalsprices["XRH"]*$rhweightoz )/31.104;
            $ptprice = ( $metalpricePT*$ptweightoz )/31.104;
            $pdprice = ( $metalpricePD*$pdweightoz )/31.104;
            $rhprice = ( $metalpriceRH*$rhweightoz )/31.104;

            $totalprice = $ptprice + $pdprice + $rhprice;
            $ActualPrice = round($totalprice,2);
            return response()->json(['success'=>"1",'response'=>$ActualPrice]);
        }
    }

    public function Product_price4(Request $request)
    {
        $id = $request->id;
        $productdata = Products::where('id',$id)->first();
        $setting = Settings::where('name',"reduce_percentage")->get();
        $reduce_percentage = $setting[0]->value;
        $metalpricePT = $setting[0]->pt_price;
        $metalpricePD = $setting[0]->pd_price;
        $metalpriceRH = $setting[0]->rh_price;
        
        $company = Company::all();
        if($productdata->count() == 0){
             return abort(404);
        }
        else{
            $weight = $productdata->weight3;

            $ptweightoz = (( $productdata->PT3*$weight )/1000000);
            $pdweightoz = (( $productdata->PD3*$weight )/1000000);
            $rhweightoz = (( $productdata->RH3*$weight )/1000000);

            // $metalsprices = $this->metalsprices();
            // $ptprice = ( $metalsprices["XPT"]*$ptweightoz )/31.104;
            // $pdprice = ( $metalsprices["XPD"]*$pdweightoz )/31.104;
            // $rhprice = ( $metalsprices["XRH"]*$rhweightoz )/31.104;
            $ptprice = ( $metalpricePT*$ptweightoz )/31.104;
            $pdprice = ( $metalpricePD*$pdweightoz )/31.104;
            $rhprice = ( $metalpriceRH*$rhweightoz )/31.104;

            $totalprice = $ptprice + $pdprice + $rhprice;
            $ActualPrice = round($totalprice,2);
            $Price = round($totalprice-($totalprice*$reduce_percentage/100),2);
            return response()->json(['success'=>"1",'response'=>$Price]);
        }
    }

    public function check_availability(Request $request)
    {
        $code = $request->code;
        $query=Products::where('code',$code)->get();
        if(count($query)>0){
            echo 1;
        }else{
            echo 0;
        }
    }
    public function RemovePimage(Request $request)
    {
        $productid = $request->productid;
        $pimage = $request->pimage;
        
        $query = Products::where('id',$productid)->first();
        $images = $query->image;
        $image_array = explode('^^', $images);

        if (($key = array_search($pimage, $image_array)) !== false) {
            unset($image_array[$key]);
            @unlink(public_path('/assets/images/productimage/'.$pimage)); 
        }
        $product = Products::find($productid);
        $product->image = implode('^^', $image_array);
        if($product->save())
        {
            return response()->json(['success'=>"1",'message'=>'removed.']);
        }
        else
        {
            return response()->json(['success'=>"0",'message'=>'not removed.']);   
        }
    }
}