<!DOCTYPE html>
<html lang="en">
@include('head')
<body class="skin-default fixed-layout">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Mobile-Data</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        @include('topnavigation')
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        @include('leftsidebar')
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <button type="button" data-toggle="modal" data-target="#addusermodal" class="btn waves-effect waves-light btn-secondary ">Add Entry</button>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active">Mobiles</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="form-label">Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">End Date</label>
                            <input type="date" name="end_date" id="end_date"  class="form-control">
                        </div>
                        <div class="col-md-3 align-self-center">
                            <button type="button" class="btn waves-effect filter_btn waves-light btn-secondary ">Filter</button>
                        </div>
                    </div>
                    <div class="col-12 table-responsive">
                        <table class="table table-bordered mobilesdata w-100 table-sm table-striped">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Phone No.</th>
                                    <th>Company</th>
                                    <th>Model</th>
                                    <th>Battery Health</th>
                                    <th>IMEI</th>
                                    <th>ID Proof</th>
                                    <th>Purchase Price</th>
                                    <th>Sell Price</th>
                                    <th>Profit</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="Loader"></div>
                </div>
                <!-- Add User modal -->
                <div id="addusermodal" class="modal fade pr-0" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-modal="true">
                    <div class="modal-dialog modal-dialog-slideout" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Create Entry</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" autocomplete="off" id="addentryform" method="post" enctype="multipart/form-data">
                                    <div class="form-group" >
                                        @csrf
                                        <label>Name</label>
                                        <input type="text" name="name" id="name" class="form-control">
                                    </div>
                                    <div class="form-group" >
                                        <label>Phone No</label>
                                        <input type="text" name="phone_no" id="phone_no" class="form-control">
                                    </div>
                                    <div class="form-group" >
                                        <label>Company</label>
                                        <select class="form-control selectpicker" id="company" name="company">
											<option value="" selected>Select</option>
											@foreach($company as $key)
											<option value="{{ $key->companyname}}">{{ $key->companyname}}</option>
											@endforeach
										</select>
                                    </div>
                                    <div class="form-group" >
                                        <label>Model</label>
                                        <input type="text" name="model" id="model" class="form-control">
                                    </div>
                                    <div class="form-group" >
                                        <label>Battery Health</label>
                                        <input type="text" name="battery_health" id="battery_health" class="form-control">
                                    </div>
                                    <div class="form-group" >
                                        <label>IMEI</label>
                                        <input type="text" name="imei" id="imei" class="form-control">
                                    </div>
                                    <div class="form-group" >
                                        <label>ID Proof</label>
                                        <input type="text" name="id_proof" id="id_proof" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Purchase Price</label>
                                        <input type="number" class="form-control" name="purchase_price" id="purchase_price" />
                                    </div>
                                    <div class="form-group">
                                        <label>Sell Price</label>
                                        <input type="number" class="form-control" name="sell_price" id="sell_price" />
                                    </div>
                                    <div class="Loader addentryloader"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Add</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                </form>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- Update user modal -->
                <div id="updateusermodal" class="modal fade pr-0" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-modal="true">
                    <div class="modal-dialog modal-dialog-slideout" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Update Entry</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" autocomplete="off" id="updateentryform" method="post" enctype="multipart/form-data">
                                    <div class="form-group" >
                                        @csrf
                                        <label>Name</label>
                                        <input type="hidden" name="entryid" class="entryid"  id="entryid" value="">
                                        <input type="text" name="name" id="updatename" class="form-control">
                                    </div>
                                    <div class="form-group" >
                                        <label>Phone No</label>
                                        <input type="text" name="phone_no" id="updatephone_no" class="form-control">
                                    </div>
                                    <div class="form-group" >
                                        <label>Company</label>
                                        <select class="form-control selectpicker" id="updatecompany" name="company">
											<option value="">Select</option>
											@foreach($company as $key)
											<option value="{{ $key->companyname}}">{{ $key->companyname}}</option>
											@endforeach
										</select>
                                    </div>
                                    <div class="form-group" >
                                        <label>Model</label>
                                        <input type="text" name="model" id="updatemodel" class="form-control">
                                    </div>
                                    <div class="form-group" >
                                        <label>Battery Health</label>
                                        <input type="text" name="battery_health" id="update_battery_health" class="form-control">
                                    </div>
                                    <div class="form-group" >
                                        <label>IMEI</label>
                                        <input type="text" name="imei" id="updateimei" class="form-control">
                                    </div>
                                    <div class="form-group" >
                                        <label>ID Proof</label>
                                        <input type="text" name="id_proof" id="update_id_proof" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Purchase Price</label>
                                        <input type="number" class="form-control" name="purchase_price" id="update_purchase_price" />
                                    </div>
                                    <div class="form-group">
                                        <label>Sell Price</label>
                                        <input type="number" class="form-control" name="sell_price" id="update_sell_price" />
                                    </div>
                                    <div class="Loader updateentryloader"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Update</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                </form>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            </div>
        </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        @include('footer')
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    @include('script')
</body>
<script type="text/javascript">
    var table = $('.mobilesdata').DataTable({
        "pageLength": 20,
        "responsive": true,
        "serverSide": true,
        "processing" : true,
        "destroy": true,
        "ordering": false,
        "autoWidth": true,
        "columnDefs": [
            {"className" : 'text-center', "targets" : '_all'},
        ],
        "ajax": {
               url: "{{ url('/mobiles/getall') }}",
               data: function (d) {
                d.start_date = $('#start_date').val(),
                d.end_date = $('#end_date').val()
               }
           },
        "columns": [
            {
                "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                "data": "created_at",
                "render": function (data, type, full, meta){
                    return moment(data).format('DD/MM/YYYY');
                }
            },
            {data: 'name', name: 'name'},
            {data: 'phone_no', name: 'phone_no'},
            {data: 'company', name: 'company'},
            {data: 'model', name: 'model'},
            {data: 'battery_health', name: 'battery_health'},
            {data: 'imei', name: 'imei'},
            {data: 'id_proof', name: 'id_proof'},
            {data: 'purchase_price', name: 'purchase_price'},
            {data: 'sell_price', name: 'sell_price'},
            {data: 'profit', name: 'profit'},
            {
                "data": "id",
                "render": function(data, type, row) {
                    return '<a href="#" id="editentry" title="Edit Entry" class="btn btn-sm btn-thm bg-dark" data-id="' + data + '"><span class="fa fa-edit"></span></a> <a href="#" id="deleteentry" title="Delete Entry" class="btn btn-sm btn-thm bg-dark" data-id="' + data + '"><span class="fa fa-trash"></span></a>';
                }
            },
        ],
    });
    $(".filter_btn").click(function(){
        table.draw();
       });
    $(document).ready(function(){
        $(document).on("click","#editentry",function(){
            var entryid = $(this).attr("data-id");
            $(".Loader").show();
            $.ajax({
                url:"{{ url('/mobiles/selectentry') }}/"+entryid,
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
                        $("#updatename").val(data.response.name);
                        $("#updatephone_no").val(data.response.phone_no);
                        $("#updatecompany").selectpicker("val",data.response.company);
                        $("#updatecompany").selectpicker("refresh");
                        $("#updatemodel").val(data.response.model);
                        $("#update_battery_health").val(data.response.battery_health);
                        $("#updateimei").val(data.response.imei);
                        $("#update_id_proof").val(data.response.id_proof);
                        $("#update_purchase_price").val(data.response.purchase_price);
                        $("#update_sell_price").val(data.response.sell_price);
                        $("#entryid").val(data.response.id);
                        $("#updateusermodal").modal("show");
                        $(".Loader").hide();
                    }
                }
            });
        });
        $(document).on("click","#deleteentry",function(){
            var entryid = $(this).attr("data-id");
            var result = confirm("Are you sure?");
            if(result)
            {
                $(".Loader").show();
                $.ajax({
                    url:"{{ url('/mobiles/deleteentry')}}/"+entryid,
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
                            $('.mobilesdata').DataTable().ajax.reload();  
                        }
                    }
                });
            }
        });

        $("#addentryform").validate({
            submitHandler: function(){
                $(".addentryloader").show();
                var form = $('#addentryform')[0];
                var data = new FormData(form);
                $.ajax({
                    dataType:"json",
                    type:"post",
                    contentType: false,
                    processData: false,
                    data:data,
                    url:"{{ url('/mobiles/addentry')}}",
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
                            $(".addentryloader").hide();
                        }
                        else if(data.success == "1")
                        {
                            $(".addentryloader").hide();
                            $("#addusermodal").modal("hide");
                            $('#addentryform').each(function(){ this.reset(); });
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
                            location.reload();
                            //$('.repairingdata').DataTable().ajax.reload();  
                        }
                    }
                });
            }
        });
        $("#updateentryform").validate({
            submitHandler: function(){
                $(".updatentryloader").show();
                var form = $('#updateentryform')[0];
                var data = new FormData(form);
                $.ajax({
                    dataType:"json",
                    type:"post",
                    contentType: false,
                    processData: false,
                    data:data,
                    url:"{{ url('/mobiles/updateentry')}}",
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
                            $(".updateentryloader").hide();
                            $("#updateusermodal").modal("hide");
                            $('#updateentryform').each(function(){ this.reset(); });
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
                            location.reload();
                            //$('.repairingdata').DataTable().ajax.reload(); 
                        }
                    }
                });
            }
        });
    });
</script>
</html>