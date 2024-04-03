<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Demo Form</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .close-btn {
            cursor: pointer;
        }
    </style>
</head>

<body>

    <?php
    include("./include/navbar.php");
    ?>

    <?php

    if (isset($_SESSION['u'])) {


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include("./include/connection.php");

            $product_id = $_POST['product_id'];
            $demo_date = $_POST['demo_date'];
            $userid = $_SESSION['u'];

            $sql_electronic = "SELECT p.product_id
                     FROM products p
                     INNER JOIN categories c ON p.category_id = c.category_id
                     WHERE p.product_id = $product_id AND c.name = 'Electronics'";
            $result_electronic = $conn->query($sql_electronic);

            if ($result_electronic->num_rows > 0) {
                $sql = "INSERT INTO book_demo (user_id, product_id, Application_date, Demo_date, status)
              VALUES ($userid, $product_id, NOW(), '$demo_date', 'Pending')";

                if ($conn->query($sql) === TRUE) {
                    echo '<div class="container mt-3"><div class="alert alert-success alert-dismissible" role="alert">
         Your demo request send successfully. Vendor will decide the demo date and send you a message on email.
          <button type="button" class="close close-btn" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div></div>';
                } else {
                    echo '<div class="container mt-3"><div class="alert alert-danger alert-dismissible" role="alert">
          Error: ' . $sql . "<br>" . $conn->error . '
          <button type="button" class="close close-btn" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div></div>';
                }
            } else {
                echo '<div class="container mt-3"><div class="alert alert-danger alert-dismissible" role="alert">
      Only electronic products are accepted for demo booking.
      <button type="button" class="close close-btn" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div></div>';
            }

            $conn->close();
        }
        ?>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Book Demo</h2>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="form-group">
                                <label for="product_id">Product</label>
                                <select class="form-control" id="product_id" name="product_id" required>
                                    <option value="">Select a product</option>
                                    <?php
                                    include("./include/connection.php");

                                    $sql_products = "SELECT oi.order_item_id, oi.product_id, p.name
                             FROM order_items oi
                             INNER JOIN products p ON oi.product_id = p.product_id
                             INNER JOIN categories c ON p.category_id = c.category_id
                             WHERE c.name = 'Electronics'";
                                    $result_products = $conn->query($sql_products);

                                    if ($result_products->num_rows > 0) {
                                        while ($row_product = $result_products->fetch_assoc()) {
                                            echo '<option value="' . $row_product['product_id'] . '">' . $row_product['order_item_id'] . ' - ' . $row_product['name'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="demo_date">Demo Date</label>
                                <input type="date" class="form-control" id="demo_date" name="demo_date" required min="<?php echo date('Y-m-d'); ?>">
                            </div>

                            <?php
                            $userid = $_SESSION['u'];
                            $sql_user = "SELECT * FROM users WHERE user_id = $userid";
                            $result_user = $conn->query($sql_user);

                            if ($result_user->num_rows > 0) {
                                $user = $result_user->fetch_assoc();
                            ?>
                                <div class="row form-group pl-2 pr-2">
                                    <div class="form-group" style="margin-left: 8px; width: 265px;">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $user['first_name']; ?>" disabled>
                                    </div>
                                    <div class="form-group" style="margin-left: 8px; width: 265px;">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $user['last_name']; ?>" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="<?php echo $user['address']; ?>" disabled>
                                </div>

                            <?php
                            }

                            ?>

                            <button type="submit" class="btn btn-success btn-block" name="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php
    } else {

        echo "<a class='btn m-3'> login to access";
    }
        ?>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function() {

                $(".close-btn").click(function() {
                    $(this).parent().parent().remove();
                });
            });
        </script>
</body>

</html>
