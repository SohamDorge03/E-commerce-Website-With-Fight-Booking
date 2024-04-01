<?php

include("./include/connection.php");

if(isset($_POST['vendor_id']) && !empty($_POST['vendor_id'])) {
   
    $vendorId = $_POST['vendor_id'];

    
    $confirmVendorSql = "UPDATE vendors SET confirmed_vendor = 1 WHERE vendor_id = ?";
    $stmt = $conn->prepare($confirmVendorSql);
    
    
    $stmt->bind_param("i", $vendorId);

    if($stmt->execute()) {
        
        echo "Vendor confirmed successfully";
    } else {
        
        echo "Error confirming vendor: " . $conn->error;
    }

    $stmt->close();
} else {
   
    echo "Invalid request";
}

$conn->close();
?>
