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
            echo "<div class='container'>";
            echo "<h2 class='text-center mb-4'>Search Results</h2>";
            echo "<div class='row'>";
            while ($row = $searchResult->fetch_assoc()) {
                echo "<div class='col-md-12'>";
                echo "<div class='shadow p-3 mb-5 bg-white rounded'>";
                echo "<div class='card-body d-flex justify-content-between align-items-center '>";

                echo "<div class='1'>";
                echo "<img src='./admin" . $row["logo"] . "' class='img-fluid' alt='Airline Logo' width='50' height='50'>";
                echo "<p class='card-text mt-2'>" . $row["airline_name"] . "</p>";
                echo "<h6 class='card-title '>" . $row["flight_code"] . "</h6>";
                echo "</div>";
                echo "<div>";
                $departureTime = strtotime($row["source_time"]);
                $arrivalTime = strtotime($row["dest_time"]);
                $duration = round(($arrivalTime - $departureTime) / 3600, 2); // Convert seconds to hours and round to two decimal places
                echo "<p class='card-text'>Duration: " . $duration . " hours</p>";
                echo "</div>";
                echo "<div class='2'>";
                echo "<p class='card-text'> " . $fromCity . "</p>";
                echo "<p class='card-text'> " . $row["source_time"] . "</p>";
                echo "</div>";

                echo "<div>";
                echo "<p class='card-text'> " . $toCity . "</p>";
                echo "<p class='card-text'> " . $row["dest_time"] . "</p>";
                echo "</div>";

                echo "<div>";
                echo "<p class='card-text'> " . $row["price"] . "</p>";
                $totalAmount = $row["price"] * $passengers;
                echo "<p class='card-text'>Total Amount: " . $totalAmount . "</p>";
                if ($row["seats"] > 0) {
                    echo "<div class='flight-seats text-success'>Only " . $row["seats"] . " seat(s) left</div>"; 
                }
                echo "</div>";
                echo "<a href='booking_form.php?flight_id=" . $row['flight_id'] . "&passengers=" . $passengers . "' class='btn btn-primary'>Book Now</a>";
                // Styling the button using Bootstrap
               
                echo "</div>";

                echo "</div>";
                echo "</div>";
                echo "</div>";
               
            }
            echo "</div>";
            
            echo "</div>";
           
        } else {
            // No flights found
            echo "<div class='container'>";
            echo "<h2 class='text-center mb-4'>No Flights Found</h2>";
            echo "</div>";
        }
    } else {
        // Airport IDs not found
        echo "<div class='container'>";
        echo "<h2 class='text-center mb-4'>Invalid Airport Selection</h2>";
        echo "</div>";
    }
}

// Close the database connection
$conn->close();
?>
