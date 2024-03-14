<?php

include './include/navbar.php';
include './include/connection.php';



session_start();
$vendor_id = $_SESSION['vendor_id'];

 
$query = "SELECT oi.order_item_id, o.order_date, o.status, p.name AS product_name, p.price AS product_price,
                 oi.quantity, (p.price * oi.quantity) AS total_price
          FROM orders o
          JOIN order_items oi ON o.order_id = oi.order_id
          JOIN products p ON oi.product_id = p.product_id
          WHERE p.vendor_id = $vendor_id";

 
$result = mysqli_query($conn, $query);

if (isset($_POST['confirm_button'])) {
    // Replace {vendor_id} with the actual vendor ID
    $vendor_id = $_SESSION['vendor_id'];

    // Get the order_item_id from the POST request
    $order_item_id = $_POST['order_item_id'];

    // Update the status to "Shipped" in the database
    $updateQuery = "UPDATE orders o
                    JOIN order_items oi ON o.order_id = oi.order_id
                    JOIN products p ON oi.product_id = p.product_id
                    SET o.status = 'Shipped'
                    WHERE p.vendor_id = $vendor_id
                    AND oi.order_item_id = $order_item_id";

    mysqli_query($conn, $updateQuery);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Orders List</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
  <h2>Orders List</h2>
  <div class="table-responsive">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Order Item ID</th>
            <th>Order Date</th>
            <th>Status</th>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Confirm Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Loop through the results and display in the table
          while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<td>{$row['order_item_id']}</td>";
              echo "<td>{$row['order_date']}</td>";
              echo "<td>{$row['status']}</td>";
              echo "<td>{$row['product_name']}</td>";
              echo "<td>{$row['product_price']}</td>";
              echo "<td>{$row['quantity']}</td>";
              echo "<td>{$row['total_price']}</td>";
              echo "<td><input type='hidden' value=' " . $row['order_item_id'] . "' name='order_item_id' /><button type='submit' name='confirm_button' value='{$row['order_item_id']}' class='btn btn-primary'>Confirm</button></td>";
              echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </form>
  </div>
</div>

</body>
</html>
