<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Booking</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .jumbotron {
            background: url('ppp.jpg') no-repeat center;
            background-size: cover;
            color: #fff;
            padding: 150px 0;
            text-align: center;
            margin-bottom: 50px;
        }

        h1 {
            font-size: 48px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .search-container {
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            border-radius: 5px;
        }

        .btn-search {
            background-color: #ffc107;
            color: #333;
            border: none;
            border-radius: 5px;
            padding: 10px 30px;
            font-size: 18px;
            font-weight: bold;
        }

  .destination-images img {
    width: 100%;
    border-radius: 10px;
    margin-bottom: 20px;
  }
  .footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 20px 0;
  }


    </style>
</head>
<body>
    <?php
    include("./include/navbar.php");
    ?>
    <div class="jumbotron">
        <div class="container">
            <h1>Book Your Flight Now</h1>
            <div class="search-container">
                <form action="search_results.php" method="post">
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <input type="text" class="form-control" name="fromCity" placeholder="From City" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <input type="text" class="form-control" name="toCity" placeholder="To City" required>
                        </div>
                        <div class="col-md-2 mb-3">
                            <input type="date" class="form-control" name="travelDate" required>
                        </div>
                        <div class="col-md-2 mb-3">
                            <select class="form-control" name="passengers" required>
                                <option value="1">1 Passenger</option>
                                <option value="2">2 Passengers</option>
                                <option value="3">3 Passengers</option>
                                <option value="4">4 Passengers</option>
                                <option value="5">5 Passengers</option>
                                <option value="6">6 Passengers</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <select class="form-control" name="class" required>
                                <option value="economy">Economy Class</option>
                                <option value="business">Business Class</option>
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-search" type="submit" name="searchFlights">Search Flights</button>
                </form>
            </div>
        </div>
    </div>

<div class="container">
  <h2 class="text-center mb-4">Top Destinations</h2>
  <div class="row destination-images">
    <div class="col-md-4">
      <img src="delhi.jpeg" alt="Destination 1">
    </div>
    <div class="col-md-4">
      <img src="udaipur.jpeg" alt="Destination 2">
    </div>
    <div class="col-md-4">
      <img src="mumbai.jpeg" alt="Destination 3">
    </div>
  </div>
</div>
<section style="padding-top: 20px;">
    <div class="container">
        <h1 class="text-center">Supporting Airlines</h1>
        <div class="d-flex justify-content-center align-items-center">
                <?php
                // Include the connection file
                include("include/connection.php");

                // Query to retrieve data from the Airlines table
                $sql = "SELECT * FROM airlines";

                // Execute the query
                $result = $conn->query($sql);

                // Check if there are rows in the result
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        // Display airline logo images
                        echo "<img src='admin" . $row["logo"] . "' alt='" . $row["airline_name"] . " Logo' style='max-width: 180px; margin: 10px;'>";
                    }
                } else {
                    // If no airlines are found
                    echo "No airlines found.";
                }

                // Close the database connection
                $conn->close();
                ?>
           
        </div>
    </div>
</section>

<div class="footer">
  <p>&copy; <?php echo date("Y"); ?> Flight Booking. All Rights Reserved.</p>
</div>

</body>
</html>
