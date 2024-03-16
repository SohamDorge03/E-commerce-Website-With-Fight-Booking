<?php
include("include/connection.php");

// Function to fetch products from the database and display them
function displayProducts($sql) {
    global $conn;

    $result = $conn->query($sql);

    // Check if there are products
    if ($result->num_rows > 0) {
        echo '<div class="pro-container" style="display: flex; padding-top: 20px; gap: 30px; justify-content: center; flex-wrap: wrap;">';

        // Loop through each product and generate HTML
        while ($row = $result->fetch_assoc()) {
            $productId = $row['product_id'];

            echo '<div class="pro" style="width: 23%; min-width: 250px; padding: 10px 20px; border: 1px solid #cce7d0; border-radius: 25px; cursor: pointer; box-shadow: 20px 20px 30px rgba(0, 0, 0, 0.02); margin: 15px 0; transition: 0.2s ease; position: relative;">';
            echo '<img src="vendor/' . $row['img1'] . '" alt="" height="200px" style="width: 100%; border-radius: 20px;">';
            echo '<div class="des" style="text-align: start; padding: 10px 0;">';
            echo '<h5 style="padding-top: 7px; color: #1a1a1a; font-size: 14px;">' . $row['name'] . '</h5>';

            // Display discounted price with a strikethrough effect on original price if discount exists
            if ($row['discount_price'] !== null && $row['discount_price'] < $row['price']) {
                echo '<span class="original-price"><span style="text-decoration: line-through; color: #606063; font-size: 12px;">$' . $row['price'] . '</span></span>';
                echo '<span class="discounted-price" style="margin-left: 5px; font-size: 18px; font-weight: bold; margin-top: 1px; color: rgb(243, 181, 25);">$' . $row['discount_price'] . '</span>';
            } else {
                // If no discount, display the regular price
                echo '<span class="price" style=" font-size: 18px; font-weight: bold; margin-top: 1px;">$' . $row['price'] . '</span>';
            }

            // Display one-line description
            echo '<p class="description" style="margin-top: 1px; color: #606063; font-size: 12px;">' . substr($row['description'], 0, 50) . '...</p>';

            echo '</div>';

            // Check if session "user_id" is set
            if (isset($_SESSION['u'])) {
                // Quantity input box
                echo 'Quantity: <input type="number" name="quantity" class="" value="1" min="1" style="width: 50px; margin-bottom: 10px;">';

                // Add to cart button with appropriate icon
                echo '<button type="button" class="add-to-cart-btn btn" data-product-id="' . $row['product_id'] . '" style="width: 40px; height: 40px; line-height: 40px; border-radius: 50px; background-color: #e8f6ea; font-weight: 500; color: #088178; border: 1px solid #cce7d0; position: absolute; bottom: 20px; right: 10px;">';
                echo '<i class="bi bi-cart"></i> ';
                echo '</button>';
            }

            echo '</div>';
        }

        echo '</div>';
    } else {
        echo 'No products found.';
    }
}
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // AJAX for Add to Cart button
        $(document).on('click', '.add-to-cart-btn', function () {
            var button = $(this); // Save reference to the button clicked
            if (!button.hasClass('disabled')) {
                var productId = button.data('product-id');
                var quantity = button.closest('.pro').find('input[name="quantity"]').val();
                button.addClass('disabled'); // Disable the button to prevent multiple clicks
                $.ajax({
                    url: window.location.href,
                    type: 'POST',
                    data: {action: 'add_to_cart', product_id: productId, quantity: quantity},
                    success: function (response) {
                        button.html('<i class="bi bi-cart-fill"></i> '); // Change button icon
                    },
                    complete: function () {
                        button.removeClass('disabled'); // Re-enable the button after AJAX request completes
                    }
                });
            }
        });
    });
