<?php
// Include the navbar file
include("./include/navbar.php");

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

// Check if form is submitted
if (isset($_POST['searchFlights'])) {
    // Retrieve user input
    $fromCity = $_POST['fromCity'];
    $toCity = $_POST['toCity'];
    $travelDate = $_POST['travelDate'];
    $passengers = $_POST['passengers'];
    $class = $_POST['class'];
    // Retrieve selected airline name if set, otherwise set it to an empty string
    $selectedAirline = isset($_POST['airline_name']) ? $_POST['airline_name'] : '';

    // Query to get airport IDs based on city names
    $fromCityQuery = "SELECT airport_id FROM airports WHERE airport_name = '$fromCity'";
    $toCityQuery = "SELECT airport_id FROM airports WHERE airport_name = '$toCity'";

    // Execute queries
    $fromCityResult = $conn->query($fromCityQuery);
    $toCityResult = $conn->query($toCityQuery);

    // Check if both airport IDs are found
    if ($fromCityResult->num_rows > 0 && $toCityResult->num_rows > 0) {
        // Fetch airport IDs
        $fromAirportID = $fromCityResult->fetch_assoc()['airport_id'];
        $toAirportID = $toCityResult->fetch_assoc()['airport_id'];

        // Query to search for flights based on user input
        $searchQuery = "SELECT flights.*, airlines.airline_name, airlines.logo FROM flights 
                        INNER JOIN airlines ON flights.airline_id = airlines.airline_id 
                        WHERE dep_airport_id = $fromAirportID 
                        AND arr_airport_id = $toAirportID 
                        AND source_date = '$travelDate' 
                        AND flight_class = '$class'";

        // Append the selected airline condition if an airline is selected
        if (!empty($selectedAirline)) {
            $searchQuery .= " AND airlines.airline_name = '$selectedAirline'";
        }

        // Execute search query
        $searchResult = $conn->query($searchQuery);

        // Display search results or a message if no flights found
        if ($searchResult->num_rows > 0) {
            // Display search results
            ?>
            <div class='container'>
                <h2 class='text-center mb-4'>Search Results</h2>
                <?php
                while ($row = $searchResult->fetch_assoc()) {
                    ?>
                    <div class='row'>
                        <div class='col-md-12'>
                            <div class='shadow p-3 mb-5 bg-white rounded flight-card'>
                                <div class='card-body d-flex justify-content-between align-items-center'>
                                    <!-- Card content -->
                                    <div>
                                        <img src='./admin<?php echo $row["logo"]; ?>' class='img-fluid' alt='Airline Logo' width='50' height='50'>
                                        <p class='card-text mt-2'><?php echo $row["airline_name"]; ?></p>
                                        <h6 class='card-title'><?php echo $row["flight_code"]; ?></h6>
                                    </div>
                                    <div>
                                        <?php
                                 // Fetch departure and arrival dates and times
$departureDateTime = strtotime($row["source_date"] . ' ' . $row["source_time"]);
$arrivalDateTime = strtotime($row["dest_date"] . ' ' . $row["dest_time"]);

// Calculate duration in seconds
$durationInSeconds = $arrivalDateTime - $departureDateTime;

// Calculate duration in hours and minutes
$hours = floor($durationInSeconds / 3600);
$minutes = floor(($durationInSeconds % 3600) / 60);

// Format the duration
$duration = sprintf('%02d:%02d', $hours, $minutes);
 // Convert seconds to hours and round to two decimal places
                                        ?>
                                        <p class='card-text'>Duration: <?php echo $duration; ?> hours</p>
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
                                        // Retrieve available seats
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
                                            // echo "</div>";
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
            // No flights found
            ?>
            <div class='container'>
                <h2 class='text-center mb-4'>No Flights Found</h2>
            </div>
            <?php
        }
    } else {
        // Airport IDs not found
        ?>
        <div class='container'>
            <h2 class='text-center mb-4'>Invalid Airport Selection</h2>
        </div>
        <?php
    }
}

// Close the database connection
$conn->close();
?>

<?php
include("./include/footer.php");
?>
