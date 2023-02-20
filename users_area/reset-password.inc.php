<?php
if (isset($_POST["reset-password-submit"])) {

    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = $_POST["pwd"];
    $passwordRepeat = $_POST["pwd-repeat"];

    if (empty($password) || empty($passwordRepeat)) {
        header("Location: ../create-new-password.php?newpwd=empty");
        exit();
    } else if ($password != $passwordRepeat) {
        header("Location: ../create-new-password.php?newpwd=pwdnotsame");
        exit();
    }

        $currentDate = date("U");
        
        require 'connect.php';

        $sql = "SELECT * FROM passwordReset WHERE passwordResetSelector=? AND passwordResetExpires >= ?";
        $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt, $sql)) {

        echo "There was an error!";
        exit();

    } else {
        mysqli_stmt_bind_param($stmt, "s", $selector);
        mysqli_stmt_excute($stmt);

    }

        $result = mysqli_stmt_get_result($stmt);
        if (!$row = mysqli_fetch_assoc($result)) {
            echo "You need to re-submit your reset request.";
            exist();
        } else {

                $tokenBin = hex2bin($validator);
                $tokenCheck = password_verify($tokenBin, $row["passwordResetToken"]);

                if ($tokenCheck === false) {
                    echo "You need to re-submit your reset request.";
                    exit();

                } elseif ($tokenCheck === true) {

                    $tokenEmail = $row['passwordResetEmail'];

                    $sql = "SELECT * FROM user_table WHERE user_email=?;";
                    $stmt = mysqli_stmt_init($con);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                
                        echo "There was an error!";
                        exit();
                
                    } else {
                        mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                        mysqli_stmt_excute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        if (!$row = mysqli_fetch_assoc($result)) {
                            echo "There was an error!";
                            exist();
                        } else {

                            $sql = "UPDATE user_table SET pwdUsers=? WHERE user_email=?"; 
                            $stmt = mysqli_stmt_init($con);
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                        
                                echo "There was an error!";
                                exit();
                        
                            } else {
                                $newpwdHash = password_hash($password, PASSWORD_DEFAULT);
                                mysqli_stmt_bind_param($stmt, "ss", $newpwdHash, $tokenEmail);
                                mysqli_stmt_excute($stmt);


                                $sql = "DELETE FROM pwdReset=? WHERE pwdResetEmail=?"; 
                            $stmt = mysqli_stmt_init($con);
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                        
                                echo "There was an error!";
                                exit();
                        
                            } else {
                            
                                mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                                mysqli_stmt_excute($stmt);
                                header("Location: ../user_login.php?newpwd=passwordupdated");

                            }
                            }
                        }

                    }
                }
            

        }

} else {
    header("Location: ../index.php");
}