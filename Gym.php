<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Product Listing</title>
<style>
    /* CSS for the popup */
    .popup {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
    }
    
    .popup-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }
    
    .close {
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
    }
</style>
</head>
<body>
<!-- Main content -->
<div class="main-content">
    <?php
    session_start();
    include("include/connection.php");

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
                echo '<img src="vendor/' . $row['img1'] . '" alt="" height="200px" style="width: 100%; border-radius: 20px;" onclick="showProductDetails(' . $productId . ')">'; // Added onclick attribute
                echo '<div class="des" style="text-align: start; padding: 10px 0;">';
                echo '<h5 style="padding-top: 7px; color: #1a1a1a; font-size: 14px;">' . $row['name'] . '</h5>';
                echo '<span class="price" style=" font-size: 18px; font-weight: bold; margin-top: 1px;">$' . $row['price'] . '</span>';
                echo '<p class="description" style="margin-top: 1px; color: #606063; font-size: 12px;">' . substr($row['description'], 0, 50) . '...</p>';
                echo '</div>';
                echo '</div>';
            }

            echo '</div>';
        } else {
            echo 'No products found.';
        }
    }

    // Display products
    echo '<div style="display: flex; justify-content:center; align-items:center;">';
    echo '<h2 style="justify-content:center; margin-top:20px;">Gym Tools</h2>';
    echo '</div>';

    // If no search term provided, fetch all products
    $sql = "SELECT * FROM products where category_id=1";
    displayProducts($sql);

    ?>
</div>

<!-- Popup for product details -->
<div id="productDetailsPopup" class="popup">
    <div class="popup-content">
        <span class="close" onclick="closeProductDetailsPopup()">&times;</span>
        <div id="productDetailsContent"></div>
    </div>
</div>

<script>
    // JavaScript function to show product details popup
    function showProductDetails(productId) {
        // Fetch product details using AJAX
        fetch('fetchProductDetails.php?productId=' + productId)
            .then(response => response.text())
            .then(data => {
                document.getElementById('productDetailsContent').innerHTML = data;
                document.getElementById('productDetailsPopup').style.display = 'block';
            })
            .catch(error => {
                console.error('Error fetching product details:', error);
            });
    }

    // JavaScript function to close product details popup
    function closeProductDetailsPopup() {
        document.getElementById('productDetailsPopup').style.display = 'none';
    }
</script>
</body>
</html>
