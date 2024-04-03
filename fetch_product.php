<?php

include("./include/connection.php");

$response = array('success' => false, 'product_name' => '', 'message' => '');

if(isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    $sql = "SELECT name FROM products WHERE product_id = $productId AND category_id = 3";
    
    $result = $conn->query($sql);

    if($result) {
        if($result->num_rows > 0) {
           
            $row = $result->fetch_assoc();
            $response['success'] = true;
            $response['product_name'] = $row['name'];
        } else {
            $response['message'] = 'Product not found';
        }
    } else {
        $response['message'] = 'Error fetching product details';
    }
} else {
    
    $response['message'] = 'Product ID not provided';
}

$conn->close();

// Return the response as JSON
echo json_encode($response);
?>
