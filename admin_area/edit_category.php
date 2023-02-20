<div class="container mt-3">
    <h1 class="text-center">Edit Category</h1>
    <form action="" method="post" class="text-center">
        <div class="form-outline mb-4">
            <label for="category_title" class="form-label">Category Title</label>
            <input type="text" name="<?php echo $category_title?>" id="category_title" class="form-control"
            required="required">
        </div>
        <div class="w-50 m-auto">
            <input type="submit" class="btn btn-info px-3 mb-3" name="edit_category" value="Update ctegory">
        </div>
    </form>
</div>


<?php
if(isset($_GET['edit_category'])){
    $category_id=$_GET['edit_category'];


    $select_category="Select * from `categories` where category_id=$category_id";
    $result_category=mysqli_query($con,$select_category);
    $row_category=mysqli_fetch_assoc($result_category);
    $category_title=$row_category['category_title'];



    
    


}
?>

