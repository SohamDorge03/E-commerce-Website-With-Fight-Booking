<?php
include("./connection.php");

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $flight_id = $_GET['id'];

    $sql = "DELETE FROM flights WHERE flight_id = $flight_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: flights.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Flight ID not specified";
}
?>
