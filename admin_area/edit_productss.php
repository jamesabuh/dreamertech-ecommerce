

<?php
        if(isset($_GET['edit_products'])){
                $edit_id=$_GET['edit_products'];


                $get_data="Select * from `products` where product_id=$edit_id";
                $result=mysqli_query($con,$get_data);
                $row=mysqli_fetch_assoc($result);
                $product_title=$row['product_title'];
                echo $product_title;       
        }
?>


<div class="container mt-5">
        <h1 class="text-center">Edit Product</h1>
        <form action="" method="" enctype="multipart/form-data"></form>
</div>