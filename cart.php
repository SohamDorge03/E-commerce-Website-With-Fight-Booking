    <?php
    require("./config.php");
    include("include/connection.php");
    include("include/navbar.php");


    $total_price = 0;

    if (!isset($_SESSION['u'])) {
        echo '<div class="container mt-5">';
        echo '<div class="row">';
        echo '<div class="col-md-8">';
        echo '<div class="alert alert-warning" role="alert">';
        echo 'Please log in to view your cart.';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        exit(); 
    }

    $user_id = $_SESSION['u'];
    $sql = "SELECT c.*, p.name, p.price, p.img1 FROM cart c INNER JOIN products p ON c.product_id = p.product_id WHERE c.user_id = '$user_id'";
    $result = $conn->query($sql);

    if ($result === false) {
        echo "Error: " . $conn->error;
        exit; 
    }

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Shopflix Cart</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
        <div class="container mt-5" style="margin-bottom:80px;">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="">Cart</h2>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-lg table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            // Truncate product name if it exceeds 20 characters
                                            $productName = $row['name'];
                                            if (strlen($productName) > 20) {
                                                $productName = substr($productName, 0, 20) . '...';
                                            }
                                            $total_price += $row['price'] * $row['quantity'];
                                    ?>
                                            <tr>
                                                <td>
                                                    <img src="vendor/<?php echo $row['img1']; ?>" alt="<?php echo $row['name']; ?>" height="50">
                                                    <?php echo $productName; ?>
                                                </td>
                                                <td><?php echo $row['price']; ?></td>
                                                <td>
                                                    <form action="" method="post" class="form-inline">
                                                        <input type="hidden" name="action" value="update">
                                                        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                                        
                                                        <button type="submit" class="btn btn-lg" name="update" value="plus">+</button>
                                                        <span class="mx-2"><?php echo $row['quantity']; ?></span>
                                                        
                                                        <button type="submit" class="btn btn-lg" name="update" value="minus">-</button>
                                                    </form>
                                                </td>

                                                <td><?php echo $row['price'] * $row['quantity']; ?></td>
                                                <td>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="action" value="remove">
                                                        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                                    </form>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo '<tr><td colspan="5">Your cart is empty.</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mt-5">
                        <div class="card-body">
                            <h5 class="card-title">Total Price: Rs. <?php echo $total_price; ?></h5>
                            <form action="submit.php" method="post">
                                <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="<?php echo $Publishablekey; ?>" data-amount="<?php echo $total_price * 100; ?>" data-name="Shopflix" data-description="Shopflix" data-image="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQiUuPgu-yLEY2NbaZa7MdSibC9nDZQZ8AjEGH022Vpvw&s" data-currency="INR" data-email="shopfilx420@gmail.com">
                                </script>
                                <input type="hidden" name="total_amount" value="<?php echo $total_price; ?>">
                                <input type="hidden" name="stripeToken" value="<?php echo $_SESSION['u'] . random_int(1000, 2000); ?> ">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>

    <?php
    if (isset($_POST['action']) && $_POST['action'] === 'remove' && isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];

        $remove_sql = "DELETE FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
        $remove_result = $conn->query($remove_sql);

        if ($remove_result === true) {
            echo "<script> window.location.href = './cart'; </script>";
        } else {
            echo "Error removing item from cart: " . $conn->error;
        }
    }

    if (isset($_POST['action']) && $_POST['action'] === 'update' && isset($_POST['product_id']) && isset($_POST['update'])) {
        $product_id = $_POST['product_id'];
        $update = $_POST['update'];

        // Fetch current quantity
        $fetch_sql = "SELECT quantity FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
        $fetch_result = $conn->query($fetch_sql);

        if ($fetch_result->num_rows == 1) {
            $row = $fetch_result->fetch_assoc();
            $current_quantity = $row['quantity'];

            if ($update === 'plus') {
                $new_quantity = $current_quantity + 1;
            } elseif (
                $update === 'minus'
                && $current_quantity > 1
            ) {
                $new_quantity = $current_quantity - 1;
            } else {
            
                $new_quantity = $current_quantity;
            }

            $update_sql = "UPDATE cart SET quantity = '$new_quantity' WHERE user_id = '$user_id' AND product_id = '$product_id'";
            $update_result = $conn->query($update_sql);

            if ($update_result === true) {
                echo "<script> window.location.href = './cart'; </script>";
            } else {
                echo "Error updating item quantity: " . $conn->error;
            }
        } else {
            echo "Error: Product not found in cart.";
        }   
    }
    ?>
    <?php
    include("./include/footer.php");
    ?>
