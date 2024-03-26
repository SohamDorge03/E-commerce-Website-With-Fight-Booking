<?php
session_start();

include("./include/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['vendor_id'])) {
    $vendorId = $_POST['vendor_id'];
    
    $sql = "UPDATE vendors SET confirmed_vendor = 1 WHERE vendor_id = $vendorId";
    if ($conn->query($sql) === TRUE) {
        echo "Vendor confirmed successfully";
    } else {
        echo "Error confirming vendor: " . $conn->error;
    }
} else {
    echo "Invalid request";
}
?>
