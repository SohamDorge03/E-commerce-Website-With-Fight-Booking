<?php
include("./connection.php");
include("./navbar.php");
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
                        <th>Airline Email</th>
                        <th>Actions</th> <!-- New column for update and delete buttons -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT flights.*, airlines.email AS airline_email FROM flights JOIN airlines ON flights.airline_id = airlines.airline_id";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
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
                            echo "<td>" . $row["airline_email"] . "</td>";
                            echo "<td>
                    <a href='update_flight.php?id=" . $row["flight_id"] . "' class='btn btn-sm btn-primary'>Update</a>
                    
                    <a href='delete_flight.php?id=" . $row["flight_id"] . "' class='btn btn-sm btn-danger'>Delete</a>
                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='12'>No flights found</td></tr>";
                    }

                    $conn->close();
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
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="form-group">
                            <label for="flight_code">Flight Code:</label>
                            <input type="text" class="form-control" id="flight_code" name="flight_code" required>
                        </div>
                        <div class="form-group">
                            <label for="source_date">Source Date:</label>
                            <input type="date" class="form-control" id="source_date" name="source_date">
                        </div>
                        <div class="form-group">
                            <label for="source_time">Source Time:</label>
                            <input type="time" class="form-control" id="source_time" name="source_time">
                        </div>
                        <div class="form-group">
                            <label for="dest_date">Destination Date:</label>
                            <input type="date" class="form-control" id="dest_date" name="dest_date">
                        </div>
                        <div class="form-group">
                            <label for="dest_time">Destination Time:</label>
                            <input type="time" class="form-control" id="dest_time" name="dest_time">
                        </div>
                        <div class="form-group">
                            <label for="dep_airport_id">Departure Airport ID:</label>
                            <input type="number" class="form-control" id="dep_airport_id" name="dep_airport_id">
                        </div>
                        <div class="form-group">
                            <label for="arr_airport_id">Arrival Airport ID:</label>
                            <input type="number" class="form-control" id="arr_airport_id" name="arr_airport_id">
                        </div>
                        <div class="form-group">
                            <label for="seats">Number of Seats:</label>
                            <input type="number" class="form-control" id="seats" name="seats">
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="text" class="form-control" id="price" name="price">
                        </div>
                        <div class="form-group">
                            <label for="airline_id">Airline ID:</label>
                            <input type="text" class="form-control" id="airline_id" name="airline_id">
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
</body>

</html>
