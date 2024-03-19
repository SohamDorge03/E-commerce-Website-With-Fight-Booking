<?php
include("./include/navbar.php");
include("./include/connection.php");

if(isset($_GET['flight_id']) && isset($_GET['passengers'])) {
    $flight_id = $_GET['flight_id'];
    $numPassengers = $_GET['passengers'];

    $flightQuery = "SELECT * FROM flights WHERE flight_id = $flight_id";
    $flightResult = $conn->query($flightQuery);

    if($flightResult->num_rows > 0) {
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
                    <label for="firstName<?php echo $i; ?>">First Name:</label>
                    <input type="text" class="form-control" id="firstName<?php echo $i; ?>" name="firstName<?php echo $i; ?>" required>
                </div>
                <div class="form-group">
                    <label for="lastname<?php echo $i; ?>">Last Name:</label>
                    <input type="text" class="form-control" id="lastname<?php echo $i; ?>" name="lastname<?php echo $i; ?>" required>
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
    echo "<h2 class='text-center mb-4'>Invalid Request</h2>";
    echo "</div>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form is submitted
    if(isset($_POST['confirmBooking'])) {
        // Prepare INSERT statement for PassengerDetails table
        $insertStatement = $conn->prepare("INSERT INTO PassengerDetails (FirstName, LastName, Gender, DateOfBirth) VALUES (?, ?, ?, ?)");

        for($i = 1; $i <= $numPassengers; $i++) {
            // Retrieve form data for each passenger
            $firstName = $_POST["firstName$i"];
            $lastName = $_POST["lastname$i"];
            $gender = $_POST["gender$i"];
            $dob = $_POST["dob$i"];

            // Bind parameters and execute the INSERT statement
            $insertStatement->bind_param("ssss", $firstName, $lastName, $gender, $dob);
            $insertStatement->execute();
        }

        // Close the prepared statement
        $insertStatement->close();

        // Redirect to booking confirmation page
        header("Location: booking_confirmation.php?flight_id=$flight_id&passengers=$numPassengers");
        exit();
    }
}

$conn->close();
?>
