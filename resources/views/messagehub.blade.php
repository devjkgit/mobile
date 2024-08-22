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
            <p class="loader__label">Caremobile Portal</p>
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
                        <h3 class="text-themecolor">Message Hub</h3>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Message Hub</li>
                            </ol>
                            <!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button> -->
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12" align="right">
                        <button id="sendbtn" class="btn btn-dark" data-toggle="modal">Send Notification</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-bordered msgdata w-100 table-sm table-striped">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <!-- <th><input type="checkbox" name="check"> Check All</th> -->
                                    <th><input type="checkbox" class="checkall" label="Check All" /></th>
                                    <th>CarerID</th>
                                    <th>Branch Name</th>
                                    <th>Name</th>
                                    <th>Contact No.</th>
                                    <th>Email</th>
                                    <th>Action</th>
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
                                <h4 class="modal-title" id="myModalLabel">Send Message</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" autocomplete="off" id="adduserform" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group" >
                                        <label>Name</label>
                                        <input type="text" name="name" class="div-tag form-control">
                                        <!-- <p id="checkid"></p> -->
                                    </div>
                                    <div class="form-group" >
                                        <label>Title</label>
                                        <input type="text" name="title" id="title" class="form-control">
                                    </div>
                                    <div class="form-group" >
                                        <label>Message</label>
                                        <textarea class="form-control" rows="10" name="message"></textarea>
                                    </div>
                                    <div class="Loader adduserloader"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Send</button>
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
    var tbl = $('.msgdata').DataTable({
        "pageLength": 20,
        "responsive": true,
        "processing" : true,
        "destroy": true,
        "ordering": false,
        "autoWidth": false,
        "columnDefs": [
            {"className" : 'text-center', "targets" : '_all'},
            { "width": "15%", "targets": 0 },
            { "width": "15%", "targets": 1 },
            { "width": "15%", "targets": 2 },
            { "width": "15%", "targets": 3 },
            { "width": "15%", "targets": 4 },
            { "width": "15%", "targets": 5 },
            { "width": "15%", "targets": 6 },
        ],
        "ajax": "{{ url('/messagehub/getallcarers') }}",
        "columns": [
            {
                "data": "CarerID",
                "render": function(data, type, row) {
                    return "<input type='checkbox' class='checkboxes' name='msg[]' value='"+data+"'>";
                }
            },
            {data: 'CarerID', name: 'CarerID'},
            {data: 'BranchName', name: 'BranchName'},
            // {data: 'Title', name: 'Title'},
            {
                "data": {Title:"Title",Forename:"Forename",Surname:"Surname"},className: 'abc text-center',
                "render": function (data, type, full, meta){
                    return data.Title+" "+data.Forename+" "+data.Surname;
                }
            },
            {data: 'Telephone', name: 'Telephone'},
            {data: 'email', name: 'email'},
            {
                "data": "CarerID",
                "render": function(data, type, row) {
                    // return '#';
                    return "<a href='/messageview/"+data+"'><button class='btn btn-dark btn-sm'><i class='fa fa-eye'></i></button></a>";
                }
            },
        ],
    });

    $(document).ready(function(){

        $('.checkall').click(function() {
            $('.checkboxes').prop('checked', this.checked);
        });

        $("#sendbtn").click(function() {

            if($("input[name='msg[]']:checked").length > 0)
            {
                // var arr=[];
                
                $.each($("input[name='msg[]']:checked"), function() {

                    $('.div-tag').tagsinput({
                        allowDuplicates: false,
                        itemValue: 'id',  // this will be used to set id of tag
                        itemText: 'label' // this will be used to set text of tag
                    });
                    $('.div-tag').tagsinput('add', { id: $(this).val(), label: $(this).parent().parent().find('.abc').text() });
                    $('.bootstrap-tagsinput').addClass('form-control');
                    $('.bootstrap-tagsinput').children().children().remove();
                   
                });
                $("#addusermodal").modal("show");
            }
            else if($("input[name='msg[]']:checked").length == 0)
            {

                $("#addusermodal").modal('hide');

                swal('Please select','A carer to send Message!');

            }
              
        }); 

        // var p = $("#addusermodal #checkid");
            // var input = $("#addusermodal #username");
            // // $(p).html("you have selected:");
            // $.each($("input[name='msg[]']:checked"), function() {
            //     $(p).html($(p).html() + '<br>' + $(this).val());
            //     console.log($(this).parent().parent().find('.abc').text());
            //     $(input).val($(this).parent().parent().find('.abc').text());
            // });    

        $("#adduserform").validate({
            rules: {
                "name": {required: true},
                "title": {required: true},
                "message": {required: true},
            },
            messages: {
                "name": {required: "Please select the username."},
                "title": {required: "Please enter the title."},
                "message": {required: "Please enter the message."},
            },
            submitHandler: function(){
                $(".adduserloader").show();
                var form = $('#adduserform')[0];
                var data = new FormData(form);
                $.ajax({
                    dataType:"json",
                    type:"post",
                    contentType: false,
                    processData: false,
                    data:data,
                    url:"{{ url('/messagehub/addmsg')}}",
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
                            $(".adduserloader").hide();
                        }
                        else if(data.success == "1")
                        {
                            $(".adduserloader").hide();
                            $("#addusermodal").modal("hide");
                            $('#adduserform').each(function(){ this.reset(); });
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
                             $('.usersdata').DataTable().ajax.reload();  
                        }
                    }
                });
            }
        });
    });
</script>
</html>