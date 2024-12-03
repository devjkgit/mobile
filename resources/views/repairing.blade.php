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
            <p class="loader__label">Admin Panel</p>
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
                                <li class="breadcrumb-item active">Repairing</li>
                            </ol>
                            <!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button> -->
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
                        <table class="table table-bordered repairingdata w-100 table-sm table-striped">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Phone No.</th>
                                    <th>Company</th>
                                    <th>Model</th>
                                    <th>IMEI</th>
                                    <th>Issue</th>
                                    <th>Other Issue</th>
                                    <th>Payment</th>
                                    <th>Total</th>
                                    <th>Expense</th>
                                    <th>Profit</th>
                                    <th>Date</th>
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
                                        <label>IMEI No.</label>
                                        <input type="text" name="imei" id="imei" class="form-control">
                                    </div>
                                    <div class="form-group" >
                                        <label>Issue</label>
                                        <select class="form-control selectpicker" id="issue" name="issue">
                                            <option value="" selected>Select</option>
                                            @foreach($issues as $key)
                                            <option value="{{ $key->issuename}}">{{ $key->issuename}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" >
                                        <label>Other Issue</label>
                                        <input type="text" name="other_issue" id="other_issue" class="form-control">
                                    </div>
                                    <div class="form-group" >
                                        <label>Payment</label>
                                        <select class="form-control selectpicker" id="payment" name="payment">
                                            <option value="CASH" selected>Cash</option>
                                            <option value="CREDIT">Credit</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Total</label>
                                        <input type="number" class="form-control" name="total" id="total" />
                                    </div>
                                    <div class="form-group">
                                        <label>Expense</label>
                                        <input type="number" class="form-control" name="expense" id="expense" />
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
                                        <label>IMEI No.</label>
                                        <input type="text" name="imei" id="updateimei" class="form-control">
                                    </div>
                                    <div class="form-group" >
                                        <label>Model</label>
                                        <input type="text" name="model" id="updatemodel" class="form-control">
                                    </div>
                                    <div class="form-group" >
                                        <label>Issue</label>
                                        <select class="form-control selectpicker" id="updateissue" name="issue">
                                            <option value="" selected>Select</option>
                                            @foreach($issues as $key)
                                            <option value="{{ $key->issuename}}">{{ $key->issuename}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" >
                                        <label>Other Issue</label>
                                        <input type="text" name="other_issue" id="update_other_issue" class="form-control">
                                    </div>
                                    <div class="form-group" >
                                        <label>Payment</label>
                                        <select class="form-control selectpicker" id="update_payment" name="payment">
                                            <option value="CASH">Cash</option>
                                            <option value="CREDIT">Credit</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Total</label>
                                        <input type="number" class="form-control" name="total" id="updatetotal" />
                                    </div>
                                    <div class="form-group">
                                        <label>Expense</label>
                                        <input type="number" class="form-control" name="expense" id="updateexpense" />
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
    // $('#updatebranch,#branch').select2();
    var table = $('.repairingdata').DataTable({
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
        "createdRow": function( row, data, dataIndex){
            if(data['payment'] == "CREDIT" ){
                $(row).css('background-color', '#F39B9B');
            }
        },
        "ajax": {
               url: "{{ url('/repairing/getall') }}",
               data: function (d) {
                d.start_date = $('#start_date').val(),
                d.end_date = $('#end_date').val()
               }
           },
        "columns": [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'phone_no', name: 'phone_no'},
            {data: 'company', name: 'company'},
            {data: 'model', name: 'model'},
            {data: 'imei', name: 'imei'},
            {data: 'issue', name: 'issue'},
            {data: 'other_issue', name: 'other_issue'},
            {data: 'payment', name: 'payment'},
            {data: 'total', name: 'total'},
            {data: 'expense', name: 'expense'},
            {data: 'profit', name: 'profit'},
            {
                "data": "created_at",
                "render": function (data, type, full, meta){
                    return moment(data).format('DD/MM/YYYY');
                }
            },
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
                url:"{{ url('/repairing/selectentry') }}/"+entryid,
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
                        $("#updateimei").val(data.response.imei);
                        $("#updatemodel").val(data.response.model);
                        $("#update_other_issue").val(data.response.other_issue);
                        $("#updatetotal").val(data.response.total);
                        $("#updateexpense").val(data.response.expense);
                        $("#updatecompany").selectpicker("val",data.response.company);
                        $("#updatecompany").selectpicker("refresh");
                        $("#update_payment").selectpicker("val",data.response.payment);
                        $("#update_payment").selectpicker("refresh");
                        $("#updateissue").selectpicker("val",data.response.issue);
                        $("#updateissue").selectpicker("refresh");
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
                    url:"{{ url('/repairing/deleteentry')}}/"+entryid,
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
                            $('.repairingdata').DataTable().ajax.reload();  
                        }
                    }
                });
            }
        });
        $('.profileimage').dropify({
            messages: {
                'default': 'Drag and drop a profile image here or click',
                'replace': 'Drag and drop or click to replace',
                'remove':  'Remove',
                'error':   'Ooops, something wrong happended.'
            }
        });
        $('.updateprofileimage').dropify({
            messages: {
                'default': 'Drag and drop a profile image here or click',
                'replace': 'Drag and drop or click to replace',
                'remove':  'Remove',
                'error':   'Ooops, something wrong happended.'
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
                    url:"{{ url('/repairing/addentry')}}",
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
                    url:"{{ url('/repairing/updateentry')}}",
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