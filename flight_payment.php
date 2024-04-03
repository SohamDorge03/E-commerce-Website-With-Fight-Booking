<?php
require("./config.php");
include("include/connection.php");
session_start();

if (isset($_SESSION['u'])) {
    $user_id = $_SESSION['u'];
    $sql = "SELECT c.*, f.flight_class, f.airline_id, f.price FROM cart c INNER JOIN flights f ON c.flight_id = f.flight_id WHERE c.user_id = '$user_id'";
    $result = $conn->query($sql);

   
    $total_amount = 0;
    $take_seats_total = 0;
    // $transaction_id = $_SESSION['t'];

    $booked_flights = array();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $total_amount += $row['price'] * $row['take_seats'];
            $take_seats_total += $row['take_seats'];
            
            $booked_flights[] = array(
                'flight_id' => $row['flight_id'],
                'take_seats' => $row['take_seats'],
                'flight_class' => $row['flight_class'],
                'airline_id' => $row['airline_id']
            );
        }
    }
} else {
    $result = false;
    $total_amount = 0;
    $take_seats_total = 0;
}

if ($result && $total_amount > 0) {
    $confirmation_status = 0;
    $payment_status = '0';
    $booked_date = date('Y-m-d H:i:s');

   
    $insert_booking_query = "INSERT INTO booked_flights (flight_id, user_id, take_seats, flight_class, airline_id, TransactionID, total_amount, confirmation_status, payment_status, booked_date) VALUES ";

    foreach ($booked_flights as $flight) {
        $flight_id = $flight['flight_id'];
        $take_seats = $flight['take_seats'];
        $flight_class = $flight['flight_class'];
        $airline_id = $flight['airline_id'];

        $insert_booking_query .= "('$flight_id', '$user_id', '$take_seats', '$flight_class', '$airline_id', '$transaction_id', '$total_amount', '$confirmation_status', '$payment_status', '$booked_date'),";
    }

 
    $insert_booking_query = rtrim($insert_booking_query, ",");

    if ($conn->query($insert_booking_query)) {
    
        $delete_cart_items_query = "DELETE FROM cart WHERE user_id = '$user_id'";
        $conn->query($delete_cart_items_query);

        echo "Booking created successfully.";
    } else {
        echo "Error creating booking: " . $conn->error;
    }
} else {
    echo "No flights booked or total amount is 0.";
    echo $_SESSION['booking_id'];
}
?>
