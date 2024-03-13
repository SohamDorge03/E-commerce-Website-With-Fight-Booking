<?php
include("./include/connection.php");    

// SQL query to fetch flights data with airport names and airline name
$sql = "SELECT 
            f.*, 
            dep.airport_name AS dep_airport_name, 
            arr.airport_name AS arr_airport_name,
            a.airline_name
        FROM flights f
        INNER JOIN airports dep ON f.dep_airport_id = dep.airport_id
        INNER JOIN airports arr ON f.arr_airport_id = arr.airport_id
        INNER JOIN airlines a ON f.airline_id = a.airline_id";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flights Data</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php
include("./include/navbar.php");
?>
<div class="container mt-5">
    <h2>Flights Data</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Flight ID</th>
                <th>Flight Code</th>
                <th>Source Date</th>
                <th>Source Time</th>
                <th>Destination Date</th>
                <th>Destination Time</th>
                <th>Departure Airport</th>
                <th>Arrival Airport</th>
                <th>Seats</th>
                <th>Price</th>
                <th>Airline</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["flight_id"] . "</td>";
                echo "<td>" . $row["flight_code"] . "</td>";
                echo "<td>" . $row["source_date"] . "</td>";
                echo "<td>" . $row["source_time"] . "</td>";
                echo "<td>" . $row["dest_date"] . "</td>";
                echo "<td>" . $row["dest_time"] . "</td>";
                echo "<td>" . $row["dep_airport_name"] . "</td>";
                echo "<td>" . $row["arr_airport_name"] . "</td>";
                echo "<td>" . $row["seats"] . "</td>";
                echo "<td>" . $row["price"] . "</td>";
                echo "<td>" . $row["airline_name"] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

<?php
// Close connection
$conn->close();
?>
