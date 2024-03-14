<?php
require("./config.php");
include("include/connection.php");
session_start();
// Send HTML email with the bill
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Fetch cart items for the current user
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT c.*, p.name, p.price FROM cart c INNER JOIN products p ON c.product_id = p.product_id WHERE c.user_id = '$user_id'";
    $result = $conn->query($sql);

    // Calculate total price
    $total_price = 0;
    $order_items = array(); // Array to store order items

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $total_price += $row['price'] * $row['quantity'];
            // Add item to order_items array
            $order_items[] = array(
                'product_id' => $row['product_id'],
                'quantity' => $row['quantity']
            );
        }
    }
} else {
    $result = false;
    $total_price = 0;
}

// Create order in the database
if ($result && $total_price > 0) {
    $payment_method = "Stripe";  
    $payment_status = "Paid";  
    $transaction_id = "testid123"; 

    // Insert order into orders table
    $insert_order_query = "INSERT INTO orders (user_id, order_date, status, payment_method, payment_status, transaction_id, total_amount) VALUES ('$user_id', NOW(), 'Pending', '$payment_method', '$payment_status', '$transaction_id', '$total_price')";
    if ($conn->query($insert_order_query) === TRUE) {
        $order_id = $conn->insert_id;

        // Insert order items into order_items table
        foreach ($order_items as $item) {
            $product_id = $item['product_id'];
            $quantity = $item['quantity'];
            $insert_order_item_query = "INSERT INTO order_items (order_id, product_id, quantity) VALUES ('$order_id', '$product_id', '$quantity')";
            $conn->query($insert_order_item_query);
        }

        // Empty the cart for the user
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
            $mail->addAddress($email, 'Recipient Name');
            $mail->isHTML(true);
            $mail->Subject = 'Your Order Details';

            // Construct HTML bill
            $html_bill = "<h2>Order Details</h2>";
            $html_bill .= "<p>Order ID: $order_id</p>";
            $html_bill .= "<table border='1'><tr><th>Product</th><th>Price</th><th>Quantity</th><th>Total</th></tr>";
            foreach ($order_items as $item) {
                // Fetch product details for each item
                $product_id = $item['product_id'];
                $product_query = "SELECT name, price FROM products WHERE product_id = '$product_id'";
                $product_result = $conn->query($product_query);
                $product_row = $product_result->fetch_assoc();

                $product_name = $product_row['name'];
                $product_price = $product_row['price'];
                $quantity = $item['quantity'];
                $total = $product_price * $quantity;

                // Add item details to HTML bill
                $html_bill .= "<tr><td>$product_name</td><td>$product_price</td><td>$quantity</td><td>$total</td></tr>";
            }
            $html_bill .= "<tr><td colspan='3'>Total Amount</td><td>$total_price</td></tr></table>";

            // Set HTML bill as the email body
            $mail->Body = $html_bill;

            // Send email
            if ($mail->send()) {
                echo 'Email sent successfully.';
            } else {
                echo 'Email could not be sent. Please try again later.';
            }
        } catch (Exception $e) {
            echo "Email could not be sent. Error: {$mail->ErrorInfo}";
        }

        // Redirect to a success page
        header("Location: success.php");
        exit();
    } else {
        echo "Error creating order: " . $conn->error;
    }
} else {
    echo "No items in cart or total price is 0.";
}
?>
