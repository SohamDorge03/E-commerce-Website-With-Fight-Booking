<?php
require("./config.php");
include("include/connection.php");
\Stripe\Stripe::setVerifySslCerts(false);

if(isset($_POST['stripeToken'])) {
    $token = $_POST['stripeToken'];


    try {
        session_start();
        if (isset($_SESSION['u'])) {
            $user_id = $_SESSION['u'];
            $total_amount = $_POST['total_amount']; 

            // Adjust the amount to meet or exceed the minimum charge amount required by Stripe
            $amount = $total_amount * 100; // Convert to cents

            // Create Stripe charge
            $data = \Stripe\Charge::create([
                'amount' => $amount,
                'currency' => 'INR',
                'description' => 'Shopflix Purchase',
                'source' => $token,
            ]);

            // Payment successful, proceed with order creation
            $payment_status = "1";
            $transaction_id = $data->id;
$_SESSION['a'] = $amount;
$_SESSION['t'] = $token;

header("Location:flight_ payment.php");
          
        } else {
            // User not logged in
            echo "User not logged in.";
            exit();
        }
    } catch (\Stripe\Exception\InvalidRequestException $e) {
        // Handle Stripe API exceptions
        echo 'Error: ' . $e->getMessage();
    } catch (Exception $e) {
        // Handle other exceptions
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo "stripeToken is not set in the POST request.";
}
?>