<?php
    session_start();
    error_reporting(0);
    include("includes/config.php");
    if(isset($_POST['submit'])) {
        $ret=mysqli_query($bd, "SELECT * FROM users WHERE userEmail='".$_POST['username']."' and password='".md5($_POST['password'])."'");
        $num=mysqli_fetch_array($ret);
        // echo $num;
        if($num>0)
        {
            if($num['userStatus'] == 0) {
                $msg="Your account is not yet activated.";
            } elseif($num['userStatus'] == 2) {
                $errormsg="Your account has been blocked.";
            } else {
                $extra="dashboard.php";
                $_SESSION['login']=$_POST['username'];
                $_SESSION['id']=$num['id'];
                $host=$_SERVER['HTTP_HOST'];
                $uip=$_SERVER['REMOTE_ADDR'];
                $status=1;
                $log=mysqli_query($bd, "insert into userlog(uid,username,userip,status) values('".$_SESSION['id']."','".$_SESSION['login']."','$uip','$status')");
                $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
                header("location:http://$host$uri/$extra");
                exit();
            }
    }
    else
    {
        $_SESSION['login']=$_POST['username'];	
        $uip=$_SERVER['REMOTE_ADDR'];
        $status=0;
        mysqli_query($bd, "insert into userlog(username,userip,status) values('".$_SESSION['login']."','$uip','$status')");
        $errormsg="Invalid username or password";
        $extra="login.php";
    }
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

    <title>CMS | User Login</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
<script type="text/javascript">
function valid()
{
 if(document.forgot.password.value!= document.forgot.confirmpassword.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.forgot.confirmpassword.focus();
return false;
}
return true;
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
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">
	  	
		      <form class="form-login" name="login" method="post">
		        <h2 class="form-login-heading">sign in now</h2>
		        <p style="padding-left:4%; padding-top:2%;  color:red">
		        	<?php if($errormsg){
echo htmlentities($errormsg);
		        		}?></p>

		        		<p style="padding-left:4%; padding-top:2%;  color:green">
		        	<?php if($msg){
echo htmlentities($msg);
		        		}?></p>
						<?php if($_SESSION['msg']){
echo htmlentities($_SESSION['msg']);
		        		}?></p>
						<?php 	
							
						?>
						<?php 	
							if(isset($_GET["newpwd"])){
								switch($_GET["newpwd"]){
									case "empty": echo '<p style="color:red; font-size:15px; padding-left:30%; paddinf-top:2%;"> Password Empty! </p>'; break;
									case "pwdnotsame": echo '<p style="color:red; font-size:15px; padding-left:30%; paddinf-top:2%;"> Password Not Same! </p>'; break;
									case "passwordupdated": echo '<p style="color:red; font-size:15px; padding-left:30%; paddinf-top:2%;"> Password Updated! </p>'; break;
								}
							}elseif(isset($_GET["reset"])){
								if($_GET["reset"] == "success"){
									echo '<p style="color:red; font-size:15px; padding-left:30%; paddinf-top:2%;"> Check Your Email! </p>';
								}
							}elseif(isset($_GET["user"])){
								if($_GET["user"] == "invalid"){
									echo '<p style="color:red; font-size:15px; padding-left:35%; paddinf-top:2%;"> Invalid User! </p>';
								}
							}
						?>
		        <div class="login-wrap">
		            <input type="text" class="form-control" name="username" placeholder="Email"  required autofocus>
		            <br>
		            <input type="password" class="form-control" name="password" required placeholder="Password">
		            <label class="checkbox">
		                <span class="pull-right">
		                    <a href="recovery-email.php"> Forgot Password?</a>
		                </span>	
		            </label>
		            <button class="btn btn-theme btn-block" name="submit" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
		            <hr>
		           </form>
		            <div class="registration">
		                Don't have an account yet?<br/>
		                <a class="" href="registration.php">
		                    Create an account
		                </a>
		            </div>
		
		        </div>	  	
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/c3.jpg", {speed: 500});
    </script>


  </body>
</html>
