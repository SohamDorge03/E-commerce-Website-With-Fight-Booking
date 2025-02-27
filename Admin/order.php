<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

?>

<style>
    .container {
        margin-top: 70px !important;
        margin-left: 20px !important;
        font-family: 'poppins';
    }

    .table-header {
        background-color: 5f1e30;
        color: wheat;
    }
</style>
<?php
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include("include/connection.php");
include('include/navbar.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_status"])) {
    $order_id = $_POST["order_id"];
    $new_status = $_POST["status"];

    $update_status_query = "UPDATE orders SET status = '$new_status' WHERE order_id = $order_id";
    $update_status_result = $conn->query($update_status_query);

    if ($update_status_result) {
        echo "<script>alert('Order status updated successfully!');</script>";


        if ($new_status === "Shipped") {
            $customer_email_query = "SELECT email FROM users WHERE user_id IN (SELECT user_id FROM orders WHERE order_id = $order_id)";
            $customer_email_result = $conn->query($customer_email_query);
            if ($customer_email_result->num_rows > 0) {
                $customer_email_row = $customer_email_result->fetch_assoc();
                $customer_email = $customer_email_row['email'];

                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'shopflix420@gmail.com';
                $mail->Password   = 'vabjcndouidetrnt';
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;
                $mail->setFrom('shopflix420@gmail.com', 'SHOPFLIX');
                $mail->addAddress($customer_email, 'User');
                $mail->isHTML(true);
                $mail->Subject = 'Your Order has been Shipped!';
                $mail->Body    = 'Dear Customer,<br><br>Your order has been successfully shipped. Thank you for shopping with us!<br><br>Regards,<br>The SHOPFLIX Team';
                $mail->AltBody = 'Your order has been successfully shipped. Thank you for shopping with us!';

                // Send email
                try {
                    $mail->send();
                    echo "<script>alert('Order Shipped Successfully.');</script>";
                } catch (Exception $e) {

                    echo "<script>alert('Order Shipped Successfully, but there was an error sending the confirmation email: {$mail->ErrorInfo}');</script>";
                }
            }
        }
    } else {
        echo "<script>alert('Failed to update order status.');</script>";
    }
}

echo "<div class='container mt-5'>";
echo "<h2>Orders with Product Details</h2>";
echo "<table class='table table-bordered'>";
echo "<thead class='table-header'>";
echo "<tr>";
echo "<th>Order ID</th><th>User ID</th><th>User Name</th><th>Email</th><th>Address</th><th>Order Date</th><th>Status</th><th>Payment Method</th><th>Payment Status</th><th>Transaction ID</th><th>Total Amount</th><th>Products</th>";
echo "</tr>";
echo "</thead>";


echo "</thead>";
echo "<tbody>";

$sql_orders_products = "SELECT o.order_id, o.user_id, u.username AS user_name, u.email, u.address, o.order_date, o.status, o.payment_method, o.payment_status, o.transaction_id, o.total_amount,
                        GROUP_CONCAT(CONCAT(oi.product_id, ':', p.name, ':', oi.quantity, ':', FORMAT(p.price, 2), ':', FORMAT(oi.quantity * p.price, 2)) SEPARATOR '<br>') AS product_details
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
            echo "<td>" . number_format($row['total_amount'], 2) . "</td>";
            echo "<td>";

            echo "<button class='btn btn-info btn-sm' data-toggle='modal' data-target='#productDetailsModal" . $row['order_id'] . "'>View Details</button>";

            echo "<div class='modal fade' id='productDetailsModal" . $row['order_id'] . "' tabindex='0' role='dialog' aria-labelledby='productDetailsModalLabel' aria-hidden='true'>";
            echo "<div class='modal-dialog modal-lg' role='document'>";
            echo "<div class='modal-content'>";
            echo "<div class='modal-header'>";
            echo "<h5 class='modal-title' id='productDetailsModalLabel'>Product Details</h5>";
            echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
            echo "<span aria-hidden='true'>&times;</span>";
            echo "</button>";
            echo "</div>";
            echo "<div class='modal-body'>";

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

$conn->close();
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>