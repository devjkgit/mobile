<!DOCTYPE html>
<html lang="en">
@include('head')
<body>
    @include('header_new')
    <div class="search_box">
        <div class="container">
            <div class="row">
                <div class="search_box_enner">
                    <h3>True catalyst prices based on Pt Pd Rh quotes</h3>
                    <div class="search_box_enner_mn">
                        <input type="text" name="productcode" id="productcode" placeholder="Search by Products"> 
                        <button type="button"  id="searchbutton">Search</button>
                    </div>
                    <p>Example: <a href="#">1740060</a></p>
                </div>
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

    <script src="public/assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <script src="public/assets/node_modules/jqueryui/jquery-ui.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="public/assets/node_modules/popper/popper.min.js"></script>
    <script src="public/assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="public/assets/node_modules/wizard/jquery.validate.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script>
        $(".mobile_menu").click(function(){
            $(".login_btn ul").addClass("active");
        });
        $("li.mobile_menu_close").click(function(){
            $(".login_btn ul").removeClass("active");
        });

        $( function() {
            $("#productcode").autocomplete({
                minLength: 1,
                source:"/product/productcodes",
                select: function( event, ui ) {
                    $("#productcode").val(ui.item.code);
                    // window.location.href = "https://watsdoc.com/searchresults/"+prodcode;
                }
            })
            .autocomplete( "instance" )._renderItem = function( ul, item ) {
                return $( "<li>" )
                .append( "<a class='autosuggestions'  href='https://watsdoc.com/product/"+item.code+"' >"+item.code+"</a>" )
                .appendTo( ul );
            };
        });

        $(document).ready(function(){
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

        $(document).on("click","#searchbutton",function(){
            var prodcode = $("#productcode").val();
            window.location.href = "https://watsdoc.com/searchresults/"+prodcode;
        });
    </script>
</body>
</html>