<?php
require("./config.php");
include("include/connection.php");
include("include/navbar.php");

// Initialize total price
$total_price = 0;

// Fetch cart items for the current user
if (isset($_SESSION['u'])) {
    $user_id = $_SESSION['u'];
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
    <title>Shopflix Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="m-5 p-4">Cart</h2>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Calculate total price and display individual cart items
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $total_price += $row['price'] * $row['quantity'];
                                ?>
                                        <tr>
                                            <td>
                                                <img src="vendor/<?php echo $row['img1']; ?>" alt="<?php echo $row['name']; ?>" height="50">
                                                <?php echo $row['name']; ?>
                                            </td>
                                            <td>$<?php echo $row['price']; ?></td>
                                            <td><?php echo $row['quantity']; ?></td>
                                            <td>$<?php echo $row['price'] * $row['quantity']; ?></td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo '<tr><td colspan="4">Your cart is empty.</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Price: Rs. <?php echo $total_price; ?></h5>
                        <form action="submit.php" method="post">
                            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                    data-key="<?php echo $Publishablekey; ?>"
                                    data-amount="<?php echo $total_price * 100; ?>"
                                    data-name="Shopflix"
                                    data-description="Shopflix"
                                    data-image="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQiUuPgu-yLEY2NbaZa7MdSibC9nDZQZ8AjEGH022Vpvw&s"
                                    data-currency="INR"
                                    data-email="shopfilx420@gmail.com">
                            </script>
                            <input type="hidden" name="total_amount" value="<?php echo $total_price; ?>">
                            <input type="hidden" name="stripeToken" value="<?php echo $_SESSION['u'] . random_int(1000,2000); ?> ">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
} else {
    echo '<div class="container mt-5">';
    echo '<div class="row">';
    echo '<div class="col-md-8">';
    echo '<div class="alert alert-warning" role="alert">';
    echo 'Please log in to view your cart.';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    // echo '</div>';
}
?>