<?php
session_start();

if(!isset($_SESSION['email'])) {
    header("Location: log.php");
    exit();
}

include("./connection.php");

// Fetch the logged-in user's email
$email = $_SESSION['email'];

// Fetch the airline's ID based on their email
$sql_airline_id = "SELECT airline_id FROM airlines WHERE email = '$email'";
$result_airline_id = $conn->query($sql_airline_id);
if ($result_airline_id->num_rows > 0) {
    $row_airline_id = $result_airline_id->fetch_assoc();
    $airline_id = $row_airline_id['airline_id'];
    
    // SQL query to fetch booked flights data for the current logged-in airline
    $sql = "SELECT bf.booking_id, bf.flight_id, bf.user_id, bf.take_seats, bf.flight_class, a.airline_name, bf.TransactionID, bf.total_amount, bf.book_status, bf.payment_status, bf.booked_date 
            FROM booked_flights bf
            LEFT JOIN airlines a ON bf.airline_id = a.airline_id
            WHERE bf.airline_id = $airline_id";

    // Execute the query
    $result = $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booked Flights</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include("./navbar.php"); ?>
    <div class="container mt-5">
        <h2>Booked Flights</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Flight ID</th>
                        <th>User ID</th>
                        <th>Take Seats</th>
                        <th>Flight Class</th>
                        <th>Airline</th>
                        <th>Transaction ID</th>
                        <th>Total Amount</th>
                        <th>Booking Status</th>
                        <th>Payment Status</th>
                        <th>Booked Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if there are any results
                    if ($result && $result->num_rows > 0) {
                        // Output data of each row in a table format
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>".$row["booking_id"]."</td>
                                    <td>".$row["flight_id"]."</td>
                                    <td>".$row["user_id"]."</td>
                                    <td>".$row["take_seats"]."</td>
                                    <td>".$row["flight_class"]."</td>
                                    <td>".$row["airline_name"]."</td>
                                    <td>".$row["TransactionID"]."</td>
                                    <td>".$row["total_amount"]."</td>
                                    <td>".$row["book_status"]."</td>
                                    <td>".$row["payment_status"]."</td>
                                    <td>".$row["booked_date"]."</td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='11'>No results found for the current user.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
// Close connection
$conn->close();
?>
