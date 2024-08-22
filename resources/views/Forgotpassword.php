<?php require_once('function.php'); ?>

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from eliteadmin.themedesigner.in/demos/bt4/material/pages-login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 07 May 2018 05:33:17 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url ;?>/assets/images/favicon.png">
    <title>Khalaf - Admin</title>
    
    <!-- page css -->
    <link href="<?php echo base_url ;?>/dist/css/pages/login-register-lock.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url ;?>/dist/css/style.min.css" rel="stylesheet">
    <link href="<?php echo base_url ;?>/assets/custom.css" rel="stylesheet">
    
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Khalaf</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper" class="login-register login-sidebar" style="background-image:url(../assets/images/background/login-register.jpg);">
        <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal form-material" id="forgotform" action="#">
            <!-- <a href="javascript:void(0)" class="text-center db"><img src="../assets/images/logo-icon.png" alt="Home" /><br/><img src="../assets/images/logo-text.png" alt="Home" /></a> -->
            <h3 class="box-title m-t-40 m-b-0">Forgot Password</h3><small></small>
                    <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <input class="form-control" type="text"  placeholder="Email" id="Email" name="Email">
                        </div>
                        <div class="errorTxt1"></div>
                    </div>
                    
                    
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase btn-rounded" type="submit">Send</button>
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


        $("#forgotform").validate({
                    rules: {
                        Email: {required: true,},
                        
                        
                       

                        },
                        
                    messages: {
                        Email: {required: "Please enter  email"},
                       
                        
                         },
                         errorPlacement: function(error, element) 
                         {
                            if (element.attr("name") == "Email" )
                            {
                                error.insertAfter(".errorTxt1");
                            }
                            
                         },
                        submitHandler: function() 
                        {
                            $(".Loader").show();
                            var data = $("#forgotform").serialize();
                            data= data + "&action=ForgotPassword";

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
                                     setTimeout(function () { window.location.href = "index.php"; }, 2000)    
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


<!-- Mirrored from eliteadmin.themedesigner.in/demos/bt4/material/pages-login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 07 May 2018 05:33:17 GMT -->
</html>