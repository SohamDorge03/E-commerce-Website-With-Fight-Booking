<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Search Results</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .alert {
            margin-top: 20px;
        }

        .table {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        
        <?php
        if (isset($_POST['searchFlights'])) {
            include("include/connection.php");

            $fromCity = $_POST['fromCity'];
            $toCity = $_POST['toCity'];
            $travelDate = $_POST['travelDate'];
            $passengers = $_POST['passengers'];
            $class = $_POST['class'];

            // Query flights based on user input
            $sql = " SELECT 
                        f.*, 
                        dep.airport_name AS dep_airport_name, 
                        arr.airport_name AS arr_airport_name,
                        a.airline_name,
                        a.logo
                    FROM flights f
                    INNER JOIN airports dep ON f.dep_airport_id = dep.airport_id
                    INNER JOIN airports arr ON f.arr_airport_id = arr.airport_id
                    INNER JOIN airlines a ON f.airline_id = a.airline_id
                    WHERE f.source_date = '$travelDate' AND f.seats >= $passengers";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<h3>Available Flights</h3>";
                echo "<table class='table'>";
                echo "<thead><tr>
                        <th>Airline Logo</th>
                        <th>Airline Name</th>
                        <th>Flight Code</th>
                        <th>Source Date</th>
                        <th>Source Time</th>
                        <th>Destination Date</th>
                        <th>Destination Time</th>
                        <th>Departure Airport</th>
                        <th>Arrival Airport</th>
                        <th>Seats</th>
                        <th>Price</th>
                    </tr></thead>";
                echo "<tbody>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><img src='./admin" . $row["logo"] . "' alt='Airline Logo' style='width: 50px; height: auto;'></td>";
                    echo "<td>" . $row["airline_name"] . "</td>";
                    echo "<td>" . $row["flight_code"] . "</td>";
                    echo "<td>" . $row["source_date"] . "</td>";
                    echo "<td>" . $row["source_time"] . "</td>";
                    echo "<td>" . $row["dest_date"] . "</td>";
                    echo "<td>" . $row["dest_time"] . "</td>";
                    echo "<td>" . $row["dep_airport_name"] . "</td>";
                    echo "<td>" . $row["arr_airport_name"] . "</td>";
                    echo "<td>" . $row["seats"] . "</td>";
                    echo "<td>" . $row["price"] . "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<div class='alert alert-warning'>No flights available for the selected date and passengers.</div>";
            }
        }
        ?>
    </div>
</body>
</html>
