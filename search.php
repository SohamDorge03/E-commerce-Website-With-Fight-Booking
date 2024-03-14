<?php
// Include database connection code here

include("./include/connection.php");

// Retrieve form data
$from_city = $_GET['from_city'];
$to_city = $_GET['to_city'];
$departure_date = $_GET['departure_date'];
$flight_class = $_GET['flight_class'];
$seats = $_GET['seats'];

// Prepare SQL query with JOINs
$sql = "SELECT flights.*, airports_dep.city AS from_city, airports_arr.city AS to_city
        FROM flights
        JOIN airports AS airports_dep ON flights.dep_airport_id = airports_dep.airport_id
        JOIN airports AS airports_arr ON flights.arr_airport_id = airports_arr.airport_id
        WHERE airports_dep.city LIKE CONCAT('%', :from_city, '%')
        AND airports_arr.city LIKE CONCAT('%', :to_city, '%')
        AND source_date = :departure_date
        AND flight_class = :flight_class
        AND seats >= :seats";

// Prepare and execute the query
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':from_city' => $from_city,
    ':to_city' => $to_city,
    ':departure_date' => $departure_date,
    ':flight_class' => $flight_class,
    ':seats' => $seats
]);

// Fetch the results
$flights = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Display the results
foreach ($flights as $flight) {
    echo "Flight Code: " . $flight['flight_code'] . "<br>";
    echo "From: " . $flight['from_city'] . "<br>";
    echo "To: " . $flight['to_city'] . "<br>";
    echo "Departure Date: " . $flight['source_date'] . "<br>";
    echo "Flight Class: " . $flight['flight_class'] . "<br>";
    echo "Available Seats: " . $flight['seats'] . "<br><br>";
}
?>
