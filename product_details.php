<?php
// Include database connection
include("include/connection.php");

if (isset($_GET['productId'])) {

    $productId = intval($_GET['productId']);

    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();

 
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        
        echo '<h2>' . $product['name'] . '</h2>';
        
        // Fetch all image URLs associated with the product
        $imageKeys = array('img1', 'img2', 'img3', 'img4');
        foreach ($imageKeys as $imgKey) {
            if (!empty($product[$imgKey])) {
                echo '<img src="vendor/' . $product[$imgKey] . '" alt="" style="height: 40%; margin-right: 40px;">';
            }
        }
        echo '<p>Description: ' . $product['description'] . '</p>';
        echo '<p>Price: $' . $product['price'] . '</p>';
        echo '<p>Stock Quantity: ' . $product['stock_quantity'] . '</p>';
        if (!empty($product['discount_price'])) {
            echo '<p>Discount Price: $' . $product['discount_price'] . '</p>';
        }
    
    } else {
        // Product not found
        echo 'Product not found.';
    }
} else {
   
    echo 'Product ID not provided.';
}
?>
