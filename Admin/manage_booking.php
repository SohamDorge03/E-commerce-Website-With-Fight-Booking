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
        <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="fromDate">From Date:</label>
                    <input type="date" class="form-control" id="fromDate" name="from_date" value="<?php echo isset($_GET['from_date']) ? $_GET['from_date'] : ''; ?>" max="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="toDate">To Date:</label>
                    <input type="date" class="form-control" id="toDate" name="to_date" value="<?php echo isset($_GET['to_date']) ? $_GET['to_date'] : ''; ?>" max="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="form-group col-md-3 align-self-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
        <table class="table">
            <thead style="background-color: #5F1E30;">
                <tr style="color: wheat;">
                    <th>Booking ID</th>
                    <th>Flight Code</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Seats</th>
                    <th>Transaction ID</th>
                    <th>Total Amount</th>
                    <th>Airline Name</th>
                    <th>Payment Status</th>
                    <th>Booked Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("./include/connection.php");

                $fromDate = isset($_GET['from_date']) ? $_GET['from_date'] : '';
                $toDate = isset($_GET['to_date']) ? $_GET['to_date'] : '';

                $sql = "SELECT bf.booking_id, f.flight_code, u.first_name, u.last_name, u.email, u.phone_number,
                                bf.take_seats, bf.TransactionID, bf.total_amount, bf.payment_status,
                                a.airline_id, a.airline_name, bf.booked_date
                        FROM booked_flights bf
                        INNER JOIN users u ON bf.user_id = u.user_id
                        INNER JOIN flights f ON bf.flight_id = f.flight_id
                        INNER JOIN airlines a ON f.airline_id = a.airline_id";

                if (!empty($fromDate) && !empty($toDate)) {
                    $sql .= " WHERE bf.booked_date BETWEEN '$fromDate' AND '$toDate'";
                }

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
                        echo "<td>" . $row['TransactionID'] . "</td>";
                        echo "<td>" . $row['total_amount'] . "</td>";
                        echo "<td>" . $row['airline_name'] . "</td>";
                        echo "<td>" . ($row['payment_status'] ? 'Paid' : 'Not Paid') . "</td>";
                        echo "<td>" . $row['booked_date'] . "</td>";
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
