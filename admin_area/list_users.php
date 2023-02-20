
<h3 class="text-center text-success">All users</h3>
<table class="table table-bordered mt-5 text-center">
    <thead class="bg-info">
        <?php
$get_users="select * from `user_table`";
$result=mysqli_query($con,$get_users);
$row_count=mysqli_num_rows($result);
echo "
<tr>
<th>S1 no</th>
<th>Username</th>
<th>User email</th>
<th>User password</th>
<th>User image</th>
<th>User address</th>
<th>User mobile</th>
<th>Delete</th>
</tr>
</thead>
    <tbody class='bg-secondary text-light'>";

        if($row_count===0){
            echo "<h2 class='bg-danger text-center mt-5'>No users yet</h2>";

        }else{
            $number=0;
            while($row_data=mysqli_fetch_assoc($result)){
                $user_id=$row_data['user_id'];
                $username=$row_data['username'];
                $user_email=$row_data['user_email'];
                $user_password=$row_data['user_password'];
                $user_image=$row_data['user_image'];
                $user_address=$row_data['user_address'];
                $user_mobile=$row_data['user_mobile'];
                $number++;
                echo "
                <tr>
                <td>$number</td>
                <td>$username</td>
                <td>$user_email</td>
                <td>$user_password</td>
                <td><img src='../users_area/user_images/$user_image' alt='$user_image' class='product_img'/></td>
                <td>$user_address</td>
                <td>$user_mobile</td>
                <td><a href='' class='text-light'>
            <i class='fas fa-trash'></i></a></td>
                 </tr>";
            }
        }
        ?>
        
 
    </tbody>
</table>