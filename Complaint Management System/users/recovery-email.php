<?php
    session_start();
    error_reporting(0);
    if(isset($_POST['submit'])){

        $selector = bin2hex(random_bytes(8));
        $token = random_bytes(32);

        $url = "http://localhost/Complaint%20Management%20System/users/reset-password.php?selector=" . $selector . "&validator=" . bin2hex($token) ;
        $expires = date("U") + 1800;

        include("includes/config.php"); 

        $userEmail = $_POST["email"];

        $sql = "SELECT * FROM users WHERE userEmail=?;";
        $stmt = mysqli_stmt_init($bd);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "There was an error!";
            exit();
        }else{
            mysqli_stmt_bind_param($stmt, "s", $userEmail);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if(!($row = mysqli_fetch_assoc($result))){
                header("location: index.php?user=invalid");
                exit();
            }
        }

        $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?;";
        $stmt = mysqli_stmt_init($bd);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "There was an error!";
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $userEmail);
            mysqli_stmt_execute($stmt);
        }

        $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "There was an error!";
            exit();
        }
        else{
            $hashedToken = password_hash($token, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
            mysqli_stmt_execute($stmt);
        }

        mysqli_stmt_close($stmt);
        mysqli_close($bd);

        $to = $userEmail;
        $subject = 'Reset your password for CMS';
        $message = '<p> We received a password reset request. The link to reset your password is given below. If you did not make this request you can ignore this email</p>
        <p> The Link is only valid for 30 minutes.</p>
        <p>Here is your Password Reset Link: </br>
        <a href = "' . $url . '">' . $url . '</a></p>';

        $headers = "From: Final Year Project \r\n";
        $headers .= "Reply-To: alwayswelcome456@gmail.com\r\n";
        $headers .= "Content-type: text/html\r\n";

        mail($to, $subject, $message, $headers);

        header("location: index.php?reset=success");

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recovery Email</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
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
                <a class="navbar-brand" href="http://localhost/Complaint Management System/">HOME </a>
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
                </div> 
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

<div id="login-page">
	  	<div class="container">
		      <form class="form-login" name="recovery" method="post">
		        <h2 class="form-login-heading">Reset Your Password</h2>
		        <p style="padding-left:5%; padding-top:2%;  color:red">
		        		<p style="padding-left:4%; padding-top:2%;  color:green">
		        <div class="recovery-wrap">
		            <input type="text" class="form-control" name="email" placeholder="Email"  required autofocus>
		            <br>
		            <button class="btn btn-theme btn-block" name="submit" type="submit"><i class="fa fa-lock"></i> Send Mail</button>
		            <hr>
		           </form>
		        </div>	 
                <p>
                <!-- <?php
                    if(isset($_GET["reset"])){
                        // echo $_GET["reset"];
                        if($_GET["reset"] == "success"){
                            echo 'Check your Email!';
                        }
                    }
                ?></p> -->
	  	</div>
</div>
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