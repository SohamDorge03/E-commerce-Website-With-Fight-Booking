<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Products</h1>
        <div class="row">
            <?php
            include("./include/connection.php");
            
            // Fetch products from the database for a specific category (assuming category_id is known)
            $category_id = 7; // Change this to the desired category ID
            $sql = "SELECT * FROM products WHERE category_id = $category_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <img src="<?php echo $row['img1']; ?>" class="card-img-top" alt="Product Image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['name']; ?></h5>
                                <p class="card-text"><?php echo $row['description']; ?></p>
                                <p class="card-text">Price: $<?php echo $row['price']; ?></p>
                                <p class="card-text">Stock: <?php echo $row['stock_quantity']; ?></p>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-secondary" onclick="decreaseQuantity(<?php echo $row['product_id']; ?>)">-</button>
                                    <input type="text" id="quantity_<?php echo $row['product_id']; ?>" value="1" class="form-control text-center">
                                    <button class="btn btn-sm btn-outline-secondary" onclick="increaseQuantity(<?php echo $row['product_id']; ?>)">+</button>
                                    <button class="btn btn-sm btn-primary" onclick="addToCart(<?php echo $row['product_id']; ?>)">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "No products found in this category.";
            }
            $conn->close();
            ?>
        </div>
    </div>

    <script>
        function increaseQuantity(productId) {
            var input = document.getElementById('quantity_' + productId);
            input.value++;
        }

        function decreaseQuantity(productId) {
            var input = document.getElementById('quantity_' + productId);
            if (input.value > 1) {
                input.value--;
            }
        }

        function addToCart(productId) {
            var quantity = document.getElementById('quantity_' + productId).value;
            // Here you can implement functionality to add the product to the cart,
            // such as sending an AJAX request to the server or storing it in local storage.
            console.log("Adding product " + productId + " to cart with quantity " + quantity);
        }
    </script>
</body>
</html>
