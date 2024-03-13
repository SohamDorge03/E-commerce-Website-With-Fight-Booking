<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Report</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
        include("./include/navbar.php")
    ?>
    <div class="container">
        <h2>Order Report</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="from_date">From Date:</label>
                <input type="date" class="form-control" id="from_date" name="from_date" required>
            </div>
            <div class="form-group">
                <label for="to_date">To Date:</label>
                <input type="date" class="form-control" id="to_date" name="to_date" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status">
                    <option value="">All Details</option>
                    <option value="Pending">Pending</option>
                    <option value="Shipped">Shipped</option>
                    <option value="Delivered">Delivered</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Generate Report</button>
        </form>
        <?php
        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include("./include/connection.php");
            $from_date = $_POST['from_date'];
            $to_date = $_POST['to_date'];
            $status = $_POST['status'];

            // Construct SQL query based on selected options
            $sql = "SELECT * FROM orders WHERE order_date BETWEEN '$from_date' AND '$to_date'";
            if (!empty($status)) {
                if ($status != "All Details") {
                    $sql .= " AND status = '$status'";
                }
            }

            // Execute the query
            $result = $conn->query($sql);

            if ($result !== false && $result->num_rows > 0) {
                echo "<h3>Orders from $from_date to $to_date with Status: ";
                echo empty($status) ? "All Details" : $status;
                echo "</h3>";
                echo "<table class='table'>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>User ID</th>
                                <th>Order Date</th>
                                <th>Status</th>
                                <th>Payment Method</th>
                                <th>Payment Status</th>
                                <th>Transaction ID</th>
                                <th>Total Amount</th>
                            </tr>
                        </thead>
                        <tbody>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['order_id']}</td>
                            <td>{$row['user_id']}</td>
                            <td>{$row['order_date']}</td>
                            <td>{$row['status']}</td>
                            <td>{$row['payment_method']}</td>
                            <td>{$row['payment_status']}</td>
                            <td>{$row['transaction_id']}</td>
                            <td>{$row['total_amount']}</td>
                        </tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "No orders found for the selected criteria.";
            }
            $conn->close();
        }
        ?>
    </div>
</body>
</html>
