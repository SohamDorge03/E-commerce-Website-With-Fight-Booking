<?php
include("./include/connection.php");


$selectedFromCity = $_POST['fromCity'];

$sqlToCity = "SELECT a.airport_name 
              FROM airports AS a 
              LEFT JOIN airports AS b ON a.airport_name = b.airport_name 
              WHERE b.airport_name != '$selectedFromCity'";


$resultToCity = $conn->query($sqlToCity);

if ($resultToCity->num_rows > 0) {
    $output = "<option value=''>Select To City</option>";
 
    while($row = $resultToCity->fetch_assoc()) {
        $output .= "<option value='" . $row['airport_name'] . "'>" . $row['airport_name'] . "</option>";
    }
    echo $output;
} else {
    echo "<option value=''>No available cities</option>";
}

$conn->close();
?>
