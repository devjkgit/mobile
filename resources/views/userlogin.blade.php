<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/png" sizes="16x16" href="public/assets/images/favicon.png">
        <title>User - Login</title>
        <link rel="manifest" href="manifest.json">
        <link rel="icon" href="favicon.ico" type="image/x-icon" />  
        <link rel="apple-touch-icon" href="images/hello-icon-152.png">   
        <meta name="apple-mobile-web-app-capable" content="yes">  
        <meta name="apple-mobile-web-app-status-bar-style" content="black"> 
        <meta name="apple-mobile-web-app-title" content="Hello World"> 
        <meta name="msapplication-TileImage" content="images/hello-icon-144.png">  
        <meta name="msapplication-TileColor" content="#FFFFFF">
        <meta name="theme-color" content="white"/>  
        <link href="public/assets/node_modules/register-steps/steps.css" rel="stylesheet">
        <link href="public/dist/css/pages/register3.css" rel="stylesheet">
        <link href="public/assets/custom.css" rel="stylesheet">
        <link href="public/dist/css/style.min.css" rel="stylesheet">
        <link href="public/dist/css/pages/login-register-lock.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="public/dist/css/style.min.css" rel="stylesheet">
        <link href="public/assets/custom.css" rel="stylesheet">
    </head>
    <body class="skin-default card-no-border" data-new-gr-c-s-check-loaded="14.997.0" data-gr-ext-installed="" cz-shortcut-listen="true">
                            <div class="Loader" style="top: 50%;left:50%"></div>
        <div class="preloader" style="display: none;">
            <div class="loader">
                <div class="loader__figure"></div>
            </div>
        </div>
        <section id="wrapper" class="step-register">
            <div class="register-box">
                <div class="">
                    <!-- <a href="javascript:void(0)" class="text-center m-b-40"><img src="../assets/images/logo-icon.png" alt="Home"><br><img src="../assets/images/logo-text.png" alt="Home"></a> -->
                    <!-- multistep form -->
                    <form id="msform" class="loginform" action="#">
                        @csrf
                        <fieldset>
                            <h2 class="fs-title">Login to your account.</h2>
                            <div class="Username">
                                 <input class="form-control" type="text"  placeholder="Username" id="username" name="username">
                                 <div class="errorTxt1"></div>
                             </div>
                            <div class="password">
                                <input class="form-control" type="password"  placeholder="Password" id="password" name="password">
                                <div class="errorTxt3"></div>
                            </div>
                            <button class="action-button" id="loginbutton" type="submit">Log In</button>
                            <!-- <input type="button" name="next" class="action-button" value="Next"> -->
                        </fieldset>
                    </form>
                    <div class="col-lg-12 col-md-12" style="padding: 10px 0;">
                        <div class="alert alert-success" id="resonse" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                            <h3 class="text-success"><i class="fa fa-check-circle"></i> Success</h3>
                            <p id="resonsemsg"></p>
                        </div>
                        <div class="alert alert-danger" id="error" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                            <h3 class="text-danger"><i class="fa fa-exclamation-circle"></i> Information </h3>
                            <p id="errormsg"></p>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </section>
        <script src="js/main.js"></script>
        <script src="public/assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
        <script src="public/assets/node_modules/popper/popper.min.js"></script>
        <script src="public/assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="public/assets/node_modules/register-steps/jquery.easing.min.js"></script>
        <script src="public/assets/node_modules/register-steps/register-init.js"></script>
        <script src="public/assets/node_modules/wizard/jquery.validate.min.js"></script>
        <script type="text/javascript">
            $(function() {
                $(".preloader").fadeOut();
            });
            $(document).ready(function(){
                $("#msform").validate({
                    rules: {
                        username: {required: true},
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
                        $(".Loader").show();
                        var data = $("#msform").serialize();
                        jQuery.ajax({
                            dataType:"json",
                            type:"post",
                            data:data,
                            url:"{{ url('loginuser') }}",
                            success: function(data)
                            {
                                if(data.response)
                                {   
                                    $('#msform').each(function(){ this.reset(); });
                                    setTimeout(function () { window.location.href = "repairing"; }, 500)
                                }
                                else if(data.error)
                                {
                                    $(".Loader").hide();
                                    alert(data.error);
                                }
                            }
                        });
                    }
                });
            });
        </script>
    </body>
</html>