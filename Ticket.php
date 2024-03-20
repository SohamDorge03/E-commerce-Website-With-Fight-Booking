<?php
// Include the database connection file
include("./include/connection.php");

// Query to fetch data from multiple tables
$sql = "SELECT 
            p.name,
            p.age,
            p.dob,
            p.gender,
            bf.total_amount,
            bf.take_seats ,
            bf.flight_class,
            a.airline_name,
            f.flight_code,
            f.source_time,
            f.source_date
        FROM passenger p
        INNER JOIN booked_flights bf ON p.booking_id = bf.booking_id
        INNER JOIN airlines a ON bf.airline_id = a.airline_id
        INNER JOIN flights f ON bf.flight_id = f.flight_id";

$result = $conn->query($sql);

if ($result === false) {
    // Handle query error
    echo "Error: " . $conn->error;
} elseif ($result->num_rows > 0) {
    // Display fetched data in card format
    while ($row = $result->fetch_assoc()) {
        ?>
        <div class="card mb-3">
            <div class="card-header">
                Passenger: <?php echo $row['name']; ?>
            </div>
            <div class="card-body">
                <p>Age: <?php echo $row['age']; ?></p>
                <p>Date of Birth: <?php echo $row['dob']; ?></p>
                <p>Gender: <?php echo $row['gender']; ?></p>
                <p>Total Amount: <?php echo $row['total_amount']; ?></p>
                <p>Take Seat: <?php echo $row['take_seats']; ?></p>
                <p>Flight Class: <?php echo $row['flight_class']; ?></p>
                <p>Airline: <?php echo $row['airline_name']; ?></p>
                <p>Flight Code: <?php echo $row['flight_code']; ?></p>
                <p>Source Time: <?php echo $row['source_time']; ?></p>
                <p>Source Date: <?php echo $row['source_date']; ?></p>
            </div>
        </div>
        <?php
    }
} else {
    // No results found
    echo "No passengers found";
}

// Close connection
$conn->close();
?>
