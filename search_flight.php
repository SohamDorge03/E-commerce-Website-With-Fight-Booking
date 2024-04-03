<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Booking</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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
            border-radius: 20px;
            padding: 40px;
            width:100%;
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

include("./include/connection.php");


if(isset($_POST['searchFlights'])) {

    $fromCity = $_POST['fromCity'];
    $toCity = $_POST['toCity'];


    if($fromCity == $toCity) {
   
        echo "<div class='container'>";
        echo "<h2 class='text-center mb-4'>Error: Same Airport Selected</h2>";
        echo "<p class='text-center'>Please select different airports for departure and arrival.</p>";
        echo "</div>";
        exit;
    }
    $travelDate = $_POST['travelDate'];
    $passengers = $_POST['passengers'];
    $class = $_POST['class'];

    $fromCityQuery = "SELECT airport_id FROM airports WHERE airport_name = '$fromCity'";
    $toCityQuery = "SELECT airport_id FROM airports WHERE airport_name = '$toCity'";

    $fromCityResult = $conn->query($fromCityQuery);
    $toCityResult = $conn->query($toCityQuery);

    if ($fromCityResult->num_rows > 0 && $toCityResult->num_rows > 0) {
        
        $fromAirportID = $fromCityResult->fetch_assoc()['airport_id'];
        $toAirportID = $toCityResult->fetch_assoc()['airport_id'];

        $searchQuery = "SELECT * FROM flights WHERE dep_airport_id = $fromAirportID AND arr_airport_id = $toAirportID AND source_date = '$travelDate' AND flight_class = '$class'";

        $searchResult = $conn->query($searchQuery);

        if ($searchResult->num_rows > 0) {
            
            echo "<div class='container'>";
            echo "<h2 class='text-center mb-4'>Search Results</h2>";
            echo "<div class='table-responsive'>";
            echo "<table class='table table-bordered'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Flight Code</th>";
            echo "<th>Departure Airport</th>";
            echo "<th>Arrival Airport</th>";
            echo "<th>Departure Time</th>";
            echo "<th>Arrival Time</th>";
            echo "<th>Seats Available</th>";
            echo "<th>Price</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($row = $searchResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["flight_code"] . "</td>";
                echo "<td>" . $fromCity . "</td>";
                echo "<td>" . $toCity . "</td>";
                echo "<td>" . $row["source_time"] . "</td>";
                echo "<td>" . $row["dest_time"] . "</td>";
                echo "<td>" . $row["seats"] . "</td>";
                echo "<td>" . $row["price"] . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
            echo "</div>";
        } else {
           
            echo "<div class='container'>";
            echo "<h2 class='text-center mb-4'>No Flights Found</h2>";
            echo "</div>";
        }
    } else {
       
        echo "<div class='container'>";
        echo "<h2 class='text-center mb-4'>Invalid Airport Selection</h2>";
        echo "</div>";
    }
}
?>

<div class="jumbotron">
    <div class="container">
        <h1>Book Your Flight Now</h1>
        <div class="search-container">
        
        <form action="search_results.php" method="post">
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <?php
                        $sql = "SELECT airport_name FROM airports";
                        $result = $conn->query($sql);

                      
                        if ($result->num_rows > 0) {
                            echo "<select class='form-control' name='fromCity' id='fromCity' required>";
                            echo "<option value=''>Select From City</option>";
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['airport_name'] . "'>" . $row['airport_name'] . "</option>";
                            }
                            echo "</select>";
                        } else {
                            echo "<input type='text' class='form-control' name='fromCity' placeholder='From City' required>";
                        }
                        ?>
                    </div>
                    <div class="">
                    <button type="button" class="btn btn-light ml-2" onclick="reverseCities()"><i class="fas fa-exchange-alt"></i></button>
                    </div>
                    <div class="col-md-3 mb-3">
                        <?php
                       
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            echo "<select class='form-control' name='toCity' id='toCity' required>";
                            echo "<option value=''>Select To City</option>";
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['airport_name'] . "'>" . $row['airport_name'] . "</option>";
                            }
                            echo "</select>";
                        } else {
                            echo "<input type='text' class='form-control' name='toCity' placeholder='To City' required>";
                        }


                        $conn->close();
                        ?>
                    </div>
                    <div class=" mb-3">
                        <input type="date" class="form-control" name="travelDate" id="travelDate" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <select class="form-control" name="passengers" value='$passengers' required>
                            <option value="1">1 Passenger</option>
                            <option value="2">2 Passengers</option>
                            <option value="3">3 Passengers</option>
                            <option value="4">4 Passengers</option>
                            <option value="5">5 Passengers</option>
                          
                        </select>
                    </div>
                    <div class="col-md-1 mb-3">
                        <select class="form-control" name="class" required>
                            
                            <option value="economy">Economy Class</option>
                            <option value="business">Business Class</option>
                            <option value="first class">First Class</option>
                        </select>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit" name="searchFlights"><i class="fas fa-plane-departure"></i> Search Flights</button>
                
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
            
            include("include/connection.php");

            $sql = "SELECT * FROM airlines";

        
            $result = $conn->query($sql);

        
            if ($result->num_rows > 0) {
              
                while($row = $result->fetch_assoc()) {
                    echo "<img src='admin" . $row["logo"] . "' alt='" . $row["airline_name"] . " Logo' style='max-width: 140px; margin: 10px;'>";
                }
            } else {

                echo "No airlines found.";
            }

            $conn->close();
            ?>
        </div>
    </div>
</section>


<?php
include("./include/footer.php");
?>

<script>
   
    function disableBackdate() {
        var today = new Date().toISOString().split('T')[0];
        document.getElementById("travelDate").setAttribute('min', today);
    }

    window.onload = disableBackdate;


    document.getElementById('fromCity').addEventListener('change', function() {
        var fromCity = this.value;
        var toCitySelect = document.getElementById('toCity');
        for (var i = 0; i < toCitySelect.options.length; i++) {
            if (toCitySelect.options[i].value === fromCity) {
                toCitySelect.options[i].disabled = true;
            } else {
                toCitySelect.options[i].disabled = false;
            }
        }
    });

    function reverseCities() {
        var fromCity = document.getElementById('fromCity').value;
        var toCity = document.getElementById('toCity').value;
        document.getElementById('fromCity').value = toCity;
        document.getElementById('toCity').value = fromCity;
    }
</script>

</body>
</html>
