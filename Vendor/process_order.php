<?php
session_start(); // Start the session

// Check if vendor_id is set in the session
if (!isset($_SESSION['vendor_id'])) {
    header("Location: login.php");
    exit();
}

// Database connection
include './include/connection.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_button'])) {
    // Retrieve the order item ID from the form
    $order_item_id = $_POST['order_item_id'];

    // Perform any necessary validation here

    // Proceed to process the order item confirmation
    // Update the status of the order item based on the corresponding order's status
    $update_query = "UPDATE order_items oi
                     JOIN orders o ON oi.order_id = o.order_id
                     SET o.status = 'Confirmed'
                     WHERE oi.order_item_id = $order_item_id";

    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        // Order item confirmation successful
        // Redirect the user back to the page where they confirmed the order item
        header("Location: order_product.php");
        exit();
    } else {
        // Error handling if the update query fails
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // If the form has not been submitted via POST method, redirect back to the page
    header("Location: orders.php");
    exit();
}
?>
