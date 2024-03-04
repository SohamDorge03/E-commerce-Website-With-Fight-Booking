<?php
include("./connection.php");

// Query to fetch data from multiple tables using JOINs
$sql = "SELECT bf.booking_id, u.user_id, u.email, f.flight_id, f.flight_code, f.source_date, f.dep_airport_id, f.arr_airport_id, bf.take_seats, bf.flight_class, a.airline_name
        FROM booked_flights bf
        INNER JOIN users u ON bf.user_id = u.user_id
        INNER JOIN flights f ON bf.flight_id = f.flight_id
        INNER JOIN airlines a ON bf.airline_id = a.airline_id";

$result = $conn->query($sql);

// Check if the query executed successfully
if ($result === false) {
    echo "Error executing query: " . $conn->error;
} else {
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Booked Flights</title>
        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>

    <div class="container mt-5">
        <h2>Booked Flights</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Booking ID</th>
                <th>User ID</th>
                <th>Email</th>
                <th>Flight ID</th>
                <th>Flight Code</th>
                <th>Source Date</th>
                <th>Departure Airport ID</th>
                <th>Arrival Airport ID</th>
                <th>Take Seats</th>
                <th>Flight Class</th>
                <th>Airline</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["booking_id"] . "</td>";
                    echo "<td>" . $row["user_id"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["flight_id"] . "</td>";
                    echo "<td>" . $row["flight_code"] . "</td>";
                    echo "<td>" . $row["source_date"] . "</td>";
                    echo "<td>" . $row["dep_airport_id"] . "</td>";
                    echo "<td>" . $row["arr_airport_id"] . "</td>";
                    echo "<td>" . $row["take_seats"] . "</td>";
                    echo "<td>" . $row["flight_class"] . "</td>";
                    echo "<td>" . $row["airline_name"] . "</td>"; // corrected field name
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='11'>No booked flights found</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    </body>
    </html>

    <?php
    // Close database connection
    $conn->close();
}
?>
