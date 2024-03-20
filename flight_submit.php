<?php
require("./config.php");
include("./include/connection.php");
include("./include/navbar.php");
\Stripe\Stripe::setVerifySslCerts(false);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['stripeToken'])) {
    if (isset($_SESSION['u'])) {
        $user_id = $_SESSION['u'];
        $total_amount = $_SESSION['total_price'];

        try {
            $token = $_POST['stripeToken'];
            $amount = $total_amount * 100;

            $data = \Stripe\Charge::create([
                'amount' => $amount,
                'currency' => 'INR',
                'description' => 'Flight Booking Payment',
                'source' => $token,
            ]);

            // Payment successful, proceed with order creation
            $payment_status = "1";
            $transaction_id = $data->id;

            // Store payment details in session
            $_SESSION['transaction_id'] = $transaction_id;
            $bookin =  $_SESSION['booking_id'];
            // Update booked flight data with payment status and transaction ID
            $update_sql = "UPDATE booked_flights SET payment_status = 'success', TransactionID = '$transaction_id' WHERE booking_id = $bookin";
            if (mysqli_query($conn, $update_sql)) {
                 
                echo "success ";
            } else {
                // Error updating data
                echo "Error updating data: " . mysqli_error($conn);
            }

        } catch (\Stripe\Exception\InvalidRequestException $e) {
            // Handle Stripe API exceptions
            echo 'Error: ' . $e->getMessage();
        } catch (Exception $e) {
            // Handle other exceptions
            echo 'Error: ' . $e->getMessage();
        }
    } else {
        // User not logged in
        echo "User not logged in.";
    }
} else {
    // Invalid request
    echo "Invalid request.";
}
?>
