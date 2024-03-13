<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <title>Boarding Pass</title>
    <style type="text/css">
        body {
            font-family: 'Times New Roman';
            font-size: 12pt;
            margin: 0;
            padding: 0;
        }

        .card-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px auto;
        }

        .card {
            border: 2px solid black;
            padding: 10px;
            margin-bottom: 20px;
            width: 80%;
            max-width: 600px;
        }

        .flight-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .flight-details .column {
            flex: 1;
        }

        .card p {
            margin: 0;
        }

        .card p:first-child {
            font-size: 19pt;
            text-align: center;
        }

        .card p:nth-child(2) {
            font-size: 17pt;
        }

        .card p:nth-child(3) {
            font-size: 12pt;
        }
    </style>
</head>

<body>
    <div class="card-container">
        <!-- First Card -->


        <!-- PHP Code Included Here -->
        <?php include("./connection.php");

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

        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="card">
                <p>BOARDING PASS | BOARDING</p>
                <div class="flight-details">
                    <div class="column">
                        <p>Username:<?php echo $row['username']; ?></p>
                        <p><?php echo $row['flight_code']; ?></p>
                        <p><?php echo $row['flight_class']; ?></p>
                        <p><?php echo $row['source_date']; ?></p>
                        <p><?php echo $row['source_time']; ?></p>
                        <p><?php echo $row['dep_airport']; ?></p>
                        <p><?php echo $row['arr_airport']; ?></p>
                        <p><?php echo $row['take_seats']; ?></p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>

        <!-- End of PHP Code -->

    </div>
</body>

</html>
