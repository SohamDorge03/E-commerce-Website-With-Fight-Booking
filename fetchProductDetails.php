<?php

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

        echo '<div class="product-images" style="max-height: 400px; overflow-y: auto;">'; 
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
    
    } else {
     
        echo 'Product not found.';
    }
} else {
   
    echo 'Product ID not provided.';
}
?>
