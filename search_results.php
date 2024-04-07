<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Search</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            overflow: hidden;
        }
        .background-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* background-image: url('/major project/Admin/image/flight.png'); Background image when flight is animated */
            background-size: cover;
            background-position: center;
            z-index: -1;
            animation: background-animation 20s linear infinite alternate; /* Background animation */
        }
        @keyframes background-animation {
            0% {
                background-position: 0 0;
            }
            100% {
                background-position: 100% 0;
            }
        }
        .flying-animation {
            position: absolute;
          
            top: 50%;
            left: -50%;
            transform: translate(-50%, -50%);
            animation: flying-left-right 2s forwards,2s infinite alternate; /* Flight animation */
        }
        @keyframes flying-left-right {
            0% {
                left: -50%; 
            }
            100% {
                left: 50%; 
            }
        }
        
        footer {
            display: none;
        }
        .search-results {
            display: none;
        }
        .fetching-data-text {
            position: absolute;
            top: 70%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }
    </style>
</head>
<body>


<div class="background-container"></div>

<img src="https://img.freepik.com/premium-photo/modern-passenger-airplane-isolated-white-background_527900-2049.jpg?size=626&ext=jpg&ga=GA1.1.1794533741.1712144084&semt=ais" class="flying-animation" alt="Flying Indigo" >



<div class="fetching-data-text">
    <h2><p>Your data is being fetched...</p></h2>
</div>

<?php

include("./include/navbar.php");
include("./include/connection.php");

if (isset($_POST['searchFlights'])) {

    $fromCity = $_POST['fromCity'];
    $toCity = $_POST['toCity'];
    $travelDate = $_POST['travelDate'];
    $passengers = $_POST['passengers'];
    $class = $_POST['class'];
  
    $selectedAirline = isset($_POST['airline_name']) ? $_POST['airline_name'] : '';

    $fromCityQuery = "SELECT airport_id FROM airports WHERE airport_name = '$fromCity'";
    $toCityQuery = "SELECT airport_id FROM airports WHERE airport_name = '$toCity'";

    $fromCityResult = $conn->query($fromCityQuery);
    $toCityResult = $conn->query($toCityQuery);

    if ($fromCityResult->num_rows > 0 && $toCityResult->num_rows > 0) {
        
        $fromAirportID = $fromCityResult->fetch_assoc()['airport_id'];
        $toAirportID = $toCityResult->fetch_assoc()['airport_id'];

        $searchQuery = "SELECT flights.*, airlines.airline_name, airlines.logo FROM flights 
                        INNER JOIN airlines ON flights.airline_id = airlines.airline_id 
                        WHERE dep_airport_id = $fromAirportID 
                        AND arr_airport_id = $toAirportID 
                        AND source_date = '$travelDate' 
                        AND flight_class = '$class'";

        if (!empty($selectedAirline)) {
            $searchQuery .= " AND airlines.airline_name = '$selectedAirline'";
        }

        $searchResult = $conn->query($searchQuery);

        if ($searchResult && $searchResult->num_rows > 0) {
            echo "<style>.background-container { display: none; }</style>"; // Disable background animation
            echo "<style>footer { display: block; }</style>";
        }

    }
}

?>


<script>
    setTimeout(function() {
        document.querySelector('.flying-animation').style.animation = 'none'; 
        document.querySelector('.fetching-data-text').style.display = 'none';
        document.querySelector('.search-results').style.display = 'block';
        document.querySelector('footer').style.display = 'block';
    }, 6000); 
</script>

<div class='container mt-5 search-results'>
    <?php if (isset($searchResult) && $searchResult->num_rows > 0) { ?>
        <h2 class='text-center mb-4'>Search Results</h2>
        <?php while ($row = $searchResult->fetch_assoc()) { ?>
            <div class='row'>
                <div class='col-md-12'>
                    <div class='shadow p-3 mb-5 bg-white rounded flight-card'>
                        <div class='card-body d-flex justify-content-between align-items-center'>
                            <div>
                                <img src='./admin<?php echo $row["logo"]; ?>' class='img-fluid' alt='Airline Logo' width='50' height='50'>
                                <p class='card-text mt-2'><?php echo $row["airline_name"]; ?></p>
                                <h6 class='card-title'><?php echo $row["flight_code"]; ?></h6>
                            </div>
                            <div>
                                <?php
                                $departureDateTime = strtotime($row["source_date"] . ' ' . $row["source_time"]);
                                $arrivalDateTime = strtotime($row["dest_date"] . ' ' . $row["dest_time"]);

                                $durationInSeconds = $arrivalDateTime - $departureDateTime;

                                $hours = floor($durationInSeconds / 3600);
                                $minutes = floor(($durationInSeconds % 3600) / 60);

                                $duration = sprintf('%02d:%02d', $hours, $minutes);
                                ?>
                                <p class='card-text'>Duration: <?php echo $duration; ?> HH:MM</p>
                            </div>
                            <div>
                                <p class='card-text'><?php echo $fromCity; ?></p>
                                <p class='card-text'><?php echo $row["source_time"]; ?></p>
                            </div>
                            <div>
                                <p class='card-text'><?php echo $toCity; ?></p>
                                <p class='card-text'><?php echo $row["dest_time"]; ?></p>
                            </div>
                            <div>
                                <p class='card-text'><?php echo $row["price"]; ?></p>
                                <?php
                                $flightID = $row['flight_id'];
                                $bookedQuery = "SELECT SUM(take_seats) as total_booked_seats FROM booked_flights WHERE flight_id = $flightID AND payment_status = 'success'";
                                $bookedResult = $conn->query($bookedQuery);
                                $bookedSeats = $bookedResult->fetch_assoc()['total_booked_seats'];
                                $totalAmount = $row["price"] * $passengers;
                                $availableSeats = $row['seats'] - $bookedSeats;
                                ?>
                                <p class='card-text'>Total Amount: <?php echo $totalAmount; ?></p>
                                <p class='text-success'>Only: <?php echo $availableSeats; ?> seat(s) left</p>
                                <?php if ($availableSeats > 0) { ?>
                                    <a href='booking_form.php?flight_id=<?php echo $row['flight_id']; ?>&passengers=<?php echo $passengers; ?>&airline_id=<?php echo $row["airline_id"]; ?>' class='btn btn-primary'>Book Now</a>
                                <?php } else { ?>
                                    <p class='text-danger'>No seats available</p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } else { ?>
        <div class='container mt-5' >
            <h1 class='text-center text-danger mb-4'>No Flights Found</h1>
        </div>
    <?php } ?>
</div>

</body>
</html>
