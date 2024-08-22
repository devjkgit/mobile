<!DOCTYPE html>
<html lang="en">
@include('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.css" />
<body class="skin-default fixed-layout">    
	<div class="preloader">
		<div class="loader">
			<div class="loader__figure"></div>
			<p class="loader__label">Admin Panel</p>
		</div>
	</div>
	<div id="main-wrapper">
		@include('topnavigation')
		@include('leftsidebar')
		<div class="page-wrapper">
			<div class="container-fluid">
				<div class="row page-titles">
					<div class="col-md-5 align-self-center">
						<!-- <h3 class="text-themecolor">Products</h3> -->
						<button type="button" data-toggle="modal" data-target="#addproductmodal" class="btn waves-effect waves-light btn-secondary ">Add Product</button>
					</div>
					<div class="col-md-7 align-self-center text-right">
						<div class="d-flex justify-content-end align-items-center">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="/">Home</a></li>
								<li class="breadcrumb-item active">Products</li>
							</ol>
							<!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button> -->
						</div>
					</div>
				</div> 
				<!-- Add product modal -->
				<div id="addproductmodal" class="modal fade pr-0" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-modal="true">
					<div class="modal-dialog modal-dialog-slideout" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" id="myModalLabel">Add Product</h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							</div>
							<div class="modal-body">
								<form class="form-horizontal" autocomplete="off" id="addproductform" method="post" enctype="multipart/form-data">
									<div class="form-group" >
										@csrf
										<label>Product Type</label>
										<select class="form-control selectpicker" id="producttype" name="producttype">
											<option value="" hidden disabled>Select</option>
											<option value="Metal">Metal</option>
											<option selected value="Ceramic">Ceramic</option>
										</select>
									</div>
									<div class="form-group form_group_custom" >
										<label>Code</label>
										<input type="text" name="code" id="code" class="form-control" onkeyup="check_availability()">
										<div id="avaliability"></div>
									</div>
									<div class="form-group" >
										<label>Company</label>
										<select class="form-control selectpicker" id="company" name="company">
											<option value="" hidden disabled selected>Select</option>
											@foreach($company as $key)
											<option value="{{ $key->companyname}}">{{ $key->companyname}}</option>
											@endforeach
										</select>
									</div>
									<div class="products_two_show_check">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" value="1" name="subproductcheck" class="custom-control-input" id="subproductcheck">
											<label class="custom-control-label task-done" for="subproductcheck">
												<span>Sub Product</span>
											</label>
										</div>
									</div>
									<div class="product_mn">
										<div class="product_one_mn">
											<div class="form-group" >
												<label>PT</label>
												<input type="number" name="PT" id="PT" class="form-control">
											</div>
											<div class="form-group" >
												<label>PD</label>
												<input type="number" name="PD" id="PD" class="form-control">
											</div>
											<div class="form-group" >
												<label>RH</label>
												<input type="number" name="RH" id="RH" class="form-control">
											</div>
											<div class="form-group" >
												<label>Weight (grams)</label>
												<input type="number" name="weight" id="weight" class="form-control">
											</div>
										</div>
										<div class="product_one_mn subproductdiv" style="display:none; ">
											<div class="form-group" >
												<label>PT</label>
												<input type="number" name="PT1" id="PT1" class="form-control">
											</div>
											<div class="form-group" >
												<label>PD</label>
												<input type="number" name="PD1" id="PD1" class="form-control">
											</div>
											<div class="form-group" >
												<label>RH</label>
												<input type="number" name="RH1" id="RH1" class="form-control">
											</div>
											<div class="form-group" >
												<label>Weight (grams)</label>
												<input type="number" name="weight1" id="weight1" class="form-control">
											</div>
										</div>
										<div class="product_one_mn subproductdiv" style="display:none; ">
											<div class="form-group" >
												<label>PT</label>
												<input type="number" name="PT2" id="PT2" class="form-control">
											</div>
											<div class="form-group" >
												<label>PD</label>
												<input type="number" name="PD2" id="PD2" class="form-control">
											</div>
											<div class="form-group" >
												<label>RH</label>
												<input type="number" name="RH2" id="RH2" class="form-control">
											</div>
											<div class="form-group" >
												<label>Weight (grams)</label>
												<input type="number" name="weight2" id="weight2" class="form-control">
											</div>
										</div>
										<div class="product_one_mn subproductdiv" style="display:none; ">
											<div class="form-group" >
												<label>PT</label>
												<input type="number" name="PT3" id="PT3" class="form-control">
											</div>
											<div class="form-group" >
												<label>PD</label>
												<input type="number" name="PD3" id="PD3" class="form-control">
											</div>
											<div class="form-group" >
												<label>RH</label>
												<input type="number" name="RH3" id="RH3" class="form-control">
											</div>
											<div class="form-group" >
												<label>Weight (grams)</label>
												<input type="number" name="weight3" id="weight3" class="form-control">
											</div>
										</div>
									</div>									
									<div class="form-group upload_img_mn">
										<label>Image</label>
										<input type="file" class="pimage" name="pimage[]" id="pimage" multiple />
									</div>
									<div class="Loader addproductloader"></div>
								</div>
								<div class="modal-footer">
									<button type="submit" id="submitbtn" class="btn btn-primary"><i class="fa fa-check"></i> Add</button>
									<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
								</form>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- Update product modal -->
				<div id="updateproductmodal" class="modal fade pr-0" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-modal="true">
					<div class="modal-dialog modal-dialog-slideout" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" id="myModalLabel">Update Product</h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							</div>
							<div class="modal-body">
								<form class="form-horizontal" autocomplete="off" id="updateproductform" method="post" enctype="multipart/form-data">
									<div class="form-group" >
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
										<label>Company</label>
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
										<div class="product_one_mn updatesubproductdiv" style="display: none">
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
										<div class="product_one_mn updatesubproductdiv" style="display: none">
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
										<div class="product_one_mn updatesubproductdiv" style="display: none">
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
									<div class='images-list'>
										<div class='row' id="previewdiv">	
										</div>
									</div>
									
									{{-- @if(count($pimages) > 1)
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
			                        @endif --}}
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
				<div class="row">
					<div class="col-12 table-responsive">
						<table class="table table-bordered proddata w-100 table-sm table-striped">
							<thead class="bg-dark text-white">
								<tr>
									<th></th>
									<th>ID</th>
									<th>Product Type</th>
									<th>Code</th>
									<th>Company</th>
									<th>PT</th>
									<th>PD</th>
									<th>RH</th>
									<th>Weight (grams)</th>
									<th>Image</th>
									<th>Created At</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
					<div class="Loader"></div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('footer')
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button"
				class="close"
				data-dismiss="modal" 
				aria-label="Close">
					<span aria-hidden="true">
						×
					</span>
				</button>
			</div>
			<!--Modal body with image-->
			<div class="modal-body">
				<img id="previewimagesrc" style="width: 100%;" src="" />
			</div>
		</div>
	</div>
</div>
@include('script')
</body>
<script type="text/javascript">
	$('#subproductcheck').click(function() {
		if (!$(this).is(':checked')) {
			$(".subproductdiv").hide();
			$("#addproductmodal").removeClass("subproductmaindiv");
		}
		else{
			$(".subproductdiv").show();
			$("#addproductmodal").addClass("subproductmaindiv");
		}
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

	function getChildRow(data) {
		
		if(data.PT2 != null && data.PD2 != null && data.RH2 != null && data.weight2 != null && data.PT3 == null && data.PD3 == null && data.RH3 == null && data.weight3 == null)
		{
			return '<div class="row"><div class="col-3"><h5>Product 1</h5><table cellpadding="5" cellspacing="0"'
				+ ' style="padding-left:50px;width: 90%;">' +
				'<tr>' +
				'<td>PT</td>' +
				'<td>' + data.PT + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>PD</td>' +
				'<td>' + data.PD + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>RH</td>' +
				'<td>' + data.RH + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>Weight (grams)</td>' +
				'<td>' + data.weight + '</td>' +
				'</tr>' +
				'</table></div><div class="col-3"> <h5>Product 2</h5><table cellpadding="5" cellspacing="0"'
				+ ' style="padding-left:50px;width: 90%;">' +
				'<tr>' +
				'<td>PT</td>' +
				'<td>' + data.PT1 + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>PD</td>' +
				'<td>' + data.PD1 + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>RH</td>' +
				'<td>' + data.RH1 + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>Weight (grams)</td>' +
				'<td>' + data.weight1 + '</td>' +
				'</tr>' +
				'</table></div><div class="col-3"> <h5>Product 3</h5><table cellpadding="5" cellspacing="0"'
				+ ' style="padding-left:50px;width: 90%;">' +
				'<tr>' +
				'<td>PT</td>' +
				'<td>' + data.PT2 + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>PD</td>' +
				'<td>' + data.PD2 + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>RH</td>' +
				'<td>' + data.RH2 + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>Weight (grams)</td>' +
				'<td>' + data.weight2 + '</td>' +
				'</tr>' +
				'</table></div></div>';
		}
		else if(data.PT2 == null && data.PD2 == null && data.RH2 == null && data.weight2 == null && data.PT3 != null && data.PD3 != null && data.RH3 != null && data.weight3 != null)
		{
			return '<div class="row"><div class="col-3"><h5>Product 1</h5><table cellpadding="5" cellspacing="0"'
				+ ' style="padding-left:50px;width: 90%;">' +
				'<tr>' +
				'<td>PT</td>' +
				'<td>' + data.PT + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>PD</td>' +
				'<td>' + data.PD + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>RH</td>' +
				'<td>' + data.RH + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>Weight (grams)</td>' +
				'<td>' + data.weight + '</td>' +
				'</tr>' +
				'</table></div><div class="col-3"> <h5>Product 2</h5><table cellpadding="5" cellspacing="0"'
				+ ' style="padding-left:50px;width: 90%;">' +
				'<tr>' +
				'<td>PT</td>' +
				'<td>' + data.PT1 + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>PD</td>' +
				'<td>' + data.PD1 + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>RH</td>' +
				'<td>' + data.RH1 + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>Weight (grams)</td>' +
				'<td>' + data.weight1 + '</td>' +
				'</tr>' +
				'</table></div><div class="col-3"> <h5>Product 4</h5><table cellpadding="5" cellspacing="0"'
				+ ' style="padding-left:50px;width: 90%;">' +
				'<tr>' +
				'<td>PT</td>' +
				'<td>' + data.PT3 + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>PD</td>' +
				'<td>' + data.PD3 + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>RH</td>' +
				'<td>' + data.RH3 + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>Weight (grams)</td>' +
				'<td>' + data.weight3 + '</td>' +
				'</tr>' +
				'</table></div></div>';
		}
		else if(data.PT2 != null && data.PD2 != null && data.RH2 != null && data.weight2 != null && data.PT3 != null && data.PD3 != null && data.RH3 != null && data.weight3 != null)
		{
			return '<div class="row"><div class="col-3"><h5>Product 1</h5><table cellpadding="5" cellspacing="0"'
				+ ' style="padding-left:50px;width: 90%;">' +
				'<tr>' +
				'<td>PT</td>' +
				'<td>' + data.PT + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>PD</td>' +
				'<td>' + data.PD + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>RH</td>' +
				'<td>' + data.RH + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>Weight (grams)</td>' +
				'<td>' + data.weight + '</td>' +
				'</tr>' +
				'</table></div><div class="col-3"> <h5>Product 2</h5><table cellpadding="5" cellspacing="0"'
				+ ' style="padding-left:50px;width: 90%;">' +
				'<tr>' +
				'<td>PT</td>' +
				'<td>' + data.PT1 + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>PD</td>' +
				'<td>' + data.PD1 + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>RH</td>' +
				'<td>' + data.RH1 + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>Weight (grams)</td>' +
				'<td>' + data.weight1 + '</td>' +
				'</tr>' +
				'</table></div><div class="col-3"> <h5>Product 3</h5><table cellpadding="5" cellspacing="0"'
				+ ' style="padding-left:50px;width: 90%;">' +
				'<tr>' +
				'<td>PT</td>' +
				'<td>' + data.PT2 + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>PD</td>' +
				'<td>' + data.PD2 + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>RH</td>' +
				'<td>' + data.RH2 + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>Weight (grams)</td>' +
				'<td>' + data.weight2 + '</td>' +
				'</tr>' +
				'</table></div><div class="col-3"> <h5>Product 4</h5><table cellpadding="5" cellspacing="0"'
				+ ' style="padding-left:50px;width: 90%;">' +
				'<tr>' +
				'<td>PT</td>' +
				'<td>' + data.PT3 + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>PD</td>' +
				'<td>' + data.PD3 + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>RH</td>' +
				'<td>' + data.RH3 + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>Weight (grams)</td>' +
				'<td>' + data.weight3 + '</td>' +
				'</tr>' +
				'</table></div></div>';
		}
		else
		{
			return '<div class="row"><div class="col-3"><h5>Product 1</h5><table cellpadding="5" cellspacing="0"'
				+ ' style="padding-left:50px;width: 90%;">' +
				'<tr>' +
				'<td>PT</td>' +
				'<td>' + data.PT + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>PD</td>' +
				'<td>' + data.PD + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>RH</td>' +
				'<td>' + data.RH + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>Weight (grams)</td>' +
				'<td>' + data.weight + '</td>' +
				'</tr>' +
				'</table></div><div class="col-3"> <h5>Product 2</h5><table cellpadding="5" cellspacing="0"'
				+ ' style="padding-left:50px;width: 90%;">' +
				'<tr>' +
				'<td>PT</td>' +
				'<td>' + data.PT1 + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>PD</td>' +
				'<td>' + data.PD1 + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>RH</td>' +
				'<td>' + data.RH1 + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>Weight (grams)</td>' +
				'<td>' + data.weight1 + '</td>' +
				'</tr>' +
				'</table></div></div>';	
		}
	}

	var tbl =  $('.proddata').DataTable({
		"pageLength": 20,
		//"responsive": true,
		"processing" : true,
		"destroy": true,
		"ordering": false,
		"autoWidth": false,
		"columnDefs": [
		{"className" : 'text-center', "targets" : '_all'},
		{ "width": "4%", "targets": 0 },
		{ "width": "7%", "targets": 1 },
		{ "width": "10%", "targets": 2 },
		{ "width": "10%", "targets": 3 },
		{ "width": "10%", "targets": 4 },
		{ "width": "7%", "targets": 5 },
		{ "width": "7%", "targets": 6 },
		{ "width": "7%", "targets": 7 },
		{ "width": "7%", "targets": 8 },
		{ "width": "10%", "targets": 9 },
		{ "width": "10%", "targets": 10 },
		{ "width": "10%", "targets": 11 },
		],
		"order": [[1, 'asc']],
		"createdRow": function (row, data, index) {
			if (data.subproduct != '1') { /* value of item.Person checkbox */
				var td = $(row).find("td:first");
				td.removeClass('details-control');
			}
		},
		"ajax": "{{ url('/products/getallproducts') }}",
		"columns": [
		{
			"className": 'details-control',
			"orderable": true,
			"data": null,
			"defaultContent": ''
		},
		{data: 'id', name: 'id'},
		{data: 'producttype', name: 'producttype'},
		{data: 'code', name: 'code'},
		{data: 'company', name: 'company'},
		// {data: 'PT', name: 'PT'},
		// {data: 'PD', name: 'PD'},
		// {data: 'RH', name: 'RH'},
		// {data: 'weight', name: 'weight'},
		{
			"data": { PT:"PT",PT1:"PT1",PT2:"PT2",PT3:"PT3",subproduct:"subproduct",weight:"weight",weight1:"weight1",weight2:"weight2",weight3:"weight3" },
			"render": function (data, type, full, meta){
				if(data.subproduct != '1'){
					return parseFloat(data.PT).toFixed(2) + " " ;
				}
				else{
					if(data.weight2 == null){
						var weight2 = 0;
					}else{
						var weight2 = data.weight2;
					}

					if(data.weight3 == null){
						var weight3 = 0;
					}else{
						var weight3 = data.weight3;
					}

					if(data.PT2 == null){
						var PT2 = 0;
					}else{
						var PT2 = data.PT2;
					}

					if(data.PT3 == null){
						var PT3 = 0;
					}else{
						var PT3 = data.PT3;
					}
					var total_weight = parseInt(data.weight) + parseInt(data.weight1) + parseInt(weight2) + parseInt(weight3);
					//var totalPT = parseInt(data.PT) + parseInt(data.PT1);
					var totalPT = ((parseInt(data.PT) * parseInt(data.weight)) + (parseInt(data.PT1) * parseInt(data.weight1)) + (parseInt(PT2) * parseInt(weight2)) + (parseInt(PT3) * parseInt(weight3))) / total_weight ;
					return parseFloat(totalPT).toFixed(2) + " " ;
				}
			}
		},
		{
			"data": { PD:"PD",PD1:"PD1",PD2:"PD2",PD3:"PD3",subproduct:"subproduct",weight:"weight",weight1:"weight1",weight2:"weight2",weight3:"weight3" },
			"render": function (data, type, full, meta){
				if(data.subproduct != '1'){
					return parseFloat(data.PD).toFixed(2) + " " ;
				}
				else{
					if(data.weight2 == null){
						var weight2 = 0;
					}else{
						var weight2 = data.weight2;
					}

					if(data.weight3 == null){
						var weight3 = 0;
					}else{
						var weight3 = data.weight3;
					}

					if(data.PD2 == null){
						var PD2 = 0;
					}else{
						var PD2 = data.PD2;
					}

					if(data.PD3 == null){
						var PD3 = 0;
					}else{
						var PD3 = data.PD3;
					}
					var total_weight = parseInt(data.weight) + parseInt(data.weight1) + parseInt(weight2) + parseInt(weight3);
					//var totalPD = parseInt(data.PD) + parseInt(data.PD1);
					var totalPD = ((parseInt(data.PD) * parseInt(data.weight)) + (parseInt(data.PD1) * parseInt(data.weight1)) + (parseInt(PD2) * parseInt(weight2)) + (parseInt(PD3) * parseInt(weight3))) / total_weight ;
					return parseFloat(totalPD).toFixed(2) + " " ;
				}
			}
		},
		{
			"data": { RH:"RH",RH1:"RH1",RH2:"RH2",RH3:"RH3",subproduct:"subproduct",weight:"weight",weight1:"weight1",weight2:"weight2",weight3:"weight3" },
			"render": function (data, type, full, meta){
				if(data.subproduct != '1'){
					return parseFloat(data.RH).toFixed(2) + " " ;
				}
				else{
					if(data.weight2 == null){
						var weight2 = 0;
					}else{
						var weight2 = data.weight2;
					}

					if(data.weight3 == null){
						var weight3 = 0;
					}else{
						var weight3 = data.weight3;
					}

					if(data.RH2 == null){
						var RH2 = 0;
					}else{
						var RH2 = data.RH2;
					}

					if(data.RH3 == null){
						var RH3 = 0;
					}else{
						var RH3 = data.RH3;
					}
					var total_weight = parseInt(data.weight) + parseInt(data.weight1) + parseInt(weight2) + parseInt(weight3);
					//var totalRH = parseInt(data.RH) + parseInt(data.RH1);
					var totalRH = ((parseInt(data.RH) * parseInt(data.weight)) + (parseInt(data.RH1) * parseInt(data.weight1)) + (parseInt(RH2) * parseInt(weight2)) + (parseInt(RH3) * parseInt(weight3))) / total_weight ;
					return parseFloat(totalRH).toFixed(2) + " " ;
				}
			}
		},
		{
			"data": { weight:"weight",weight1:"weight1",subproduct:"subproduct",weight2:"weight2",weight3:"weight3" },
			"render": function (data, type, full, meta){
				if(data.subproduct != '1'){
					return data.weight ;
				}
				else{
					if(data.weight2 == null){
						var weight2 = 0;
					}else{
						var weight2 = data.weight2;
					}

					if(data.weight3 == null){
						var weight3 = 0;
					}else{
						var weight3 = data.weight3;
					}
					var totalweight = parseInt(data.weight) + parseInt(data.weight1) + parseInt(weight2) + parseInt(weight3);
					return totalweight ;
				}
			}
		},
		{
			"data": "image",
			"render": function (data, type, full, meta){
				if(data == "" || data === null){
					return "N/A";
				}
				else{
					var row = data;
					var result = row.split('^^');
					return '<img src="public/assets/images/productimage/'+result[0]+'" class="previewimage" width="80" height="80">';
				}
			}
		},
		{
			"data": "created_at",
			"render": function (data, type, full, meta){
				return moment(data).format('DD/MM/YYYY');
			}
		},
		{
			"data": "id",
			"render": function(data, type, row) {
				return '<a href="#" id="editproduct" title="Edit Product" class="btn btn-sm btn-thm bg-dark" data-id="' + data + '"><span class="fa fa-edit"></span></a> <a href="#" id="deleteproduct" title="Delete Product" class="btn btn-sm btn-thm bg-dark" data-id="' + data + '"><span class="fa fa-trash"></span></a>';
			}
		},
		],
	});

	$('.proddata tbody').on('click', 'td.details-control', function () {
		var tr = $(this).closest('tr');
		var row = tbl.row(tr);
		if (row.child.isShown()) {
			row.child.hide();
			tr.removeClass('shown');
		}
		else {
			row.child(getChildRow(row.data())).show();
			tr.addClass('shown');
		}
	});

	$(document).ready(function(){

		$(document).on("click",".removepimage",function(){
            $(this).closest('div').remove();
        });
		
		$(document).on("click",".previewimage",function(){
			var image = $(this).attr("src");
			$("#previewimagesrc").attr("src",image);
			$("#exampleModal").modal("show");
		}); 
		$('.pimage').dropify({
			messages: {
				'default': 'Drag and drop a profile image here or click',
				'replace': 'Drag and drop or click to replace',
				'remove':  'Remove',
				'error':   'Ooops, something wrong happended.'
			}
		});     

		$("#addproductform").validate({
			rules: {
				"producttype": {required: true},
				"code": {required: true},
				"company": {required: true},
				"PT": {required: true},
				"PD": {required: true},
				"RH": {required: true},
				"weight": {required: true},
				"PT1": {required: true},
				"PD1": {required: true},
				"RH1": {required: true},
				"weight1": {required: true},	
			},
			messages: {
				"producttype": {required: "Please select the product type."},
				"code": {required: "Please enter the code."},
				"company": {required: "Please select the company."},
				"PT": {required: "Please enter the value for PT."},
				"PD": {required: "Please enter the value for PD."},
				"RH": {required: "Please enter the value for RH."},
				"weight": {required: "Please enter the weight."},
				"PT1": {required: "Please enter the value for PT."},
				"PD1": {required: "Please enter the value for PD."},
				"RH1": {required: "Please enter the value for RH."},
				"weight1": {required: "Please enter the weight."},
			},
			submitHandler: function(){
				$(".addproductloader").show();
				var form = $('#addproductform')[0];
				var data = new FormData(form);
				$.ajax({
					dataType:"json",
					type:"post",
					contentType: false,
					processData: false,
					data:data,
					url:"{{ url('/products/addproduct')}}",
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
							$(".addproductloader").hide();
						}
						else if(data.success == "1")
						{
							$(".addproductloader").hide();
							$("#addproductmodal").modal("hide");
							$('#addproductform').each(function(){ this.reset(); });
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
							$('.proddata').DataTable().ajax.reload();
							location.reload();
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
				$(".Loader").show();
				$.ajax({
					url:"{{ url('/products/deleteproduct')}}/"+userid,
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
							$(".Loader").hide();
						}
						else if(data.success == "1")
						{
							$(".Loader").hide();
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
							$('.proddata').DataTable().ajax.reload();  
						}
					}
				});
			}
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
					headers: {
						'X-CSRF-TOKEN': "{{ csrf_token() }}"
					},
					dataType:"json",
					contentType: false,
					processData: false,
					type:"post",
					data:data,
					url:"{{ url('/products/updateproduct')}}",
					success: function(data)
					{
						if(data.success == "0"){
							$.each(data.error, function(key, value){
								$.notify(
								{
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
							$('#updateproductform').each(function(){ this.reset(); });
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
							$('.proddata').DataTable().ajax.reload();  
							location.reload();
						}
					}
				});
			}
		});

		$(document).on("click","#editproduct",function(){
			var userid = $(this).attr("data-id");
			$(".Loader").show();
			$.ajax({
				url:"{{ url('products/selectproduct') }}/"+userid,
				type:"get",
				dataType:"json",
				success:function(data){
					if(data.success == "0")
					{
						$(".Loader").hide();
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
						$("#productid").val(data.response.id);
						$('.dropify-render img').remove();
						if(data.response.subproduct == '1' ){
							$("#updatesubproductcheck").prop('checked',true);
							$(".updatesubproductdiv").show();
							$("#updateproductmodal").addClass("updatesubproductmaindiv");
							//sub-product 1
							$("#updatePT").val(data.response.PT);
							$("#updatePD").val(data.response.PD);
							$("#updateRH").val(data.response.RH);
							$("#updateweight").val(data.response.weight);
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
						else{
							$("#updatesubproductcheck").prop('checked',false);
							$(".updatesubproductdiv").hide();
							$("#updateproductmodal").removeClass("updatesubproductmaindiv");
							//product 1
							$("#updatePT").val(data.response.PT);
							$("#updatePD").val(data.response.PD);
							$("#updateRH").val(data.response.RH);
							$("#updateweight").val(data.response.weight);
						}

						if(data.response.image != null)
						{
							$('#previewdiv').empty();
							var row = data.response.image;
							var pimage = row.split('^^');
							if(pimage.length > 1){
								$.each(pimage, function (key, val) {
									$('#previewdiv').append("<div class='col-2'><img src='/assets/images/productimage/"+val+"' height='100px' width='100px' alt='' class='pimage-name' /><br/><a href='#' class='removepimage' onclick='RemovePimage(this.id)' id='"+val+"'>remove</a></div>");
							    });	
							}
							$('#updateproductform .dropify-render img').first().remove();
							$('#updateproductform .dropify-preview,#updateproductform .dropify-clear').css('display','block');
							$(".dropify-clear").attr("data-image",data.response.image);
							$('<img src="public/assets/images/productimage/'+pimage[0]+'">').appendTo("#updateproductform .dropify-render");
							$('#updateproductform .dropify-filename-inner').text(data.response.image);
						}
						else
						{
							$("#updatepimage").next(".dropify-clear").trigger("click");
						}

						$("#updateproductmodal").modal("show");
						$(".Loader").hide();
					}
				}
			});
		});
	});

	$(document).on("click",".dropify-clear",function(){ 
		var data = $(this).attr("data-image");
		$("#removeimage").val(data);    
	});
	
</script>

<script type="text/javascript">
  	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  	function check_availability()
  	{
    	var code = $('#code').val();
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
	            	$('#avaliability').html('<span class="error" style="color:red;">Code already exist</span>');
	            	$('#submitbtn').attr('disabled',true);
	          	}else{
	            	$('#avaliability').html('<span></span>');
	            	$('#submitbtn').attr('disabled',false);
	          	}
	        }
	    });
  	}
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

</html>