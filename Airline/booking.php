<?php
// Check if the session has not started
if (session_status() == PHP_SESSION_NONE) {
    // Start the session
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION['airline_id'])) {
    // Redirect to the login page if not logged in
    header("Location: log.php");
    exit();
}

include("./connection.php");

// Initialize $result variable
$result = null;

// Fetch the logged-in user's airline ID from the session
$airline_id = $_SESSION['airline_id'];

// SQL query to fetch booked flights data for the current logged-in airline
$sql = "SELECT bf.booking_id, bf.flight_id, bf.user_id, bf.take_seats, bf.flight_class, a.airline_name, bf.TransactionID, bf.total_amount, bf.payment_status, bf.booked_date 
        FROM booked_flights bf
        LEFT JOIN airlines a ON bf.airline_id = a.airline_id
        WHERE bf.airline_id = $airline_id";

// Execute the query and handle errors
$result = $conn->query($sql);
if ($result === false) {
    // Handle query execution error
    echo "Error executing SQL query: " . $conn->error;
    // Optionally, you can log the error or redirect the user to an error page
}

// Close the database connection
$conn->close();
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
                <thead style="background-color: black; color:white">
                    <tr>
                        <th>Booking ID</th>
                        <th>Flight ID</th>
                        <th>User ID</th>
                        <th>Take Seats</th>
                        <!-- <th>Flight Class</th> -->
                        <th>Airline</th>
                        <th>Transaction ID</th>
                        <th>Total Amount</th>
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
                            
                                    <td>".$row["airline_name"]."</td>
                                    <td>".$row["TransactionID"]."</td>
                                    <td>".$row["total_amount"]."</td>
                                    <td>".$row["payment_status"]."</td>
                                    <td>".$row["booked_date"]."</td>
                                </tr>";
                        }
                    } else {
                        // No results found for the current user
                        echo "<tr><td colspan='10'>No results found for the current user.</td></tr>";
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
