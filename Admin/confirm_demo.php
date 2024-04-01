<?php
include("./include/connection.php");

if(isset($_POST['demo_id']) && !empty($_POST['demo_id'])) {
    $demo_id = mysqli_real_escape_string($conn, $_POST['demo_id']);

    $sql = "UPDATE book_demo SET status = 'Confirmed' WHERE demo_id = $demo_id";

    if ($conn->query($sql) === TRUE) {
        echo "Demo confirmed successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "Invalid demo ID";
}

$conn->close();
?>
