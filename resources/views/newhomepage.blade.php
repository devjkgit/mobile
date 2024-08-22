<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon.png">
        <title>Watsdoc</title>
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
        <link href="public/assets/css/unslider.css" rel="stylesheet">
    </head>
<body>
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Watsdoc</p>
        </div>
    </div>
    <section id="wrapper" class="login-register login-sidebar">
        <header id="header" class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="header_enner_mn w-100">
                        <div class="header_logo">
                            <a href="#"><img src="public/assets/images/site-logo.png" alt=""></a>
                        </div>
                        <div class="login_btn">
                            <div class="mobile_menu">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                            </div>
                            <ul>
                                <li class="mobile_menu_close"><i class="fa fa-times" aria-hidden="true"></i></li>
                                <li><button type="button" class="btn" data-toggle="modal" data-target="#login">Log in</button2></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- <div class="banner_text">
            <div class="container">
                <div class="row">
                    <div class="banner_text_enner">
                        <h4>An Innovative high technology company specialized in recycling catalytic converters and circuit boards that contain Platinum Group Metals.</h4>
                        <ul>
                            <li><a href="#">Purchasing</a></li>
                            <li><a href="#">Trading & Hedging</a></li>
                            <li><a href="#">Consulting</a></li>
                        </ul>
                        <button type="button" class="btn" data-toggle="modal" data-target="#contact_us">Become a Supplier</button>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="section top">
            <div class="slideshow">
                <div class="slider banner_slider_mn">
                    <ul>
                        <li style="background-image: url('/assets/images/background/image2.png')">
                            <div class="slider-content">
                                <div class="container banner_text_enner banner_text_black" style="margin-top: 110px;">
                                    <h4 style="margin-top: 150px;">We are specialized in purchasing scrap catalytic converters and circuit boards.</h4>
                                    <!-- <ul>
                                        <li><a href="#">Purchasing</a></li>
                                        <li><a href="#">Trading & Hedging</a></li>
                                        <li><a href="#">Consulting</a></li>
                                    </ul> -->
                                    <button type="button" class="btn" data-toggle="modal" data-target="#contact_us">Contact us</button>
                                </div>
                            </div>
                        </li>
                        <li class="img_overlay" style="background-image: url('/assets/images/background/image1.png')">
                            <div class="slider-content">
                                <div class="container banner_text_enner banner_text_white" style="margin-top: 110px;">
                                    <h4 style="margin-top: 150px;">We are specialized in purchasing scrap catalytic converters and circuit boards.</h4>
                                    <!-- <ul>
                                        <li><a href="#">Purchasing</a></li>
                                        <li><a href="#">Trading & Hedging</a></li>
                                        <li><a href="#">Consulting</a></li>
                                    </ul> -->
                                    <button type="button" class="btn" data-toggle="modal" data-target="#contact_us">Contact us</button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>


    <div class="modal fade login_popup_box" id="login">
        <div class="Loader"></div>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="loginform" class="loginform" action="#">
                    @csrf
                    <div class="modal-header">
                        <h2>Login</h2>
                        <button type="button" class="close popup_close_btn" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="Username">
                            <input type="text" id="username" name="username" placeholder="Username">
                             <div class="errorTxt1"></div>
                         </div>
                        <div class="Password">
                            <input type="password" placeholder="Password" id="password" name="password">
                            <div class="errorTxt3"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn login_btn_mn">Log in</button>
                        <button type="button" class="btn cancel_btn_mn" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade contact_popup_box" id="contact_us">
        <div class="Loader"></div>
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Contact us</h2>
                    <button type="button" class="close popup_close_btn" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12 col-md-12">
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
                    <form id="contactform" autocomplete="off" method="post" class="form-horizontal contactform">
                        @csrf
                        <div class="form_input_mn first_name_input_mn">
                            <input type="text" name="firstname" placeholder="First Name" class="first_name_input">
                        </div>
                        <div class="form_input_mn last_name_input_mn">
                            <input type="text" name="lastname"  placeholder="Last Name" class="last_name_input">
                        </div>
                        <div class="form_input_mn">
                            <input type="email" name="email"  placeholder="Email">
                        </div>
                        <div class="form_input_mn">
                            <input type="text" name="phone"  placeholder="Phone Number">
                        </div>
                        <div class="form_input_mn">
                            <textarea rows="4" cols="50"  name="message" placeholder="Message"></textarea>
                        </div>
                        <div class="form_input_mn">
                            <div class="form-group g-recaptcha" data-sitekey="6Lfy5dUaAAAAAPgegE_fu9nqly2WF1mgiP1wzPFt"></div>
                        </div>
                        <div class="form_input_mn">
                            <input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn submit_btn_mn">Submit</button>
                    <button type="button" class="btn cancel_btn_mn" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="container">
            <div class="row w-100">
                <p>© 2021 Watsdoc S.A.R.L – All Rights Reserved</p>
                <p>Office : Berytech, 2nd Floor, Mathaf, Beirut, Lebanon, Office Phone: +961 1 612 500 ext: 5300 | <a href="#" data-toggle="modal" data-target="#contact_us">Contact us</a></p>
            </div>
        </div>
    </footer>
    <script src="js/main.js"></script>
    <script src="public/assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="public/assets/node_modules/popper/popper.min.js"></script>
    <script src="public/assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="public/assets/node_modules/wizard/jquery.validate.min.js"></script>
    <script src="public/assets/js/unslider-min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script> -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <!--Custom JavaScript -->
    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });

        $(document).ready(function(){
            $("#loginform").validate({
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
                    var data = $("#loginform").serialize();
                    jQuery.ajax({
                        dataType:"json",
                        type:"post",
                        data:data,
                        url:"{{ url('loginuser') }}",
                        success: function(data)
                        {
                            if(data.response)
                            {   
                                $('#loginform').each(function(){ this.reset(); });
                                setTimeout(function () { window.location.href = "dashboard"; }, 500)    
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

            $("#contactform").validate({
                ignore: ".ignore",
                rules: {
                    firstname: {required: true},
                    lastname: {required: true,},
                    email: {required: true,email:true},
                    phone: {required: true,number:true},
                    message: {required: true},
                    hiddenRecaptcha: {
                        required: function () {
                            if (grecaptcha.getResponse() == '') {
                                return true;
                            } 
                            else
                            {
                                return false;
                            }
                        }
                    }
                },
                messages: {
                    firstname: {required: "Please enter your firstname"},
                    email: {required: "Please enter your email"},
                    phone: {required: "Please enter your phone number"},
                    lastname: {required: "Please enter your lastname"},
                    message: {required: "Please enter your message."},
                    hiddenRecaptcha: {required: "Please verify yourself."},
                },
                submitHandler: function() 
                {
                    $(".Loader").show();
                    var data = $("#contactform").serialize();
                    jQuery.ajax({
                        dataType:"json",
                        type:"post",
                        data:data,
                        url:"/contactform",
                        success: function(data)
                        {
                            if(data.response)
                            {   
                                $(".Loader").hide();
                                $("#resonse").show();
                                $('#resonsemsg').html('<span>'+data.response+'</span>');
                                $('#contactform').each(function(){ this.reset(); });
                                setTimeout(function () { $("#contact_us").modal("hide");location.reload(); }, 3000)
                            }
                            else if(data.error)
                            {
                                $("#error").show();
                                $('#errormsg').html('<span>'+data.error+'</span>');
                                $(".Loader").hide();
                            }
                        }
                    });
                }
            });
        });

        $(".mobile_menu").click(function(){
            $(".login_btn ul").addClass("active");
        });
        $("li.mobile_menu_close").click(function(){
            $(".login_btn ul").removeClass("active");
        });
        $('.slider').unslider({
            animation: 'fade',
            autoplay: true,
            arrows: false,
            nav: false,
            delay: 4000,
            speed: 250,
        });
    </script>
</body>
</html>