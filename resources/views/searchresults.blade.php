<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.css" />
    <style type="text/css">
    	.slick-prev{
    		z-index: 1
    	}
    </style>
    <body class="search_result_mn">
        @include('header_new')
        <div class="search_result_product_mn">
            <div class="single_product_search bg-white">
                <div class="container">
                    <div class="row">
                        <div class="search_box_enner_mn">
                            <input type="text" name="productcode" id="productcode" value="{{ $productcodekeywords }}"> 
                            <button type="button" id="searchbutton" >Search</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="single_products_mn bg-white">
                <div class="container">
                    <div class="row">
                        <div class="search_result_number">
                            <p>Search Result <span><u>{{ $productcodekeywords }}</u></span> <a href="#">( {{ $pdatacounts }} results)</a></p>
                        </div>
                        <?php 
                            $reduce_percentage_actual = $setting[0]->actual_value;
                        	$reduce_percentage = $setting[0]->value;
                        	$metalpricePT = $setting[0]->pt_price;
                        	$metalpricePD = $setting[0]->pd_price;
                        	$metalpriceRH = $setting[0]->rh_price;
                        ?>
                        @foreach ($pdata as $key)
                        <?php 
                        	$pimages = explode('^^', $key->image);
                        ?>
                        <div class="single_products_enner">
                            <div class="product_img">                            	
                                <h4>
                                    <a href="/product/{{ $key->code }}">
                                        <?php if(strlen($key->code) > '30'){
                                            echo substr($key->code,0,30)."<br>".substr($key->code,30);
                                            }else{
                                            echo $key->code ;
                                            }
                                        ?>
                                    </a>
                                </h4>
                                <div class="slider_main_img">
                                	<div class="slider">
                                		@if($key->image != null || $key->image != "")
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
                                    <a href="/product/{{ $key->code }}">
                                        <?php if(strlen($key->code) > '30'){
                                            echo substr($key->code,0,30)."<br>".substr($key->code,30);
                                            }else{
                                            echo $key->code ;
                                            }
                                        ?>
                                    </a>
                                </h4>
                                <div class="more_details">
                                    <ul>
                                        <li>
                                            <span class="heading">Code :</span>
                                            <span class="details">
                                                <?php if(strlen($key->code) > '25'){
                                                    echo substr($key->code,0,25)."<br>".substr($key->code,25);
                                                    }else{
                                                    echo $key->code ;
                                                    }
                                                ?>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="heading">company :</span>
                                            <span class="details">{{ $key->company }}</span>
                                        </li>
                                        <li>
                                            <span class="heading">Type :</span>
                                            <span class="details">{{ $key->producttype }}</span>
                                        </li>
                                        @if($key->subproduct != "1")
                                        	<?php 
                                        		$weight = $key->weight;
								        		$ptweightoz = (( $key->PT*$weight )/1000000);
								            	$pdweightoz = (( $key->PD*$weight )/1000000);
								            	$rhweightoz = (( $key->RH*$weight )/1000000);

								            	$ptprice = ( $metalpricePT*$ptweightoz )/31.104;
								            	$pdprice = ( $metalpricePD*$pdweightoz )/31.104;
								            	$rhprice = ( $metalpriceRH*$rhweightoz )/31.104;

								            	$totalprice = $ptprice + $pdprice + $rhprice;
                                                $originalActualPrice = round($totalprice,2);
                                        	?>
                                            <li>
                                                <span class="heading">Price :</span>
                                                <span class="details">{{ round($originalActualPrice-($originalActualPrice*$reduce_percentage/100),2) }}</span>
                                            </li>
                                            <li>
                                                <span class="heading">Weight (Gram) :</span>
                                                <span class="details">{{ $key->weight }}</span>
                                            </li>
                                            @if(Auth::user()->is_admin != 0)
                                                <li>
                                                    <span class="heading">PT :</span>
                                                    <span class="details">{{$key->PT}}</span>
                                                </li>
                                                <li>
                                                    <span class="heading">PD :</span>
                                                    <span class="details">{{ $key->PD }}</span>
                                                </li>
                                                <li>
                                                    <span class="heading">RH :</span>
                                                    <span class="details">{{ $key->RH }}</span>
                                                </li>
                                            @endif
                                        @else
                                            <?php 
                                                // $total_weight = $key->weight + $key->weight1;
                                                // $total_pt = (($key->PT * $key->weight) + ($key->PT1 * $key->weight1))/$total_weight;
                                                // $total_pd = (($key->PD * $key->weight) + ($key->PD1 * $key->weight1))/$total_weight;
                                                // $total_rh = (($key->RH * $key->weight) + ($key->RH1 * $key->weight1))/$total_weight;

                                                $totalweight = $key->weight + $key->weight1 + $key->weight2 + $key->weight3;
								                $totalpt = (($key->PT * $key->weight) + ($key->PT1 * $key->weight1) + ($key->PT2 * $key->weight2) + ($key->PT3 * $key->weight3))/$totalweight;
								                $totalpd = (($key->PD * $key->weight) + ($key->PD1 * $key->weight1) + ($key->PD2 * $key->weight2) + ($key->PD3 * $key->weight3))/$totalweight;
								                $totalrh = (($key->RH * $key->weight) + ($key->RH1 * $key->weight1) + ($key->RH2 * $key->weight2) + ($key->RH3 * $key->weight3))/$totalweight;

								        		$totalptweightoz = (( $totalpt*$totalweight )/1000000);
								            	$totalpdweightoz = (( $totalpd*$totalweight )/1000000);
								            	$totalrhweightoz = (( $totalrh*$totalweight )/1000000);

								            	$totalptprice = ( $metalpricePT*$totalptweightoz )/31.104;
								            	$totalpdprice = ( $metalpricePD*$totalpdweightoz )/31.104;
								            	$totalrhprice = ( $metalpriceRH*$totalrhweightoz )/31.104;

								            	$totalpricedis = $totalptprice + $totalpdprice + $totalrhprice;
                                                $originalactualprice = round($totalpricedis,2);
                                            ?>
                                            <li>
                                                <span class="heading">Price :</span>
                                                <span class="details">${{ round($originalactualprice-($originalactualprice*$reduce_percentage/100),2) }}</span>
                                            </li>
                                            <li>
                                                <span class="heading">Total Weight (Gram) :</span>
                                                <span class="details">{{ $totalweight }}</span>
                                            </li>
                                            @if(Auth::user()->is_admin != 0)
	                                            <li>
	                                                <span class="heading">Total PT :</span>
	                                                <span class="details">{{ number_format((float)$totalpt, 2, '.', '') }}</span>
	                                            </li>
	                                            <li>
	                                                <span class="heading">Total PD :</span>
	                                                <span class="details">{{ number_format((float)$totalpd, 2, '.', '') }}</span>
	                                            </li>
	                                            <li>
	                                                <span class="heading">Total RH :</span>
	                                                <span class="details">{{ number_format((float)$totalrh, 2, '.', '') }}</span>
	                                            </li>
	                                        @endif   
                                            <div id="accordion" class="product_accordion">
                                                <div class="card">
                                                    <div class="card-header text-left">
                                                        <a class="card-link w-100 d-inline-block" data-toggle="collapse" href="#collapseOne{{ $key->code }}">Product - 1</a>
                                                    </div>
                                                    <div id="collapseOne{{ $key->code }}" class="collapse" data-parent="#accordion">
                                                        <div class="card-body text-left">
                                                            <ul>
                                                            	<?php 
	                                                            	$weight = $key->weight;
	                                                            	$ptweightoz1 = (( $key->PT*$weight )/1000000);
	                                                            	$pdweightoz1 = (( $key->PD*$weight )/1000000);
	                                                            	$rhweightoz1 = (( $key->RH*$weight )/1000000);

	                                                            	$ptprice1 = ( $metalpricePT*$ptweightoz1 )/31.104;
	                                                            	$pdprice1 = ( $metalpricePD*$pdweightoz1 )/31.104;
	                                                            	$rhprice1 = ( $metalpriceRH*$rhweightoz1 )/31.104;

	                                                            	$totalprice1 = $ptprice1 + $pdprice1 + $rhprice1;
                                                                    $originalActualPrice1 = round($totalprice1,2);
	                                                            ?>
                                                                <li>
                                                                    <span class="heading">Weight (Gram) :</span>
                                                                    <span class="details">{{ $key->weight }}</span>
                                                                </li>

                                                                @if(Auth::user()->is_admin != 0)
	                                                                <li>
	                                                                    <span class="heading">PT :</span>
	                                                                    <span class="details">{{$key->PT}}</span>
	                                                                </li>
	                                                                <li>
	                                                                    <span class="heading">PD :</span>
	                                                                    <span class="details">{{ $key->PD }}</span>
	                                                                </li>
	                                                                <li>
	                                                                    <span class="heading">RH :</span>
	                                                                    <span class="details">{{ $key->RH }}</span>
	                                                                </li>
	                                                            @endif

	                                                            <li class="dic_price_mn">
	                                                                <div>
	                                                                    <span id="Product4_Price">Price : ${{ round($originalActualPrice1-($originalActualPrice1*$reduce_percentage/100),2) }}</span>
	                                                                </div>
                                                            	</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header text-left">
                                                        <a class="card-link w-100 d-inline-block" data-toggle="collapse" href="#collapseTwo{{ $key->code }}">Product - 2</a>
                                                    </div>
                                                    <div id="collapseTwo{{ $key->code }}" class="collapse" data-parent="#accordion">
                                                        <div class="card-body text-left">
                                                            <ul>
                                                            	<?php 
	                                                            	$weight = $key->weight1;
	                                                            	$ptweightoz2 = (( $key->PT1*$weight )/1000000);
	                                                            	$pdweightoz2 = (( $key->PD1*$weight )/1000000);
	                                                            	$rhweightoz2 = (( $key->RH1*$weight )/1000000);

	                                                            	$ptprice2 = ( $metalpricePT*$ptweightoz2 )/31.104;
	                                                            	$pdprice2 = ( $metalpricePD*$pdweightoz2 )/31.104;
	                                                            	$rhprice2 = ( $metalpriceRH*$rhweightoz2 )/31.104;

	                                                            	$totalprice2 = $ptprice2 + $pdprice2 + $rhprice2;
                                                                    $originalActualPrice2 = round($totalprice2,2);
	                                                            ?>
                                                                <li>
                                                                    <span class="heading">Weight (Gram) :</span>
                                                                    <span class="details">{{ $key->weight1 }}</span>
                                                                </li>

                                                                @if(Auth::user()->is_admin != 0)
	                                                                <li>
	                                                                    <span class="heading">PT :</span>
	                                                                    <span class="details">{{ $key->PT1 }}</span>
	                                                                </li>
	                                                                <li>
	                                                                    <span class="heading">PD :</span>
	                                                                    <span class="details">{{ $key->PD1 }}</span>
	                                                                </li>
	                                                                <li>
	                                                                    <span class="heading">RH :</span>
	                                                                    <span class="details">{{ $key->RH1 }}</span>
	                                                                </li>
	                                                            @endif 

	                                                            <li class="dic_price_mn">
	                                                                <div>
	                                                                    <span id="Product4_Price">Price : ${{ round($originalActualPrice2-($originalActualPrice2*$reduce_percentage/100),2) }}</span>
	                                                                </div>
                                                            	</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($key->weight2 != "" && $key->PT2 != "" && $key->PD2 != "" && $key->RH2 != "")
                                                    <div class="card">
                                                        <div class="card-header text-left">
                                                            <a class="card-link w-100 d-inline-block" data-toggle="collapse" href="#collapseThree{{ $key->code }}">Product - 3</a>
                                                        </div>
                                                        <div id="collapseThree{{ $key->code }}" class="collapse" data-parent="#accordion">
                                                            <div class="card-body text-left">
                                                                <ul>
                                                                	<?php 
	                                                                	$weight = $key->weight2;
	                                                                	$ptweightoz3 = (( $key->PT2*$weight )/1000000);
	                                                                	$pdweightoz3 = (( $key->PD2*$weight )/1000000);
	                                                                	$rhweightoz3 = (( $key->RH2*$weight )/1000000);

	                                                                	$ptprice3 = ( $metalpricePT*$ptweightoz3 )/31.104;
	                                                                	$pdprice3 = ( $metalpricePD*$pdweightoz3 )/31.104;
	                                                                	$rhprice3 = ( $metalpriceRH*$rhweightoz3 )/31.104;

	                                                                	$totalprice3 = $ptprice3 + $pdprice3 + $rhprice3;
                                                                        $originalActualPrice3 = round($totalprice3,2);
                                                                	?>
                                                                    <li>
                                                                        <span class="heading">Weight (Gram) :</span>
                                                                        <span class="details">{{ $key->weight2 }}</span>
                                                                    </li>

                                                                    @if(Auth::user()->is_admin != 0)
	                                                                    <li>
	                                                                        <span class="heading">PT :</span>
	                                                                        <span class="details">{{ $key->PT2 }}</span>
	                                                                    </li>
	                                                                    <li>
	                                                                        <span class="heading">PD :</span>
	                                                                        <span class="details">{{ $key->PD2 }}</span>
	                                                                    </li>
	                                                                    <li>
	                                                                        <span class="heading">RH :</span>
	                                                                        <span class="details">{{ $key->RH2 }}</span>
	                                                                    </li>
	                                                                @endif

	                                                                <li class="dic_price_mn">
		                                                                <div>
		                                                                    <span id="Product4_Price">Price : ${{ round($originalActualPrice3-($originalActualPrice3*$reduce_percentage/100),2) }}</span>
		                                                                </div>
	                                                            	</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($key->weight3 != "" && $key->PT3 != "" && $key->PD3 != "" && $key->RH3 != "")
                                                    <div class="card">
                                                        <div class="card-header text-left">
                                                            <a class="card-link w-100 d-inline-block" data-toggle="collapse" href="#collapseFour{{ $key->code }}">Product - 4</a>
                                                        </div>
                                                        <div id="collapseFour{{ $key->code }}" class="collapse" data-parent="#accordion">
                                                            <div class="card-body text-left">
                                                                <ul>
                                                                	<?php 
	                                                                	$weight = $key->weight3;
	                                                                	$ptweightoz4 = (( $key->PT3*$weight )/1000000);
	                                                                	$pdweightoz4 = (( $key->PD3*$weight )/1000000);
	                                                                	$rhweightoz4 = (( $key->RH3*$weight )/1000000);

	                                                                	$ptprice4 = ( $metalpricePT*$ptweightoz4 )/31.104;
	                                                                	$pdprice4 = ( $metalpricePD*$pdweightoz4 )/31.104;
	                                                                	$rhprice4 = ( $metalpriceRH*$rhweightoz4 )/31.104;

	                                                                	$totalprice4 = $ptprice4 + $pdprice4 + $rhprice4;
                                                                        $originalActualPrice4 = round($totalprice4,2);
                                                                	?>
                                                                    <li>
                                                                        <span class="heading">Weight (Gram) :</span>
                                                                        <span class="details">{{ $key->weight3 }}</span>
                                                                    </li>

                                                                    @if(Auth::user()->is_admin != 0)
	                                                                    <li>
	                                                                        <span class="heading">PT :</span>
	                                                                        <span class="details">{{ $key->PT3 }}</span>
	                                                                    </li>
	                                                                    <li>
	                                                                        <span class="heading">PD :</span>
	                                                                        <span class="details">{{ $key->PD3 }}</span>
	                                                                    </li>
	                                                                    <li>
	                                                                        <span class="heading">RH :</span>
	                                                                        <span class="details">{{ $key->RH3 }}</span>
	                                                                    </li>
	                                                                @endif

	                                                                <li class="dic_price_mn">
		                                                                <div>
		                                                                    <span id="Product4_Price">Price : ${{ round($originalActualPrice4-($originalActualPrice4*$reduce_percentage/100),2) }}</span>
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
                                    @if(Auth::user()->is_admin != 0)
                                        <a href="/product/{{ $key->code }}" ><button type="button" class="ml-2"> Show Details</button></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="pagination_mn">
                            {{ $pdata->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        <footer>
            <div class="container">
                <div class="row w-100">
                    <p>© 2021 Watsdoc S.A.R.L – All Rights Reserved</p>
                    <p>Office : Berytech, 2nd Floor, Mathaf, Beirut, Lebanon, Office Phone: +961 1 612 500 ext: 5300 | <a href="#" data-toggle="modal" data-target="#contact_us">Contact us</a></p>
                </div>
            </div>
        </footer>
        <script src="/assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
        <script src="/assets/node_modules/jqueryui/jquery-ui.min.js"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script src="/assets/node_modules/popper/popper.min.js"></script>
        <script src="/assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="/assets/node_modules/wizard/jquery.validate.min.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script>
            $(".mobile_menu").click(function(){
                $(".login_btn ul").addClass("active");
            });
            $("li.mobile_menu_close").click(function(){
                $(".login_btn ul").removeClass("active");
            });

            $( function() {
                $("#productcode").autocomplete({
                    minLength: 1,
                    source:"/product/productcodes",
                    select: function( event, ui ) {
                        $("#productcode").val(ui.item.code);
                    }
                })
                .autocomplete( "instance" )._renderItem = function( ul, item ) {
                    return $( "<li>" )
                    .append( "<a class='autosuggestions'  href='https://watsdoc.com/product/"+item.code+"' >"+item.code+"</a>" )
                    .appendTo( ul );
                };
            });

            $(document).on("click","#editproduct",function(){
              $("#updateproductmodal").modal("show");
          });

            $(document).on("click","#searchbutton",function(){
                var prodcode = $("#productcode").val();
                window.location.href = "https://watsdoc.com/searchresults/"+prodcode;
            });

            $(document).ready(function(){
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
            });
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