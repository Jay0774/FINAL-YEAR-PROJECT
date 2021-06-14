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

                            <form action="includes/reset-password.php" class="form-login" method="post">
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
              
              <!-- <form class="form-login" method="post">
		        <h2 class="form-login-heading">Password Recovery</h2>
		        <p style="padding-left: 1%; color: green">
		        	
		        </p>
		        <div class="login-wrap">
		            <input type="password" class="form-control" placeholder="New Password" required="required" name="password">
                    <br>
                    <input type="password" class="form-control" placeholder="Confirm Password" required="required" name="confirm-password">
		            <br>
		            <button class="btn btn-theme btn-block"  type="submit" name="submit" id="submit"><i class="fa fa-user"></i> Update Password</button>
		            <hr>
		
		        </div>
		
		      
		
		      </form>	  	 -->
	  	
	  	</div>
	  </div>


    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/login-bg.jpg", {speed: 500});
    </script>


  </body>
</html>
