<?php
include("./connection.php");

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $flight_id = $_GET['id'];

    $sql = "SELECT * FROM flights WHERE flight_id = $flight_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        include("./navbar.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Flight</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1>Update Flight</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="hidden" name="flight_id" value="<?php echo $row['flight_id']; ?>">
            <div class="form-group">
                <label for="flight_code">Flight Code:</label>
                <input type="text" class="form-control" id="flight_code" name="flight_code" value="<?php echo $row['flight_code']; ?>" required>
            </div>
            <div class="form-group">
                <label for="source_date">Source Date:</label>
                <input type="date" class="form-control" id="source_date" name="source_date" value="<?php echo $row['source_date']; ?>">
            </div>
            <div class="form-group">
                <label for="source_time">Source Time:</label>
                <input type="time" class="form-control" id="source_time" name="source_time" value="<?php echo $row['source_time']; ?>">
            </div>
            <div class="form-group">
                <label for="dest_date">Destination Date:</label>
                <input type="date" class="form-control" id="dest_date" name="dest_date" value="<?php echo $row['dest_date']; ?>">
            </div>
            <div class="form-group">
                <label for="dest_time">Destination Time:</label>
                <input type="time" class="form-control" id="dest_time" name="dest_time" value="<?php echo $row['dest_time']; ?>">
            </div>
            <div class="form-group">
                <label for="dep_airport_id">Departure Airport ID:</label>
                <input type="number" class="form-control" id="dep_airport_id" name="dep_airport_id" value="<?php echo $row['dep_airport_id']; ?>">
            </div>
            <div class="form-group">
                <label for="arr_airport_id">Arrival Airport ID:</label>
                <input type="number" class="form-control" id="arr_airport_id" name="arr_airport_id" value="<?php echo $row['arr_airport_id']; ?>">
            </div>
            <div class="form-group">
                <label for="seats">Number of Seats:</label>
                <input type="number" class="form-control" id="seats" name="seats" value="<?php echo $row['seats']; ?>">
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
                <input type="text" class="form-control" id="price" name="price" value="<?php echo $row['price']; ?>">
            </div>
            <div class="form-group">
                <label for="airline_id">Airline ID:</label>
                <input type="text" class="form-control" id="airline_id" name="airline_id" value="<?php echo $row['airline_id']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update Flight</button>
        </form>
    </div>
</body>

</html>

<?php
    } else {
        echo "Flight not found";
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $flight_id = $_POST['flight_id'];
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
    $airline_id = $_POST["airline_id"];

    $sql_update = "UPDATE flights SET 
                    flight_code = '$flight_code', 
                    source_date = '$source_date', 
                    source_time = '$source_time', 
                    dest_date = '$dest_date', 
                    dest_time = '$dest_time', 
                    dep_airport_id = '$dep_airport_id', 
                    arr_airport_id = '$arr_airport_id', 
                    seats = '$seats', 
                    flight_class = '$flight_class', 
                    price = '$price', 
                    airline_id = '$airline_id' 
                    WHERE flight_id = $flight_id";

    if ($conn->query($sql_update) === TRUE) {
        echo "<script>alert('Flight updated successfully');</script>";
      
        echo "<script>window.location.href = 'Flights.php';</script>";
    }   
}

?>
