<?php
require("./config.php");
include("./include/connection.php");
include("./include/navbar.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            background-color: #f8f9fa;
        }

        .card-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        .list-group-item {
            background-color: transparent;
            border: none;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
<?php

if(isset($_GET['booking_id'])) {
    $booking_id = $_GET['booking_id'];

    $booking_query = "SELECT bf.booking_id, bf.take_seats, bf.booked_date,  
                            p.name AS passenger_name, 
                            f.flight_code, 
                            a.airline_name,
                            a1.airport_name AS source_airport,
                            a2.airport_name AS destination_airport,
                            f.source_date,
                            f.source_time,
                            p.seatno,
                            p.gateno
                    FROM booked_flights bf
                    JOIN passenger p ON bf.booking_id = p.booking_id
                    JOIN flights f ON bf.flight_id = f.flight_id
                    JOIN airlines a ON f.airline_id = a.airline_id
                    JOIN airports a1 ON f.dep_airport_id = a1.airport_id
                    JOIN airports a2 ON f.arr_airport_id = a2.airport_id
                    WHERE bf.booking_id = $booking_id";

    $result = mysqli_query($conn, $booking_query);

    if(mysqli_num_rows($result) > 0) {
 
        $booking_data = mysqli_fetch_assoc($result);

        echo "<div class='container'>
                <div class='row justify-content-center'>
                    <div class='col-md-8'>
                        <div class='card'>
                            <div class='card-body'>
                                <h2 class='card-title text-center'>Booking Details</h2>
                                <ul class='list-group list-group-flush'>
                                    
                                    <li class='list-group-item'><strong>Passenger Name:</strong> ".$booking_data['passenger_name']."</li>
                                    <li class='list-group-item'><strong>Flight:</strong> ".$booking_data['flight_code']."</li>
                                    <li class='list-group-item'><strong>Airline Name:</strong> ".$booking_data['airline_name']."</li>
                                    <li class='list-group-item'><strong>From:</strong> ".$booking_data['source_airport']."</li>
                                    <li class='list-group-item'><strong>To:</strong> ".$booking_data['destination_airport']."</li>
                                    <li class='list-group-item'><strong> Date:</strong> ".$booking_data['source_date']."</li>
                                    <li class='list-group-item'><strong>Time:</strong> ".$booking_data['source_time']."</li>
                                    <li class='list-group-item'><strong>Seats Booked:</strong> ".$booking_data['take_seats']."</li>
                                    <li class='list-group-item'><strong>Seat Number:</strong> ".$booking_data['seatno']."</li>
                                    <li class='list-group-item'><strong>Gate Number:</strong> ".$booking_data['gateno']."</li>
                                    <li class='list-group-item'><strong>Booked Date:</strong> ".$booking_data['booked_date']."</li>
                                </ul>
                                <div class='text-center mt-3'>
                                    <a href='ticket_pdf.php?booking_id=".$booking_data['booking_id']."' class='btn btn-primary'>Generate PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>";
    } else {
       
        echo "<div class='container mt-5'>
                <div class='row justify-content-center'>
                    <div class='col-md-6'>
                        <div class='alert alert-danger text-center' role='alert'>
                            No booking found for the provided booking ID.
                        </div>
                    </div>
                </div>
            </div>";
    }
} else {
  
    echo "<div class='container mt-5'>
            <div class='row justify-content-center'>
                <div class='col-md-6'>
                    <div class='alert alert-danger text-center' role='alert'>
                        Booking ID not provided.
                    </div>
                </div>
            </div>
        </div>";
}
?>
</body>
</html>
