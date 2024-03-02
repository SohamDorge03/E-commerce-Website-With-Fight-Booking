<?php
include("./include/navbar.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booked Flights</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <h2>Booked Flights</h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Booking ID</th>
        <th>Flight Code</th>
        <th>Source Date</th>
        <th>Source Time</th>
        <th>Destination Date</th>
        <th>Destination Time</th>
        <th>Departure Airport</th>
        <th>Arrival Airport</th>
        <th>Airline</th>
        <th>Username</th>
        <th>Email</th>
        <th>User's Full Name</th>
        <th>Seats</th>
        <th>Flight Class</th>
        <th>Booking Date</th>
      
        <th>Booking Status</th>
      </tr>
    </thead>
    <tbody>
      <?php
      include("./include/connection.php");
      // SQL query
      $sql = "SELECT
                bf.booking_id,
                bf.take_seats,
                bf.flight_class,
                bf.book_status,
                bf.booking_date,
                f.flight_code,
                f.source_date,
                f.source_time,
                f.dest_date,
                f.dest_time,
                dep.airport_name AS dep_airport,
                arr.airport_name AS arr_airport,
                a.airline_name,
                u.username AS user_username,
                u.email AS user_email,
                CONCAT(u.first_name, ' ', u.last_name) AS user_name
              FROM
                booked_flights bf
              JOIN flights f ON bf.flight_id = f.flight_id
              JOIN airports dep ON f.dep_airport_id = dep.airport_id
              JOIN airports arr ON f.arr_airport_id = arr.airport_id
              JOIN airline_users u ON bf.user_id = u.user_id
              JOIN airlines a ON f.airline_id = a.airline_id";

      $result = $conn->query($sql);

      if ($result === false) {
        // Query failed, display error message
        echo "Error: " . $conn->error;
      } else {
        // Check if any rows were returned
        if ($result->num_rows > 0) {
          // Output data of each row
          while($row = $result->fetch_assoc()) {
            // Output row data
            echo "<tr>";
            echo "<td>".$row["booking_id"]."</td>";
            echo "<td>".$row["flight_code"]."</td>";
            echo "<td>".$row["source_date"]."</td>";
            echo "<td>".$row["source_time"]."</td>";
            echo "<td>".$row["dest_date"]."</td>";
            echo "<td>".$row["dest_time"]."</td>";
            echo "<td>".$row["dep_airport"]."</td>";
            echo "<td>".$row["arr_airport"]."</td>";
            echo "<td>".$row["airline_name"]."</td>";
            echo "<td>".$row["user_username"]."</td>";
            echo "<td>".$row["user_email"]."</td>";
            echo "<td>".$row["user_name"]."</td>";
            echo "<td>".$row["take_seats"]."</td>";
            echo "<td>".$row["flight_class"]."</td>";
            echo "<td>".$row["booking_date"]."</td>";
       
            echo "<td>".$row["book_status"]."</td>";
            echo "</tr>";
          }
        } else {
          // No rows returned
          echo "0 results";
        }
      }
      // Close connection
      $conn->close();
      ?>
    </tbody>
  </table>
</div>

</body>
</html>
