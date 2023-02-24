<?php 
    include('../includes/connect.php');
    include('../functions/common_function.php');
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
<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">New User Registration</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-outline mb-4">
                        <label for="user_username" class="form-label">Username</label>
                        <input type="text" id="user_username" class="form-control"
                        placeholder="Enter your username" autocomplete="off" require="required" name="user_username"/>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="user_email" class="form-label">Email</label>
                        <input type="text" id="user_email" class="form-control"
                        placeholder="Enter your user email" autocomplete="off" require="required" name="user_email"/>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="user_image" class="form-label">User Image</label>
                        <input type="file" id="user_image" class="form-control"
                         required name="user_image"/>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" id="user_password" class="form-control"
                        placeholder="Enter your password" autocomplete="off" require="required" name="user_password"/>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="conf_user_password" class="form-label">Confirm Password</label>
                        <input type="password" id="conf_user_password" class="form-control"
                        placeholder="Confirm Password" autocomplete="off" require="required" name="conf_user_password"/>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="user_address" class="form-label">Address</label>
                        <input type="text" id="user_address" class="form-control"
                        placeholder="Enter your address" autocomplete="off" require="required" name="user_address"/>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="user_contact" class="form-label">Contact</lm mabel>
                        <input type="text" id="user_contact" class="form-control"
                        placeholder="Enter your mobile number" autocomplete="off" require="required" name="user_contact"/>
                    </div>
                    <div class="mt-4 pt-2">
                        <input type="submit" value="Registration" class="bg-info py-2 px-3 border-0" name="user_register">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account ?<a href="user_login.php" class="text-danger"> Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    


    <script src="./js/jquery-3.3.1.js"></script>
    <script src="../js/bootstrap.bundle.js"></script>
</body>
</html>


<?php
   if(isset($_POST['user_register'])){
        $user_username=$_POST['user_username'];
        $user_email=$_POST['user_email'];
        $user_password=$_POST['user_password'];
        $hash_password=password_hash($user_password,PASSWORD_DEFAULT);
        $conf_user_password=$_POST['conf_user_password'];
        $user_address=$_POST['user_address'];
        $user_contact=$_POST['user_contact'];
        $user_image=$_FILES['user_image']['name'];
        $user_image_tmp=$_FILES['user_image']['tmp_name'];
        $user_ip=getIPAddress();


        $select_query="Select * from `user_table` where username='$user_username' or user_email='$user_email'";
        $result=mysqli_query($con,$select_query);
        $rows_count=mysqli_num_rows($result);
        if($rows_count>0){
          echo  "<script>alert('Username and Email already exist')</script>";
        }else if
            ($user_password!=$conf_user_password){
                echo "<script>alert('Passwords do not match')</script>";
            }
        
        else{
            move_uploaded_file($user_image_tmp,"./user_images/$user_image");
            $insert_query="insert into `user_table` (username,user_email,user_password,user_image,user_ip,
            user_address,user_mobile) values ('$user_username','$user_email','$hash_password',
            '$user_image','$user_ip','$user_address','$user_contact')";
            $sql_excute=mysqli_query($con,$insert_query);
        }

        $select_cart_items="Select * from `cart_details` where ip_address='$user_ip'";
        $result_cart=mysqli_query($con,$select_cart_items);
        $rows_count=mysqli_num_rows($result_cart);
        if($rows_count>0){
            $_SESSION['username']=$user_username;
            echo  "<script>alert('You have items in your cart')</script>";
            echo   "<script>window.open('checkout.php','_self')</script>";
            }else{
            
            echo  "<script>alert('registration successful')</script>";
            echo   "<script>window.open('index.php','_self')</script>";
            }
         
   }

?>