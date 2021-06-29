<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>Reset Password</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
  </head>
    <body>
        <!-- Navigation -->
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
	  	<!-- <h1>Hello</h1> -->
		    <?php
                $selector = $_GET["selector"];
                $validator = $_GET["validator"];

                if(empty($selector) || empty($validator)){
                    echo "Could not validate your request!";
                }else{
                    if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false){
                        ?>

                            <form action="resetpassword.php" class="form-login" method="post">
		                    <h2 class="form-login-heading">Password Recovery</h2>
		                    <p style="padding-left: 1%; color: green">
		                    </p>
		                    <div class="login-wrap">
                                <input type="hidden" name="selector" value="<?php echo $selector; ?>">
                                <input type="hidden" name="validator" value="<?php echo $validator; ?>">
		                        <input type="password" class="form-control" placeholder="New Password" required="required" name="pwd">
                                <br>
                                <input type="password" class="form-control" placeholder="Confirm Password" required="required" name="pwd-repeat">
		                        <br>
		                        <button class="btn btn-theme btn-block"  type="submit" name="submit" id="reset-password-submit"><i class="fa fa-user"></i> Reset Password</button>
		                        <hr>
		                    </div>
		                    </form>	  	

                        <?php
                    }
                }
            ?>
	  	
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
