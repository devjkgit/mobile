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
            <p class="loader__label">Mobile Data</p>
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
                        <h3 class="text-themecolor">Profile</h3>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                            <!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button> -->
                        </div>
                    </div>
                </div>

                
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card"> <img class="card-img" src="/assets/images/profileimage/profilebackground.jpg" height="300" alt="Card image">
                            <div class="card-img-overlay card-inverse text-white social-profile d-flex justify-content-center">
                                <div class="align-self-center"> 
                                    @if(Auth::user()->profileimage != "")
                                        <img src="{{ url('assets/images/profileimage/'.Auth::user()->profileimage) }}" class="img-circle" width="100" height="100">
                                    @else
                                        <img src="{{ url('assets/images/profileimage/user2.png') }}" class="img-circle" width="100" height="100">
                                    @endif
                                                                        
                                    <h4 class="card-title" style="margin-top: 15px;">{{ Auth::user()->username }}</h4>
                                    <p class="text-white">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="Loader"></div>
                        <!-- <div class="card">
                            <div class="card-body"> 
                                <small class="text-muted">Email address</small><h6>{{ Auth::user()->email }}</h6> 
                                <small class="text-muted p-t-30 db">Branch</small><h6>{{ Auth::user()->email }}</h6>
                            </div>
                        </div> -->
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Edit Username</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Edit Profile Image</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Change Password</a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                    <div class="card-body">
                                        <form class="form-horizontal form-material" id="updatename" method="post" style="margin-top: 43px;">
                                            
                                            @csrf
                                        
                                            <input type="hidden" name="id" id="usernameid" value="{{ Auth::user()->id }}">

                                            
                                            <div class="form-group">
                                                <label for="example-email">Username *</label>
                                                <input type="text" id="username" name="username" value="{{ Auth::user()->username }}" class="form-control" value="">
                                            </div>
                                            
                                
                                            <div class="form-group">
                                                <button class="btn btn-success" id="btnusername" type="submit" style="margin-top: 20px;">Update Username</button>
                                            </div>
                                        
                                        </form>
                                    
                                    </div>
                                </div>

                                <!--second tab-->
                                <div class="tab-pane" id="profile" role="tabpanel">
                                    <div class="card-body">
                                        
                                        <form class="form-horizontal" method="post" id="updateimage" enctype="multipart/form-data">

                                            @csrf

                                            <input type="hidden" name="id" id="imageid" value="{{ Auth::user()->id }}">

                                            <div class="form-group">
                                                <label>Profile Image</label>
                                                <input type="file" class="profileimage" name="profileimage" id="updateprofileimage" />
                                            </div>
                                            <div class="Loader updateuserloader"></div>

                                            <div class="form-group">
                                                <button class="btn btn-success" id="btnimage" type="button">Update Profile Image</button>
                                                @if(Auth::user()->profileimage != "")
                                                <button class="btn btn-danger" id="removeprofile" type="button">Remove Profile Image</button>
                                                @endif
                                            </div>
                                            
                                        </form>
                                        
                                        
                                    </div>
                                </div>

                                <div class="tab-pane" id="settings" role="tabpanel">
                                    <div class="card-body">

                                        <form class="form-horizontal form-material" id="updatepwd" method="post">

                                            @csrf
                                            
                                            <input type="hidden" name="id" id="passwordid" value="{{ Auth::user()->id }}">

                                            <div class="form-group m-t-40">
                                                <label>Old Password *</label>
                                                <div class="col-xs-12">
                                                    <input class="form-control" type="password" id="oldpwd" name="oldpwd">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>New Password *</label>
                                                <div class="col-xs-12">
                                                    <input class="form-control" type="password" id="newpwd" name="newpwd">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Confirm Password *</label>
                                                <div class="col-xs-12">
                                                    <input class="form-control" type="password" id="confirmpwd" name="confirmpwd">
                                                </div>
                                            </div>
                                                        
                                            <div class="form-group m-t-40">
                                                <div class="col-xs-12">
                                                    <button class="btn btn-success" id="btnpwd" type="submit">Change Password</button>
                                                </div>
                                            </div>

                                        </form>
                                       
                                    </div>
                                </div>
                        </div>
                    </div>
                    </div>
                    <!-- Column -->
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
    
    
    $(document).ready(function(){

        $("#updatename").validate({
            rules: {
                username: {
                    required: true
                }
            },
            messages: {
                username: {
                    required: "* Please enter username."
                }
            },
            submitHandler: function(){
                var username = "{{ Auth::user()->username }}";
                if($("#username").val() == username )
                {
                    alert("You have not update the username yet")
                    return false;
                }
                else{    
                $(".Loader").show();
                var form = $('#updatename')[0];
                var data = new FormData(form);
                $.ajax({
                    type:"post",                
                    dataType:"json", 
                    contentType: false,
                    processData: false,
                    data: data,
                    url:"{{ url('/users/profilename') }}",
                    success:function(data){
                        
                        if(data.success == "0"){
                            $(".Loader").hide();
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
                            // $(".adduserloader").hide();
                        }
                        else if(data.success == "1")
                        {
                            $(".Loader").hide();
                            $('#updatename').each(function(){ this.reset(); });
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
                        }
                        
                        }
                    });
                }
            }
        });


    
        $(document).on("click","#btnimage",function(){
            
           $(".Loader").show();
            var form = $('#updateimage')[0];
            var data = new FormData(form);
            
            $.ajax({
                type:"post",                
                dataType:"json", 
                contentType: false,
                processData: false,
                data: data,
                url:"{{ url('/users/changeimage') }}",
                success:function(data){
                    if(data.success == "0"){
                        $(".Loader").hide();
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
                        // $(".adduserloader").hide();
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
                        // setTimeout(function () { window.location.href = "https://watsdoc.com/users/profile"; }, 1000);
                        location.reload();
                    }
                    
                }
            });
        });

        $(document).on("click","#removeprofile",function(){
            $(".Loader").show();
            $.ajax({
                type:"get",                
                dataType:"json", 
                contentType: false,
                processData: false,
                url:"{{ url('/users/removeprofile') }}",
                success:function(data){
                    if(data.success == "0"){
                        $(".Loader").hide();
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
                        // $(".adduserloader").hide();
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
                        // setTimeout(function () { window.location.href = "https://watsdoc.com/users/profile"; }, 1000);
                        location.reload();
                    }
                    
                }
            });
        });

        $('#updateprofileimage').dropify({
            messages: {
                'default': 'Drag and drop a profile image here or click',
                'replace': 'Drag and drop or click to replace',
                'remove':  'Remove',
                'error':   'Ooops, something wrong happended.'
            }
        });

        $("#updatepwd").validate({
            rules: {
                oldpwd: {
                    required: true,
                    minlength: 8
                },
                newpwd: {
                    required: true,
                    minlength: 8
                },
                confirmpwd: {
                    required: true,
                    minlength: 8,
                    equalTo : newpwd
                }
            },
            messages: {
                oldpwd: {
                    required: "* Please enter old password.",
                    minlength: "* Password must be at least 8 characters long."
                },
                newpwd: {
                    required: "* Please enter new password.",
                    minlength: "* Password must be at least 8 characters long."
                },
                confirmpwd: {
                    required: "* Please enter confirm password.",
                    minlength: "* Password must be at least 8 characters long.",
                    equalTo: "* Confirm Password is not matched with New Password."
                }
            },
            submitHandler: function(){
                $(".Loader").show();
                var form = $('#updatepwd')[0];
                var data = new FormData(form);
                
                $.ajax({
                    type:"post",                
                    dataType:"json", 
                    contentType: false,
                    processData: false,
                    data: data,
                    url:"{{ url('/users/changepwd') }}",
                    success:function(data){
                        if(data.success == "0")
                        {
                            $(".Loader").hide();
                            // $('#updatepwd').each(function(){ });
                            
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
                        }
                        else if(data.success == "1")
                        {
                            $(".Loader").hide();
                            $('#updatepwd').each(function(){ this.reset(); });
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
                        }
                        
                        }
                    });
            }
        });

        // $(document).on("click","#edituser",function(){
        //     var userid = $(this).attr("data-id");
        //     $(".Loader").show();
        //     $.ajax({
        //         url:"{{ url('users/selectuser') }}/"+userid,
        //         type:"get",
        //         dataType:"json",
        //         success:function(data){
        //             if(data.success == "0")
        //             {
        //                 $(".Loader").hide();
        //                 $.notify({
        //                     message: data.error 
        //                 },{
        //                     type: 'danger',
        //                     placement: {
        //                         from: "bottom",
        //                         align: "left"
        //                     },
        //                     z_index: 9999999,
        //                     mouse_over: "pause",
        //                 });
        //             }
        //             else
        //             {
        //                 if(data.response.role == "Admin")
        //                     $('.udpatebranchdiv').hide();
        //                 else
        //                     $('.udpatebranchdiv').show();

        //                 $("#updateusername").val(data.response.username);
        //                 $("#updateemail").val(data.response.email);
        //                 $("#updaterole").val(data.response.role);
        //                 $("#updaterole").selectpicker("refresh");
                        
                    
        //                 if(data.response.branch != null)
        //                 {
        //                     $("#updatebranch").selectpicker("val",data.response.branch.split(','));
        //                     $("#updatebranch").selectpicker("refresh");
        //                 }
        //                 else
        //                 {
        //                     $("#updatebranch").selectpicker("val",data.response.branch);
        //                     $("#updatebranch").selectpicker("refresh");
        //                 }
                        

        //                 $("#userid").val(data.response.id);
        //                 $('.dropify-render img').remove();
        //                 if(data.response.profileimage != null)
        //                 {
        //                     $('#updateuserform .dropify-render img').first().remove();
        //                     $('#updateuserform .dropify-preview,#updateuserform .dropify-clear').css('display','block');
        //                     $('<img src="public/assets/images/profileimage/'+data.response.profileimage+'">').appendTo("#updateuserform .dropify-render");
        //                     $('#updateuserform .dropify-filename-inner').text(data.response.profileimage);
        //                 }
        //                 $("#updateusermodal").modal("show");
        //                 $(".Loader").hide();
        //             }
        //         }
        //     });
        // });

        // $(document).on("click","#deleteuser",function(){
        //     var userid = $(this).attr("data-id");
        //     var result = confirm("Are you sure?");
        //     if(result)
        //     {
        //         $(".Loader").show();
        //         $.ajax({
        //             url:"{{ url('/users/deleteuser')}}/"+userid,
        //             type:"get",
        //             dataType:"json",
        //             success:function(data){
        //                 if(data.success == "0"){
        //                     $.notify({
        //                         message: data.error 
        //                     },{
        //                         type: 'danger',
        //                         placement: {
        //                             from: "bottom",
        //                             align: "left"
        //                         },
        //                         z_index: 9999999,
        //                         mouse_over: "pause",
        //                     });
        //                     $(".Loader").hide();
        //                 }
        //                 else if(data.success == "1")
        //                 {
        //                     $(".Loader").hide();
        //                     $.notify({
        //                         message: data.response 
        //                     },
        //                     {
        //                         type: 'success',
        //                         placement: {
        //                             from: "bottom",
        //                             align: "left"
        //                         },
        //                         z_index: 9999999,
        //                         mouse_over: "pause",
        //                     });
        //                     $('.usersdata').DataTable().ajax.reload();  
        //                 }
        //             }
        //         });
        //     }
        // });

        // $('.profileimage').dropify({
        //     messages: {
        //         'default': 'Drag and drop a profile image here or click',
        //         'replace': 'Drag and drop or click to replace',
        //         'remove':  'Remove',
        //         'error':   'Ooops, something wrong happended.'
        //     }
        // });

        // $('.updateprofileimage').dropify({
        //     messages: {
        //         'default': 'Drag and drop a profile image here or click',
        //         'replace': 'Drag and drop or click to replace',
        //         'remove':  'Remove',
        //         'error':   'Ooops, something wrong happended.'
        //     }
        // });

        // $("#adduserform").validate({
        //     rules: {
        //         "username": {required: true},
        //         "email": {required: true,email: true},
        //         "role": {required: true},
        //         "password": {required: true,minlength: 8},
        //         "confirmpassword": {required: true,equalTo :'[name="password"]'},
        //     },
        //     messages: {
        //         "username": {required: "Please enter the username."},
        //         "email": {required: "Please enter email.",email:"Please enter valid email address."},
        //         "role": {required: "Please select the role."},
        //         "password": {required: "Please enter password.", minlength:"Your password must be greater than 8 characters."},
        //         "confirmpassword": {required: "Please re-enter your password.",equalTo:"Confirm password must be the same."},
        //     },
        //     submitHandler: function(){
        //         $(".adduserloader").show();
        //         var form = $('#adduserform')[0];
        //         var data = new FormData(form);
        //         $.ajax({
        //             dataType:"json",
        //             type:"post",
        //             contentType: false,
        //             processData: false,
        //             data:data,
        //             url:"{{ url('/users/adduser')}}",
        //             success: function(data)
        //             {
        //                 if(data.success == "0"){
        //                     $.each(data.error, function(key, value){
        //                         $.notify({
        //                             message: value 
        //                         },{
        //                             type: 'danger',
        //                             placement: {
        //                                 from: "bottom",
        //                                 align: "left"
        //                             },
        //                             z_index: 9999999,
        //                             mouse_over: "pause",
        //                         });
        //                     });
        //                     $(".adduserloader").hide();
        //                 }
        //                 else if(data.success == "1")
        //                 {
        //                     $(".adduserloader").hide();
        //                     $("#addusermodal").modal("hide");
        //                     $('#adduserform').each(function(){ this.reset(); });
        //                     $.notify({
        //                         message: data.response 
        //                     },
        //                     {
        //                         type: 'success',
        //                         placement: {
        //                             from: "bottom",
        //                             align: "left"
        //                         },
        //                         z_index: 9999999,
        //                         mouse_over: "pause",
        //                     });
        //                      $('.usersdata').DataTable().ajax.reload();  
        //                 }
        //             }
        //         });
        //     }
        // });

        // $("#updateuserform").validate({
        //     rules: {
        //         "username": {required: true},
        //         "email": {required: true,email: true},
        //         "role": {required: true},
        //         "password": {minlength: 8},
        //         "confirmpassword": {equalTo :'#updatepassword'},
        //     },
        //     messages: {
        //         "username": {required: "Please enter the username."},
        //         "email": {required: "Please enter email.",email:"Please enter valid email address."},
        //         "role": {required: "Please select the role."},
        //         "password": {minlength:"Your password must be greater than 8 characters."},
        //         "confirmpassword": {equalTo:"Confirm password must be the same."},
        //     },
        //     submitHandler: function(){
        //         $(".updateuserloader").show();
        //         var form = $('#updateuserform')[0];
        //         var data = new FormData(form);
        //         $.ajax({
        //             dataType:"json",
        //             type:"post",
        //             contentType: false,
        //             processData: false,
        //             data:data,
        //             url:"{{ url('/users/updateuser')}}",
        //             success: function(data)
        //             {
        //                 if(data.success == "0"){
        //                     $.each(data.error, function(key, value){
        //                         $.notify({
        //                             message: value 
        //                         },{
        //                             type: 'danger',
        //                             placement: {
        //                                 from: "bottom",
        //                                 align: "left"
        //                             },
        //                             z_index: 9999999,
        //                             mouse_over: "pause",
        //                         });
        //                     });
        //                     $(".updateuserloader").hide();
        //                 }
        //                 else if(data.success == "1")
        //                 {
        //                     $(".updateuserloader").hide();
        //                     $("#updateusermodal").modal("hide");
        //                     $('#updateuserform').each(function(){ this.reset(); });
        //                     $.notify({
        //                         message: data.response 
        //                     },
        //                     {
        //                         type: 'success',
        //                         placement: {
        //                             from: "bottom",
        //                             align: "left"
        //                         },
        //                         z_index: 9999999,
        //                         mouse_over: "pause",
        //                     });
        //                     setTimeout(function () { location.reload(); }, 1000);
        //                 }
        //             }
        //         });
        //     }
        // });
    });
</script>
</html>