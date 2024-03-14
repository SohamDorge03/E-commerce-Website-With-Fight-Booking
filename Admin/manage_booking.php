<?php
session_start();

if(!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Booked Flights</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
      .container{
        margin-top: 80px;
        margin-left: 10px;
      }
    </style>
</head>
<body>
    <?php
    include("./include/navbar.php");
    ?>
    <div class="container mt-5">
        <h2>Booked Flights</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Flight Code</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Seats</th>
                    <th>Flight Class</th>
                    <th>Transaction ID</th>
                    <th>Total Amount</th>
                    <th>Airline Name</th>
                    <th>Payment Status</th>
                    <th>Booking Status</th> 
                </tr>
            </thead>
            <tbody>
                <?php
                include("./include/connection.php");
                
            
                $sql = "SELECT bf.booking_id, f.flight_code, u.first_name, u.last_name, u.email, u.phone_number,
                                bf.take_seats, bf.flight_class, bf.TransactionID, bf.total_amount, bf.payment_status,
                                a.airline_id, a.airline_name
                        FROM booked_flights bf
                        INNER JOIN users u ON bf.user_id = u.user_id
                        INNER JOIN flights f ON bf.flight_id = f.flight_id
                        INNER JOIN airlines a ON f.airline_id = a.airline_id"; // Join with airlines table

                $result = mysqli_query($conn, $sql);
                
                if (!$result) {
                    die("Query failed: " . mysqli_error($conn));
                }
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['booking_id'] . "</td>";
                        echo "<td>" . $row['flight_code'] . "</td>";
                        echo "<td>" . $row['first_name'] . "</td>";
                        echo "<td>" . $row['last_name'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['phone_number'] . "</td>";
                        echo "<td>" . $row['take_seats'] . "</td>";
                        echo "<td>" . $row['flight_class'] . "</td>";
                        echo "<td>" . $row['TransactionID'] . "</td>";
                        echo "<td>" . $row['total_amount'] . "</td>";
                        echo "<td>" . $row['airline_name'] . "</td>"; //
                        echo "<td>" . ($row['payment_status'] ? 'Paid' : 'Not Paid') . "</td>";
                        
                       
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='13'>No records found</td></tr>";
                }

                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
