<?php
include("./include/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vendorId = $_POST['vendor_id'];
    
    $deleteSql = "DELETE FROM vendors WHERE vendor_id = $vendorId";

    if ($conn->query($deleteSql) === TRUE) {
        echo "Vendor deleted successfully";
    } else {
        echo "Error deleting vendor: " . $conn->error;
    }
} else {
    // Handle invalid request method
    echo "Invalid request method";
}
?>
