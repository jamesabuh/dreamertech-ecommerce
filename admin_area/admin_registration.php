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
        <h2 class="text-center mb-5">Admin Registration</h2>
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6 col-xl-5">
                    <img src="../images/jamess.jpg" alt="Admin Registration"
                    class="img-fluid">
                </div>
                <div class="col-lg-6 col-xl-4">
                    <form action="" method="post">
                        <div class="form-ouline mb-4">
                            <label for="admin_name" class="form-label">Username</label>
                            <input type="text" class="form-control" id="admin_name" 
                            name="admin_name" placeholder="Enter your username" required="required">
                        </div>
                        <div class="form-ouline mb-4">
                            <label for="admin_email" class="form-label">Email</label>
                            <input type="admin_email" class="form-control" id="admin_email" 
                            name="admin_email" placeholder="Enter your email" required="required">
                        </div>
                        <div class="form-ouline mb-4">
                            <label for="admin_password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="admin_password" 
                            name="admin_password" placeholder="Enter your password" required="required">
                        </div>
                        <div class="form-ouline mb-4">
                            <label for="admin_confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="admin_confirm_password" 
                            name="admin_confirm_password" placeholder="Enter your Confirm password" required="required">
                        </div>
                        <input type="submit" class="bg-info py-2 px-3 border-0"
                        name="admin_registration" value="Register">
                        <p class="small fw-bold mt-2 pt-1">Don't you have an account?
                            <a href="admin_login.php" class="text-danger">Login</a></p>
                    </form>
                </div>
            </div>
     </div>
</body>
</html>

<?php
   if(isset($_POST['admin_registration'])){
        $admin_name=$_POST['admin_name'];
        $admin_email=$_POST['admin_email'];
        $admin_password=$_POST['admin_password'];
        $hash_password=password_hash($admin_password,PASSWORD_DEFAULT);
        $admin_confirm_password=$_POST['admin_confirm_password'];
        
        


        $select_query="Select * from `admin_table` where admin_name='$admin_name' or admin_email='$admin_email";
        $result=mysqli_query($con,$select_query);
        $rows_count=mysqli_num_rows($result);
        if($rows_count>0){
          echo  "<script>alert('Admin_name and Email already exist')</script>";
        }else if
            ($admin_password!=$admin_confirm_password){
                echo "<script>alert('Passwords do not match')</script>";
            }
        
        else{
            
            $insert_query="insert into `admin_table` (admin_name,admin_email,admin_password)
             values ('$admin_name','$admin_email','$hash_password')";
            $sql_excute=mysqli_query($con,$insert_query);
        }

    }

?>