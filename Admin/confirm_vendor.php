<?php
include("./include/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get vendor ID from POST data
    $vendorId = $_POST['vendor_id'];

    // Retrieve the current status from the database
    $statusSql = "SELECT status FROM vendors WHERE vendor_id = $vendorId";
    $statusResult = $conn->query($statusSql);
    
    if ($statusResult->num_rows > 0) {
        $row = $statusResult->fetch_assoc();
        // Toggle the status (true to false or false to true)
        $newStatus = !$row['status'];
        // Update the status in the database
        $updateSql = "UPDATE vendors SET status = $newStatus WHERE vendor_id = $vendorId";

        if ($conn->query($updateSql) === TRUE) {
            // Provide appropriate response message based on the new status
            $responseMessage = $newStatus ? "Vendor confirmed successfully" : "Vendor status toggled successfully";
            echo $responseMessage;
        } else {
            echo "Error updating vendor status: " . $conn->error;
        }
    } else {
        echo "Vendor not found";
    }

    // Close database connection
    $conn->close();
} else {
    // Handle invalid request method
    echo "Invalid request method";
}
?>
