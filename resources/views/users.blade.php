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
                        <button type="button" data-toggle="modal" data-target="#addusermodal" class="btn waves-effect waves-light btn-secondary ">+ Add User</button>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active">Users</li>
                            </ol>
                            <!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button> -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-bordered usersdata w-100 table-sm table-striped">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
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
                <!-- Add User modal -->
                <div id="addusermodal" class="modal fade pr-0" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-modal="true">
                    <div class="modal-dialog modal-dialog-slideout" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Create User</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" autocomplete="off" id="adduserform" method="post" enctype="multipart/form-data">
                                    <div class="form-group" >
                                        @csrf
                                        <label>Username</label>
                                        <input type="text" name="username" id="username" class="form-control">
                                    </div>
                                    <div class="form-group" >
                                        <label>Email</label>
                                        <input type="text" name="email" id="email" class="form-control">
                                    </div>
                                    <div class="form-group" >
                                        <label>Role</label>
                                        <select class="form-control selectpicker" id="role" name="role">
                                            <option value="" hidden disabled selected>Select</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Subadmin">Sub Admin</option>
                                            <option value="User">User</option>
                                        </select>
                                    </div>
                                    <div class="form-group" >
                                        <label>Status</label>
                                        <select class="form-control selectpicker" id="status" name="status">
                                            <option value="" hidden disabled selected>Select</option>
                                            <option value="0">Active</option>
                                            <option value="1">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="form-group" >
                                        <label>Password</label>
                                        <input type="password" name="password" id="password" class="form-control">
                                    </div>
                                    <div class="form-group" >
                                        <label>Confirm Password</label>
                                        <input type="password" name="confirmpassword" id="confirmpassword" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Profile Image</label>
                                        <input type="file" class="profileimage" name="profileimage" id="profileimage" />
                                    </div>
                                    <div class="Loader adduserloader"></div>
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
                                <h4 class="modal-title" id="myModalLabel">Update User</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" autocomplete="off" id="updateuserform" method="post" enctype="multipart/form-data">
                                    <div class="form-group" >
                                        @csrf
                                        <label>Username</label>
                                        <input type="hidden" name="userid" class="userid"  id="userid" value="">
                                        <input type="text" name="username" id="updateusername" class="form-control">
                                    </div>
                                    <div class="form-group" >
                                        <label>Email</label>
                                        <input type="text" name="email" id="updateemail" class="form-control">
                                    </div>
                                    <div class="form-group" >
                                        <label>Role</label>
                                        <select class="form-control selectpicker" id="updaterole" name="role">
                                            <option value="" hidden disabled selected>Select</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Subadmin">Sub Admin</option>
                                            <option value="User">User</option>
                                        </select>
                                    </div>
                                    <div class="form-group" >
                                        <label>Status</label>
                                        <select class="form-control selectpicker" id="updatestatus" name="status">
                                            <option value="" hidden disabled selected>Select</option>
                                            <option value="0">Active</option>
                                            <option value="1">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="form-group" >
                                        <label>New-Password</label>
                                        <input type="password" name="password" id="updatepassword" class="form-control">
                                    </div>
                                    <div class="form-group" >
                                        <label>Confirm Password</label>
                                        <input type="password" name="confirmpassword" id="updateconfirmpassword" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Profile Image</label>
                                        <input type="file" class="profileimage" name="profileimage" id="updateprofileimage" />
                                    </div>
                                    <div class="Loader updateuserloader"></div>
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
    $('.usersdata').DataTable({
        "pageLength": 20,
        "responsive": true,
        "processing" : true,
        "destroy": true,
        "ordering": false,
        "autoWidth": true,
        "columnDefs": [
            {"className" : 'text-center', "targets" : '_all'},
        ],
        "ajax": "{{ url('/users/getallusers') }}",
        "columns": [
            {data: 'id', name: 'id'},
            {data: 'username', name: 'username'},
            {data: 'email', name: 'email'},
            {data: 'role', name: 'role'},
            {
                "data":"active",
                "render": function(data, type, full, meta){
                    if(data == "0"){
                        return "Active";
                    }
                    else if(data == "1"){
                        return "Inactive";
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
                    return '<a href="#" id="edituser" title="Edit User" class="btn btn-sm btn-thm bg-dark" data-id="' + data + '"><span class="fa fa-edit"></span></a> <a href="#" id="deleteuser" title="Delete User" class="btn btn-sm btn-thm bg-dark" data-id="' + data + '"><span class="fa fa-trash"></span></a>';
                }
            },
        ],
    });
    $(document).ready(function(){
        $(document).on("click","#edituser",function(){
            var userid = $(this).attr("data-id");
            $(".Loader").show();
            $.ajax({
                url:"{{ url('/users/selectuser') }}/"+userid,
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
                        if(data.response.role == "Admin")
                            $('.udpatebranchdiv').hide();
                        else
                            $('.udpatebranchdiv').show();
                        $("#updateusername").val(data.response.username);
                        $("#updateemail").val(data.response.email);
                        $("#updaterole").val(data.response.role);
                        $("#updaterole").selectpicker("refresh");
                        $("#updatestatus").val(data.response.active);
                        $("#updatestatus").selectpicker("refresh");
                        if(data.response.branch != null)
                        {
                            $("#updatebranch").selectpicker("val",data.response.branch.split(','));
                            $("#updatebranch").selectpicker("refresh");
                        }
                        else
                        {
                            $("#updatebranch").selectpicker("val",data.response.branch);
                            $("#updatebranch").selectpicker("refresh");
                        }
                        $("#userid").val(data.response.id);
                        $('.dropify-render img').remove();
                        if(data.response.profileimage != "")
                        {
                            $('#updateuserform .dropify-render img').first().remove();
                            $('#updateuserform .dropify-preview,#updateuserform .dropify-clear').css('display','block');
                            $('<img src="public/assets/images/profileimage/'+data.response.profileimage+'">').appendTo("#updateuserform .dropify-render");
                            $('#updateuserform .dropify-filename-inner').text(data.response.profileimage);
                        }
                        $("#updateusermodal").modal("show");
                        $(".Loader").hide();
                    }
                }
            });
        });
        $(document).on("click","#deleteuser",function(){
            var userid = $(this).attr("data-id");
            var result = confirm("Are you sure?");
            if(result)
            {
                $(".Loader").show();
                $.ajax({
                    url:"{{ url('/users/deleteuser')}}/"+userid,
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
                            $('.usersdata').DataTable().ajax.reload();  
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
        $("#adduserform").validate({
            rules: {
                "username": {required: true},
                "email": {required: true,email: true},
                "role": {required: true},
                "branch[]": {required: true},
                "password": {required: true,minlength: 8},
                "confirmpassword": {required: true,equalTo :'[name="password"]'},
            },
            messages: {
                "username": {required: "Please enter the username."},
                "email": {required: "Please enter email.",email:"Please enter valid email address."},
                "role": {required: "Please select the role."},
                "branch[]": {required: "Please select the branch."},
                "password": {required: "Please enter password.", minlength:"Your password must be greater than 8 characters."},
                "confirmpassword": {required: "Please re-enter your password.",equalTo:"Confirm password must be the same."},
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
                    url:"{{ url('/users/adduser')}}",
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
        $("#updateuserform").validate({
            rules: {
                "username": {required: true},
                "email": {required: true,email: true},
                "role": {required: true},
                "branch[]": {required: true},
                "password": {minlength: 8},
                "confirmpassword": {equalTo :'#updatepassword'},
            },
            messages: {
                "username": {required: "Please enter the username."},
                "email": {required: "Please enter email.",email:"Please enter valid email address."},
                "role": {required: "Please select the role."},
                "branch[]": {required: "Please select the branch."},
                "password": {minlength:"Your password must be greater than 8 characters."},
                "confirmpassword": {equalTo:"Confirm password must be the same."},
            },
            submitHandler: function(){
                $(".updateuserloader").show();
                var form = $('#updateuserform')[0];
                var data = new FormData(form);
                $.ajax({
                    dataType:"json",
                    type:"post",
                    contentType: false,
                    processData: false,
                    data:data,
                    url:"{{ url('/users/updateuser')}}",
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
                            $(".updateuserloader").hide();
                            $("#updateusermodal").modal("hide");
                            $('#updateuserform').each(function(){ this.reset(); });
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
                            setTimeout(function () { location.reload(); }, 1000);
                        }
                    }
                });
            }
        });
    });
</script>
</html>