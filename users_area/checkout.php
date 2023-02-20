<?php
include('../includes/connect.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce website-Checkout page</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/all.css">   
    <link rel="stylesheet" href="../css/style.css">    
</head>
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
                <a class="nav-link" href="user_registration.php">Register</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
              </li>
         
            </ul>
            <form class="d-flex" action="search_product.php" method="get">
              <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
            <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
            </form>
        </div>
      </div>
    </nav>




    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
      <ul class="navbar-nav me-auto">
        
        <?php
        if(!isset($_SESSION['username'])){
          echo " <li class='nav-item'>
          <a class='nav-link' href='#'>Welcome guest</a>
        </li> ";
        }else{
          "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome ".$_SESSION['username']."</a>
        </li>";
        }
if(!isset($_SESSION['username'])){
  echo " <li class='nav-item'>
  <a class='nav-link' href='./user_login.php'>Login</a
</li> ";
}else{
  "<li class='nav-item'>
          <a class='nav-link' href='logout.php'>Logout</a>
        </li>";
}
      ?>
        
      </ul>
    </nav>
</div> 


    <div class="bg-light">
      <h3 class="text-center">Hidden Store</h3>
      <p class="text-center"> Communication is at the heart of e-commerce
      and community</p>
    </div>

    <div class="row px-1">
      <div class="col-md-10">
        <div class="row">
            <?php
        if(!isset($_SESSION['username'])){
            include('user_login.php');
        }else{
            include('payment.php');
        }
        
        ?>
        
      </div>
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