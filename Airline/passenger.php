<?php
session_start(); // Start the session

include("connection.php");


// Check if airline is logged in
if(isset($_SESSION['airline_id'])) {
    // Retrieve the airline ID from the session
    $airline_id = $_SESSION['airline_id'];

    $sql = "SELECT p.*, b.*, f.*, a.airline_name 
    FROM passenger p
    INNER JOIN booked_flights b ON p.booking_id = b.booking_id
    INNER JOIN flights f ON b.flight_id = f.flight_id
    INNER JOIN airlines a ON f.airline_id = a.airline_id
    WHERE a.airline_id = $airline_id";


    // Execute query
    $result = $conn->query($sql);

    // Check for errors in query execution
    if (!$result) {
        echo "Error: " . $conn->error;
    } else {
        // Check if any rows were returned
        if ($result->num_rows > 0) {
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Passenger Details</title>
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            </head>
            <body>
                <?php
                include("./navbar.php");
                ?>
                <div class="container mt-5">
                    <h1>Passenger Details</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Passenger ID</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>DOB</th>
                                <th>Gender</th>
                                <!-- <th>Seat Number</th>
                                <th>Gate Number</th>
                                <th>Boarding Time</th> -->
                                <th>Booking ID</th>
                                <th>Flight ID</th>
                                <th>Flight Code</th>
                                <th>Airline Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Loop through each row of data
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo $row['passenger_id']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['age']; ?></td>
                                    <td><?php echo $row['dob']; ?></td>
                                    <td><?php echo $row['gender']; ?></td>
                                    <!-- <td><?php echo $row['seatno']; ?></td>
                                    <td><?php echo $row['gateno']; ?></td>
                                    <td><?php echo $row['boarding_time']; ?></td> -->
                                    <td><?php echo $row['booking_id']; ?></td>
                                    <td><?php echo $row['flight_id']; ?></td>
                                    <td><?php echo $row['flight_code']; ?></td>
                                    <td><?php echo $row['airline_name']; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </body>
            </html>
            <?php
        } else {
            echo "No records found";
        }
    }
} else {
    // Redirect to log.php if not logged in
    echo "<script>window.location.href = 'log.php';</script>";

    exit();
}

// Close connection
$conn->close();
?>
