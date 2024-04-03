<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

include("./include/connection.php");

if (isset($_POST['demo_id'])) {

    $demoId = mysqli_real_escape_string($conn, $_POST['demo_id']);

  
    $sql = "DELETE FROM book_demo WHERE demo_id = $demoId";

   
    if (mysqli_query($conn, $sql)) {
   
        echo "Demo removed successfully";
    } else {
    
        echo "Error removing demo: " . mysqli_error($conn);
    }
} else {
    
    echo "Demo ID not provided";
}

mysqli_close($conn);
?>
