<?php
session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "";
$database = "shopflix";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

include("./navbar.php");

$error = ""; // Variable to store error message

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $flight_code = $_POST["flight_code"];
    $source_date = $_POST["source_date"];
    $source_time = $_POST["source_time"];
    $dest_date = $_POST["dest_date"];
    $dest_time = $_POST["dest_time"];
    $dep_airport_id = $_POST["dep_airport_id"];
    $arr_airport_id = $_POST["arr_airport_id"];
    $seats = $_POST["seats"];
    $price = $_POST["price"];

    // Check for back date
    if (strtotime($source_date) < strtotime(date("Y-m-d"))) {
        $error = "Source date cannot be a past date";
    }
    // Check if destination date is after source date
    elseif (strtotime($dest_date) <= strtotime($source_date)) {
        $error = "Destination date must be after source date";
    } else {
        // Retrieve airline ID from session
        $airline_id = $_SESSION['airline_id'];

        // SQL query to insert new flight record
        $sql = "INSERT INTO flights (flight_code, source_date, source_time, dest_date, dest_time, dep_airport_id, arr_airport_id, seats, price, airline_id) 
            VALUES ('$flight_code', '$source_date', '$source_time', '$dest_date', '$dest_time', '$dep_airport_id', '$arr_airport_id', '$seats', '$price', '$airline_id')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Flight added successfully');</script>";
            // Redirect to the same page to avoid resubmission on page refresh
            echo "<script>window.location.href = 'Flights.php';</script>";
        } else {
            $error = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Retrieve airline ID from session
$airline_id = $_SESSION['airline_id'];

// Fetch airports for dropdown
$airport_query = "SELECT airport_id, airport_name FROM airports";
$airport_result = $conn->query($airport_query);

// Fetch flight records
$flight_query = "SELECT * FROM flights";
$result = $conn->query($flight_query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 70px !important;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <h2>Add New Flight</h2>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addFlightModal">Add New Flight</button>
        <hr>
        <h2>Flight Details</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Flight ID</th>
                        <th>Flight Code</th>
                        <th>Source Date</th>
                        <th>Source Time</th>
                        <th>Destination Date</th>
                        <th>Destination Time</th>
                        <th>Departure Airport ID</th>
                        <th>Arrival Airport ID</th>
                        <th>Seats</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["flight_id"] . "</td>";
                            echo "<td>" . $row["flight_code"] . "</td>";
                            echo "<td>" . $row["source_date"] . "</td>";
                            echo "<td>" . $row["source_time"] . "</td>";
                            echo "<td>" . $row["dest_date"] . "</td>";
                            echo "<td>" . $row["dest_time"] . "</td>";
                            echo "<td>" . $row["dep_airport_id"] . "</td>";
                            echo "<td>" . $row["arr_airport_id"] . "</td>";
                            echo "<td>" . $row["seats"] . "</td>";
                            echo "<td>" . $row["price"] . "</td>";
                            echo "<td>
                                    <a href='update_flight.php?id=" . $row["flight_id"] . "' class='btn btn-sm btn-primary'>Update</a>
                                    <a href='delete_flight.php?id=" . $row["flight_id"] . "' class='btn btn-sm btn-danger'>Delete</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='11'>No flights found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Flight Modal -->
    <div class="modal fade" id="addFlightModal" tabindex="-1" role="dialog" aria-labelledby="addFlightModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFlightModalLabel">Add New Flight</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validateForm()">
                        <!-- Flight details form -->
                        <div class="form-group">
                            <label for="flight_code">Flight Code:</label>
                            <input type="text" class="form-control" id="flight_code" name="flight_code" required>
                        </div>
                        <div class="form-group">
    <label for="source_date">Source Date:</label>
    <input type="date" class="form-control" id="source_date" name="source_date" required min="<?php echo date('Y-m-d'); ?>">
</div>


                        <div class="form-group">
                            <label for="source_time">Source Time:</label>
                            <input type="time" class="form-control" id="source_time" name="source_time" required>
                        </div>
                        <div class="form-group">
    <label for="dest_date">Destination Date:</label>
    <input type="date" class="form-control" id="dest_date" name="dest_date" required min="<?php echo date('Y-m-d'); ?>">
</div>
                        <div class="form-group">
                            <label for="dest_time">Destination Time:</label>
                            <input type="time" class="form-control" id="dest_time" name="dest_time" required>
                        </div>
                        <div class="form-group">
                            <label for="dep_airport_id">Departure Airport:</label>
                            <select class="form-control" id="dep_airport_id" name="dep_airport_id" required>
                                <?php
                                if ($airport_result && $airport_result->num_rows > 0) {
                                    while ($airport_row = $airport_result->fetch_assoc()) {
                                        echo "<option value='" . $airport_row['airport_id'] . "'>" . $airport_row['airport_name'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="arr_airport_id">Arrival Airport:</label>
                            <select class="form-control" id="arr_airport_id" name="arr_airport_id" required>
                                <?php
                                if ($airport_result && $airport_result->num_rows > 0) {
                                    $airport_result->data_seek(0);
                                    while ($airport_row = $airport_result->fetch_assoc()) {
                                        echo "<option value='" . $airport_row['airport_id'] . "'>" . $airport_row['airport_name'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="seats">Number of Seats:</label>
                            <input type="number" class="form-control" id="seats" name="seats" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="text" class="form-control" id="price" name="price" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function validateForm() {
            var sourceDate = document.getElementById('source_date').value;
            var destDate = document.getElementById('dest_date').value;
            if (sourceDate == '' || destDate == '') {
                alert('Please select source and destination dates');
                return false;
            }
            if (new Date(destDate) <= new Date(sourceDate)) {
                alert('Destination date must be after source date');
                return false;
            }
            return true;
        }
        
    </script>
<script>
    function updateArrivalAirports(selectedDepAirportId) {
        var arrAirportDropdown = document.getElementById("arr_airport_id");
        // Remove all existing options
        arrAirportDropdown.innerHTML = "";

        // Add a default option
        var defaultOption = document.createElement("option");
        defaultOption.text = "Select Arrival Airport";
        defaultOption.value = "";
        arrAirportDropdown.add(defaultOption);

        // Add arrival airports dynamically based on the selected departure airport
        <?php
        if ($airport_result && $airport_result->num_rows > 0) {
            while ($airport_row = $airport_result->fetch_assoc()) {
                if ($airport_row['airport_id'] != selectedDepAirportId) {
                    echo "var option = document.createElement('option');";
                    echo "option.text = '" . $airport_row['airport_name'] . "';";
                    echo "option.value = '" . $airport_row['airport_id'] . "';";
                    echo "arrAirportDropdown.add(option);";
                }
            }
        }
        ?>
    }
</script>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>