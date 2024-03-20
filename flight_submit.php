<?php
require("./config.php");
include("./include/connection.php");
include("./include/navbar.php");

\Stripe\Stripe::setVerifySslCerts(false);

// Check if the request method is POST and if the stripeToken is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['stripeToken'])) {
    // Check if the user is logged in
    if (isset($_SESSION['u'])) {
        $user_id = $_SESSION['u'];
        $total_amount = $_SESSION['total_price'];

        try {
            $token = $_POST['stripeToken'];
            $amount = $total_amount * 100;

            // Create a charge using Stripe API
            $data = \Stripe\Charge::create([
                'amount' => $amount,
                'currency' => 'INR',
                'description' => 'Flight Booking Payment',
                'source' => $token,
            ]);

            // Payment successful, proceed with order creation
            $payment_status = "success";
            $transaction_id = $data->id;

            // Store payment details in session
            $_SESSION['transaction_id'] = $transaction_id;
            $booking_id = $_SESSION['booking_id'];

            // Update booked flight data with payment status and transaction ID
            $update_sql = "UPDATE booked_flights SET payment_status = 'success', TransactionID = '$transaction_id' WHERE booking_id = $booking_id";
            if (mysqli_query($conn, $update_sql)) {
                // Payment success message
                echo "<div class='container mt-5'>
                        <div class='row justify-content-center'>
                            <div class='col-md-6'>
                                <div class='alert alert-success text-center' role='alert'>
                                    Payment successful
                                </div>
                            </div>
                        </div>
                    </div>";
            } else {
                // Error updating data
                echo "Error updating data: " . mysqli_error($conn);
            }

        } catch (\Stripe\Exception\InvalidRequestException $e) {
            // Handle Stripe API exceptions
            echo 'Stripe Error: ' . $e->getMessage();
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
