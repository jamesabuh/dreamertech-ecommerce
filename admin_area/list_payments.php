
<h3 class="text-center text-success">All payments</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <?php
$get_payments="select * from `user_payments`";
$result=mysqli_query($con,$get_payments);
$row_count=mysqli_num_rows($result);
echo "
<tr>
<th>S1 no</th>
<th>Amount</th>
<th>Invoice number</th>
<th>Order date</th>
<th>Pyment mode</th>
<th>Delete</th>
</tr>
</thead>
    <tbody class='bg-secondary text-light'>";

        if($row_count===0){
            echo "<h2 class='bg-danger text-center mt-5'>No payments yet</h2>";

        }else{
            $number=0;
            while($row_data=mysqli_fetch_assoc($result)){
                $order_id=$row_data['order_id'];
                $payments_id=$row_data['payments_id'];
                $amount=$row_data['amount'];
                $invoice_number=$row_data['invoice_number'];
                $date=$row_data['date'];
                $payment_mode=$row_data['payment_mode'];
                $number++;
                echo "
                <tr>
                <td>$number</td>
                <td>$amount</td>
                <td>$invoice_number</td>
                <td>$date</td>
                <td>$payment_mode</td>
                <td><a href='' class='text-light'>
            <i class='fas fa-trash'></i></a></td>
                 </tr>";
            }
        }
        ?>
        
 
    </tbody>
</table>