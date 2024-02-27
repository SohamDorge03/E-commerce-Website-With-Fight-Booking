<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Optional CSS customizations */
        body {
            margin: 20px;
        }
        table {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Manage Bookings</h2>
        <div class="table-responsive">
            <?php
            // Database connection
            include("./include/connection.php");

            // Function to confirm booking
            if(isset($_POST['confirm_booking'])) {
                $booking_id = $_POST['booking_id'];
                $sql = "UPDATE manage_booking SET status='Confirmed' WHERE booking_id='$booking_id'";
                if ($conn->query($sql) === TRUE) {
                    echo "<div class='alert alert-success'>Booking confirmed successfully.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Error confirming booking: " . $conn->error . "</div>";
                }
            }

            // Function to delete booking
            if(isset($_POST['delete_booking'])) {
                $booking_id = $_POST['booking_id'];
                $sql = "DELETE FROM manage_booking WHERE booking_id='$booking_id'";
                if ($conn->query($sql) === TRUE) {
                    echo "<div class='alert alert-success'>Booking deleted successfully.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Error deleting booking: " . $conn->error . "</div>";
                }
            }

            // Fetch data from the database
            $sql = "SELECT booking_id, passenger_name, flight_no, gender, date, food FROM manage_booking";
            $result = $conn->query($sql);

            if ($result === false) {
                echo "<div class='alert alert-danger'>Error fetching data: " . $conn->error . "</div>";
            } else {
                if ($result->num_rows > 0) {
                    echo "<table class='table table-striped table-bordered'>
                    <thead>
                    <tr>
                    <th>Booking ID</th>
                    <th>Passenger Name</th>
                    <th>Flight Number</th>
                    <th>Gender</th>
                    <th>Date</th>
                    <th>Food</th>
                    <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>";

                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                        <td>" . $row["booking_id"] . "</td>
                        <td>" . $row["passenger_name"] . "</td>
                        <td>" . $row["flight_no"] . "</td>
                        <td>" . $row["gender"] . "</td>
                        <td>" . $row["date"] . "</td>
                        <td>" . $row["food"] . "</td>
                        <td>
                        <form action='manage_booking.php' method='post'>
                        <input type='hidden' name='booking_id' value='" . $row["booking_id"] . "'>
                        <button type='submit' name='confirm_booking' class='btn btn-success'>Confirm</button>
                        <button type='submit' name='delete_booking' class='btn btn-danger'>Delete</button>
                        </form>
                        </td>
                        </tr>";
                    }
                    echo "</tbody></table>";
                } else {
                    echo "<div class='alert alert-warning'>0 results</div>";
                }
            }

            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
