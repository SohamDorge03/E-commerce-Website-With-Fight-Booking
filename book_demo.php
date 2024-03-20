<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("./include/connection.php");
    // Retrieving data from the form
    $product_id = $_POST['product_id'];
    $demo_date = $_POST['demo_date'];

    // Check if the product belongs to the current user
    $sql_check_order = "SELECT oi.user_id 
                        FROM order_items oi
                        INNER JOIN orders o ON oi.order_id = o.order_id
                        WHERE oi.product_id = $product_id 
                        AND o.user_id = $user_id"; // Assuming you have a user_id in the orders table
    $result_check_order = $conn->query($sql_check_order);

    if ($result_check_order->num_rows > 0) {
        $row = $result_check_order->fetch_assoc();
        $user_id = $row['user_id'];
        
        // Product belongs to the user, proceed with inserting into book_demo table
        // SQL query to insert data into the book_demo table
        $sql = "INSERT INTO book_demo (user_id, product_id, Application_date, Demo_date, status)
                VALUES ($user_id, $product_id, NOW(), '$demo_date', 'Pending')";

        if ($conn->query($sql) === TRUE) {
            echo '<div class="container mt-3"><div class="alert alert-success" role="alert">
            New record created successfully</div></div>';
        } else {
            echo '<div class="container mt-3"><div class="alert alert-danger" role="alert">
            Error: ' . $sql . "<br>" . $conn->error . '</div></div>';
        }
    } else {
        // Product does not belong to the user
        echo '<div class="container mt-3"><div class="alert alert-danger" role="alert">
        This product does not belong to you.</div></div>';
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Demo Form</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .col-md-6 {
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Shadow effect */
      padding: 30px;
      margin-bottom: 40px; /* Optional: Add padding for better spacing */
    }
  </style>
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
          <button type="button" class="btn btn-primary mt-2" id="fetchProductBtn">Fetch Product</button>
          <div id="productNameContainer" class="mt-2" style="display: none;">
            <label for="product_name">Product Name</label>
            <input type="text" class="form-control" id="product_name" name="product_name" readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="demo_date">Demo Date</label>
          <input type="date" class="form-control" id="demo_date" name="demo_date" required>
        </div>
        <button type="submit" class="btn btn-success btn-block" name="submit" style="margin-bottom: 10px; margin-top:30px;">Submit</button>
      </form>
    </div>
  </div>
</div>
</body>
</html>


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
  $('#fetchProductBtn').click(function(){
    var productId = $('#product_id').val();
    $.ajax({
      url: 'fetch_product.php', // Assuming you have a PHP script to fetch product details
      method: 'POST',
      data: {product_id: productId},
      dataType: 'json',
      success: function(response) {
        if(response.success) {
          $('#product_name').val(response.product_name);
          $('#productNameContainer').show();
        } else {
          alert(response.message);
          $('#productNameContainer').hide();
        }
      },
      error: function(xhr, status, error) {
        console.error(error);
        alert('Error fetching product details. Please try again.');
        $('#productNameContainer').hide();
      }
    });
  });
});
</script>

</body>
</html>
