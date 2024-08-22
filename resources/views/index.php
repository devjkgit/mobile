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
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon.png">
    <title>Portal</title>
    
    <!-- page css -->
    <link href="/dist/css/pages/login-register-lock.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/dist/css/style.min.css" rel="stylesheet">
    <link href="/assets/custom.css" rel="stylesheet">
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Portal</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper" class="login-register login-sidebar" style="background-image:url(../assets/images/background/login-register.jpg);">
        <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal form-material" id="loginform" action="#">
            <!-- <a href="javascript:void(0)" class="text-center db"><img src="../assets/images/logo-icon.png" alt="Home" /><br/><img src="../assets/images/logo-text.png" alt="Home" /></a> -->
            <h3 class="box-title m-t-40 m-b-0">Login</h3><small></small>
                    <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <input class="form-control" type="text"  placeholder="Username" id="Username" name="Username">
                        </div>
                        <div class="errorTxt1"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password"  placeholder="Password" id="Password" name="Password">
                        </div>
                        <div class="errorTxt3"></div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Remember me</label>
                                <a href="<?php echo base_url; ?>/Forgotpassword.php" id="" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Forgot pwd?</a> 
                            </div>     
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase btn-rounded" id="loginbutton" type="submit">Log In</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                            <div class="social">
                        <!--    <a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip" title="Login with Facebook"> <i aria-hidden="true" class="fa fa-facebook"></i> </a> -->
    <!-- <a href="<?php echo $login_url ;?>" style="width: 100%;" class="btn btn-googleplus" data-toggle="tooltip" title="Login with Google"> <i aria-hidden="true" class="fa fa-google-plus"></i> Google </a> </div> -->
                        </div>
                        
                    </div>
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            Don't have an account? <a href="<?php echo base_url; ?>/Register.php" class="text-primary m-l-5"><b>Sign Up</b></a>
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
                <!-- <form class="form-horizontal" id="recoverform" action="#">
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <h3>Recover Password</h3>
                            <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                        </div>
                    </div>
                </form> -->
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
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
                        Username: {required: true, minlength: 4},
                        Password: {required: true,},
                        
                       

                        },
                        
                    messages: {
                        Username: {required: "Please enter Username",minlength: "Your Username must consist at least 4 characters"},
                        Password: {required: "Please enter password"},
                       
                        
                         },
                         errorPlacement: function(error, element) 
                         {
                            if (element.attr("name") == "Username" )
                            {
                                error.insertAfter(".errorTxt1");
                            }
                            else if (element.attr("name") == "Password" )
                            {
                            error.insertAfter(".errorTxt3");
                            }
                            

                         },
                        submitHandler: function() 
                        {
                            $(".Loader").show();
                            var data = $("#loginform").serialize();
                            data= data + "&action=Login";

                            jQuery.ajax({
                            dataType:"json",
                            type:"post",
                            data:data,
                            url:'<?php echo EXEC; ?>/Exec_Registration.php',
                            success: function(data)
                            {
                                if(data.resonse)
                                {
                                    $("#resonse").show();
                                    $('#resonsemsg').html('<span>'+data.resonse+'</span>');
                                    $( '#loginform' ).each(function(){ this.reset(); });

                                    $(".Loader").hide();
                                     setTimeout(function () { window.location.href = "Dashboard.php"; }, 2000)    
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