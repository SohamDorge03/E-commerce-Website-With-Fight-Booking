<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Flight Search</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <h1>Flight Search</h1>
    <form action="search.php" method="GET">
      <div class="form-group">
        <label for="from_city">From City</label>
        <input type="text" class="form-control" id="from_city" name="from_city" placeholder="Enter From City">
      </div>
      <div class="form-group">
        <label for="to_city">To City</label>
        <input type="text" class="form-control" id="to_city" name="to_city" placeholder="Enter To City">
      </div>
      <div class="form-group">
        <label for="departure_date">Departure Date</label>
        <input type="date" class="form-control" id="departure_date" name="departure_date">
      </div>
      <div class="form-group">
        <label for="flight_class">Flight Class</label>
        <select class="form-control" id="flight_class" name="flight_class">
          <option>Economy</option>
          <option>Business</option>
          <option>First Class</option>
        </select>
      </div>
      <div class="form-group">
        <label for="seats">Number of Seats</label>
        <input type="number" class="form-control" id="seats" name="seats" min="1" value="1">
      </div>
      <button type="submit" class="btn btn-primary">Search Flights</button>
    </form>
  </div>
</body>
</html>
