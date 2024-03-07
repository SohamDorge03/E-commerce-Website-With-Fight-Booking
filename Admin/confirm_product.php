<?php
include("./include/connection.php");

if(isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    $sql = "UPDATE products SET confirmation_status = 1 WHERE product_id = $product_id";

    if ($conn->query($sql) === TRUE) {
        echo "Confirmation status updated successfully";
    } else {
        echo "Error updating confirmation status: " . $conn->error;
    }
} else {
    echo "Product ID not received";
}

$conn->close();
?>
