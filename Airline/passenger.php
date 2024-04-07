<?php
session_start();

include("connection.php");


if(isset($_SESSION['airline_id'])) {
    $airline_id = $_SESSION['airline_id'];

    $sql = "SELECT p.*, b.*, f.*, a.airline_name 
    FROM passenger p
    INNER JOIN booked_flights b ON p.booking_id = b.booking_id
    INNER JOIN flights f ON b.flight_id = f.flight_id
    INNER JOIN airlines a ON f.airline_id = a.airline_id
    WHERE a.airline_id = $airline_id";


    $result = $conn->query($sql);

    if (!$result) {
        echo "Error: " . $conn->error;
    } else {
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
                        <thead style="color:wheat;">
                            <tr style="background-color:#000080;">
                                <th>Passenger ID</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>DOB</th>
                                <th>Gender</th>
                                <th>Booking ID</th>
                                <th>Flight ID</th>
                                <th>Flight Code</th>
                                <th>Airline Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo $row['passenger_id']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['age']; ?></td>
                                    <td><?php echo $row['dob']; ?></td>
                                    <td><?php echo $row['gender']; ?></td>
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
    echo "<script>window.location.href = 'log.php';</script>";

    exit();
}

$conn->close();
?>
