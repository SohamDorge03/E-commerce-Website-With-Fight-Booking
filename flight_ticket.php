<?php
include("./include/connection.php");


$booking_id = $_GET['booking_id'];
$query = "SELECT * FROM booked_flights WHERE booking_id = $booking_id";
$result = mysqli_query($conn, $query);
$flight = mysqli_fetch_assoc($result);

$ticket_html = '
<!DOCTYPE html>
<html>
<head>
    <title>Flight Ticket</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .ticket-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        .ticket-header {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            text-align: center;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .ticket-details {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="ticket-container">
        <div class="ticket-header">
            <h2>Flight Ticket</h2>
        </div>
        <div class="ticket-details">
            <p><strong>Booking ID:</strong> ' . $flight['booking_id'] . '</p>
            <p><strong>Flight ID:</strong> ' . $flight['flight_id'] . '</p>
            <p><strong>User ID:</strong> ' . $flight['user_id'] . '</p>
            <p><strong>Number of Seats:</strong> ' . $flight['take_seats'] . '</p>
            <p><strong>Flight Class:</strong> ' . $flight['flight_class'] . '</p>
            <p><strong>Airline ID:</strong> ' . $flight['airline_id'] . '</p>
            <p><strong>Transaction ID:</strong> ' . $flight['TransactionID'] . '</p>
            <p><strong>Total Amount:</strong> ' . $flight['total_amount'] . '</p>
            <p><strong>Payment Status:</strong> ' . ($flight['payment_status'] == '1' ? 'Paid' : 'Pending') . '</p>
            <p><strong>Booked Date:</strong> ' . $flight['booked_date'] . '</p>
        </div>
    </div>
</body>
</html>
';

echo $ticket_html;
?>
