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

                        <h3 class="text-themecolor">Companies</h3>

                        <!-- <button type="button" data-toggle="modal" data-target="#addusermodal" class="btn waves-effect waves-light btn-secondary ">+ Add User</button> -->

                    </div>

                    <div class="col-md-7 align-self-center text-right">

                        <div class="d-flex justify-content-end align-items-center">

                            <ol class="breadcrumb">

                                <li class="breadcrumb-item"><a href="/">Home</a></li>

                                <li class="breadcrumb-item active">Companies</li>

                            </ol>

                            <!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button> -->

                        </div>

                    </div>

                </div>



                <div class="row">

                    <div class="col-12 col-md-6 ">

                        <h3 class="text-themecolor">Add Company</h3>

                        <form class="form-horizontal" autocomplete="off" id="addcompanyform" method="post" >

                            @csrf

                            <div class="form-group" >

                                <label>Company Name</label>

                                <input type="text" name="companyname" id="companyname" class="form-control">

                            </div>

                            <div class="form-group">

                                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Add</button>

                            </div>

                        </form>

                    </div>

                    <!-- <div class="col-0 col-md-0 table-responsive"></div> -->

                    <div class="col-12 col-md-6 table-responsive">

                        <table class="table table-bordered companiesdata w-100 table-sm table-striped">

                            <thead class="bg-dark text-white">

                                <tr>

                                    <th>#</th>

                                    <th>Company Name</th>

                                    <th>Action</th>

                                </tr>

                            </thead>

                            <tbody>

                            </tbody>

                        </table>

                    </div>

                    <div class="Loader"></div>

                </div>



                <!-- Update company modal -->

                <div id="updatecompanymodal" class="modal fade pr-0" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-modal="true">

                    <div class="modal-dialog modal-dialog-slideout" role="document">

                        <div class="modal-content">

                            <div class="modal-header">

                                <h4 class="modal-title" id="myModalLabel">Update Company</h4>

                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                            </div>

                            <div class="modal-body">

                                <form class="form-horizontal" autocomplete="off" id="updatecompanyform" method="post" enctype="multipart/form-data">

                                    <div class="form-group" >

                                        <label>Company Name</label>

                                        <input type="hidden" name="companyid" class="companyid"  id="companyid" value="">

                                        <input type="text" name="updatecompanyname" id="updatecompanyname" class="form-control">

                                    </div>

                                    <div class="Loader updatecompanyloader"></div>

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

   

    var tbl =  $('.companiesdata').DataTable({

        "pageLength": 10,

        "responsive": true,

        "processing" : true,

        "searching": false,

        "destroy": true,

        "ordering": false,

        "autoWidth": true,

        "columnDefs": [

            {"className" : 'text-center', "targets" : '_all'},

        //     { "width": "10%", "targets": 0 },

        //     { "width": "70%", "targets": 1 },
        //     { "width": "20%", "targets": 2 },

        ],

        // "order": [[ 1, 'asc' ]],

        "ajax": "{{ url('/companies/getallcompanies') }}",

        "columns": [

            {data: 'id', name: 'id'},

            {data: 'companyname', name: 'companyname'},

            {

                "data": "id",

                "render": function(data, type, row) {

                    return '<a href="#" id="editcompany" title="Edit Company" class="btn btn-sm btn-thm bg-dark" data-id="' + data + '"><span class="fa fa-edit"></span></a> <a href="#" id="deletecompany" title="Delete Company" class="btn btn-sm btn-thm bg-dark" data-id="' + data + '"><span class="fa fa-trash"></span></a>';

                }

            },

        ],

    });



    tbl.on('order.dt search.dt',function(){

        tbl.column(0, {search:'applied', order:'applied'}).nodes().each(function(cell, i){

            cell.innerHTML = i+1;

        });

    }).draw();

    $(document).on("click","#deletecompany",function(){

            var companyid = $(this).attr("data-id");

            var result = confirm("Are you sure?");

            if(result)

            {

                $(".Loader").show();
                $.ajax({

                    url:"{{ url('/companies/deletecompany')}}/"+companyid,

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

                            $('.companiesdata').DataTable().ajax.reload();  

                        }

                    }

                });

            }

        });





    $("#addcompanyform").validate({

            rules: {

                "companyname": {required: true},

            },

            messages: {

                "companyname": {required: "Please add the company name"},

            },

            submitHandler: function(){

                $(".Loader").show();

                var form = $('#addcompanyform')[0];

                var data = new FormData(form);

                $.ajax({

                    dataType:"json",

                    type:"post",

                    contentType: false,

                    processData: false,

                    data:data,

                    url:"{{ url('/companies/addcompany')}}",

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

                            $(".Loader").hide();

                        }

                        else if(data.success == "1")

                        {

                            $(".Loader").hide();

                            $('#addcompanyform').each(function(){ this.reset(); });

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

                             $('.companiesdata').DataTable().ajax.reload();  

                        }

                    }

                });

            }

        });



        $(document).on("click","#editcompany",function(){

            var companyid = $(this).attr("data-id");

            $(".updatecompanyloader").show();

            $.ajax({

                url:"{{ url('companies/selectcompany') }}/"+companyid,

                type:"get",

                dataType:"json",

                success:function(data){

                    if(data.success == "0")

                    {

                        $(".updatecompanyloader").hide();

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

                        $("#updatecompanyname").val(data.response.companyname);

                        $("#companyid").val(data.response.id);

                        $("#updatecompanymodal").modal("show");

                        $(".updatecompanyloader").hide();

                    }

                }

            });

        });



        $("#updatecompanyform").validate({

            rules: {

                "updatecompanyname": {required: true},

            },

            messages: {

                "updatecompanyname": {required: "Please enter the company name"},

            },

            submitHandler: function(){

                $(".updatecompanyloader").show();

                var form = $('#updatecompanyform')[0];

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

                    url:"{{ url('/companies/updatecompany')}}",

                    success: function(data)

                    {

                        if(data.success == "0"){

                            $.notify({

                                message: data.error 

                            },

                            {

                                type: 'danger',

                                placement: {

                                    from: "bottom",

                                    align: "left"

                                },

                                z_index: 9999999,

                                mouse_over: "pause",

                            });

                            $(".updatecompanyloader").hide();

                        }

                        else if(data.success == "1")

                        {

                            $(".updatecompanyloader").hide();

                            $("#updatecompanymodal").modal("hide");

                            $('#updatecompanyform').each(function(){ this.reset(); });

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

                             $('.companies').DataTable().ajax.reload();  

                        }

                    }

                });

            }

        });

</script>

</html>