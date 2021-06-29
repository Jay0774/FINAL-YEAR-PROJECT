<?php
include('includes/config.php');
error_reporting(0);
if(isset($_POST['submit']))
{
	$fullname=$_POST['fullname'];
	$email=$_POST['email'];
	$password=md5($_POST['password']);
	$contactno=$_POST['contactno'];
	$adharno = $_POST['adhar'];
	$year = $_POST['year'];
	$adhfile=$_FILES["adhfile"]["name"];
	move_uploaded_file($_FILES["adhfile"]["tmp_name"],"adharids/".$_FILES["adhfile"]["name"]);
	$status=1;
    $userStatus=0;
	$query=mysqli_query($bd, "INSERT INTO `users`(`fullName`, `userEmail`, `password`, `contactNo`,`adharno`, `AdharFile`, `status`,`year`,`userStatus`) values('$fullname','$email','$password','$contactno','$adharno','$adhfile','$status',$year,$userStatus)");
	$msg="Registration successfull.Your account needs to be activated by SWO Officer. Wait for the activation mail!";
	
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>CMS | User Registration</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
<script>

function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'email='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

function AadharValidate() {
        var aadhar = document.getElementById("adhar").value;
        var adharcardTwelveDigit = /^\d{12}$/;
        var adharSixteenDigit = /^\d{16}$/;
        if (aadhar != '') {
            if (aadhar.match(adharcardTwelveDigit)) {
                return true;
            }
            else if (aadhar.match(adharSixteenDigit)) {
                return true;
            }
            else {
                alert("Enter valid Aadhar Number");
                return false;
            }
        }
    }
function phonenumber()
{
var inputtxt = document.getElementById("num").value;
var phoneno = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
if (inputtxt.match(phoneno))        
{      
	return true;
}
else
{
    alert("Enter Vaild Phone Number");
    return false;
}
}
</script>
  </head>

  <body>
  	<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">HOME </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="http://localhost/Complaint Management System/users/our-team.php">OUR TEAM</a>
                    </li>
                    <li>
                        <a href="http://localhost/Complaint Management System/users/registration.php">REGISTRATION</a>
                    </li>
                    <li>
                        <a href="http://localhost/Complaint Management System/users/">LOGIN</a>
                    </li>                 
                    <li style="float: right;">
                        <a href="http://localhost/Complaint Management System/admin/">ADMIN</a>
                    </li>
                    <li style="float: right;">
                        <a href="http://localhost/Complaint Management System/pannelist/">PANNELIST</a>
                    </li>
                </div> 
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
	  <div id="login-page">
	  	<div class="container">
	  	
		      <form class="form-login" method="post" enctype="multipart/form-data">
		        <h2 class="form-login-heading">User Registration</h2>
		        <p style="padding-left: 1%; color: green">
		        	<?php if($msg){
						echo htmlentities($msg);
		        	}?>


		        </p>
		        <div class="login-wrap">
		         <input type="text" class="form-control" placeholder="Full Name" name="fullname" required="required" autofocus>
		            <br>
		            <input type="email" class="form-control" placeholder="Email" id="email" onBlur="userAvailability()" name="email" required="required">
		             <span id="user-availability-status1" style="font-size:12px;"></span>
		            <br>
		            <input type="password" class="form-control" placeholder="Password" required="required" name="password"><br >
		             <input type="text" class="form-control" id="num" maxlength="10" name="contactno" placeholder="Contact no" required="required" autofocus onblur="phonenumber();">
		            <br>
		            <input type="text" class="form-control" maxlength="12" id="adhar" name="adhar" placeholder="Adhar Number" required="required" autofocus onblur="AadharValidate();">
		            <br>
		            <input type="text" class="form-control" maxlength="12" name="year" placeholder="Year of enrollment" required="required" autofocus>
		            <br>
		            <input type="file" name="adhfile" class="form-control" value="" required="required" accept="pdf">
		            <br>
		            <button class="btn btn-theme btn-block"  type="submit" name="submit" id="submit"><i class="fa fa-user"></i> Register</button>
		            <hr>
		            
		            <div class="registration">
		                Already Registered<br/>
		                <a class="" href="index.php">
		                   Sign in
		                </a>
		            </div>
		
		        </div>
		
		      
		
		      </form>	  	
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/c3.jpg");
    </script>


  </body>
</html>
