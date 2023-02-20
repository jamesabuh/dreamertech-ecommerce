 <?php
 include('../includes/connect.php');
 if(isset($_POST['insert_product'])){

    $product_tile=$_POST['product_title'];
    $description=$_POST['description'];
    $product_keywords=$_POST['product_keywords'];
    $product_category=$_POST['product_category'];
    $product_brands=$_POST['product_brands'];
    $product_price=$_POST['product_price'];
    $product_status='true';


    $product_image1=$_FILES['product_image1']['name'];
    $product_image2=$_FILES['product_image2']['name'];
    $product_image3=$_FILES['product_image3']['name'];


    $temp_image1=$_FILES['product_image1']['tmp_name'];
    $temp_image2=$_FILES['product_image2']['tmp_name'];
    $temp_image3=$_FILES['product_image3']['tmp_name'];

    if($product_tile=='' or $description=='' or $product_keywords=='' or
     $product_category=='' or $product_brands=='' or $product_price==''
      or $product_image1=='' or $product_image2=='' or $product_image3==''){
        echo "<script>alert('Please fill all the avaliable fields')</script>";
        exit();
    }else{
        move_uploaded_file($temp_image1,"./product_images/$product_image1");
        move_uploaded_file($temp_image2,"./product_images/$product_image2");
        move_uploaded_file($temp_image3,"./product_images/$product_image3");
    

        $insert_products="insert into `products`
         (product_title,
        product_description,
        product_keywords,
        category_id,brand_id,product_image1,product_image2, 
        product_image3,product_price,date,status) values ('$product_tile','$description','$product_keywords',
        '$product_category','$product_brands','$product_image1',
        '$product_image2','$product_image3','$product_price',now(),'$product_status')";
        $result_query=mysqli_query($con,$insert_products);
        if($result_query){
            echo "<script>alert('Successfully inserted the products')</script>";
        }
    }
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products-Admin Dashboard</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/all.css">
</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Products</h1>

        <form action="" method="post" enctype="multipart/form-data">
          <div class="form-outline mb-4 w-50 m-auto">  
            <label for="product_title" class="form-label">
                Product title</label>
                <input type="text" name="product_title"
                id="product_title" class="form-control" 
                placeholder="Enter product title"
            autocomplete="off" required="required">
          </div>


          <div class="form-outline mb-4 w-50 m-auto">  
            <label for="description" class="form-label">
               Product description</label>
                <input type="text" name="description"
                id="description" class="form-control" 
                placeholder="Enter product description"
            autocomplete="off" required="required">
          </div>


          <div class="form-outline mb-4 w-50 m-auto">  
            <label for="product_keywords" class="form-label">
               Product keywords</label>
                <input type="text" name="product_keywords"
                id="product_keywords" class="form-control" 
                placeholder="Enter Product keywords"
            autocomplete="off" required="required">
          </div>


          <div class="form-outline mb-4 w-50 m-auto">  
            <select name="product_category" id="" class="form-select">
                    <option value="">Select  a Category</option>
                    <?php
                    $select_query="Select * from `categories`";
                    $result_query=mysqli_query($con,$select_query);
                    while($row=mysqli_fetch_assoc($result_query)){
                        $category_title=$row['category_title'];
                        $category_id=$row['category_id'];
                        echo "<option value='$category_id'>$category_title</option>";
                    }
                    ?>
                 <!--   <option value="">category1</option>
                    <option value="">category2</option>
                    <option value="">category3</option>
                    <option value="">category4</option>-->
                </select>
          </div>


          <div class="form-outline mb-4 w-50 m-auto">  
            <select name="product_brands" id="" class="form-select">
                    <option value="">Select  a brands</option>
                    <?php
                    $select_brands="Select * from `brands`";
                    $result_brands=mysqli_query($con,$select_brands);
                    while($row=mysqli_fetch_assoc($result_brands)){
                        $brand_title=$row['brand_title'];
                        $brand_id=$row['brand_id'];
                        echo "<option value='$brand_id'>$brand_title</option>";
                    }
                    ?>
                 <!--   <option value="">brands1</option>
                    <option value="">brands2</option>
                    <option value="">brands3</option>
                    <option value="">brands4</option>-->
                </select>
          </div>


          <div class="form-outline mb-4 w-50 m-auto">  
            <label for="product_image1" class="form-label">
            product image 1</label>
                <input type="file" name="product_image1"
                id="product_image1" class="form-control" 
            autocomplete="off" required="required">
          </div>

          <div class="form-outline mb-4 w-50 m-auto">  
            <label for="product_image2" class="form-label">
            product image 2</label>
                <input type="file" name="product_image2"
                id="product_image2" class="form-control" 
            autocomplete="off" required="required">
          </div>


          <div class="form-outline mb-4 w-50 m-auto">  
            <label for="product_image3" class="form-label">
            product image 3</label>
                <input type="file" name="product_image3"
                id="product_image3" class="form-control" 
            autocomplete="off" required="required">
          </div>


          <div class="form-outline mb-4 w-50 m-auto">  
            <label for="product_price" class="form-label">
            product price</label>
                <input type="text" name="product_price"
                id="product_price" class="form-control" 
            placeholder="Enter product price" autocomplete="off" required="required">
          </div>

          <div class="form-outline p-4 w-50 m-auto">  
                <input type="submit" name="insert_product"
                class="btn btn-info mb-3 px-3" value="Insert Products"> 
          </div>
        </form>
    
    </div>
    


    <script src="./js/jquery-3.3.1.js"></script>
    <script src="./js/bootstrap.bundle.js"></script>
</body>
</html>