<?php
// Include database connection
include("./include/connection.php");

// Check if demo_id is set and not empty
if(isset($_POST['demo_id']) && !empty($_POST['demo_id'])) {
    // Sanitize the input to prevent SQL injection
    $demo_id = mysqli_real_escape_string($conn, $_POST['demo_id']);

    // Update status field in the database
    $sql = "UPDATE book_demo SET status = 'Confirmed' WHERE demo_id = $demo_id";

    if ($conn->query($sql) === TRUE) {
        echo "Demo confirmed successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "Invalid demo ID";
}

// Close connection
$conn->close();
?>
