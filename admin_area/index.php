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
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/all.css">
    <style>
        .admin_image{
            width: 100px;
            object-fit: contain;
        }
        .footer{
            position: absolute;
            bottom: 0;
        }
        body{
            overflow-x:hidden;
        }
        .product_image{
            width:100px;
            object-fit:contain;
        }
        .product_img{
            width:50px;
            object-fit:contain;
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <img src="../images/favicon.png" alt="" class="logo">
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="" class="nav-link">welcome guest</a>
                        </li>
                    </ul>

                </nav>    
            </div>
        </nav>
        <div class="bg-light">
            <h3 class="text-center p-2">Manage Details</h3>
        </div>

        <div class="row">
            <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
                <div class="p-3">
                    <a href="#"><img src="../images/jamess.jpg" alt="" class="admin_image"></a>
                    <p class="text-light text-center">Admin Name</p>
                    </div>
                    <div class="button text-center">
                   <!-- button*10>a.nav-link.text-light.bg-info.my-1-->  
                        <button class="my-3"><a href="insert_product.php" class="nav-link text-light
                         bg-info my-1">Insert Products</a></button>
                         <button><a href="index.php?view_products" class="nav-link text-light
                          bg-info my-1">View products</a></button>
                          <button><a href="index.php?insert_category" class="nav-link text-light
                           bg-info my-1">Insert Categories</a></button>
                           <button><a href="index.php?view_categories" class="nav-link text-light
                                 bg-info my-1">View Categories</a></button>
                           <button><a href="index.php?insert_brand" class="nav-link text-light
                            bg-info my-1">Insert Brands</a></button>
                            <button><a href="index.php?view_brands" class="nav-link text-light
                             bg-info my-1">View Brands</a></button>
                             <button><a href="index.php?list_orders" class="nav-link text-light
                              bg-info my-1">All orders</a></button>
                              <button><a href="index.php?list_payments" class="nav-link text-light
                               bg-info my-1">All payments</a></button>
                               <button><a href="index.php?list_users" class="nav-link text-light
                                bg-info my-1">List users</a></button>
                                <button><a href="" class="nav-link text-light
                                 bg-info my-1">logout</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-1">
        <?php
        if(isset($_GET['insert_category'])){
            include('insert_categories.php');
        }
        if(isset($_GET['insert_brand'])){
            include('insert_brands.php');
        }
        if(isset($_GET['view_products'])){
            include('view_products.php');
        }
        if(isset($_GET['edit_products'])){
            include('edit_products.php');
        }
        if(isset($_GET['delete_product'])){
            include('delete_product.php');
        }
        if(isset($_GET['view_categories'])){
            include('view_categories.php');
        }
        if(isset($_GET['view_brands'])){
            include('view_brands.php');
        }
        if(isset($_GET['edit_category'])){
            include('edit_category.php');
        }
        if(isset($_GET['edit_brand'])){
            include('edit_brand.php');
        }
    
    if(isset($_GET['delete_category'])){
        include('delete_category.php');
    }
    if(isset($_GET['delete_brand'])){
        include('delete_brand.php');
    }
    if(isset($_GET['list_orders'])){
        include('list_orders.php');
    }
    if(isset($_GET['list_payments'])){
        include('list_payments.php');
    }
    if(isset($_GET['list_users'])){
        include('list_users.php');
    }
        ?>
    </div>
    
    
    <?php
    include("../footer.php")
    ?>




    <script src="../js/jquery-3.3.1.js"></script>
    <script src="../js/bootstrap.bundle.js"></script>
</body>
</html>