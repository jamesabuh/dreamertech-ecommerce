<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce website using php and mySQL..</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/all.css">   
    <link rel="stylesheet" href="../css/style.css">    
</head>
            <style>
                body{
                    
                }
                .profile_img{
                    width:50%;
                    margin:auto;
                    display:block;
                    object-fit:contain;
                }
                .edit_image{
                    width:100px;
                    height:100px;
                    object-fit:contain;
                }
                .w-10{
                        width:10%;
                }
            </style>
<body>
  <div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
      <div class="container-fluid">
            <img src="./images/favicon.png" alt="Logo">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="../index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../display_all.php">Products</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./users_area/user_registration.php">My Account</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../cart.php"><i class="fas fa-shopping-cart "></i><sup><?php 
                cart_item();?></sup></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Total Price: <?php total_cart_price();?>/-</a>
              </li>
            </ul>
            <form class="d-flex" action="../search_product.php" method="get">
              <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
            <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
            </form>
        </div>
      </div>
    </nav>

    <?php
    cart();
?>



    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
      <ul class="navbar-nav me-auto">
        
        <?php
        if(!isset($_SESSION['username'])){
          echo " <li class='nav-item'>
          <a class='nav-link' href'#'>Welcome guest</a>
        </li> ";
        }else{
          echo "<li class='nav-item'>
          <a class='nav-link' href'#'>Welcome ".$_SESSION['username']."</a>
        </li>";
        }
if(!isset($_SESSION['username'])){
  echo " <li class='nav-item'>
  <a class='nav-link' href='user_login.php' >Login</a
</li> ";
}else{
   echo "<li class='nav-item'>
          <a class='nav-link' href='logout.php'>Logout</a>
        </li>";
}
        ?>
      </ul>
    </nav>



    <div class="bg-light">
      <h3 class="text-center">DreamerTECH Store</h3>
      <p class="text-center"> Communication is at the heart of e-commerce
      and community</p>
    </div>


    <div class="row">
        <div class="col-md-2">
            <ul class="navbar-nav bg-secondary text-center">
                <li class="nav-item bg-info">
                    <a href="#" class="nav-link text-light"><h4>Your profile</h4></a>
                </li>

                <?php
                    $username=$_SESSION['username'];
                    $user_image="Select * from `user_table` where username='$username'";
                    $user_image=mysqli_query($con,$user_image);
                    $row_image=mysqli_fetch_array($user_image);
                    $user_image=$row_image['user_image'];
                    echo "<li class='nav-item'>
                    <img src='./user_images/$user_image' class='profile_img my-4' 
                    alt''>
                    </li>";

                ?>
                
                
                <li class="nav-item bg-info">
                    <a href="profile.php" class="nav-link text-light"><h4>Pending Orders</h4></a>
                </li>
                <li class="nav-item bg-info">
                    <a href="profile.php?edit_account" class="nav-link text-light"><h4>Edit Account</h4></a>
                </li>
                <li class="nav-item bg-info">
                    <a href="profile.php?my_orders" class="nav-link text-light"><h4>My Orders</h4></a>
                </li>
                <li class="nav-item bg-info">
                    <a href="profile.php?delete_account" class="nav-link text-light"><h4>Delete Account</h4></a>
                </li>
                <li class="nav-item bg-info">
                    <a href="logout.php" class="nav-link text-light"><h4>Logout</h4></a>
                </li>
            </ul>
        </div>
        <div class="col-md-10 text-center">
      <?php  get_user_order_details();
      
      if(isset($_GET['edit_account'])){
        include('edit_account.php');
      }
      if(isset($_GET['my_orders'])){
        include('user_orders.php');
      }
      if(isset($_GET['delete_account'])){
        include('delete_account.php');
      }
      ?>
        </div>
    </div>
 
    <?php
    include("../footer.php")
    ?>
</div>  

    <script src="./js/jquery-3.3.1.js"></script>
    <script src="./js/bootstrap.bundle.js"></script>
</body>
</html>