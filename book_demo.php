<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Demo Form</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  
<?php
include("./include/navbar.php");
?>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h2 class="text-center mb-4">Book Demo</h2>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
          <label for="product_id">Product ID</label>
          <input type="text" class="form-control" id="product_id" name="product_id" required>
        </div>
        <div class="form-group">
    <label for="demo_date">Demo Date</label>
    <input type="date" class="form-control" id="demo_date" name="demo_date" required>
</div>

        <button type="submit" class="btn btn-success btn-block" name="submit">Submit</button>
      </form>
    </div>
  </div>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include("./include/connection.php");
  // Retrieving data from the form
  $product_id = $_POST['product_id'];
  $demo_date = $_POST['demo_date'];

  // SQL query to insert data into the book_demo table
  $sql = "INSERT INTO book_demo (user_id, product_id, Application_date, Demo_date, status)
          VALUES (9, $product_id, NOW(), '$demo_date', 'Pending')";

  if ($conn->query($sql) === TRUE) {
    echo '<div class="container mt-3"><div class="alert alert-success" role="alert">
    New record created successfully</div></div>';
  } else {
    echo '<div class="container mt-3"><div class="alert alert-danger" role="alert">
    Error: ' . $sql . "<br>" . $conn->error . '</div></div>';
  }

  $conn->close();
}
?>
</body>
</html>
