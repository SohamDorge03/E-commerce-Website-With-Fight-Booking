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
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Booking ID</th>
            <th>Flight Code</th>
            <th>User Name</th>
            <th>User Email</th>
            <th>User Username</th>
            <th>Source</th>
            <th>Departure Time</th>
            <th>Destination</th>
            <th>Arrival Time</th>
            <th>Airline</th>
            <th>Class</th>
            <th>Seats</th>
            <th>Payment Status</th>
            <th>Booking Status</th>
            <th>Booking Date</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Include your database connection file
          include "./include/connection.php";

          // Fetch data from database and populate the table
          $query = "SELECT * FROM booked_flights"; // Change to your actual table name
          $result = mysqli_query($conn, $query);

          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<td>" . $row['booking_id'] . "</td>";
              echo "<td>" . $row['flight_code'] . "</td>";
              echo "<td>" . $row['user_name'] . "</td>";
              echo "<td>" . $row['user_email'] . "</td>";
              echo "<td>" . $row['user_username'] . "</td>";
              echo "<td>" . $row['source'] . "</td>";
              echo "<td>" . $row['departure_time'] . "</td>";
              echo "<td>" . $row['destination'] . "</td>";
              echo "<td>" . $row['arrival_time'] . "</td>";
              echo "<td>" . $row['airline'] . "</td>";
              echo "<td>" . $row['class'] . "</td>";
              echo "<td>" . $row['seats'] . "</td>";
              echo "<td>" . $row['payment_status'] . "</td>";
              echo "<td>" . $row['booking_status'] . "</td>";
              echo "<td>" . $row['booking_date'] . "</td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='15'>No data available</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Bootstrap JS and jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

