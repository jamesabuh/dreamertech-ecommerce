<?php


$ref = $_GET['reference'];
if ($ref == ""){
  header("location:javascript://history.go(-1)");
}
?>



<?php
  $curl = curl_init();

  

  curl_setopt_array($curl, array(

    CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($ref),

    CURLOPT_RETURNTRANSFER => true,

    CURLOPT_ENCODING => "",

    CURLOPT_MAXREDIRS => 10,

    CURLOPT_TIMEOUT => 30,

    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

    CURLOPT_CUSTOMREQUEST => "GET",

    CURLOPT_HTTPHEADER => array(

      "Authorization: Bearer sk_live_6b26a51b863b6b66b02968563b779b9a0cb0afcd",

      "Cache-Control: no-cache",

    ),

  ));

  

  $response = curl_exec($curl);

  $err = curl_error($curl);


  curl_close($curl);

  

  if ($err) {

    echo "cURL Error #:" . $err;

  } else {

   // echo $response;
   $result = json_decode($response);

  }
  if ($result->data->status == 'success'){
          $status = $result->data->status;
          $reference = $result->data->reference;
          $lname = $result->data->customer->last_name;
          $fname = $result->data->customer->first_name;
          $fullname = $lname.' '.$fname;
          $cus_email = $result->data->customer->email;
          date_default_timezone_set('Africa/Lagos');
          $Date_time = date('m/d/y h:i:s a', time());

          include('../includes/connect.php');
          $stmt = $con->prepare("INSERT INTO custumer_details (status,
          reference, Fullname, date_purchased, email) VALUES
          (?, ?, ?, ?, ?,");
          $stmt->bind_param("sssss, $status, $reference, $fullname, $Date_time, $Cus_email");
          $stmt->excute();
          if ($stmt) {
            echo 'There was a problem on your code'. mysqli_error($con);
          }
          else{
            header("loction: success.php?status=success");
          exit;
          }
          $stmt->close();
          $con->close();
  } 
  else{
    header("location: error.html");
  exit;
  }

?>