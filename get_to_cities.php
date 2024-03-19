<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shopflix";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get selected "From City" value from AJAX request
$selectedFromCity = $_POST['fromCity'];

// Query to retrieve city names from the airports table excluding the selected "From City"
$sqlToCity = "SELECT a.airport_name 
              FROM airports AS a 
              LEFT JOIN airports AS b ON a.airport_name = b.airport_name 
              WHERE b.airport_name != '$selectedFromCity'";

// Execute the query for "To City" dropdown
$resultToCity = $conn->query($sqlToCity);

// Check if there are rows in the result for "To City"
if ($resultToCity->num_rows > 0) {
    $output = "<option value=''>Select To City</option>";
    // Output data of each row
    while($row = $resultToCity->fetch_assoc()) {
        $output .= "<option value='" . $row['airport_name'] . "'>" . $row['airport_name'] . "</option>";
    }
    echo $output;
} else {
    echo "<option value=''>No available cities</option>";
}

// Close the database connection
$conn->close();
?>
