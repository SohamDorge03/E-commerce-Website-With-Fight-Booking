<?php

include_once './include/connection.php';

$from_date = "";
$to_date = "";

if(isset($_POST['from_date']) && isset($_POST['to_date'])) {
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $sql = "SELECT * FROM booked_flights WHERE DATE(booked_date) BETWEEN '$from_date' AND '$to_date'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        // Display error message
        echo "Error: " . mysqli_error($conn);
    } else {

        if (mysqli_num_rows($result) > 0) {
            echo "<table class='table'>";
            echo "<thead><tr><th>Booking ID</th><th>Flight ID</th><th>User ID</th><th>Take Seats</th><th>Flight Class</th><th>Transaction ID</th><th>Total Amount</th><th>Payment Status</th><th>Book Status</th><th>Book Date</th></tr></thead>";
            echo "<tbody>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['booking_id'] . "</td>";
                echo "<td>" . $row['flight_id'] . "</td>";
                echo "<td>" . $row['user_id'] . "</td>";
                echo "<td>" . $row['take_seats'] . "</td>";
                echo "<td>" . $row['flight_class'] . "</td>";
                echo "<td>" . $row['TransactionID'] . "</td>";
                echo "<td>" . $row['total_amount'] . "</td>";
                echo "<td>" . ($row['payment_status'] ? 'Paid' : 'Unpaid') . "</td>";
                echo "<td>" . ($row['book_status'] ? 'Booked' : 'Not Booked') . "</td>";
                echo "<td>" . $row['book_date'] . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "No data found for the selected date range.";
        }
    }
}

mysqli_close($conn);
?>
