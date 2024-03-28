<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passenger Booking</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* CSS for table records */
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #23395d;
            padding: 8px;
            vertical-align: middle;
        }
        .card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
        }
    </style>
</head>
<body>
<?php
require("./config.php");
include("./include/navbar.php");
include("./include/connection.php");

$flight_id = null;

// Check if user is logged in
if (isset($_SESSION['u'])) {
    $userid = $_SESSION['u'];

    if (isset($_GET['flight_id']) && isset($_GET['passengers'])) {
        $flight_id = $_GET['flight_id'];
        $numPassengers = $_GET['passengers'];

        $flightQuery = "SELECT * FROM flights WHERE flight_id = $flight_id";
        $flightResult = $conn->query($flightQuery);

        if ($flightResult && $flightResult->num_rows > 0) {
            $flight = $flightResult->fetch_assoc();

            // Calculate total amount
            $total_amount = $flight['price'] * $numPassengers;

            // Store total amount in session
            $_SESSION['total_price'] = $total_amount;
            $_SESSION['flight_id'] = $flight_id;
?>
            <div class="container">
                <h2 class="text-center mb-4">Passenger Details</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="hidden" name="flight_id" value="<?php echo $flight['flight_id']; ?>">
                    <input type="hidden" name="passengers" value="<?php echo $numPassengers; ?>">
                    <input type="hidden" name="total_price" value="<?php echo $total_amount; ?>">

                    <!-- Loop to generate input fields for passengers -->
                    <?php for ($i = 1; $i <= $numPassengers; $i++) { ?>
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title">Passenger <?php echo $i; ?></h5>
                            </div>
                            <div class="card-body">
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
                                    <input type="date" class="form-control" id="dob<?php echo $i; ?>" name="dob<?php echo $i; ?>" max="<?php echo date('Y-m-d'); ?>" onchange="calculateAge(<?php echo $i; ?>)" required>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary" name="confirmBooking">Confirm Booking</button>
                </form>
            </div>

            <script>
                function calculateAge(passengerNumber) {
                    var dobInput = document.getElementById('dob' + passengerNumber).value;
                    var dob = new Date(dobInput);
                    var today = new Date();
                    var age = today.getFullYear() - dob.getFullYear();
                    var monthDiff = today.getMonth() - dob.getMonth();
                    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
                        age--;
                    }
                    document.getElementById('age' + passengerNumber).value = age;
                }
            </script>

<?php
        } else {
            echo "<div class='container'>";
            echo "<h2 class='text-center mb-4'>Flight not found</h2>";
            echo "</div>";
        }
    } else {
        echo "<div class='container'>";
        //echo "<h2 class='text-center mb-4'>Flight ID is not set in session.</h2>";
        echo "</div>";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if form is submitted
        if (isset($_POST['confirmBooking'])) {
            // Ensure $numPassengers is defined
            $numPassengers = isset($_POST['passengers']) ? $_POST['passengers'] : 0;

            // Ensure total price is set in session
            if (isset($_SESSION['total_price'])) {
                // Prepare INSERT statement for booked_flights table
                $insertStatement = $conn->prepare("INSERT INTO booked_flights (flight_id, user_id, take_seats, flight_class, total_amount, airline_id) VALUES (?, ?, ?, ?, ?, ?)");

                if ($insertStatement) {
                    // Bind parameters and execute the INSERT statement
                    $insertStatement->bind_param("iiisii", $_POST['flight_id'], $userid, $numPassengers, $_POST['flight_class'], $_SESSION['total_price'], $flight['airline_id']);
                    $insertStatement->execute();

                    // Get the booking ID
                    $booking_id = $insertStatement->insert_id;

                    // Store the booking ID in session
                    $_SESSION['booking_id'] = $booking_id;

                    // Close the prepared statement
                    $insertStatement->close();

                    // Prepare INSERT statement for passenger table
                    $passengerStatement = $conn->prepare("INSERT INTO passenger (name, age, gender, dob, booking_id, pnr_no, seatno, gateno) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

                    if ($passengerStatement) {
                        // Initialize PNR number
                        $pnr_no = null;

                        // Check if booking ID already exists to retrieve the same PNR number
                        $checkBookingQuery = "SELECT pnr_no FROM passenger WHERE booking_id = ?";
                        $checkBookingStatement = $conn->prepare($checkBookingQuery);
                        $checkBookingStatement->bind_param("i", $booking_id);
                        $checkBookingStatement->execute();
                        $checkBookingStatement->store_result();

                        if ($checkBookingStatement->num_rows > 0) {
                            $checkBookingStatement->bind_result($pnr_result);
                            $checkBookingStatement->fetch();
                            $pnr_no = $pnr_result;
                        } else {
                            // Generate new PNR number if booking ID doesn't exist
                            $pnr_no = mt_rand(1000000000, 9999999999);
                        }

                        // Loop through passengers
                        for ($i = 1; $i <= $numPassengers; $i++) {
                            // Generate random seat number and gate number
                            $seatno = rand(1, 50); // Assuming there are 50 seats
                            $gateno = rand(1, 10); // Assuming there are 10 gates

                            // Retrieve form data for each passenger
                            $name = $_POST["name$i"];
                            $age = $_POST["age$i"];
                            $gender = $_POST["gender$i"];
                            $dob = $_POST["dob$i"];

                            // Bind parameters and execute the INSERT statement for passenger table
                            $passengerStatement->bind_param("sissiiss", $name, $age, $gender, $dob, $booking_id, $pnr_no, $seatno, $gateno);
                            $passengerStatement->execute();
                        }

                        // Close the prepared statement for passenger table
                        $passengerStatement->close();
                    } else {
                        echo "Error preparing statement for passenger table: " . $conn->error;
                    }

                    // Fetch the latest booking details based on booking_id
                    $latest_booking_query = "SELECT * FROM passenger WHERE booking_id = $booking_id";
                    $latest_booking_result = mysqli_query($conn, $latest_booking_query);

                    if ($latest_booking_result && mysqli_num_rows($latest_booking_result) > 0) {
                        ?>
                        <div class="container mt-5">
                            <h2 class="mb-3">Traveller Details</h2>
                            <div class="table-responsive ">
                                <table class="table table-bordered ">
                                    <thead class="thead-dark">
                                    <tr style="background-color:red;">
                                        <th scope="col" class="bg-primary text-white">Name</th>
                                        <th scope="col" class="bg-primary text-white">Age</th>
                                        <th scope="col" class="bg-primary text-white">Gender</th>
                                        <th scope="col" class="bg-primary text-white">Date of Birth</th>
                                        <!-- <th scope="col" class="bg-primary text-white">PNR No</th>
                                        <th scope="col" class="bg-primary text-white">Seat No</th>
                                        <th scope="col" class="bg-primary text-white">Gate No</th> -->
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($latest_booking_result)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['age'] . "</td>";
                                        echo "<td>" . $row['gender'] . "</td>";
                                        echo "<td>" . $row['dob'] . "</td>";
                                        // echo "<td>" . $row['pnr_no'] . "</td>";
                                        // echo "<td>" . $row['seatno'] . "</td>";
                                        // echo "<td>" . $row['gateno'] . "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php
                    } else {
                        echo "<div class='container'>";
                        echo "<h2 class='text-center mb-4'>No booking details found</h2>";
                        echo "</div>";
                    }

                    // Display Stripe payment form
                    ?>
                    <div class="container mt-3">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Price: Rs. <?php echo $_SESSION['total_price']; ?></h5>
                                        <form action="flight_submit.php" method="post">
                                            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                                    data-key="<?php echo $Publishablekey; ?>"
                                                    data-amount="<?php echo $_SESSION['total_price'] * 100; ?>"
                                                    data-name="Shopflix"
                                                    data-description="Shopflix"
                                                    data-image="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQiUuPgu-yLEY2NbaZa7MdSibC9nDZQZ8AjEGH022Vpvw&s"
                                                    data-currency="INR"
                                                    data-email="shopfilx420@gmail.com">
                                            </script>
                                            <input type="hidden" name="total_amount" value="<?php echo $_SESSION['total_price']; ?>">
                                            <input type="hidden" name="stripeToken" value="<?php echo $_SESSION['u'] . random_int(1000,2000); ?>">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                } else {
                    echo "Error fetching latest booking details: " . $conn->error;
                }
            } else {
                echo "Error preparing statement for booked_flights table: " . $conn->error;
            }
        } else {
            echo "Total price not set in session.";
        }
    }
} else {
    // User is not logged in, redirect to login page
    echo '<script>window.location.href = "login.php";</script>';
    exit();
}

$conn->close();
?>
</body>
</html>
