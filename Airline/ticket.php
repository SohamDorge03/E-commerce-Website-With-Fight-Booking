<?php
include("./connection.php");

// Step 2: Query the necessary data
$query = "SELECT users.username, 
                 airports_dep.airport_name AS dep_airport, 
                 airports_arr.airport_name AS arr_airport, 
                 flights.source_date, 
                 flights.source_time, 
                 booked_flights.take_seats, 
                 booked_flights.flight_class, 
                 flights.flight_code 
          FROM booked_flights 
          INNER JOIN users ON booked_flights.user_id = users.user_id 
          INNER JOIN flights ON booked_flights.flight_id = flights.flight_id 
          INNER JOIN airports AS airports_dep ON flights.dep_airport_id = airports_dep.airport_id 
          INNER JOIN airports AS airports_arr ON flights.arr_airport_id = airports_arr.airport_id";

$result = mysqli_query($conn, $query);

if (!$result) {
    // Query failed, print error message
    echo "Error: " . mysqli_error($conn);
    exit; // Exit the script to prevent further execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boarding Passes</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .boarding-pass {
            border: 2px solid #000;
            border-radius: 10px;
            padding: 20px;
            margin: 20px;
            width: 300px;
            background-color: #f0f0f0;
        }
        .boarding-pass-header {
            text-align: center;
            margin-bottom: 10px;
        }
        .boarding-pass-header h2 {
            margin: 0;
            font-size: 24px;
        }
        .boarding-pass-header h3 {
            margin: 0;
            font-size: 20px;
        }
        .boarding-pass-details {
            font-size: 16px;
        }
        .boarding-pass-details p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="col-md-6">
                <div class="boarding-pass">
                    <div class="boarding-pass-header">
                        <h2>Boarding Pass</h2>
                        <h3><?php echo $row['username']; ?></h3>
                    </div>
                    <div class="boarding-pass-details">
                        <p>Flight Code: <?php echo $row['flight_code']; ?></p>
                        <p>Class: <?php echo $row['flight_class']; ?></p>
                        <p>Date: <?php echo $row['source_date']; ?></p>
                        <p>Time: <?php echo $row['source_time']; ?></p>
                        <p>Departure Airport: <?php echo $row['dep_airport']; ?></p>
                        <p>Arrival Airport: <?php echo $row['arr_airport']; ?></p>
                        <p>Seats: <?php echo $row['take_seats']; ?></p>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>
