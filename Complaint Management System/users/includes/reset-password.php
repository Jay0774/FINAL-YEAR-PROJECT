<?php
    // session_start();
    // error_reporting(0);
    if(isset($_POST["submit"])){

            $selector = $_POST["selector"];
            $validator = $_POST["validator"];
            $password = $_POST["pwd"];
            $passwordRepeat = $_POST["pwd-repeat"];

            if(empty($password) || empty($passwordRepeat)){
                header("location: ../index.php?newpwd=empty");
            } elseif ($password != $passwordRepeat){
                header("location: ../index.php?newpwd=pwdnotsame");
            }

            $currentDate = date("U");
            // echo $selector;
            // echo nl2br("\n");
            // echo $currentDate;

            include("config.php");

            $sql = "SELECT * FROM pwdreset WHERE pwdResetSelector=? AND pwdResetExpires >= ?;";
            $stmt = mysqli_stmt_init($bd);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                echo "There was an error!";
                exit();
            }
            else {
                
                mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
                mysqli_stmt_execute($stmt);

                $result = mysqli_stmt_get_result($stmt);
                // header("location: ../index.php?newpwd=passwordupdated");
                // $row = mysqli_fetch_assoc($result);
                // echo $row["pwdResetEmail"];
                if(!($row = mysqli_fetch_assoc($result))){
                    echo "You need to re-submit your reset request";
                    exit();
                } else {

                    $tokenBin = hex2bin($validator);
                    $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

                    if($tokenCheck === false){
                        echo "You need to re-submit your reset request";
                        exit();
                    } elseif ($tokenCheck === true){
                        $tokenEmail = $row["pwdResetEmail"];

                        $sql = 'SELECT * FROM users WHERE userEmail=?;';
                        
                        $stmt = mysqli_stmt_init($bd);
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            echo "There was an error!";
                            exit();
                        } else {
                            mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);

                            if(!$row = mysqli_fetch_assoc($result)){
                                echo "There was an error!";
                                exit();
                            } else {
                                
                                $sql = "UPDATE users SET password=? WHERE userEmail=?;";
                                $stmt = mysqli_stmt_init($bd);
                                if(!mysqli_stmt_prepare($stmt, $sql)){
                                    echo "There was an error!";
                                    exit();
                                }
                                else{
                                    // $newPwdHash = password_hash($password, PASSWORD_DEFAULT);
                                    $newPwd = md5($password);
                                    mysqli_stmt_bind_param($stmt, "ss", $newPwd, $tokenEmail);
                                    mysqli_stmt_execute($stmt);

                                    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?;";
                                    $stmt = mysqli_stmt_init($bd);
                                    if(!mysqli_stmt_prepare($stmt, $sql)){
                                        echo "There was an error!";
                                        exit();
                                    }
                                    else{
                                        mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                                        mysqli_stmt_execute($stmt);
                                        header("location: ../index.php?newpwd=passwordupdated");
                                    }

                                }

                            }

                        }


                    }

                }
            }


    }
    // else{
    //     header("location: index.php");
    // }
?>