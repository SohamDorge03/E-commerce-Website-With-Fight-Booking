<?php
// Include database connection and session handling files
require("./config.php");
include("include/connection.php");
include("include/navbar.php");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page or display an error message
    echo "Please log in to view your cart.";
    exit; // Stop further execution
}

// Initialize total price
$total_price = 0;

// Fetch cart items for the current user
$user_id = $_SESSION['user_id'];
$sql = "SELECT c.*, p.name, p.price, p.img1 FROM cart c INNER JOIN products p ON c.product_id = p.product_id WHERE c.user_id = '$user_id'";
$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    echo "Error: " . $conn->error;
    exit; // Stop execution if there's an error
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Cart</h2>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $total_price += $row['price'] * $row['quantity'];
        ?>
                <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="vendor/<?php echo $row['img1']; ?>" class="card-img" alt="<?php echo $row['name']; ?>">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['name']; ?></h5>
                                <p class="card-text">Price: $<?php echo $row['price']; ?></p>
                                <p class="card-text">Quantity: <?php echo $row['quantity']; ?></p>
                                <p class="card-text">Total: $<?php echo $row['price'] * $row['quantity']; ?></p>
                                <button class="btn btn-danger remove-btn" data-product-id="<?php echo $row['product_id']; ?>">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo '<p>Your cart is empty.</p>';
        }
        ?>
        <div class="mt-3">
            <h5>Total Price: Rs. <?php echo $total_price; ?></h5>
            <button class="btn btn-primary" id="view-cart">View Cart Product Count</button>
        </div>
    </div>
    <!-- Bootstrap JS (optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Remove product from cart
            $(".remove-btn").click(function() {
                var productId = $(this).data("product-id");
                $.post("remove_from_cart.php", { product_id: productId }, function(data) {
                    location.reload(); // Reload the page to reflect changes
                });
            });

            // Show total cart product count
            $("#view-cart").click(function() {
                alert("<?php echo $result->num_rows; ?> products in the cart.");
            });
        });
    </script>
</body>
</html>
