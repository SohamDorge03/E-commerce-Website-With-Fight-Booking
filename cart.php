<?php
require("./config.php");
include("include/connection.php");
include("include/navbar.php");

$_SESSION['user_id'] =9;
// Initialize total price
$total_price = 0;

// Fetch cart items for the current user
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT c.*, p.name, p.price, p.img1 FROM cart c INNER JOIN products p ON c.product_id = p.product_id WHERE c.user_id = '$user_id'";
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result === false) {
        echo "Error: " . $conn->error;
        exit; // Stop execution if there's an error
    }
?>
       
  <script src="https://kit.fontawesome.com/dad03e859c.js" crossorigin="anonymous"></script>
      <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alkatra&family=Berkshire+Swash&family=Comic+Neue:wght@700&family=Gentium+Book+Plus:wght@400;700&family=Lato:ital,wght@0,400;0,700;0,900;1,700&family=Lexend+Deca:wght@500&family=Lexend:wght@500&family=Montserrat:wght@500&family=Open+Sans:wght@500;800&family=Roboto:wght@100;400&family=Sue+Ellen+Francisco&family=Work+Sans:wght@400;700;900&display=swap" rel="stylesheet"> 
      <link href="https://fonts.googleapis.com/css2?family=Spartan:wght@100;200;300;400;500;600;700;800;900;&display:swap">
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

         <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

 
                    <h2 class="m-5 p-4">Cart</h2>
             
<div class="container mt-5 w-100" >
    <div class="row"  >
        <div class="col-md-8" >
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
                    <form action="payment.php" method="post">
                        <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                data-key="<?php echo $Publishablekey; ?>"
                                data-amount="<?php echo $total_price * 100; ?>"
                                data-name="Shopflix"
                                data-description="Shopflix"
                                data-image="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQiUuPgu-yLEY2NbaZa7MdSibC9nDZQZ8AjEGH022Vpvw&s"
                                data-currency="USD"
                                data-email="shopfilx420@gmail.com">
                        </script>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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