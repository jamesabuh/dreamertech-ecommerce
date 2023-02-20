<?php
include('../includes/connect.php');
session_start();
if(isset($_GET['order_id'])){
    $order_id=$_GET['order_id'];
  //  echo $order_id;
  $select_data="Select * from `user_orders` where order_id=$order_id";
  $result=mysqli_query($con,$select_data);
  $row_fetch=mysqli_fetch_assoc($result);
  $invoice_number=$row_fetch['invoice_number'];
  $amount_due=$row_fetch['amount_due'];
}

if(isset($_POST['confirm_payment'])){
    $invoice_number=$_POST['invoice_number'];
    $amount=$_POST['amount'];
    $payment_mode=$_POST['payment_mode'];
    $insert_query="insert into `user_payments` (order_id,invoice_number,amount,payment_mode)
    values ($order_id,$invoice_number,$amount,'$payment_mode')";
    $result=mysqli_query($con,$insert_query);
    if($result){
        echo "<h3 class='text-center text-light'>Successfully complete the payment</h3>";
        echo "<script>window.open('profile.php?my_orders','_self')</script>";
    }
    $update_orders="update `user_orders` set order_status='Complete' where order_id=$order_id";
    $result_orders=mysqli_query($con,$update_orders);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>payment page</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body class="bg-secondary">
    <div class="container my-5">
    <h1 class="text-center text-light">Confirm payment</h1>
        <form action="" id="paymentForm" method="post">
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="text" class="form-control w-50 m-auto" id="invoice_number" name="invoice_number"
                value="<?php echo $invoice_number ?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="" class="text-light">Amount</label>
                <input type="text" class="form-control w-50 m-auto" id="amount" name="amount"
                value="<?php echo $amount_due ?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="" class="text-light">email</label>
                <input type="email" class="form-control w-50 m-auto" id="email" name="email"
                >
            </div>

            <div class="form-outline my-4 text-center w-50 m-auto ">

                <button type="submit" class="bg-info py-2 px-3 border-0" onclick="payWithPaystack()"> Pay </button>

            </div>
        </form>
    </div>
    

    <script src="https://js.paystack.co/v1/inline.js"></script> 
    <script>
            const paymentForm = document.getElementById('paymentForm');

paymentForm.addEventListener("submit", payWithPaystack, false);

function payWithPaystack(e) {

  e.preventDefault();


  let handler = PaystackPop.setup({

    key: 'pk_live_2a9dd7707735e5630fc1c85282bf407a4d5c6039', // Replace with your public key

    email: document.getElementById("email").value,

    amount: document.getElementById("amount").value * 100,

    ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you

    // label: "Optional string that replaces customer email"

    onClose: function(){
        window.location = "http://localhost/dreamertech/index.php?transaction=cancel";

      alert('Transaction cancelled .');

    },

    callback: function(response){

      let message = 'Payment complete! Reference: ' + response.reference;

      alert(message);
      window.location = "http://localhost/dreamertech/verify_transaction.php?reference=" + response.reference;

    }

  });


  handler.openIframe();

}
    </script>
</body>
</html>
