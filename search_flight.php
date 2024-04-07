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
    <h1 class="text-center mb-4">Top Destinations</h1>
    <div class="row destination-images">
    
        <div class="col-md-4">
            <img src="udaipur.jpeg" alt="Destination 2">
        </div>
      
        <div class="col-md-4">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRY9aa_0El0bdye3RndlQMh0CKQIv5axMpJHg&s" alt="Destination 2">
        </div>
        <div class="col-md-4">
            <img src="delhi.jpeg" alt="Destination 1">
        </div>
        <div class="col-md-4">
            <img src="data:image/jpeg;base64,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" alt="Destination 3">


        </div>
        <div class="col-md-4">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSLbr9zAe7kcgx-Ir7gV90eKTUGkQacA8UFOQ&s" alt="Destination 2">
        </div>
        <div class="col-md-4">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQyOdNGO743ACDEIeH68M-2ANfC95JI_CkkCw&s" alt="Destination 2">
        </div>
    </div>
</div>

<section style="padding-top:20px;">
    <div class="container">
        <h1 class="text-center">Supporting Airlines</h1>
        <div class="d-flex justify-content-center align-items-center">
            <?php
            
            include("include/connection.php");

            $sql = "SELECT * FROM airlines";

        
            $result = $conn->query($sql);

        
            if ($result->num_rows > 0) {
              
                while($row = $result->fetch_assoc()) {
                    echo "<img src='admin" . $row["logo"] . "' alt='" . $row["airline_name"] . " Logo' style='max-width: 120px; margin: 10px;'>";
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
