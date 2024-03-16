<?php
require("./config.php");

\Stripe\Stripe::setVerifySslCerts(false);
$token = $_POST['stripeToken'];

try {
    // Adjust the amount to meet or exceed the minimum charge amount required by Stripe
    $amount = 5000; // Charging ₹50.00 (represented in paise)
    
    $data = \Stripe\Charge::create([
        'amount' => $amount,
        'currency' => 'inr',
        'description' => 'Shopflix',
        'source' => $token,
         
    ]);

    echo "<pre>";
    print_r($data);
} catch (\Stripe\Exception\InvalidRequestException $e) {
    // Handle Stripe API exceptions
    echo 'Error: ' . $e->getMessage();
} catch (Exception $e) {
    // Handle other exceptions
    echo 'Error: ' . $e->getMessage();
}
?>