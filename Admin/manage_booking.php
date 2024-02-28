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
          <!-- Data will be dynamically populated here -->
        </tbody>
      </table>
    </div>
  </div>

  <!-- Bootstrap JS and jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- JavaScript to fetch and populate data -->
  <script>
    $(document).ready(function() {
      $.ajax({
        url: 'fetch_data.php', // Change to the URL of your backend script to fetch data
        type: 'GET',
        dataType: 'json',
        success: function(data) {
          if (data && data.length > 0) {
            var rows = '';
            $.each(data, function(index, item) {
              rows += '<tr>';
              rows += '<td>' + item.booking_id + '</td>';
              rows += '<td>' + item.flight_code + '</td>';
              rows += '<td>' + item.dep_airport + ' (' + item.source_date + ' ' + item.source_time + ')' + '</td>';
              rows += '<td>' + item.dest_airport + ' (' + item.dest_date + ' ' + item.dest_time + ')' + '</td>';
              rows += '<td>' + item.airline_name + '</td>';
              rows += '<td>' + item.flight_class + '</td>';
              rows += '<td>' + item.take_seats + '</td>';
              rows += '<td>' + item.payment_status + '</td>';
              rows += '<td>' + item.book_status + '</td>';
              rows += '<td>' + item.booking_date + '</td>';
              rows += '<td>' + item.user_name + '</td>';
              rows += '<td>' + item.user_email + '</td>';
              rows += '<td>' + item.user_username + '</td>';
              rows += '</tr>';
            });
            $('tbody').html(rows);
          } else {
            $('tbody').html('<tr><td colspan="15">No data available</td></tr>');
          }
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
        }
      });
    });
  </script>
</body>
</html>
