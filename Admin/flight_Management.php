<?php
include("./include/connection.php");    

if (isset($_GET['from_date']) && isset($_GET['to_date'])) {
    $fromDate = $_GET['from_date'];
    $toDate = $_GET['to_date'];

    $sql = "SELECT 
                f.*, 
                dep.airport_name AS dep_airport_name, 
                arr.airport_name AS arr_airport_name,
                a.airline_name
            FROM flights f
            INNER JOIN airports dep ON f.dep_airport_id = dep.airport_id
            INNER JOIN airports arr ON f.arr_airport_id = arr.airport_id
            INNER JOIN airlines a ON f.airline_id = a.airline_id
            WHERE f.source_date BETWEEN '$fromDate' AND '$toDate'";
} else {

    $sql = "SELECT 
                f.*, 
                dep.airport_name AS dep_airport_name, 
                arr.airport_name AS arr_airport_name,
                a.airline_name
            FROM flights f
            INNER JOIN airports dep ON f.dep_airport_id = dep.airport_id
            INNER JOIN airports arr ON f.arr_airport_id = arr.airport_id
            INNER JOIN airlines a ON f.airline_id = a.airline_id";
}

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flights Data</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php
include("./include/navbar.php");
?>
<div class="container mt-5">
    <h2>Flights Data</h2>
    <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="fromDate">From Date:</label>
                <input type="date" class="form-control" id="fromDate" name="from_date" value="<?php echo isset($_GET['from_date']) ? $_GET['from_date'] : ''; ?>">
            </div>
            <div class="form-group col-md-3">
                <label for="toDate">To Date:</label>
                <input type="date" class="form-control" id="toDate" name="to_date" value="<?php echo isset($_GET['to_date']) ? $_GET['to_date'] : ''; ?>">
            </div>
            <div class="form-group col-md-3 align-self-end">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <table class="table">
        <thead style="background-color: #5F1E30;">
            <tr style="color: wheat;">
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

<?php

$conn->close();
?>
