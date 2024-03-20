<?php
session_start(); // Start the session

// Check if vendor_id is set in the session
if (!isset($_SESSION['vendor_id'])) {
    header("Location: login.php");
    exit();
}

$vendor_id = $_SESSION['vendor_id'];

// Database connection
include './include/connection.php';

// Query to fetch data from order_items table along with order_date, status, and company_name
$query = "SELECT oi.order_item_id, oi.order_id, oi.product_id, oi.quantity, p.vendor_id, o.order_date, o.status, v.company_name
          FROM order_items oi
          JOIN products p ON oi.product_id = p.product_id
          JOIN orders o ON oi.order_id = o.order_id
          JOIN vendors v ON p.vendor_id = v.vendor_id
          WHERE p.vendor_id = $vendor_id";

$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Items with Vendor ID</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php
include("./include/navbar.php");
?>
<div class="container mt-4">
  <h2>Order Items with Vendor ID</h2>
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Order Item ID</th>
          <th>Order ID</th>
          <th>Order Date</th>
          <th>Status</th>
          <th>Product ID</th>
          <th>Quantity</th>
          <th>Vendor ID</th>
          <th>Company Name</th>
          <!-- <th>Action</th> -->
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['order_item_id']}</td>";
                echo "<td>{$row['order_id']}</td>";
                echo "<td>{$row['order_date']}</td>";
                echo "<td>{$row['status']}</td>";
                echo "<td>{$row['product_id']}</td>";
                echo "<td>{$row['quantity']}</td>";
                echo "<td>{$row['vendor_id']}</td>";
                echo "<td>{$row['company_name']}</td>";
                // echo "<td><form method='post' action='process_order.php'><input type='hidden' value='{$row['order_item_id']}' name='order_item_id' /><button type='submit' name='confirm_button' class='btn btn-primary'>Confirm</button></form></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No order items found.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

</body>
</html>
