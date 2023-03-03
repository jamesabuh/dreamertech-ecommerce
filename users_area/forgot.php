<?php
include('../includes/connect.php');
session_start();
$error = array();




       $mode = "enter_email";
       if(isset($_GET['mode'])){
        $mode = $_GET['mode'];
       }

       if(count($_POST) > 0){

                switch($mode) {
                    case 'enter_email':
                    //code...
                    $email = $_POST['email'];
                    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                        $error[] = "Please enter a valid email";
                    }elseif(!valid_email($email)){
                        $error[] = "That email was not found";
                    }else{
                        $_SESSION['forgot']['email'] = $email;
                    send_email($email);
                    
                    header("location: forgot.php?mode=enter_code");
                    die;
                    }
                    break;

                    case 'enter_code':
                    //code...
                    $code = $_POST['code'];
                    $result = is_code_correct($code);
                            $_SESSION['forgot']['code'] = $email;
                    if($result == "the code is correct"){
                        header("location: forgot.php?mode=enter_password");
                     
                    die;
                    }else{
                        $error[] = $result;
                    }
                    break;
                    
                    case 'enter_password':
                    //code...
                    $password = $_POST['password'];
                    $password2 = $_POST['password2'];

                    if($password !== $password2){
                        $error[] = "Passwords do not match";
                    }elseif(!isset($_SESSION['forgot']['email']) || !isset($_SESSION['forgot']['code'])){
                        header("location: forgot.php");
                        die;
                    }else{ 
                        save_password($password);
                        if(isset($_SESSION['forgot'])){
                            unset($_SESSION['forgot']);
                        }
                    header("location: user_login.php");
                    die;
                    }
                    break;

                    default:
                    //code...
                    break;
                }

       }
       function send_email($email){
        global $con;
        $expire = time() +(60 * 1);
        $code = rand(10000,99999);
        $email = addslashes($email);
        

        $query = "insert into codes (email,code,expire) value ('$email', '$code','$expire')";
        mysqli_query($con,$query);

        //   send_mail($email, 'Password reset', "Your code is" . $code);
            send_mail($email, 'Password reset', "Your code is" . $code);
       }

       function save_password($password){
        global $con;
        $password = password_hash($password, PASSWORD_DEFAULT);
        $email = addslashes($_SESSION['forgot']['email']);
        

        $query = "update user_table set user_password = '$password' where user_email = '$email' limit 1";
        mysqli_query($con,$query);

     //   mail(to, subject, 'Your code is ')
       }


       function valid_email($email){
        global $con;
        $email = addslashes($email);
        

        $query = "select * from user_table where user_email = '$email' limit 1";
        $result = mysqli_query($con,$query);
         if($result){
            if(mysqli_num_rows($result) > 0){
                
                    return true;
                
            }
        }
        return false;
       }



       function is_code_correct($code){
        global $con;
        $code = addslashes($code);
        $expire = time();
        $email = addslashes($_SESSION['forgot']['email']);

        $query = "select * from codes where code = '$code' && email = '$email'  order by id desc limit 1 ";
        $result = mysqli_query($con,$query);
        if($result){
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                if($row['expire'] > $expire){
                    return "the code is correct";
                }else{
                    return "the code is expired";
                }
            }else{
                return "the code is incorrect";
            }
        }
        return "the code is incorrect";
       }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/all.css">   
    <link rel="stylesheet" href="./css/style.css">
</head>
            <style>
                body{
                    overflow: hidden;
                }
            </style>
<body>
    

            <?php

switch($mode) {
    case 'enter_email':
    //code...
    ?>
    <div class="container-fluid my-3">
        <h1 class="text-center">Forgot password</h1>
        <h3 class="text-center">Enter your email below</h3>
        <div class="row d-flex align-items-center justify-content-center mt-5">
            <div class="col-lg-12 col-xl-6">
         <form action="forgot.php?mode=enter_email" method="post">
             <?php
                                foreach($error as $err){
                                    echo $err . "<br>";
                        }
                        ?>
                    <div class="form-outline mb-4">
                       
                        <input type="email" name="email" class="form-control"
                        placeholder="email..." />
                    </div>

                    <div class="mt-4 pt-2">
                        <input type="submit" value="Next" class="bg-info py-2 px-3 border-0">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="user_registration.php" class="text-danger"> Register</a></p>
                    </div>
                    <div class="">
                    <a href="user_login.php">Login</a>
                    </div>
                </form>

<?php
    break;

    case 'enter_code':
    //code...

    ?>
    <div class="container-fluid my-3">
        <h1 class="text-center">Forgot password</h1>
        <h3 class="text-center">Enter the code sent to your email</h3>
        <div class="row d-flex align-items-center justify-content-center mt-5">
            <div class="col-lg-12 col-xl-6">
    <form action="forgot.php?mode=enter_code" method="post">
        <?php
                                foreach($error as $err){
                                            echo $err . "<br>";
                                }
                        ?>
               <div class="form-outline mb-4">
                   <input type="text" name="code" class="form-control"
                   placeholder="12345" />
               </div>

               <div class="mt-4 pt-2">
                   <input type="submit" value="Next" class="bg-info py-2 px-3 border-0" style="float:right;">
                   <a href="forgot.php">
                   <input type="button" value="Start Over" class="bg-info py-2 px-3 border-0">
                   </a> 
                   <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="user_registration.php" class="text-danger"> Register</a></p>
               </div>
               <div class="">
               <a href="user_login.php">Login</a>
               </div>
           </form>

<?php
    break;
    
    case 'enter_password':
    //code...

    ?>
    <div class="container-fluid my-3">
        <h1 class="text-center">Forgot password</h1>
        <h3 class="text-center">Enter your new password</h3>
        <div class="row d-flex align-items-center justify-content-center mt-5">
            <div class="col-lg-12 col-xl-6">
    <form action="forgot.php?mode=enter_password" method="post">
        <?php
                                foreach($error as $err){
                                            echo $err . "<br>";
                                }
                        ?>
               <div class="form-outline mb-4">
                   <input type="text" name="password" class="form-control"
                   placeholder="password" />
               </div>
               <div class="form-outline mb-4">
                   <input type="text" name="password2" class="form-control"
                   placeholder="Retype Password" />
               </div>

               <div class="mt-4 pt-2">
                   <input type="submit" value="Next" class="bg-info py-2 px-3 border-0" style="float:right;">
                   <a href="forgot.php">
                   <input type="button" value="Start Over" class="bg-info py-2 px-3 border-0">
                   </a> 
                   <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="user_registration.php" class="text-danger"> Register</a></p>
               </div>
               <div class="">
               <a href="user_login.php">Login</a>
               </div>
           </form>

<?php
    break;

    default:
    //code...
    break;
} 


?>
               
                             
                                  
            </div>
        </div>
    </div>