
<!-- Main content -->
<div class="main-content">
    









<?php

include("include/connection.php");
include("include/navbar.php");
 

// Function to display products
function displayProducts($sql)
{
    global $conn;

    $result = $conn->query($sql);

    // Check if there are products
    if ($result->num_rows > 0) {
        echo '<div class="pro-container" style="display: flex; padding-top: 20px; gap: 30px; justify-content: center; flex-wrap: wrap;">';

        // Loop through each product and generate HTML
        while ($row = $result->fetch_assoc()) {
            $productId = $row['product_id'];

            echo '<div class="pro" style="width: 300px; min-width: 250px; padding: 10px 20px; border: 1px solid #cce7d0; border-radius: 25px; cursor: pointer; box-shadow: 20px 20px 30px rgba(0, 0, 0, 0.02); margin: 15px 0; transition: 0.2s ease; position: relative;">';
            echo '<img src="vendor/' . $row['img1'] . '" alt="" height="200px" style="width: 100%; border-radius: 20px;">';
            echo '<div class="des" style="text-align: start; padding: 10px 0;">';
            echo '<h5 style="padding-top: 7px; color: #1a1a1a; font-size: 14px;">' . $row['name'] . '</h5>';
            echo '<span class="price" style=" font-size: 18px; font-weight: bold; margin-top: 1px;">$' . $row['price'] . '</span>';
            echo '<p class="description" style="margin-top: 1px; color: #606063; font-size: 12px;">' . substr($row['description'], 0, 50) . '...</p>';
            echo '</div>';

            // Check if user is logged in
            if (isset($_SESSION['u'])) {
                // Quantity input box
                echo '<form class="add-to-cart-form" method="post" action="">';
                echo '<input type="hidden" name="product_id" value="' . $row['product_id'] . '">';
                echo '<input type="number" name="quantity" class="" value="1" min="1" style="width: 50px; margin-bottom: 10px;">';

                // Add to cart button
                echo '<input type="submit" name="add_to_cart" value="Add to Cart" class="btn add-to-cart-btn" style="width: 80px; height: 40px; line-height: 40px; border-radius: 5px; background-color: #e8f6ea; font-weight: 500; color: #088178; border: 1px solid #cce7d0;">';
                echo '</form>';
            }

            echo '</div>';
        }

        echo '</div>';
    } else {
        echo 'No products found.';
    }
}

// Store current scroll position in session
$_SESSION['scroll_position'] = isset($_SESSION['scroll_position']) ? $_SESSION['scroll_position'] : 0;

if (isset($_POST['add_to_cart'])) {

    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Add product to cart
    $userId = isset($_SESSION['u']) ? $_SESSION['u'] : null; // Assuming user ID is stored in session
    if ($userId) {
        $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $userId, $productId, $quantity);
        $stmt->execute();
        $stmt->close();
    }

    // Show alert and prevent default form submission
    echo '<script>alert("Product added to cart!");</script>';
    echo '<script>
            document.querySelectorAll(".add-to-cart-form").forEach(form => {
                form.addEventListener("submit", function(event) {
                    event.preventDefault();
                   
                });
            });
          </script>';
    
    // Redirect back to the page with the stored scroll position
    echo '<script>window.location.href = window.location.pathname + "?scroll_position=" + ' . $_SESSION['scroll_position'] . ';</script>';
    exit();
}

// Display products
echo '<div style="display: flex; justify-content:center; align-items:center;">';
echo '<h2 style="justify-content:center; margin-top:20px;">Electronics</h2>';
echo '</div>';


    // If no search term provided, fetch all products
    $sql = "SELECT * FROM products where category_id=3";
    displayProducts($sql);


// Store the current scroll position in session
$_SESSION['scroll_position'] = isset($_GET['scroll_position']) ? $_GET['scroll_position'] : 0;
?>

</div>
</div>
</body>
</html>











