<?php
include("./include/connection.php");

// Check if a POST request is made and demo_id is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["demo_id"])) {
    $demoId = $_POST["demo_id"];
    
    // Delete the demo from the database
    $sql = "DELETE FROM book_demo WHERE demo_id = $demoId";
    
    if ($conn->query($sql) === TRUE) {
        echo "Demo removed successfully";
    } else {
        echo "Error removing demo: " . $conn->error;
    }
    
    $conn->close();
    exit; // Terminate script execution after handling the AJAX request
} else {
    echo "Invalid request"; // Handle invalid request
}
?>
