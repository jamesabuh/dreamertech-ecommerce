<?php 
    include('../includes/connect.php');
    include('../functions/common_function.php');
    @session_start();
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/all.css">
</head>
<style>
    body{
        overflow:hidden;
    }
</style>
<body>
     <div class="container-fluid m-3">
        <h2 class="text-center mb-5">Admin Login</h2>
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6 col-xl-5">
                    <img src="../images/jamess.jpg" alt="Admin Registration"
                    class="img-fluid">
                </div>
                <div class="col-lg-6 col-xl-4">
                    <form action="" method="post">
                        <div class="form-ouline mb-4">
                            <label for="admin_username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="admin_username" 
                            name="admin_username" placeholder="Enter your username" required="required">
                        </div>
                        
                        <div class="form-ouline mb-4">
                            <label for="adimin_password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="admin_password" 
                            name="admin_password" placeholder="Enter your password" required="required">
                        </div>
                        <input type="submit" class="bg-info py-2 px-3 border-0"
                        name="admin_login" value="Login">
                        <p class="small fw-bold mt-2 pt-1">Don't you have an account?
                            <a href="admin_registration.php" class="text-danger">Register</a></p>
                    </form>
                </div>
            </div>
     </div>
</body>
</html>



<?php


    if(isset($_POST['admin_login'])){
        $admin_username=$_POST['admin_username'];
        $admin_password=$_POST['admin_password'];

        $select_query="select * from `admin_table` where
        admin_name='$admin_username'";
        $result=mysqli_query($con,$select_query);
        $row_count=mysqli_num_rows($result);
        $row_data=mysqli_fetch_assoc($result);


        
        if($row_count>0){
            $_SESSION['admin_name']=$admin_username;
                 if(password_verify($admin_password,$row_data['admin_password'])){
                  //  echo "<script>alert('Login sucessful')</script>";   
                  
                    echo  "<script>alert('Login successful')</script>";
                    echo   "<script>window.open('profile.php','_self')</script>";
                  }else{
            echo "<script>alert('Invalid Credentials')</script>";
        }
        }
    }

    ?>