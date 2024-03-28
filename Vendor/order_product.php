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

// Initialize variables for date filtering
$filterFromDate = '';
$filterToDate = '';

// Check if form is submitted with date filter
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $filterFromDate = $_POST['filter_from_date'];
    $filterToDate = $_POST['filter_to_date'];

    // Validate dates to ensure from date is not greater than to date
    if ($filterFromDate > $filterToDate) {
        $temp = $filterFromDate;
        $filterFromDate = $filterToDate;
        $filterToDate = $temp;
    }

    // Validate to prevent selecting future dates
    $currentDate = date('Y-m-d');
    if ($filterFromDate > $currentDate) {
        $filterFromDate = $currentDate;
    }
    if ($filterToDate > $currentDate) {
        $filterToDate = $currentDate;
    }
}

// Query to fetch data from order_items table along with order_date, status, and company_name with date filter
$query = "SELECT oi.order_item_id, oi.order_id, oi.product_id, oi.quantity, p.vendor_id, o.order_date, o.status, v.company_name
          FROM order_items oi
          JOIN products p ON oi.product_id = p.product_id
          JOIN orders o ON oi.order_id = o.order_id
          JOIN vendors v ON p.vendor_id = v.vendor_id
          WHERE p.vendor_id = $vendor_id";

// Apply date filter if provided
if (!empty($filterFromDate) && !empty($filterToDate)) {
    $query .= " AND o.order_date BETWEEN '$filterFromDate' AND DATE_ADD('$filterToDate', INTERVAL 1 DAY)";
}

$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Items with Vendor ID</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .date-filter-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .date-filter-container label {
      margin-right: 10px;
    }

    .date-filter-container input[type="date"] {
      width: 150px;
      margin-right: 10px;
    }

    .date-filter-container button {
      padding: 8px 20px;
    }
  </style>
</head>
<body>
<?php include("./include/navbar.php"); ?>
<div class="container mt-4">
  <h2>Order Items with Vendor ID</h2>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="date-filter-container">
    <div>
      <label for="filter_from_date">From Date:</label>
      <input type="date" id="filter_from_date" name="filter_from_date" class="form-control" value="<?php echo $filterFromDate; ?>" max="<?php echo date('Y-m-d'); ?>">
    </div>
    <div>
      <label for="filter_to_date">To Date:</label>
      <input type="date" id="filter_to_date" name="filter_to_date" class="form-control" value="<?php echo $filterToDate; ?>" max="<?php echo date('Y-m-d'); ?>">
    </div>
    <div>
      <button type="submit" class="btn btn-primary">Apply Filter</button>
    </div>
  </form>
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
