<?php
// Include the database connection file
include("./include/connection.php");

// Initialize response array
$response = array('success' => false, 'product_name' => '', 'message' => '');

// Check if product ID is provided via POST
if(isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    // Prepare SQL query to fetch product name based on product ID and category_id
    $sql = "SELECT name FROM products WHERE product_id = $productId AND category_id = 3";
    
    // Execute the query
    $result = $conn->query($sql);

    // Check if query was successful
    if($result) {
        // Check if any rows were returned
        if($result->num_rows > 0) {
            // Fetch the product name from the result
            $row = $result->fetch_assoc();
            $response['success'] = true;
            $response['product_name'] = $row['name'];
        } else {
            // Product not found
            $response['message'] = 'Product not found';
        }
    } else {
        // Error executing query
        $response['message'] = 'Error fetching product details';
    }
} else {
    // Product ID not provided
    $response['message'] = 'Product ID not provided';
}

// Close the database connection
$conn->close();

// Return the response as JSON
echo json_encode($response);
?>
