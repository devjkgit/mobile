<!DOCTYPE html>
<html lang="en">
@include('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.css" />
<style type="text/css">
    .slick-prev{
        z-index: 1
    }
</style>
<body>
    @include('header_new')
    <div class="single_product_search bg-white">
        <div class="container">
            <div class="row">
                <div class="search_box_enner_mn">
                    <input type="text" name="productcode" id="productcode" placeholder="Search by Products"> 
                        <button type="button"  id="searchbutton">Search</button>
                </div>
            </div>
        </div>
    </div>
    <?php 
        $pimages = explode('^^', $productdata[0]->image);
    ?>
    <div class="single_products_mn bg-white">
        <div class="container">
            <div class="row">
                <div class="single_products_enner">
                    <div class="product_img">                        
                        <h4>
                            <?php if(strlen($productdata[0]->code) > '20'){
                                echo substr($productdata[0]->code,0,20)."<br>".substr($productdata[0]->code,20);
                                }else{
                                echo $productdata[0]->code ;
                                }
                            ?>
                        </h4>
                        <div class="slider_main_img">
                            <div class="slider">
                                @if($productdata[0]->image != null || $productdata[0]->image != "")
                                    @foreach($pimages as $img)
                                        <div class="sliner_imgs">
                                            <img src="public/assets/images/productimage/{{ $img }}" alt="">
                                        </div>
                                    @endforeach
                                @else
                                    <img src="public/assets/images/site-logo1.png" alt="">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="product_details">
                        <h4>
                            <?php if(strlen($productdata[0]->code) > '20'){
                                echo substr($productdata[0]->code,0,20)."<br>".substr($productdata[0]->code,20);
                                }else{
                                echo $productdata[0]->code ;
                                }
                            ?>
                        </h4>
                        <div class="more_details">
                            <ul>
                                <li>
                                    <span class="heading">Code :</span>
                                    <span class="details">
                                        <?php if(strlen($productdata[0]->code) > '20'){
                                            echo substr($productdata[0]->code,0,20)."<br>".substr($productdata[0]->code,20);
                                            }else{
                                            echo $productdata[0]->code ;
                                            }
                                        ?>
                                    </span>
                                </li>
                                <li>
                                    <span class="heading">company :</span>
                                    <span class="details">{{ $productdata[0]->company }}</span>
                                </li>
                                <li>
                                    <span class="heading">Type :</span>
                                    <span class="details">{{ $productdata[0]->producttype }}</span>
                                </li>
                                @if($productdata[0]->subproduct != "1")
                                    @if(Auth::user()->is_admin != 0)
                                        <li>
                                            <span class="heading">Actual Price :</span>
                                            <span class="details">${{ $productdata[0]->price }}</span>
                                        </li>
                                    @endif
                                    <li>
                                        <span class="heading">Price :</span>
                                        <span class="details">${{ $productdata[0]->reducedprice }}</span>
                                    </li>
                                
                                    <li>
                                        <span class="heading">Weight (Gram) :</span>
                                        <span class="details">{{ $productdata[0]->weight }}</span>
                                    </li>
                                    @if(Auth::user()->is_admin != 0)
                                        <li>
                                            <span class="heading">PT :</span>
                                            <span class="details">{{ $productdata[0]->PT }}</span>
                                        </li>
                                        <li>
                                            <span class="heading">PD :</span>
                                            <span class="details">{{ $productdata[0]->PD }}</span>
                                        </li>
                                        <li>
                                            <span class="heading">RH :</span>
                                            <span class="details">{{ $productdata[0]->RH }}</span>
                                        </li>
                                    @endif
                                 @else
                                    <?php 
                                        $reduce_percentage_actual = $setting[0]->actual_value;
                                        $reduce_percentage = $setting[0]->value;
                                        $metalpricePT = $setting[0]->pt_price;
                                        $metalpricePD = $setting[0]->pd_price;
                                        $metalpriceRH = $setting[0]->rh_price;
                                    ?>
                                    @if(Auth::user()->is_admin != 0)
                                        <li>
                                            <span class="heading">Actual Price :</span>
                                            <span class="details">${{ $productdata[0]->price }}</span>
                                        </li>
                                    @endif
                                    <li>
                                        <span class="heading">Price :</span>
                                        <span class="details">${{ $productdata[0]->reducedprice }}</span>
                                    </li>
                                    <li>
                                        <span class="heading">Total Weight (Gram) :</span>
                                        <span class="details">{{ $productdata[0]->totalweight }}</span>
                                    </li>
                                    @if(Auth::user()->is_admin != 0)
                                        <li>
                                            <span class="heading">Total PT :</span>
                                            <span class="details">{{ number_format((float)$productdata[0]->totalpt, 2, '.', '') }}</span>
                                        </li>
                                        <li>
                                            <span class="heading">Total PD :</span>
                                            <span class="details">{{ number_format((float)$productdata[0]->totalpd, 2, '.', '') }}</span>
                                        </li>
                                        <li>
                                            <span class="heading">Total RH :</span>
                                            <span class="details">{{ number_format((float)$productdata[0]->totalrh, 2, '.', '') }}</span>
                                        </li>
                                    @endif
                                    <div id="accordion" class="product_accordion">
                                        <div class="card">
                                            <div class="card-header text-left">
                                                <a class="card-link w-100 d-inline-block" data-toggle="collapse" href="#collapseOne">Product - 1</a>
                                            </div>
                                            <div id="collapseOne" class="collapse" data-parent="#accordion">
                                                <div class="card-body text-left">
                                                    <ul>
                                                        <?php 
                                                            $weight = $productdata[0]->weight;

                                                            $ptweightoz = (( $productdata[0]->PT*$weight )/1000000);
                                                            $pdweightoz = (( $productdata[0]->PD*$weight )/1000000);
                                                            $rhweightoz = (( $productdata[0]->RH*$weight )/1000000);

                                                            $ptprice = ( $metalpricePT*$ptweightoz )/31.104;
                                                            $pdprice = ( $metalpricePD*$pdweightoz )/31.104;
                                                            $rhprice = ( $metalpriceRH*$rhweightoz )/31.104;

                                                            $totalprice = $ptprice + $pdprice + $rhprice;
                                                            $originalActualPrice = round($totalprice,2);
                                                            $ActualPrice = round($originalActualPrice-($originalActualPrice*$reduce_percentage_actual/100),2);
                                                            $Price = round($originalActualPrice-($originalActualPrice*$reduce_percentage/100),2);
                                                        ?>
                                                        <li>
                                                            <span class="heading">Weight (Gram) :</span>
                                                            <span class="details">{{ $productdata[0]->weight }}</span>
                                                        </li>
                                                        @if(Auth::user()->is_admin != 0)
                                                            <li>
                                                                <span class="heading">PT :</span>
                                                                <span class="details">{{ $productdata[0]->PT }}</span>
                                                            </li>
                                                            <li>
                                                                <span class="heading">PD :</span>
                                                                <span class="details">{{ $productdata[0]->PD }}</span>
                                                            </li>
                                                            <li>
                                                                <span class="heading">RH :</span>
                                                                <span class="details">{{ $productdata[0]->RH }}</span>
                                                            </li>
                                                            <li class="normal_price_mn">
                                                                {{-- <Button class="show_product1_act_price" onclick="Product_actual1(this.id)" id="{{ $productdata[0]->id }}" >Actual Price</Button> --}}
                                                                <div>
                                                                    <span id="Product1_Actual">Actual Price : ${{ $ActualPrice }}</span>
                                                                </div>
                                                            </li>
                                                        @endif
                                                        <li class="dic_price_mn">
                                                            {{-- <Button class="show_product1_price" onclick = "Product_price1(this.id)" id="{{ $productdata[0]->id }}" >Price</Button> --}}
                                                            <div>
                                                                <span id="Product1_Price">Price : ${{ $Price }}</span>
                                                            </div>
                                                        </li>
                                                        
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header text-left">
                                                <a class="card-link w-100 d-inline-block" data-toggle="collapse" href="#collapseTwo">Product - 2</a>
                                            </div>
                                            <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                                <div class="card-body text-left">
                                                    <ul>
                                                        <?php 
                                                            $weight = $productdata[0]->weight1;

                                                            $ptweightoz2 = (( $productdata[0]->PT1*$weight )/1000000);
                                                            $pdweightoz2 = (( $productdata[0]->PD1*$weight )/1000000);
                                                            $rhweightoz2 = (( $productdata[0]->RH1*$weight )/1000000);

                                                            $ptprice2 = ( $metalpricePT*$ptweightoz2 )/31.104;
                                                            $pdprice2 = ( $metalpricePD*$pdweightoz2 )/31.104;
                                                            $rhprice2 = ( $metalpriceRH*$rhweightoz2 )/31.104;

                                                            $totalprice2 = $ptprice2 + $pdprice2 + $rhprice2;
                                                            $originalActualPrice2 = round($totalprice2,2);
                                                            $ActualPrice2 = round($totalprice2-($totalprice2*$reduce_percentage_actual/100),2);
                                                            $Price2 = round($originalActualPrice2-($originalActualPrice2*$reduce_percentage/100),2);
                                                        ?>
                                                        <li>
                                                            <span class="heading">Weight (Gram) :</span>
                                                            <span class="details">{{ $productdata[0]->weight1 }}</span>
                                                        </li>
                                                        @if(Auth::user()->is_admin != 0)
                                                            <li>
                                                                <span class="heading">PT :</span>
                                                                <span class="details">{{ $productdata[0]->PT1 }}</span>
                                                            </li>
                                                            <li>
                                                                <span class="heading">PD :</span>
                                                                <span class="details">{{ $productdata[0]->PD1 }}</span>
                                                            </li>
                                                            <li>
                                                                <span class="heading">RH :</span>
                                                                <span class="details">{{ $productdata[0]->RH1 }}</span>
                                                            </li>
                                                            <li class="normal_price_mn">
                                                                {{-- <Button class="show_product2_act_price" onclick="Product_actual2(this.id)" id="{{ $productdata[0]->id }}" >Actual Price</Button> --}}
                                                                <div>
                                                                    <span id="Product2_Actual">Actual Price : ${{ $ActualPrice2 }}</span>
                                                                </div>
                                                            </li>
                                                        @endif
                                                        <li class="dic_price_mn">
                                                            {{-- <Button class="show_product2_price" onclick="Product_price2(this.id)" id="{{ $productdata[0]->id }}" >Price</Button> --}}
                                                            <div>
                                                                <span id="Product2_Price">Price : ${{ $Price2 }}</span>
                                                            </div>
                                                        </li>
                                                        
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        @if($productdata[0]->weight2 != "" && $productdata[0]->PT2 != "" && $productdata[0]->PD2 != "" && $productdata[0]->RH2 != "")
                                            <div class="card">
                                                <div class="card-header text-left">
                                                    <a class="card-link w-100 d-inline-block" data-toggle="collapse" href="#collapseThree">Product - 3</a>
                                                </div>
                                                <div id="collapseThree" class="collapse" data-parent="#accordion">
                                                    <div class="card-body text-left">
                                                        <ul>
                                                            <?php 
                                                                $weight = $productdata[0]->weight2;

                                                                $ptweightoz3 = (( $productdata[0]->PT2*$weight )/1000000);
                                                                $pdweightoz3 = (( $productdata[0]->PD2*$weight )/1000000);
                                                                $rhweightoz3 = (( $productdata[0]->RH2*$weight )/1000000);

                                                                $ptprice3 = ( $metalpricePT*$ptweightoz3 )/31.104;
                                                                $pdprice3 = ( $metalpricePD*$pdweightoz3 )/31.104;
                                                                $rhprice3 = ( $metalpriceRH*$rhweightoz3 )/31.104;

                                                                $totalprice3 = $ptprice3 + $pdprice3 + $rhprice3;
                                                                $originalActualPrice3 = round($totalprice3,2);
                                                                $ActualPrice3 = round($originalActualPrice3-($originalActualPrice3*$reduce_percentage_actual/100),2);
                                                                $Price3 = round($originalActualPrice3-($originalActualPrice3*$reduce_percentage/100),2);
                                                            ?>
                                                            <li>
                                                                <span class="heading">Weight (Gram) :</span>
                                                                <span class="details">{{ $productdata[0]->weight2 }}</span>
                                                            </li>
                                                            @if(Auth::user()->is_admin != 0)
                                                                <li>
                                                                    <span class="heading">PT :</span>
                                                                    <span class="details">{{ $productdata[0]->PT2 }}</span>
                                                                </li>
                                                                <li>
                                                                    <span class="heading">PD :</span>
                                                                    <span class="details">{{ $productdata[0]->PD2 }}</span>
                                                                </li>
                                                                <li>
                                                                    <span class="heading">RH :</span>
                                                                    <span class="details">{{ $productdata[0]->RH2 }}</span>
                                                                </li>
                                                                <li class="normal_price_mn">
                                                                    {{-- <Button class="show_product3_act_price" onclick="Product_actual3(this.id)" id="{{ $productdata[0]->id }}" >Actual Price</Button> --}}
                                                                    <div>
                                                                        <span id="Product3_Actual">Actual Price : ${{ $ActualPrice3 }}</span>
                                                                    </div>
                                                                </li>
                                                            @endif
                                                            <li class="dic_price_mn">
                                                                {{-- <Button class="show_product3_price" onclick="Product_price3(this.id)" id="{{ $productdata[0]->id }}" >Price</Button> --}}
                                                                <div>
                                                                    <span id="Product3_Price">Price : ${{ $Price3 }}</span>
                                                                </div>
                                                                <!-- <h5 class="product2_price"></h5> -->
                                                            </li>
                                                            
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if($productdata[0]->weight3 != "" && $productdata[0]->PT3 != "" && $productdata[0]->PD3 != "" && $productdata[0]->RH3 != "")
                                            <div class="card">
                                                <div class="card-header text-left">
                                                    <a class="card-link w-100 d-inline-block" data-toggle="collapse" href="#collapseFour">Product - 4</a>
                                                </div>
                                                <div id="collapseFour" class="collapse" data-parent="#accordion">
                                                    <div class="card-body text-left">
                                                        <ul>
                                                            <?php 
                                                                $weight = $productdata[0]->weight3;

                                                                $ptweightoz4 = (( $productdata[0]->PT3*$weight )/1000000);
                                                                $pdweightoz4 = (( $productdata[0]->PD3*$weight )/1000000);
                                                                $rhweightoz4 = (( $productdata[0]->RH3*$weight )/1000000);

                                                                $ptprice4 = ( $metalpricePT*$ptweightoz4 )/31.104;
                                                                $pdprice4 = ( $metalpricePD*$pdweightoz4 )/31.104;
                                                                $rhprice4 = ( $metalpriceRH*$rhweightoz4 )/31.104;

                                                                $totalprice4 = $ptprice4 + $pdprice4 + $rhprice4;
                                                                $originalActualPrice4 = round($totalprice4,2);
                                                                $ActualPrice4 = round($originalActualPrice4-($originalActualPrice4*$reduce_percentage_actual/100),2);
                                                                $Price4 = round($originalActualPrice4-($originalActualPrice4*$reduce_percentage/100),2);
                                                            ?>
                                                            <li>
                                                                <span class="heading">Weight (Gram) :</span>
                                                                <span class="details">{{ $productdata[0]->weight3 }}</span>
                                                            </li>
                                                            @if(Auth::user()->is_admin != 0)
                                                                <li>
                                                                    <span class="heading">PT :</span>
                                                                    <span class="details">{{ $productdata[0]->PT3 }}</span>
                                                                </li>
                                                                <li>
                                                                    <span class="heading">PD :</span>
                                                                    <span class="details">{{ $productdata[0]->PD3 }}</span>
                                                                </li>
                                                                <li>
                                                                    <span class="heading">RH :</span>
                                                                    <span class="details">{{ $productdata[0]->RH3 }}</span>
                                                                </li>
                                                                <li class="normal_price_mn">
                                                                    {{-- <Button class="show_product4_act_price" onclick="Product_actual4(this.id)" id="{{ $productdata[0]->id }}" >Actual Price</Button> --}}
                                                                    <div>
                                                                        <span id="Product4_Actual">Actual Price : ${{ $ActualPrice4 }}</span>
                                                                    </div>
                                                                </li>
                                                            @endif
                                                            <li class="dic_price_mn">
                                                                {{-- <Button class="show_product4_price" onclick="Product_price4(this.id)" id="{{ $productdata[0]->id }}" >Price</Button> --}}
                                                                <div>
                                                                    <span id="Product4_Price">Price : ${{ $Price4 }}</span>
                                                                </div>
                                                            </li>
                                                            
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </ul>
                            <div class="Loader deleteproductloader"></div>
                            @if(Auth::user()->is_admin != 0)
                            <button type="button" id="editproduct" title="Edit Product" class="mr-2" data-id="{{ $productdata[0]->id }}">Edit</button>
                            <button type="button" id="deleteproduct" title="Delete Product" class="ml-2" data-id="{{ $productdata[0]->id }}">Delete</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="container">
            <div class="row w-100">
                <p>© 2021 Watsdoc S.A.R.L – All Rights Reserved</p>
                <p>Office : Berytech, 2nd Floor, Mathaf, Beirut, Lebanon, Office Phone: +961 1 612 500 ext: 5300 | <a href="#" data-toggle="modal" data-target="#contact_us">Contact us</a></p>
            </div>
        </div>
    </footer>

    <div class="modal fade contact_popup_box" id="contact_us">
        <div class="Loader"></div>
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Contact us</h2>
                    <button type="button" class="close popup_close_btn" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12 col-md-12">
                        <div class="alert alert-success" id="resonse" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        <h3 class="text-success"><i class="fa fa-check-circle"></i> Success</h3>
                            <p id="resonsemsg"></p>
                        </div>

                        <div class="alert alert-danger" id="error" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        <h3 class="text-danger"><i class="fa fa-exclamation-circle"></i> Information</h3>
                            <p id="errormsg"></p>
                        </div>
                    </div>
                    <form id="contactform" autocomplete="off" method="post" class="form-horizontal contactform">
                        @csrf
                        <div class="form_input_mn first_name_input_mn">
                            <input type="text" name="firstname" placeholder="First Name" class="first_name_input">
                        </div>
                        <div class="form_input_mn last_name_input_mn">
                            <input type="text" name="lastname"  placeholder="Last Name" class="last_name_input">
                        </div>
                        <div class="form_input_mn">
                            <input type="email" name="email"  placeholder="Email">
                        </div>
                        <div class="form_input_mn">
                            <input type="text" name="phone"  placeholder="Phone Number">
                        </div>
                        <div class="form_input_mn">
                            <textarea rows="4" cols="50"  name="message" placeholder="Message"></textarea>
                        </div>
                        <div class="form_input_mn">
                            <div class="form-group g-recaptcha" data-sitekey="6Lfy5dUaAAAAAPgegE_fu9nqly2WF1mgiP1wzPFt"></div>
                        </div>
                        <div class="form_input_mn">
                            <input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn submit_btn_mn">Submit</button>
                    <button type="button" class="btn cancel_btn_mn" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="updateproductmodal" class="modal fade pr-0" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-modal="true">
        <div class="modal-dialog modal-dialog-slideout" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Update Product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" autocomplete="off" id="updateproductform" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="pimage_list" class="pimage_list">
                        <div class="form-group" >
                            @csrf
                            <label>Product Type</label>
                            <select class="form-control selectpicker" id="updateproducttype" name="updateproducttype">
                                <option value="" hidden disabled selected>Select</option>
                                <option value="Metal">Metal</option>
                                <option value="Ceramic">Ceramic</option>
                            </select>
                        </div>
                        <div class="form-group form_group_custom" >
                            <label>Code</label>
                            <input type="hidden" name="productid" class="productid"  id="productid" value="">
                            <input type="text" name="updatecode" id="updatecode" class="form-control" onkeyup="availability_atupdate()">
                            <div id="avaliability_update"></div>
                        </div>
                        <div class="form-group" >
                            <label>company</label>
                            <select class="form-control selectpicker" id="updatecompany" name="updatecompany">
                                <option value="" hidden disabled selected>Select</option>
                                @foreach($company as $key)
                                    <option value="{{ $key->companyname}}">{{ $key->companyname}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="products_two_show_check">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" value="1" name="updatesubproductcheck" class="custom-control-input" id="updatesubproductcheck">
                                <label class="custom-control-label task-done" for="updatesubproductcheck">
                                    <span>Sub Product</span>
                                </label>
                            </div>
                        </div>
                        <div class="product_mn">
                            <div class="product_one_mn">
                                <div class="form-group" >
                                    <label>PT</label>
                                    <input type="number" name="updatePT" id="updatePT" class="form-control">
                                </div>
                                <div class="form-group" >
                                    <label>PD</label>
                                    <input type="number" name="updatePD" id="updatePD" class="form-control">
                                </div>
                                <div class="form-group" >
                                    <label>RH</label>
                                    <input type="number" name="updateRH" id="updateRH" class="form-control">
                                </div>
                                <div class="form-group" >
                                    <label>Weight (grams)</label>
                                    <input type="number" name="updateweight" id="updateweight" class="form-control">
                                </div>
                            </div>
                            <div class="product_one_mn updatesubproductdiv" style="display: none;">
                                <div class="form-group" >
                                    <label>PT</label>
                                    <input type="number" name="updatePT1" id="updatePT1" class="form-control">
                                </div>
                                <div class="form-group" >
                                    <label>PD</label>
                                    <input type="number" name="updatePD1" id="updatePD1" class="form-control">
                                </div>
                                <div class="form-group" >
                                    <label>RH</label>
                                    <input type="number" name="updateRH1" id="updateRH1" class="form-control">
                                </div>
                                <div class="form-group" >
                                    <label>Weight (grams)</label>
                                    <input type="number" name="updateweight1" id="updateweight1" class="form-control">
                                </div>
                            </div>
                            <div class="product_one_mn updatesubproductdiv" style="display: none;">
                                <div class="form-group" >
                                    <label>PT</label>
                                    <input type="number" name="updatePT2" id="updatePT2" class="form-control">
                                </div>
                                <div class="form-group" >
                                    <label>PD</label>
                                    <input type="number" name="updatePD2" id="updatePD2" class="form-control">
                                </div>
                                <div class="form-group" >
                                    <label>RH</label>
                                    <input type="number" name="updateRH2" id="updateRH2" class="form-control">
                                </div>
                                <div class="form-group" >
                                    <label>Weight (grams)</label>
                                    <input type="number" name="updateweight2" id="updateweight2" class="form-control">
                                </div>
                            </div>
                            <div class="product_one_mn updatesubproductdiv" style="display: none;">
                                <div class="form-group" >
                                    <label>PT</label>
                                    <input type="number" name="updatePT3" id="updatePT3" class="form-control">
                                </div>
                                <div class="form-group" >
                                    <label>PD</label>
                                    <input type="number" name="updatePD3" id="updatePD3" class="form-control">
                                </div>
                                <div class="form-group" >
                                    <label>RH</label>
                                    <input type="number" name="updateRH3" id="updateRH3" class="form-control">
                                </div>
                                <div class="form-group" >
                                    <label>Weight (grams)</label>
                                    <input type="number" name="updateweight3" id="updateweight3" class="form-control">
                                </div>
                            </div>
                        </div>
                        @if(count($pimages) > 1)
                            @if($productdata[0]->image != null || $productdata[0]->image != "")
                                <div class="images-list">
                                    <div class="row">
                                        @foreach($pimages as $img)
                                            <div class="col-2">
                                                <img src="/assets/images/productimage/{{ $img }}" height="100px" width="100px" alt="" class="pimage-name" ><br>
                                                <a href="#" class="removepimage" onclick="RemovePimage(this.id)" id="{{ $img }}">remove</a>
                                            </div>
                                        @endforeach
                                    </div> 
                                </div>
                            @endif
                        @endif
                        <div class="form-group upload_img_mn">
                            <label>Image</label>
                            <input type="hidden" name="removeimage" class="removeimage"  id="removeimage" value="">
                            <input type="file" class="pimage" name="updatepimage[]" id="updatepimage" multiple />
                        </div>                        
                        <div class="Loader updateproductloader"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="updatebtn"><i class="fa fa-check"></i> Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @include('script')
    <script src="/assets/node_modules/jqueryui/jquery-ui.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>

    <!-- <script type="text/javascript">
        $(document).ready(function($) {

            jQuery('body').on('DOMSubtreeModified', '.images-list', function(){
                var anser_array = [];
                jQuery('.pimage-name').each(function(){
                    anser_array.push(jQuery(this).text());
                });
                var arrString = anser_array.join(",");
                jQuery('.pimage_list').val(arrString);
            });

        });
    </script> -->

    <script>

        $(document).on("click",".removepimage",function(){
            $(this).closest('div').remove();
        });

        $('.pimage').dropify({
            messages: {
                'default': 'Drag and drop a profile image here or click',
                'replace': 'Drag and drop or click to replace',
                'remove':  'Remove',
                'error':   'Ooops, something wrong happended.'
            }
        });

        $(".mobile_menu").click(function(){
            $(".login_btn ul").addClass("active");
        });

        $("li.mobile_menu_close").click(function(){
            $(".login_btn ul").removeClass("active");
        });

        $(document).on("click","#editproduct",function(){
            $("#updateproductmodal").modal("show");
        });


        $('#updatesubproductcheck').click(function() {
            if (!$(this).is(':checked')) {
                $(".updatesubproductdiv").hide();
                $("#updateproductmodal").removeClass("updatesubproductmaindiv");
            }
            else{
                $(".updatesubproductdiv").show();
                $("#updateproductmodal").addClass("updatesubproductmaindiv");
            }
        });

        $( function() {
            $("#productcode").autocomplete({
                minLength: 1,
                source:"/product/productcodes",
                select: function( event, ui ) {
                    $("#productcode").val(ui.item.code);
                    // window.location.href = "https://watsdoc.com/searchresults/"+prodcode;
                }
            })
            .autocomplete( "instance" )._renderItem = function( ul, item ) {
                return $( "<li>" )
                .append( "<a class='autosuggestions'  href='https://watsdoc.com/product/"+item.code+"' >"+item.code+"</a>" )
                .appendTo( ul );
            };
        });


        $(document).on("click","#searchbutton",function(){
            var prodcode = $("#productcode").val();
            window.location.href = "https://watsdoc.com/searchresults/"+prodcode;
        });

        $(document).on("click","#editproduct",function(){
            var userid = $(this).attr("data-id");
            $(".updateproductloader").show();
            $.ajax({
                url:"/products/selectproduct/"+userid,
                type:"get",
                dataType:"json",
                success:function(data){
                    if(data.success == "0")
                    {
                        $(".updateproductloader").hide();
                        $.notify({
                            message: data.error 
                        },{
                            type: 'danger',
                            placement: {
                                from: "bottom",
                                align: "left"
                            },
                            z_index: 9999999,
                            mouse_over: "pause",
                        });
                    }
                    else
                    {
                        $("#updateproducttype").val(data.response.producttype);
                        $("#updateproducttype").selectpicker("refresh");
                        $("#updatecode").val(data.response.code);
                        $("#updatecompany").val(data.response.company);
                        $("#updatecompany").selectpicker("refresh");
                        $("#updatePT").val(data.response.PT);
                        $("#updatePD").val(data.response.PD);
                        $("#updateRH").val(data.response.RH);
                        $("#updateweight").val(data.response.weight);
                        $("#productid").val(data.response.id);
                        $('.dropify-render img').remove();
                        if(data.response.subproduct == '1' ){
                            $("#updatesubproductcheck").trigger("click");
                            //sub-product 2
                            $("#updatePT1").val(data.response.PT1);
                            $("#updatePD1").val(data.response.PD1);
                            $("#updateRH1").val(data.response.RH1);
                            $("#updateweight1").val(data.response.weight1);
                            //sub-product 3
                            $("#updatePT2").val(data.response.PT2);
                            $("#updatePD2").val(data.response.PD2);
                            $("#updateRH2").val(data.response.RH2);
                            $("#updateweight2").val(data.response.weight2); 
                            //sub-product 4
                            $("#updatePT3").val(data.response.PT3);
                            $("#updatePD3").val(data.response.PD3);
                            $("#updateRH3").val(data.response.RH3);
                            $("#updateweight3").val(data.response.weight3); 
                        }
                        if(data.response.image)
                        {
                            var row = data.response.image;
                            var pimage = row.split('^^');
                            $('#updateproductform .dropify-render img').first().remove();
                            $('#updateproductform .dropify-preview,#updateproductform .dropify-clear').css('display','block');
                            $(".dropify-clear").attr("data-image",data.response.image);
                            $('<img src="/assets/images/productimage/'+pimage[0]+'">').appendTo("#updateproductform .dropify-render");
                            $('#updateproductform .dropify-filename-inner').text(data.response.image);
                        }

                        $("#updateproductmodal").modal("show");
                        $(".updateproductloader").hide();
                    }
                }
            });
        });

        $("#updateproductform").validate({
            rules: {
                "updateproducttype": {required: true},
                "updatecode": {required: true},
                "updatecompany": {required: true},
                "updatePT": {required: true},
                "updatePD": {required: true},
                "updateRH": {required: true},
                "updateweight": {required: true},
            },
            messages: {
                "updateproducttype": {required: "Please select the product type."},
                "updatecode": {required: "Please enter the code."},
                "updatecompany": {required: "Please select the company."},
                "updatePT": {required: "Please enter the value for PT."},
                "updatePD": {required: "Please enter the value for PD."},
                "updateRH": {required: "Please enter the value for RH."},
                "updateweight": {required: "Please enter the weight."},
            },
            submitHandler: function(){
                $(".updateproductloader").show();
                var form = $('#updateproductform')[0];
                var data = new FormData(form);
                $.ajax({
                    dataType:"json",
                    contentType: false,
                    processData: false,
                    type:"post",
                    data:data,
                    url:"/products/updateproduct",
                    success: function(data)
                    {
                        if(data.success == "0"){
                            $.each(data.error, function(key, value){
                                $.notify({
                                    message: value 
                                },{
                                    type: 'danger',
                                    placement: {
                                        from: "bottom",
                                        align: "left"
                                    },
                                    z_index: 9999999,
                                    mouse_over: "pause",
                                });
                            });
                            $(".updateuserloader").hide();
                        }
                        else if(data.success == "1")
                        {
                            $(".updateproductloader").hide();
                            $("#updateproductmodal").modal("hide");
                            // $('#updateproductform').each(function(){ this.reset(); });
                            $.notify({
                                message: data.response 
                            },
                            {
                                type: 'success',
                                placement: {
                                    from: "bottom",
                                    align: "left"
                                },
                                z_index: 9999999,
                                mouse_over: "pause",
                            });
                            var newcode = $('#updatecode').val();  
                            window.location.href = "https://watsdoc.com/product/"+newcode;
                        }
                    }
                });
            }
        });

        $(document).on("click","#deleteproduct",function(){
            var userid = $(this).attr("data-id");
            var result = confirm("Are you sure?");
            if(result)
            {
                $(".deleteproductloader").show();
                $.ajax({
                    url:"/products/deleteproduct/"+userid,
                    type:"get",
                    dataType:"json",
                    success:function(data){
                        if(data.success == "0"){
                            $.notify({
                                message: data.error 
                            },{
                                type: 'danger',
                                placement: {
                                    from: "bottom",
                                    align: "left"
                                },
                                z_index: 9999999,
                                mouse_over: "pause",
                            });
                            $(".deleteproductloader").hide();
                        }
                        else if(data.success == "1")
                        {
                            $(".deleteproductloader").hide();
                            $.notify({
                                message: data.response 
                            },
                            {
                                type: 'success',
                                placement: {
                                    from: "bottom",
                                    align: "left"
                                },
                                z_index: 9999999,
                                mouse_over: "pause",
                            });
                            window.location.href = "https://watsdoc.com/search"; 
                        }
                    }
                });
            }
        });

        $("#contactform").validate({
                ignore: ".ignore",
                rules: {
                    firstname: {required: true},
                    lastname: {required: true,},
                    email: {required: true,email:true},
                    phone: {required: true,number:true},
                    message: {required: true},
                    hiddenRecaptcha: {
                        required: function () {
                            if (grecaptcha.getResponse() == '') {
                                return true;
                            } 
                            else
                            {
                                return false;
                            }
                        }
                    }
                },
                messages: {
                    firstname: {required: "Please enter your firstname"},
                    email: {required: "Please enter your email"},
                    phone: {required: "Please enter your phone number"},
                    lastname: {required: "Please enter your lastname"},
                    message: {required: "Please enter your message."},
                    hiddenRecaptcha: {required: "Please verify yourself."},
                },
                submitHandler: function() 
                {
                    $(".Loader").show();
                    var data = $("#contactform").serialize();
                    jQuery.ajax({
                        dataType:"json",
                        type:"post",
                        data:data,
                        url:"/contactform",
                        success: function(data)
                        {
                            if(data.response)
                            {   
                                $(".Loader").hide();
                                $("#resonse").show();
                                $('#resonsemsg').html('<span>'+data.response+'</span>');
                                $('#contactform').each(function(){ this.reset(); });
                                setTimeout(function () { $("#contact_us").modal("hide");location.reload(); }, 3000)
                            }
                            else if(data.error)
                            {
                                $("#error").show();
                                $('#errormsg').html('<span>'+data.error+'</span>');
                                $(".Loader").hide();
                            }
                        }
                    });
                }
            });

        $(document).on("click",".dropify-clear",function(){ 
            var data = $(this).attr("data-image");
            $("#removeimage").val(data);
        })
  </script>

  <script type="text/javascript">

        var base_url = window.location.origin;

        function Product_actual1(id)
        {
            //alert(id);
            $.ajax({
                url: base_url+'/Product_actual1', 
                type: "POST",             
                data: {
                    "_token": "{{ csrf_token() }}",
                    id:id
                },      
                success:function(data)
                {
                    if(data.success==1)
                    {
                        $('.show_product1_act_price').hide();
                        $('#Product1_Actual').html('Actual Price : $ '+data.response);
                    }
                    else
                    {
                    }
                }       
            });
        }

        function Product_price1(id)
        {
            //alert(id);
            $.ajax({
                url: base_url+'/Product_price1', 
                type: "POST",             
                data: {
                    "_token": "{{ csrf_token() }}",
                    id:id
                },      
                success:function(data)
                {
                    if(data.success==1)
                    {
                        $('.show_product1_price').hide();
                        $('#Product1_Price').html('Price : $ '+data.response);
                    }
                    else
                    {
                    }
                }       
            });
        }

        function Product_actual2(id)
        {
            //alert(id);
            $.ajax({
                url: base_url+'/Product_actual2', 
                type: "POST",             
                data: {
                    "_token": "{{ csrf_token() }}",
                    id:id
                },      
                success:function(data)
                {
                    if(data.success==1)
                    {
                        $('.show_product2_act_price').hide();
                        $('#Product2_Actual').html('Actual Price : $ '+data.response);
                    }
                    else
                    {
                    }
                }       
            });
        }

        function Product_price2(id)
        {
            //alert(id);
            $.ajax({
                url: base_url+'/Product_price2', 
                type: "POST",             
                data: {
                    "_token": "{{ csrf_token() }}",
                    id:id
                },      
                success:function(data)
                {
                    if(data.success==1)
                    {
                        $('.show_product2_price').hide();
                        $('#Product2_Price').html('Price : $ '+data.response);
                    }
                    else
                    {
                    }
                }       
            });
        }

        function Product_actual3(id)
        {
            //alert(id);
            $.ajax({
                url: base_url+'/Product_actual3', 
                type: "POST",             
                data: {
                    "_token": "{{ csrf_token() }}",
                    id:id
                },      
                success:function(data)
                {
                    if(data.success==1)
                    {
                        $('.show_product3_act_price').hide();
                        $('#Product3_Actual').html('Actual Price : $ '+data.response);
                    }
                    else
                    {
                    }
                }       
            });
        }

        function Product_price3(id)
        {
            //alert(id);
            $.ajax({
                url: base_url+'/Product_price3', 
                type: "POST",             
                data: {
                    "_token": "{{ csrf_token() }}",
                    id:id
                },      
                success:function(data)
                {
                    if(data.success==1)
                    {
                        $('.show_product3_price').hide();
                        $('#Product3_Price').html('Price : $ '+data.response);
                    }
                    else
                    {
                    }
                }       
            });
        }

        function Product_actual4(id)
        {
            //alert(id);
            $.ajax({
                url: base_url+'/Product_actual4', 
                type: "POST",             
                data: {
                    "_token": "{{ csrf_token() }}",
                    id:id
                },      
                success:function(data)
                {
                    if(data.success==1)
                    {
                        $('.show_product4_act_price').hide();
                        $('#Product4_Actual').html('Actual Price : $ '+data.response);
                    }
                    else
                    {
                    }
                }       
            });
        }

        function Product_price4(id)
        {
            //alert(id);
            $.ajax({
                url: base_url+'/Product_price4', 
                type: "POST",             
                data: {
                    "_token": "{{ csrf_token() }}",
                    id:id
                },      
                success:function(data)
                {
                    if(data.success==1)
                    {
                        $('.show_product4_price').hide();
                        $('#Product4_Price').html('Price : $ '+data.response);
                    }
                    else
                    {
                    }
                }       
            });
        }
  </script>

  <script type="text/javascript">
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    
    function availability_atupdate()
    {
        var code = $('#updatecode').val();
        //console.log(code);
        $.ajax({
            url: "{{ url('/check_availability') }}", 
            type: "POST",             
            data: {
               "_token": "{{ csrf_token() }}",
              code:code
            },      
            success:function(data)
            {
                if(data==1){
                    $('#avaliability_update').html('<span class="error" style="color:red;">Code already exist</span>');
                    $('#updatebtn').attr('disabled',true);
                }else{
                    $('#avaliability_update').html('<span></span>');
                    $('#updatebtn').attr('disabled',false);
                }
            }
        });
    }
</script>

<script type="text/javascript">
    function RemovePimage(image)
    {
        var productid = $('#productid').val();
        var pimage = image;
        var result = confirm("Are you sure?");
        if(result){
            $.ajax({
                url: "{{ url('/RemovePimage') }}", 
                type: "POST",             
                data: {
                   "_token" : "{{ csrf_token() }}",
                  productid : productid,
                  pimage : pimage
                },      
                success:function(data)
                {
                    if(data.success == 1){
                        console.log('product image removed');
                    }else{
                        console.log('product image not removed');
                    }
                }
            });
        }
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.min.js"></script>
<script type="text/javascript">
    $('.slider').slick();
    $('.slider').slickLightbox({
        src: 'src',
        itemSelector: '.sliner_imgs img'
    });
</script>
</body>
</html>