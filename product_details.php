<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    <style>
        .name {
            color: #007eff;
        }

        .container22 {
            padding: 50px 60px;
        }

        .product-details {
            display: flex;
            flex-wrap: wrap;
        }

        .product-images {
            margin-right: 100px;
            max-width: 600px;
            display: flex;
            flex-wrap: wrap;
        }

        .sec {
            padding-top: 60px;
            padding: 30px;
        }

        .product-images img {
            width: 300px;
            height: 300px;
            object-fit: cover;
            padding: 40px;

        }

        .product-info {
            flex: 1;
        }

        .add-to-cart-form {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }

        .add-to-cart-form select {
            height: 30px;
            width: 70px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }

        .add-to-cart-form button {
            height: 30px;
            width: 130px;
            background-color: #0062cc;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>


    <?php
    include("include/connection.php");
    include("include/navbar.php");

    echo '<div class="container22">';
    if (isset($_GET['productId'])) {
    ?>
        <div class="alert alert-dismissible fade show d-none" role="alert" style="
   
   z-index: 3;">
            <strong>Success!</strong> Product added to cart.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php
        $productId = intval($_GET['productId']);

        $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();

            echo '<div class="product-details">';

            echo '<div class="product-images">';
            $imageKeys = array('img1', 'img2', 'img3', 'img4');
            foreach ($imageKeys as $imgKey) {
                if (!empty($product[$imgKey])) {
                    echo '<img src="vendor/' . $product[$imgKey] . '" alt="' . $product['name'] . '">';
                }
            }
            echo '</div>';


            echo '<div class="product-info">';
            echo '<h2 class="name">' . $product['name'] . '</h2>';
            echo '<p><strong>Description:</strong> ' . $product['description'] . '</p>';
            echo '<p><strong>Price:</strong> $' . $product['price'] . '</p>';
            echo '<p><strong>Stock Quantity:</strong> ' . $product['stock_quantity'] . '</p>';
            $_SESSION['subcategory_id'] = $product['subcategory_id'];



            if (isset($_SESSION['u'])) {

                echo '<form class="add-to-cart-form" method="post">';
                echo '<input type="hidden" name="product_id" value="' . $product['product_id'] . '">';
                echo '<select name="quantity_' . $product['product_id'] . '">';

                for ($i = 1; $i <= $product['stock_quantity']; $i++) {
                    echo "<option value='$i'>$i</option>";
                }
                echo '</select>';

                echo '<button type="button" onclick="addToCart(' . $product['product_id'] . ')">Add to Cart</button>';



                echo '</form>';
            } else {
                echo '<a style="color: white;" type="button" class="btn bg-primary" href="login.php"  >login for add to cart</a>';
            }

            echo '</div>'; 
            echo '</div>'; 

        } else {
        
            echo '<p>Product not found.</p>';
        }
    } else {
      
        echo '<p>Product ID not provided.</p>';
    }
    ?>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function addToCart(productId) {
            var quantity = $('select[name="quantity_' + productId + '"]').val();
            var addButton = $('button[data-product-id="' + productId + '"]');

            
            var scrollPosition = $(window).scrollTop();

            
            addButton.prop('disabled', true);

            $.ajax({
                type: "POST",
                url: "add_to_cart.php",
                data: {
                    product_id: productId,
                    quantity: quantity
                },
                success: function(response) {
                   
                    $('.main-content').load(window.location.href + ' .main-content > *');

                    $(window).scrollTop(scrollPosition);

                 
                    $('.alert').html('<strong>Success!</strong> Product added to cart.').addClass('alert-success').removeClass('d-none');
                },

                error: function(xhr, status, error) {
                
                    addButton.prop('disabled', false);

                    console.error(xhr.responseText); 
                    alert('An error occurred while adding the product to the cart. Please try again.');
                }
            });
        }
    </script>












    <div class="main-content">
        <h2 class="sec">Similar Products
        </h2>
        <?php

        // Display products
        function displayProducts($sql)
        {
            global $conn;
            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0) {
                echo '<div class="pro-container" style="display: flex; padding-top: 10px; gap: 15px; justify-content: center; flex-wrap: wrap;">';
                while ($row = $result->fetch_assoc()) {
                    $productId = $row['product_id'];
                    echo '<div class="pro" style="width: 23%; min-width: 250px; padding: 10px 20px; border: 1px solid #cce7d0; border-radius: 25px; cursor: pointer; box-shadow: 20px 20px 30px rgba(0, 0, 0, 0.02); margin: 15px 0; transition: 0.2s ease; position: relative;">';
                    echo '<a href="product_details.php?productId=' . $productId . '">';
                    echo '<img src="vendor/' . $row['img1'] . '" alt="" height="200px" style="width: 100%; border-radius: 20px;">';
                    echo '</a>';
                    echo '<div class="des" style="text-align: start; padding: 10px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">';
                    echo '<h5 style="padding-top: 7px; color: #1a1a1a; font-size: 14px; overflow: hidden; text-overflow: ellipsis;">' . substr($row['name'], 0, 43) . '</h5>';
                    echo '<span class="price" style="font-size: 18px; font-weight: bold; margin-top: 1px;">' . $row['price'] . '</span>';
                    echo '<span class="stock" style="font-size: 16px; font-weight: thin; margin-top: 1px; margin-left: 30px; color: green" >In stock ' . $row['stock_quantity'] . '</span>';

                    echo '<p class="description" style="margin-top: 1px; color: #606063; font-size: 12px; overflow: hidden; text-overflow: ellipsis;">' . substr($row['description'], 0, 30) . '...</p>';

                    // Check if user is logged in
                    if (isset($_SESSION['u'])) {
                        // Check if the product is already in the cart
                        $stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
                        $stmt->bind_param("ii", $_SESSION['u'], $productId);
                        $stmt->execute();
                        $result_cart = $stmt->get_result();
                        if ($result_cart->num_rows > 0) {
                            echo '<form class="add-to-cart-form d-flex justify-content-between align-items-center" method="post">';

                            echo '<input type="hidden" name="product_id" value="' . $row['product_id'] . '">';

                            // Styling for the quantity input field
                            echo '<select name="quantity_' . $row['product_id'] . '" style="height: 30px; width: 70px; border-radius: 5px; border: 1px solid #ccc;">';
                            // Populate the dropdown with available quantities
                            for ($i = 1; $i <= $row['stock_quantity']; $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                            echo '</select>';

                            // Styling for the "Add to Cart" button
                            echo '<button type="button" onclick="addToCart(' . $row['product_id'] . ')" class="btn btn-primary d-flex justify-content-center align-items-center" style="height: 30px; width: 130px; background-color: #0062cc; margin-left: 20px;" disabled>';
                            echo '';
                            echo 'Added to Cart</button>';
                            echo '</form>';
                        } else {
                            echo '<form class="add-to-cart-form d-flex justify-content-between align-items-center" method="post">';
                            echo '<input type="hidden" name="product_id" value="' . $row['product_id'] . '">';
                            echo '<select name="quantity_' . $row['product_id'] . '" style="height: 30px; width: 70px; border-radius: 5px; border: 1px solid #ccc;">';
                            // Populate the dropdown with available quantities
                            for ($i = 1; $i <= $row['stock_quantity']; $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                            echo '</select>';

                            // Remove the disabled attribute from the button
                            echo '<button type="button" onclick="addToCart(' . $row['product_id'] . ')" class="btn btn-primary d-flex justify-content-center align-items-center" style="height: 30px; width: 130px; background-color: #0062cc; margin-left: 20px;">';
                            echo 'Add to Cart</button>';



                            echo '</form>';
                        }
                    } else {
                        // User is not logged in, redirect to login page
                        echo '<a href="login.php" class="btn btn-primary">Login to Add to Cart</a>';
                    }

                    echo '</div>';
                    echo '</div>';
                }
                echo '</div>';
            } else {
                echo 'No products found.';
            }
        }


        $sql = "SELECT * FROM products where subcategory_id =" . $_SESSION['subcategory_id'] . " limit 8";

        displayProducts($sql);
        $_SESSION['scroll_position'] = isset($_GET['scroll_position']) ? $_GET['scroll_position'] : 0;
        ?>
    </div>
    </div>

    </div>
    <?php
    include("./include/footer.php");
    ?><!-- Closing container -->
</body>

</html>