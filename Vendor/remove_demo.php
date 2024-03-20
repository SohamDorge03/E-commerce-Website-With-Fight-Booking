<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['vendor_id'])) {
    echo "Unauthorized access!";
    exit();
}

// Check if demo_id is provided and it's a valid integer
if (isset($_POST['demo_id']) && filter_var($_POST['demo_id'], FILTER_VALIDATE_INT)) {
    $demoId = $_POST['demo_id'];

    // Include your database connection
    include("./include/connection.php");

    // Prepare and execute the SQL query to delete the demo data
    $sql = "DELETE FROM book_demo WHERE demo_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $demoId);

    if ($stmt->execute()) {
        echo "Demo data removed successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid demo ID!";
}
?>
