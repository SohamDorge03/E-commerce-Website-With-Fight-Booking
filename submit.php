<?php
require("./config.php");
include("include/connection.php");
\Stripe\Stripe::setVerifySslCerts(false);

if (isset($_POST['stripeToken'])) {
    $token = $_POST['stripeToken'];


    try {
        session_start();
        if (isset($_SESSION['u'])) {
            $user_id = $_SESSION['u'];
            $total_amount = $_POST['total_amount'];

            $amount = $total_amount * 100;

            $data = \Stripe\Charge::create([
                'amount' => $amount,
                'currency' => 'INR',
                'description' => 'Shopflix Purchase',
                'source' => $token,
            ]);


            $payment_status = "1";
            $transaction_id = $data->id;
            $_SESSION['a'] = $amount;
            $_SESSION['t'] = $token;

            header("Location: payment.php");
        } else {

            echo "User not logged in.";
            exit();
        }
    } catch (\Stripe\Exception\InvalidRequestException $e) {

        echo 'Error: ' . $e->getMessage();
    } catch (Exception $e) {

        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo "stripeToken is not set in the POST request.";
}
