<?php
include("./include/navbar.php");
include("./include/connection.php");

$flight_id = null; // Define $flight_id to avoid undefined variable warning

if(isset($_GET['flight_id']) && isset($_GET['passengers'])) {
    $flight_id = $_GET['flight_id'];
    $numPassengers = $_GET['passengers'];

    $flightQuery = "SELECT * FROM flights WHERE flight_id = $flight_id";
    $flightResult = $conn->query($flightQuery);

    if($flightResult && $flightResult->num_rows > 0) {
        $flight = $flightResult->fetch_assoc();
?>

<div class="container">
    <h2 class="text-center mb-4">Passenger Details</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="hidden" name="flight_id" value="<?php echo $flight['flight_id']; ?>">
        <input type="hidden" name="passengers" value="<?php echo $numPassengers; ?>">
        
        <!-- Loop to generate input fields for passengers -->
        <?php
        for($i = 1; $i <= $numPassengers; $i++) {
        ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Passenger <?php echo $i; ?></h5>
                <!-- Other input fields for passenger details -->
                <div class="form-group">
                    <label for="name<?php echo $i; ?>">Name:</label>
                    <input type="text" class="form-control" id="name<?php echo $i; ?>" name="name<?php echo $i; ?>" required>
                </div>
                <div class="form-group">
                    <label for="age<?php echo $i; ?>">Age:</label>
                    <input type="number" class="form-control" id="age<?php echo $i; ?>" name="age<?php echo $i; ?>" required>
                </div>
                <div class="form-group">
                    <label for="gender<?php echo $i; ?>">Gender:</label>
                    <select class="form-control" id="gender<?php echo $i; ?>" name="gender<?php echo $i; ?>" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="dob<?php echo $i; ?>">Date of Birth:</label>
                    <input type="date" class="form-control" id="dob<?php echo $i; ?>" name="dob<?php echo $i; ?>" required>
                </div>
                <!-- Other input fields for passenger details -->
            </div>
        </div>
        <?php
        }
        ?>
        
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary" name="confirmBooking">Confirm Booking</button>
    </form>
</div>

<?php
    } else {
        echo "<div class='container'>";
        echo "<h2 class='text-center mb-4'>Flight not found</h2>";
        echo "</div>";
    }
} else {
    echo "<div class='container'>";
    echo "<h2 class='text-center mb-4'>successfully insert</h2>";
    echo "</div>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form is submitted
    if(isset($_POST['confirmBooking'])) {
        // Ensure $numPassengers is defined
        $numPassengers = isset($_POST['passengers']) ? $_POST['passengers'] : 0;

        // Prepare INSERT statement for PassengerDetails table
        $insertStatement = $conn->prepare("INSERT INTO shopflix.passenger (name, age, gender, dob, seatno, gateno, boarding_time, booking_id) VALUES (?, ?, ?, ?, NULL, NULL, NULL, NULL)");

        if ($insertStatement) {
            for($i = 1; $i <= $numPassengers; $i++) {
                // Retrieve form data for each passenger
                $name = $_POST["name$i"];
                $age = $_POST["age$i"];
                $gender = $_POST["gender$i"];
                $dob = $_POST["dob$i"];

                // Bind parameters and execute the INSERT statement
                $insertStatement->bind_param("siss", $name, $age, $gender, $dob);
                $insertStatement->execute();
            }

            // Close the prepared statement
            $insertStatement->close();

            // Redirect to booking confirmation page
            if ($flight_id !== null) {
                header("Location: booking_confirmation.php?flight_id=$flight_id&passengers=$numPassengers");
                exit();
            }
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    }
}

$conn->close();
?>
