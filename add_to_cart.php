<?php
session_start();

include("include/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['u'])) {

        $productId = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        $productId = mysqli_real_escape_string($conn, $productId);
        $quantity = mysqli_real_escape_string($conn, $quantity);

        $stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
        $stmt->bind_param("ii", $_SESSION['u'], $productId);
        $stmt->execute();
        $result_cart = $stmt->get_result();

        if ($result_cart->num_rows > 0) {
            echo "Product is already in the cart!";
        } else {
           
            $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
            $stmt->bind_param("iii", $_SESSION['u'], $productId, $quantity);
            if ($stmt->execute()) {
                echo "Product added to cart!";
            } else {
                echo "Failed to add product to cart.";
            }
        }
    } else {
        
        echo "Please login to add products to the cart.";
    }
} else {
    
    echo '<script>window.location.href = "index.php";</script>';
    exit();
}

?>