<?php
include 'src/instamojo.php';


$product_name = "Yipli SmartMat-"."".$_POST["FinalProductType"];
$subcriptionProduct = $_POST["FinalProductType"];
$name = $_POST["firstname"]." ".$_POST["lastname"];
$phone = "+91".$_POST["mobileno"];
$email = $_POST["email"];
$address = $_POST["address"];
$address2 = $_POST["address2"];
$zip = $_POST["zip"];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$qty = $_POST["qty"];
$price =  $_POST["totalPrice"];




/*
 echo '<p>'.$product_name.' '.$subcriptionProduct.' '.$phone.' '.$email.' '.$address.' '.$address2.' '.$zip.' '.$firstname.' '.$lastname.' '.$qty.' '.$price.'</p>';*/


// --------------------paste private key and auth -----------------------

$api = new Instamojo\Instamojo('9326a9e66973314439cc8a3d22910e7b', '821c33177885793a28ba331af861dd6e','https://www.instamojo.com/api/1.1/');

/*
$api = new Instamojo\Instamojo('test_d55d253d8863880dcd6d9bf4dcd', 'test_69b53826a51744eaf753256859a','https://test.instamojo.com/api/1.1/');
*/
try {
    $response = $api->paymentRequestCreate(array(
        "purpose" => $product_name,
        "amount" => $price,
        "buyer_name" => $name,
        "phone" => $phone,
        "send_email" => true,
        "send_sms" => true,
        "email" => $email,
        'allow_repeated_payments' => false,
        "redirect_url" => "https://playyipli.com/thankyou.php",
        "webhook" => "https://playyipli.com/webhook.php"
        ));
    //print_r($response);

    $pay_ulr = $response['longurl'];

    //Redirect($response['longurl'],302); //Go to Payment page

    header("Location: $pay_ulr");
    exit();

}
catch (Exception $e) {
    print('Error: ' . $e->getMessage());
}
  ?>
