<?php
include("./connection.php");

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $flight_id = $_GET['id'];

    // Delete flight record from the database
    $sql = "DELETE FROM flights WHERE flight_id = $flight_id";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the flight management page after successful deletion
        header("Location: flights.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Flight ID not specified";
}
?>
