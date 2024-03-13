<?php
session_start();

if(!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Report</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    .container{
        margin-top: 70px;
        margin-left: 26px;
    }
</style>
<body>
<?php
include("./include/navbar.php");
?>
    <div class="container mt-5">
        <h2>Order Report</h2>
        <form method="GET" action="">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="from_date">From Date:</label>
                    <input type="date" class="form-control form-control-sm" id="from_date" name="from_date">
                </div>
                <div class="form-group col-md-4">
                    <label for="to_date">To Date:</label>
                    <input type="date" class="form-control form-control-sm" id="to_date" name="to_date">
                </div>
                <div class="form-group col-md-4">
                    <label for="status">Select Status:</label>
                    <select class="form-control form-control-sm" id="status" name="status">
                        <option value="">All</option>
                        <option value="Pending">Pending</option>
                        <option value="Processing">Processing</option>
                        <option value="Completed">Completed</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Generate Report</button>
            <a href="order_generate_pdf.php?from_date=<?php echo $_GET['from_date'] ?? ''; ?>&to_date=<?php echo $_GET['to_date'] ?? ''; ?>&status=<?php echo $_GET['status'] ?? ''; ?>" class="btn btn-success">Generate PDF</a>
        </form>

        <?php
         include("./include/connection.php");

        if(isset($_GET['from_date']) && isset($_GET['to_date'])) {
            $from_date = $_GET['from_date'];
            $to_date = $_GET['to_date'];
            $status = isset($_GET['status']) ? $_GET['status'] : '';

            $sql = "SELECT * FROM orders WHERE DATE(order_date) BETWEEN '$from_date' AND '$to_date'";
            if (!empty($status)) {
                $sql .= " AND status = '$status'";
            }

            $result = $conn->query($sql);

            if (!$result) {
                echo "Error: " . $conn->error;
                error_log("SQL Error: " . $conn->error);
            } elseif ($result->num_rows > 0) {
                echo "<h3>Orders from $from_date to $to_date with status '$status':</h3>";
                echo "<table class='table'>";
                echo "<thead><tr><th>Order ID</th><th>User ID</th><th>Order Date</th><th>Status</th><th>Total Amount</th></tr></thead>";
                echo "<tbody>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>".$row["order_id"]."</td><td>".$row["user_id"]."</td><td>".$row["order_date"]."</td><td>".$row["status"]."</td><td>".$row["total_amount"]."</td></tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "No orders found between $from_date and $to_date with status '$status'";
            }
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
