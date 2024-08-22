<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('/assets/images/favicon.png') }}">
    <title>Admin Panel</title>
    
    <!-- page css -->
    <link href="public/dist/css/pages/login-register-lock.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="public/dist/css/style.min.css" rel="stylesheet">
    <link href="public/assets/custom.css" rel="stylesheet">
</head>
<body>
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Admin Panel</p>
        </div>
    </div>
    <section id="wrapper" class="login-register login-sidebar" style="background-image:url('public/assets/images/background/login-register.jpg');">
        <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal form-material" id="loginform" action="#">
                    @csrf
                    <h3 class="box-title m-t-40 m-b-0">Login</h3><small></small>
                    <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <input class="form-control" type="text"  placeholder="Username" id="username" name="username">
                        </div>
                        <div class="errorTxt1"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password"  placeholder="Password" id="password" name="password">
                        </div>
                        <div class="errorTxt3"></div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <a href="/" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Forgot Password?</a> 
                            </div>     
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase btn-rounded" id="loginbutton" type="submit">Log In</button>
                        </div>
                    </div>
                    <div class="Loader"></div>
                </form>
                <div class="col-lg-12 col-md-12" style="padding: 10px 0;">
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
            </div>
        </div>
    </section>
    <script src="public/assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="public/assets/node_modules/popper/popper.min.js"></script>
    <script src="public/assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="public/assets/node_modules/wizard/jquery.validate.min.js"></script>
    <!--Custom JavaScript -->
    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
    </script>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#loginform").validate({
            rules: {
                username: {required: true, minlength: 4},
                password: {required: true,},
            },
            messages: {
                username: {required: "Please enter Username",minlength: "Your Username must consist at least 4 characters"},
                password: {required: "Please enter password"},
            },
            errorPlacement: function(error, element) 
            {
                if(element.attr("name") == "username" )
                {
                    error.insertAfter(".errorTxt1");
                }
                else if(element.attr("name") == "password" )
                {
                    error.insertAfter(".errorTxt3");
                }
            },
            submitHandler: function() 
            {
                // $(".Loader").show();
                var data = $("#loginform").serialize();
                jQuery.ajax({
                    dataType:"json",
                    type:"post",
                    data:data,
                    url:"{{ url('admin/loginuser') }}",
                    success: function(data)
                    {
                        if(data.response)
                        {
                            $("#resonse").show();
                            $('#resonsemsg').html('<span>'+data.response+'</span>');
                            $( '#loginform' ).each(function(){ this.reset(); });

                            $(".Loader").hide();
                             setTimeout(function () { window.location.href = "/admin/dashboard"; }, 500)    
                        }
                        else if(data.error)
                        {
                            $("#error").show();
                            $('#errormsg').html('<span>'+data.error+'</span>');
                            $(".Loader").hide();
                            // alert('<li>'+data.error+'</li>');
                        }
                    }
                });
            }
        });
    });
</script>
</body>
</html>