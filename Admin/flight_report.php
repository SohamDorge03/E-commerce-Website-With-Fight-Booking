
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booked Flights Report</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .container{
        margin-top: 70px;
        margin-left: 26px;
    }
    .new-line-option {
      display: block;
    }

    input[type="date"],
    input[type="text"],
    select {
      width: 100%;
    }
  </style>
</head>
<body>
<?php
include("./include/navbar.php");
?>
<div class="container mt-5">
  <h2>Booked Flights Report</h2>
  <form method="post">
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="start_date">From Date:</label>
        <input type="date" class="form-control" id="start_date" name="start_date" required>
      </div>
      <div class="form-group col-md-6">
        <label for="end_date">To Date:</label>
        <input type="date" class="form-control" id="end_date" name="end_date" required>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="flight_class">Flight Class:</label>
        <select class="form-control" id="flight_class" name="flight_class">
          <option value=""></option>
          <option value="economy">Economy</option>
          <option value="business">Business</option>
          <option value="" class="new-line-option">All</option>
        </select>
      </div>
      <div class="form-group col-md-4">
        <label for="payment_status">Payment Status:</label>
        <select class="form-control" id="payment_status" name="payment_status">
          <option value=""></option>
          <option value="0">Pending</option>
          <option value="1">Completed</option>
          <option value="" class="new-line-option">All</option>
        </select>
      </div>
      <div class="form-group col-md-4">
        <label for="book_status">Booking Status:</label>
        <select class="form-control" id="book_status" name="book_status">
          <option value=""></option>
          <option value="0">Pending</option>
          <option value="1">Confirmed</option>
          <option value="2">Cancelled</option>
          <option value="" class="new-line-option">All</option>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-5">
        <button type="submit" class="btn btn-primary btn-block">Generate Report</button>
      </div>
      <div class="col-md-5">
        <a href="flight_generate_pdf.php?from_date=<?php echo $_GET['from_date'] ?? ''; ?>&to_date=<?php echo $_GET['to_date'] ?? ''; ?>&status=<?php echo $_GET['status'] ?? ''; ?>" class="btn btn-success btn-block">Generate PDF</a>
      </div>
    </div>
  </form>
<?php
  include("./include/connection.php");

  // Fetch data based on submitted filters
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $flight_class = $_POST['flight_class'];
    $payment_status = $_POST['payment_status'];
    $book_status = $_POST['book_status'];

    // Construct the SQL query based on selected filters
    $sql = "SELECT * FROM booked_flights WHERE booked_date BETWEEN '$start_date 00:00:00' AND '$end_date 23:59:59'";
    if (!empty($flight_class)) {
      $sql .= " AND flight_class = '$flight_class'";
    }
    if (!empty($payment_status)) {
      $sql .= " AND payment_status = '$payment_status'";
    }
    if (!empty($book_status)) {
      $sql .= " AND book_status = '$book_status'";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      echo '<table class="table table-striped">';
      echo '<thead><tr><th>Booking ID</th><th>Flight ID</th><th>User ID</th><th>Take Seats</th><th>Flight Class</th><th>Transaction ID</th><th>Total Amount</th><th>Book Status</th><th>Payment Status</th><th>Booked Date</th></tr></thead>';
      echo '<tbody>';
      while($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['booking_id'] . '</td>';
        echo '<td>' . $row['flight_id'] . '</td>';
        echo '<td>' . $row['user_id'] . '</td>';
        echo '<td>' . $row['take_seats'] . '</td>';
        echo '<td>' . $row['flight_class'] . '</td>';
        echo '<td>' . $row['TransactionID'] . '</td>';
        echo '<td>' . $row['total_amount'] . '</td>';
        echo '<td>' . $row['book_status'] . '</td>';
        echo '<td>' . $row['payment_status'] . '</td>';
        echo '<td>' . $row['booked_date'] . '</td>';
        echo '</tr>';
      }
      echo '</tbody></table>';
    } else {
      echo '<div class="alert alert-warning">No booked flights found for the selected filters.</div>';
    }
  }

  $conn->close();
?>
</div>

</body>
</html>
