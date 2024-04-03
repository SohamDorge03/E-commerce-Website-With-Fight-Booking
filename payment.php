<?php
require("./config.php");
include("include/connection.php");
session_start();
    
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/Exception.php';
    require 'PHPMailer/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

if (isset($_SESSION['u'])) {
    $user_id = $_SESSION['u'];
    $sql = "SELECT c.*, p.name, p.price FROM cart c INNER JOIN products p ON c.product_id = p.product_id WHERE c.user_id = '$user_id'";
    $result = $conn->query($sql);

    
   
    $order_items = array(); 

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $total_price += $row['price'] * $row['quantity'];
            
            $order_items[] = array(
                'product_id' => $row['product_id'],
                'quantity' => $row['quantity']
            );
        }
        $_SESSION['a'] = $total_price / 100;
    }
} else {
    $result = false;
    $total_price = 0;
}

$user_email = "";
if ($user_id) {
    $user_query = "SELECT email FROM users WHERE user_id = '$user_id'";
    $user_result = $conn->query($user_query);
    if ($user_result && $user_result->num_rows > 0) {
        $user_row = $user_result->fetch_assoc();
        $user_email = $user_row['email'];
    }
}

if ($result && $total_price > 0 && $user_email) {
    $payment_method = "Stripe";  
    $payment_status = "Paid";  
    $transaction_id = $_SESSION['t']; 

    $insert_order_query = "INSERT INTO orders (user_id, order_date, status, payment_method, payment_status, transaction_id, total_amount) VALUES ('$user_id', NOW(), 'Pending', '$payment_method', '$payment_status', '$transaction_id', '$total_price')";
    if ($conn->query($insert_order_query) === TRUE) {
        $order_id = $conn->insert_id;

        foreach ($order_items as $item) {
            $product_id = $item['product_id'];
            $quantity = $item['quantity'];
            $insert_order_item_query = "INSERT INTO order_items (order_id, product_id, quantity) VALUES ('$order_id', '$product_id', '$quantity')";
            $conn->query($insert_order_item_query);
        }

        $delete_cart_items_query = "DELETE FROM cart WHERE user_id = '$user_id'";
        $conn->query($delete_cart_items_query);

    
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'shopflix420@gmail.com';
            $mail->Password   = 'vabjcndouidetrnt';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;
            $mail->setFrom('shopflix420@gmail.com', 'SHOPFLIX');
            $mail->addAddress($user_email, 'Recipient Name');
            $mail->isHTML(true);
            $mail->Subject = 'Your Order Details';

          
$html_bill = "<style>
table {
    width: 100%;
    border-collapse: collapse;
}
th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}
th {
    background-color: #f2f2f2;
}
</style>";
$html_bill .= "<h2 style='color: green;'>Your Order Confirm.</h2>";
$html_bill .= "<p>Order ID: $order_id</p>";
$html_bill .= "<table>
<tr>
    <th>Product ID</th>
    <th>Product</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Total</th>
</tr>";
foreach ($order_items as $item) {

$product_id = $item['product_id'];
$quantity = $item['quantity'];
$product_query = "SELECT product_id, name, price FROM products WHERE product_id = '$product_id'";
$product_result = $conn->query($product_query);
$product_row = $product_result->fetch_assoc();

$product_name = $product_row['name'];
$product_price = $product_row['price'];
$quantity = $item['quantity'];
$total = $product_price * $quantity;

$update_stock_query = "UPDATE products SET stock_quantity = stock_quantity - $quantity WHERE product_id = '$product_id'";
if (!$conn->query($update_stock_query)) {
    throw new Exception("Error updating stock quantity for product with ID $product_id");
}

$html_bill .= "<tr>
    <td>$product_id</td>
    <td>$product_name</td>
    <td>$product_price</td>
    <td>$quantity</td>
    <td>$total</td>
</tr>";
}
$html_bill .= "<tr><td colspan='4'>Total Amount</td><td>$total_price</td></tr></table>";


            $mail->Body = $html_bill;

            if ($mail->send()) {
                echo 'Email sent successfully.';
            } else {
                echo 'Email could not be sent. Please try again later.';
            }
        } catch (Exception $e) {
            echo "Email could not be sent. Error: {$mail->ErrorInfo}";
        }

        header("Location: order.php");

        exit();
    } else {
        echo "Error creating order: " . $conn->error;
    }
} else {
    echo "No items in cart or total price is 0 or user email not found.";
}
?>
