<?php
    session_start();
    error_reporting(0);
    if(isset($_POST["save"])) {
        $userType = $_POST["type"];
        $userStatus;
        if($userType == "Valid") {
            $userStatus = 1;
        } else {
            $userStatus = 2;
        }
        $userEmail = $_POST["userEmail"];

        include("include/config.php");
        
        if($userType == "Valid") {

            $sql = "UPDATE users SET userStatus=? where userEmail=?";
            $stmt = mysqli_stmt_init($bd);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                echo "There was an error!";
                exit();
            } else {
                
                mysqli_stmt_bind_param($stmt, "is", $userStatus, $userEmail);
                mysqli_stmt_execute($stmt);
            }
            mysqli_stmt_close($stmt);
            mysqli_close($bd);
            $to = $userEmail;
            $subject = 'Account Activation for CMS';
            $message = '<p> Your account has been activated by the SWO Officer. Now you can login using the same E-Mail and the Password which you gave during registration for login into the same.</p>';

            $headers = "From: Final Year Project \r\n";
            $headers .= "Content-type: text/html\r\n";

            if(mail($to, $subject, $message, $headers)) {
                echo "<script>
                        alert('User has been activated and a mail has been sent to user informing that.');
                        window.close()
                  </script>";
            } else {
                echo "<script>alert('E-mail Sending Failed')</script>";
            }

        } else {
            echo $userType;
            $sql = "UPDATE users SET userStatus=? where userEmail=?";
            $stmt = mysqli_stmt_init($bd);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                echo "There was an error!";
                exit();
            } else {
                
                mysqli_stmt_bind_param($stmt, "is", $userStatus, $userEmail);
                mysqli_stmt_execute($stmt);
            }
            mysqli_stmt_close($stmt);
            mysqli_close($bd);

            echo "<script>
                        alert('User has been blocked.');
                        window.close()
                  </script>";

        }
    }
?>