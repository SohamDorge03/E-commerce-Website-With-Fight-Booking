<?php
session_start();

if (!isset($_SESSION['vendor_id'])) {
    echo "Unauthorized access!";
    exit();
}

if (isset($_POST['demo_id']) && filter_var($_POST['demo_id'], FILTER_VALIDATE_INT)) {
    $demoId = $_POST['demo_id'];

    include("./include/connection.php");

    $sql = "DELETE FROM book_demo WHERE demo_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $demoId);

    if ($stmt->execute()) {
        echo "Demo data removed successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid demo ID!";
}
?>
