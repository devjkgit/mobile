  

<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/function.php');
require_once('google-login-api.php');

// Google passes a parameter 'code' in the Redirect Url
if(isset($_GET['code'])) {
	try {
		$gapi = new GoogleLoginApi();
		
		// Get the access token 
		$data = $gapi->GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL, CLIENT_SECRET, $_GET['code']);
		
		// Get user information
		$user_info = $gapi->GetUserProfileInfo($data['access_token']);

		$Email = $user_info['email'];
		$Fullname = explode(' ',$user_info['name']);
		$Username = $Fullname[0];
		$Firstname = $Fullname[0];
		$Lastname = $Fullname[1];
			
		$stmt= $db->prepare("SELECT * FROM `Resignation` WHERE Email=:Email"); 
        $stmt->bindParam(':Email', $Email, PDO::PARAM_STR);
        $stmt->execute();
        $getdata=$stmt->rowCount();
        
        if($getdata!=0)
        {
        	$LoginData = $stmt->fetch(PDO::FETCH_ASSOC);
        	$UserID = $LoginData['id'];
			$Username = $LoginData['Username'];
			$Email=$LoginData['Email'];
			$Usertype = $LoginData['Usertype'];
			
			$_SESSION["Email"] = $Email;
            $_SESSION["UserName"] = $Username;
            $_SESSION["UserID"] = $UserID;
            $_SESSION['Usertype']=$Usertype;
			
			header("Location: http://khalaf.imakeawesomethings.com/Dashboard.php");
		}	
		else
		{
			?>
				<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login with google</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url ;?>/assets/node_modules/wizard/jquery.validate.min.js"></script>
  <style type="text/css">
  	label.error{color: red;}
    .Loader{display:none; position:fixed; z-index:1000; top:0; left:0; height:100%; width:100%; background: rgba( 255, 255, 255, .8) url('images/ajax-loader.gif') 50% 50% no-repeat;}
body.loading .Loader{overflow: hidden;}
body.loading .Loader{display: block;}
  </style>
</head>
<body>

<div class="container">
  
  <!-- Trigger the modal with a button -->
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        
        <div class="modal-body">
           <form class="form-horizontal form-material" id="regform" action="#">
			<input type="hidden" name="id" id="id" value="new">
			
			<div class="form-group ">
			 
        <div class="col-xs-12">
				<label>Username</label>
			<input class="form-control" type="text"  id="Username" name="Username" placeholder="Username" value="<?php echo $Username; ?>">
            </div>
            <div class="errorTxt1"></div>
         	</div>

         	<div class="form-group ">
                        <div class="col-xs-12">
                        	<label>Email</label>
                            <input class="form-control" readonly type="text" value="<?php echo $Email; ?>"  id="Email" name="Email" placeholder="Email">
                        </div>
                        <div class="errorTxt2"></div>
                    </div>

                 <div class="form-group ">
                        <div class="col-xs-12">
                          <label>Password</label>
                            <input class="form-control" type="Password"  id="Password" name="Password" placeholder="Password">
                        </div>
                        <div class="errorTxt2"></div>
                    </div>   

         	<div class="form-group">
         		<div class="col-xs-12">
                    <label class="control-label">I am</label>
                    <div class="custom-control custom-radio">
                    <input type="radio" id="customRadio1" name="Usertype" class="custom-control-input" value="Franchise">
                    <label class="custom-control-label" for="customRadio1">Franchise</label>
                    </div>
                    
                    <div class="custom-control custom-radio">
                    <input type="radio" id="customRadio2" name="Usertype" class="custom-control-input" value="Investors">
                    <label class="custom-control-label" for="customRadio2">Investors</label>
                    </div>

                    <div class="custom-control custom-radio">
                    <input type="radio" id="customRadio3" name="Usertype" class="custom-control-input" value="Users">
                    <label class="custom-control-label" for="customRadio3">Users</label>
                    </div>  
                        <div class="errorTxt5"></div>
                    </div>
                    </div>


                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Sign Up</button>
                        </div>
                    </div>
                      <div class="Loader"></div>
           </form>
        </div>
        
      </div>
      
    </div>
  </div>
  
</div>

</body>
</html>

				<script type="text/javascript">
				 $( document ).ready(function() {

   				$('#myModal').modal('show');

   				  $("#regform").validate({
                    rules: {
                        Username: {required: true, minlength: 4},
                        Email: {required: true,},
                        Password: {required: true,},
                        CoPassword: {required: true,equalTo: "#Password"},
                        Usertype: {required: true},

                        },
                        
                    messages: {
                        Username: {required: "Please enter Username",minlength: "Your Username must consist at least 4 characters"},
                        Email: {required: "Please enter  email"},
                        Password: {required: "Please enter our password"},
                        CoPassword: {required: "Please confirm password",equalTo: "Enter confirm password same as password"},
                        Usertype: {required: "Please select your type"},
                        
                         },
                         errorPlacement: function(error, element) 
                         {
                            if (element.attr("name") == "Username" )
                            {
                                error.insertAfter(".errorTxt1");
                            }
                            else if (element.attr("name") == "Email" )
                            {
                            error.insertAfter(".errorTxt2");
                            }
                            else if (element.attr("name") == "Password" )
                            {
                            error.insertAfter(".errorTxt3");
                            }
                            else if (element.attr("name") == "CoPassword" )
                            {
                            error.insertAfter(".errorTxt4");
                            }
                            else if (element.attr("name") == "Usertype" )
                            {
                            error.insertAfter(".errorTxt5");
                            }

                         },
                        submitHandler: function() 
                        {
                            $(".Loader").show();
                            var data = $("#regform").serialize();
                            data= data + "&RegAction=Register";

                            jQuery.ajax({
                            dataType:"json",
                            type:"post",
                            data:data,
                            url:'<?php echo EXEC; ?>/Exec_Registration.php?action=Registration',
                            success: function(data)
                            {
                                if(data.resonse)
                                {
                                    $("#resonse").show();
                                    $('#resonsemsg').html('<span>'+data.resonse+'</span>');
                                    $( '#loginform' ).each(function(){ this.reset(); });

                                    $(".Loader").hide();
                                     window.location.href = "http://khalaf.imakeawesomethings.com/Dashboard.php";

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

<?php
		// 	$Datecreated = date("Y-m-d H:i:s");
		// 	$Isactive = 1;

		// $stmt= $db->prepare("INSERT INTO `Users` (Username, Firstname, Lastname, Email, Datecreated,Isactive) VALUES (:Username, :Firstname, :Lastname, :Email, :Datecreated,:Isactive) "); 
  //       $stmt->bindParam(':Username', $Username, PDO::PARAM_STR);
  //       $stmt->bindParam(':Firstname', $Firstname, PDO::PARAM_STR);
  //       $stmt->bindParam(':Lastname', $Lastname, PDO::PARAM_STR);
  //       $stmt->bindParam(':Email', $Email, PDO::PARAM_STR);
  //       $stmt->bindParam(':Datecreated', $Datecreated, PDO::PARAM_STR);
  //       $stmt->bindParam(':Isactive', $Isactive, PDO::PARAM_STR);
  //       $stmt->execute();
  //       $UserID = $db->lastInsertId();


  //       	$_SESSION["Email"] = $Email;
  //           $_SESSION["UserName"] = $Username;
  //           $_SESSION["UserID"] = $UserID;
  //           if($stmt)
  //           {
  //           header("Location: http://khalaf.imakeawesomethings.com/Dashboard.php");	
  //           }
            


		}




	}
	catch(Exception $e) {
		echo $e->getMessage();
		exit();
	}
}
?>

