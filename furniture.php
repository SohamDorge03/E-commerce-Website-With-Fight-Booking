<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            transition: all 0.3s;
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
            height: 100%;
        }
        .card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .btn-group {
            margin-top: auto;
        }
        .card-body {
            display: flex;
            flex-direction: column;
        }
        .card-text {
            flex-grow: 1;
        }
        .modal-body img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Products</h1>
        <div class="row">
            <!-- PHP code to fetch products from database -->
            <?php
            include("./include/connection.php");
            $category_id = 2; // Change this to the desired category ID
            $sql = "SELECT * FROM products WHERE category_id = $category_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <!-- Product image with data-toggle and data-target attributes -->
                            <img src="./Vendor/<?php echo $row['img1']; ?>" class="card-img-top" alt="Product Image" data-toggle="modal" data-target="#productModal_<?php echo $row['product_id']; ?>">
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

                    <!-- Modal structure for each product -->
                    <div class="modal fade" id="productModal_<?php echo $row['product_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="productModalLabel_<?php echo $row['product_id']; ?>" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="productModalLabel_<?php echo $row['product_id']; ?>"><?php echo $row['name']; ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Product images -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img src="./Vendor/<?php echo $row['img1']; ?>" class="img-fluid" alt="Product Image">
                                        </div>
                                        <div class="col-md-6">
                                            <img src="./Vendor/<?php echo $row['img2']; ?>" class="img-fluid" alt="Product Image">
                                        </div>
                                    </div>
                                    <!-- Product details -->
                                    <p><?php echo $row['description']; ?></p>
                                    <p>Price: $<?php echo $row['price']; ?></p>
                                    <p>Stock: <?php echo $row['stock_quantity']; ?></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="addToCart(<?php echo $row['product_id']; ?>)">Add to Cart</button>
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
            console.log("Adding product " + productId + " to cart with quantity " + quantity);
        }
    </script>
</body>
</html>
