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

       
        if ($searchResult->num_rows > 0) {
         
            ?>
            <div class='container mt-5'>
                <h2 class='text-center mb-4'>Search Results</h2>
                <?php
                while ($row = $searchResult->fetch_assoc()) {
                    ?>
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
                                        <p class='card-text'>Duration: <?php echo $duration; ?> 
                                        HH:MM</p>
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
                                        <?php
                                        if ($availableSeats > 0) {
                                       
                                            ?>
                                           
                                        <a href='booking_form.php?flight_id=<?php echo $row['flight_id']; ?>&passengers=<?php echo $passengers; ?>&airline_id=<?php echo $row["airline_id"]; ?>' class='btn btn-primary'>Book Now</a>
                                            
                                        <?php
                                        
                                        } 
                                        
                                        else {
                                            ?>
                                            <p class='text-danger'>No seats available</p>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
        } else {
      
            ?>
            <div class='container mt-5' >
                <h1 class='text-center text-danger mb-4'>No Flight's Found</h1>
            </div>
            <?php
        }
    } else {
      
        ?>
        <div class='container'>
            <h2 class='text-center mb-4'>Invalid Airport Selection</h2>
        </div>
        <?php
    }
}

$conn->close();
?>

<?php
include("./include/footer.php");
?>
