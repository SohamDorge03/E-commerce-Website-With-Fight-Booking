<style>
.container{
    margin-top: 70px !important;
}
</style>
<?php
include("include/connection.php");
include('include/navbar.php');
session_start();

if(!isset($_SESSION['email'])) {
    // Redirect to login page
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_status"])) {
    $order_id = $_POST["order_id"];
    $new_status = $_POST["status"];
    
    $update_status_query = "UPDATE orders SET status = '$new_status' WHERE order_id = $order_id";
    $update_status_result = $conn->query($update_status_query);

    if ($update_status_result) {
        echo "<script>alert('Order status updated successfully!');</script>";
    } else {
        echo "<script>alert('Failed to update order status.');</script>";
    }
}

echo "<div class='container mt-5'>";
echo "<h2>Orders with Product Details</h2>";
echo "<table class='table table-bordered'>";
echo "<thead class='thead-light'>";
echo "<tr><th>Order ID</th><th>User ID</th><th>User Name</th><th>Email</th><th>Address</th><th>Order Date</th><th>Status</th><th>Payment Method</th><th>Payment Status</th><th>Transaction ID</th><th>Total Amount</th><th>Products</th></tr>";
echo "</thead>";
echo "<tbody>";

$sql_orders_products = "SELECT o.order_id, o.user_id, u.username AS user_name, u.email, u.address, o.order_date, o.status, o.payment_method, o.payment_status, o.transaction_id, o.total_amount,
                        GROUP_CONCAT(CONCAT(oi.product_id, ':', p.name, ':', oi.quantity, ':$', FORMAT(p.price, 2), ':$', FORMAT(oi.quantity * p.price, 2)) SEPARATOR '<br>') AS product_details
                        FROM orders o
                        INNER JOIN order_items oi ON o.order_id = oi.order_id
                        INNER JOIN products p ON oi.product_id = p.product_id
                        INNER JOIN users u ON o.user_id = u.user_id
                        GROUP BY o.order_id, o.user_id, u.username, u.email, u.address, o.order_date, o.status, o.payment_method, o.payment_status, o.transaction_id, o.total_amount";

$result_orders_products = $conn->query($sql_orders_products);

if ($result_orders_products) {
    if ($result_orders_products->num_rows > 0) {
        while ($row = $result_orders_products->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['order_id'] . "</td>";
            echo "<td>" . $row['user_id'] . "</td>";
            echo "<td>" . $row['user_name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['address'] . "</td>";
            echo "<td>" . $row['order_date'] . "</td>";
            echo "<td>";
            echo "<form method='POST' action=''>";  
            echo "<input type='hidden' name='order_id' value='" . $row['order_id'] . "'>";
            echo "<select name='status' class='form-control'>";
            echo "<option value='Processing'" . ($row['status'] == 'Processing' ? ' selected' : '') . ">Processing</option>";
            echo "<option value='Shipped'" . ($row['status'] == 'Shipped' ? ' selected' : '') . ">Shipped</option>";
            echo "<option value='Delivered'" . ($row['status'] == 'Delivered' ? ' selected' : '') . ">Delivered</option>";
            echo "</select>";
            echo "<button type='submit' class='btn btn-primary btn-sm mt-1' name='update_status'>Update</button>";
            echo "</form>";
            echo "</td>";
            echo "<td>" . $row['payment_method'] . "</td>";
            echo "<td>" . $row['payment_status'] . "</td>";
            echo "<td>" . $row['transaction_id'] . "</td>";
            echo "<td>$" . number_format($row['total_amount'], 2) . "</td>";
            echo "<td>";
            
            // View Product Details Button (opens modal)
            echo "<button class='btn btn-info btn-sm' data-toggle='modal' data-target='#productDetailsModal" . $row['order_id'] . "'>View Details</button>";
            
            // Product Details Modal
            echo "<div class='modal fade' id='productDetailsModal" . $row['order_id'] . "' tabindex='-1' role='dialog' aria-labelledby='productDetailsModalLabel' aria-hidden='true'>";
            echo "<div class='modal-dialog' role='document'>";
            echo "<div class='modal-content'>";
            echo "<div class='modal-header'>";
            echo "<h5 class='modal-title' id='productDetailsModalLabel'>Product Details</h5>";
            echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
            echo "<span aria-hidden='true'>&times;</span>";
            echo "</button>";
            echo "</div>";
            echo "<div class='modal-body'>";
            
            // Product Details Table in Modal
            echo "<table class='table table-bordered'>";
            echo "<thead><tr><th>Product ID</th><th>Product Name</th><th>Quantity</th><th>Product Price</th><th>Total Price</th></tr></thead>";
            echo "<tbody>";
            $product_details = explode("<br>", $row['product_details']);
            foreach ($product_details as $product) {
                $product_info = explode(":", $product);
                echo "<tr>";
                echo "<td>" . $product_info[0] . "</td>";
                echo "<td>" . $product_info[1] . "</td>";
                echo "<td>" . $product_info[2] . "</td>";
                echo "<td>" . $product_info[3] . "</td>";
                echo "<td>" . $product_info[4] . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            
            echo "</div>";
            echo "<div class='modal-footer'>";
            echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            
            echo "</td>";
            
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='13'>0 results</td></tr>";
    }
} else {
    echo "<tr><td colspan='13'>Error executing the query: " . $conn->error . "</td></tr>";
}

echo "</tbody>";
echo "</table>";
echo "</div>";

// Close connection
$conn->close();
?>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<!-- Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>