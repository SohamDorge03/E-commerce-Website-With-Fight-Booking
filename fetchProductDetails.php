<?php
// Include database connection
include("include/connection.php");

// Check if productId parameter is set
if (isset($_GET['productId'])) {
    // Sanitize the input
    $productId = intval($_GET['productId']);

    // Prepare and execute query to fetch product details
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if product exists
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        // Output all details of the product
        echo '<h2>' . $product['name'] . '</h2>';
        // Output all images
        echo '<div class="product-images" style="max-height: 400px; overflow-y: auto;">'; // Set max height and enable overflow-y
        for ($i = 1; $i <= 4; $i++) {
            $imgKey = 'img' . $i;
            if (!empty($product[$imgKey])) {
                echo '<img src="./vendor/' . $product[$imgKey] . '" alt="Product Image ' . $i . '" style="width: 50%; height: auto; margin-right: 5px;">'; // Set width to 50%, height to auto, and margin-right to 5px
            }
        }
        echo '</div>';
        echo '<p>Description: ' . $product['description'] . '</p>';
        echo '<p>Price: $' . $product['price'] . '</p>';
        echo '<p>Stock Quantity: ' . $product['stock_quantity'] . '</p>';
        if (!empty($product['discount_price'])) {
            echo '<p>Discount Price: $' . $product['discount_price'] . '</p>';
        }
        // Add more details as needed
    } else {
        // Product not found
        echo 'Product not found.';
    }
} else {
    // productId parameter not provided
    echo 'Product ID not provided.';
}
?>
