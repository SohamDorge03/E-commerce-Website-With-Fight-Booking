<?php
// Start the session
session_start();

// Include database connection
include("include/connection.php");

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if user is logged in
    if (isset($_SESSION['u'])) {
        // Get product ID and quantity from POST data
        $productId = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        // Sanitize inputs
        $productId = mysqli_real_escape_string($conn, $productId);
        $quantity = mysqli_real_escape_string($conn, $quantity);

        // Check if the product is already in the cart
        $stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
        $stmt->bind_param("ii", $_SESSION['u'], $productId);
        $stmt->execute();
        $result_cart = $stmt->get_result();

        if ($result_cart->num_rows > 0) {
            // Product is already in the cart
            echo "Product is already in the cart!";
        } else {
            // Insert the product into the cart
            $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
            $stmt->bind_param("iii", $_SESSION['u'], $productId, $quantity);
            if ($stmt->execute()) {
                echo "Product added to cart!";
            } else {
                echo "Failed to add product to cart.";
            }
        }
    } else {
        // User is not logged in
        echo "Please login to add products to the cart.";
    }
} else {
    // If it's not a POST request, redirect to index page
    echo '<script>window.location.href = "index.php";</script>';
    exit();
}

?>