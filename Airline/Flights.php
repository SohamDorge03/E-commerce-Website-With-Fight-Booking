<?php
session_start(); 

if (!isset($_SESSION['airline_id'])) {
    
    header("Location: log.php");
    exit; 
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "shopflix";


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = ""; 
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
    $flight_class = $_POST["flight_class"];
    $price = $_POST["price"];

    
    $check_flight_code_query = "SELECT * FROM flights WHERE flight_code = '$flight_code'";
    $check_flight_code_result = $conn->query($check_flight_code_query);
    if ($check_flight_code_result && $check_flight_code_result->num_rows > 0) {
        $error = "Flight with the same code already exists";
    }
    
    elseif ($dep_airport_id == $arr_airport_id) {
        $error = "Departure and arrival airports cannot be the same";
    }
    
    else {
        $check_time_query = "SELECT * FROM flights WHERE source_date = '$source_date' AND source_time = '$source_time' AND dest_time = '$dest_time'";
        $check_time_result = $conn->query($check_time_query);
        if ($check_time_result && $check_time_result->num_rows > 0) {
            $error = "Flight with the same departure and arrival times on the same date already exists";
        } else {
            
            $airline_id = $_SESSION['airline_id'];

            
            $sql = "INSERT INTO flights (flight_code, source_date, source_time, dest_date, dest_time, dep_airport_id, arr_airport_id, seats, flight_class, price, airline_id) 
                VALUES ('$flight_code', '$source_date', '$source_time', '$dest_date', '$dest_time', '$dep_airport_id', '$arr_airport_id', '$seats', '$flight_class', '$price', '$airline_id')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Flight added successfully');</script>";
                
                echo "<script>window.location.href = 'Flights.php';</script>";
            } else {
                $error = "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}


$airline_id = $_SESSION['airline_id'];


$airport_query = "SELECT airport_id, airport_name FROM airports";
$airport_result = $conn->query($airport_query);


$flight_query = "SELECT * FROM flights WHERE airline_id = '$airline_id'";
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
    <?php
    include("./navbar.php");
    ?>
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
                <thead style="color:wheat;" >
                    <tr style="background-color:#000080;">
                        <th>Flight ID</th>
                        <th>Flight Code</th>
                        <th>Source Date</th>
                        <th>Source Time</th>
                        <th>Destination Date</th>
                        <th>Destination Time</th>
                        <th>Departure Airport ID</th>
                        <th>Arrival Airport ID</th>
                        <th>Seats</th>
                        <th>Flight Class</th>
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
                            echo "<td>" . $row["flight_class"] . "</td>";
                            echo "<td>" . $row["price"] . "</td>";
                            echo "<td>
                                    <a href='update_flight.php?id=" . $row["flight_id"] . "' class='btn btn-sm btn-primary'>Update</a>
                                    <a href='delete_flight.php?id=" . $row["flight_id"] . "' class='btn btn-sm btn-danger' style='margin-top:5px';>Delete</a>
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
                            <select class="form-control" id="dep_airport_id" name="dep_airport_id" required onchange="updateArrivalAirports(this.value)">
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
                            <label for="flight_class">Flight Class:</label>
                            <select class="form-control" id="flight_class" name="flight_class" required>
                                <option value="Economy">Economy</option>
                                <option value="Business">Business</option>
                                <option value="First Class">First Class</option>
                            </select>
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

    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function validateForm() {
            var sourceDate = document.getElementById('source_date').value;
            var destDate = document.getElementById('dest_date').value;
            var sourceTime = document.getElementById('source_time').value;
            var destTime = document.getElementById('dest_time').value;

            if (sourceDate == '' || destDate == '') {
                alert('Please select source and destination dates');
                return false;
            }
            if (new Date(destDate) < new Date(sourceDate)) {
                alert('Destination date must be after or the same as the source date');
                return false;
            }
            if (sourceTime === destTime) {
                alert('Departure and arrival times cannot be the same');
                return false;
            }
            return true;
        }

        function updateArrivalAirports(selectedDepAirportId) {
            var arrAirportDropdown = document.getElementById("arr_airport_id");
            
            arrAirportDropdown.innerHTML = "";

            
            var defaultOption = document.createElement("option");
            defaultOption.text = "Select Arrival Airport";
            defaultOption.value = "";
            arrAirportDropdown.add(defaultOption);

            
            <?php
            if ($airport_result && $airport_result->num_rows > 0) {
                $airport_result->data_seek(0);
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
</body>

</html>
