<?php
include("./include/navbar.php");
include("include/connection.php");
?>

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<style>
    .flex {
        display: grid;
        padding: 32px;
        grid-template-columns: 333px auto;
        gap: 2px;
    }
</style>
<style>
    .sidebar {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
    }

    .category-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .category-list {
        list-style-type: none;
        padding: 0;
    }

    .category-list li {
        margin-bottom: 5px;
    }

    .subcategory-title {
        font-size: 16px;
        font-weight: bold;
        margin-top: 20px;
        margin-bottom: 10px;
    }

    .subcategory-list {
        list-style-type: none;
        padding: 0;
    }

    .subcategory-list li {
        margin-bottom: 5px;
        margin-left: 20px;
    }

    .apply-btn {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 8px 16px;
        border-radius: 5px;
        cursor: pointer;
    }

    .apply-btn:hover {
        background-color: #0056b3;
    }
</style>


</div>

<div class="main-content">
    <?php
    
    function displayProducts($sql)
    {
        global $conn;
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            echo '<div class="pro-container" style="display: flex; padding-top: 10px; gap: 15px; justify-content: center; flex-wrap: wrap;">';
            while ($row = $result->fetch_assoc()) {
                $productId = $row['product_id'];
                echo '<div class="pro" style="width: 18%; min-width: 250px; padding: 10px 20px; border: 1px solid #cce7d0; border-radius: 25px; cursor: pointer; box-shadow: 20px 20px 30px rgba(0, 0, 0, 0.02); margin: 15px 0; transition: 0.2s ease; position: relative;">';
                echo '<a href="product_details.php?productId=' . $productId . '">';
                echo '<img src="vendor/' . $row['img1'] . '" alt="" height="200px" style="width: 100%; border-radius: 20px;">';
                echo '</a>';
                echo '<div class="des" style="text-align: start; padding: 10px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">';
                echo '<h5 style="padding-top: 7px; color: #1a1a1a; font-size: 14px; overflow: hidden; text-overflow: ellipsis;">' . substr($row['name'], 0, 43) . '</h5>';
                echo '<span class="price" style="font-size: 18px; font-weight: bold; margin-top: 1px;">' . $row['price'] . '</span>';
                echo '<span class="stock" style="font-size: 16px; font-weight: thin; margin-top: 1px; margin-left: 30px; color: green" >In stock  ' . $row['stock_quantity'] . '</span>';

                echo '<p class="description" style="margin-top: 1px; color: #606063; font-size: 12px; overflow: hidden; text-overflow: ellipsis;">' . substr($row['description'], 0, 30) . '...</p>';
                
                if (isset($_SESSION['u'])) {
                   
                    $stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
                    $stmt->bind_param("ii", $_SESSION['u'], $productId);
                    $stmt->execute();
                    $result_cart = $stmt->get_result();
                    if ($result_cart->num_rows > 0) {
                        echo '<form class="add-to-cart-form d-flex justify-content-between align-items-center" method="post">';

                        echo '<input type="hidden" name="product_id" value="' . $row['product_id'] . '">';

                        echo '<select name="quantity_' . $row['product_id'] . '" style="height: 30px; width: 70px; border-radius: 5px; border: 1px solid #ccc;">';
                  
                        for ($i = 1; $i <= $row['stock_quantity']; $i++) {
                            echo "<option value='$i'>$i</option>";
                        }
                        echo '</select>';

                        echo '<button type="button" onclick="addToCart(' . $row['product_id'] . ')" class="btn btn-primary d-flex justify-content-center align-items-center" style="height: 30px; width: 130px; background-color: #0062cc; margin-left: 20px;" disabled>';
                        echo '';
                        echo 'Added to Cart</button>';
                        echo '</form>';
                    } else {
                        echo '<form class="add-to-cart-form d-flex justify-content-between align-items-center" method="post">';
                        echo '<input type="hidden" name="product_id" value="' . $row['product_id'] . '">';
                        echo '<select name="quantity_' . $row['product_id'] . '" style="height: 30px; width: 70px; border-radius: 5px; border: 1px solid #ccc;">';
                        
                        for ($i = 1; $i <= $row['stock_quantity']; $i++) {
                            echo "<option value='$i'>$i</option>";
                        }
                        echo '</select>';
                        echo '<button type="button" onclick="addToCart(' . $row['product_id'] . ')" class="btn btn-primary d-flex justify-content-center align-items-center" style="height: 30px; width: 130px; background-color: #0062cc; margin-left: 20px;">';
                        echo 'Add to Cart</button>';
                        echo '</form>';
                    }
                } else {
        
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


    $sql = "SELECT * FROM products where category_id=1";
    if (isset($_GET['subcategory'])) {
        $selectedSubcategories = $_GET['subcategory'];
        $selectedSubcategories = implode(',', $selectedSubcategories);
        $sql .= " WHERE subcategory_id IN ($selectedSubcategories)";
    } else if (isset($_GET['category'])) {
        $selectedCategories = $_GET['category'];
        $sql .= " WHERE subcategory_id IN (SELECT subcategory_id FROM subcategories WHERE category_id IN (" . implode(',', $selectedCategories) . "))";
    }
    if (isset($_GET['price_range'])) {
        $priceRange = $_GET['price_range'];
        $sql .= " AND price <= $priceRange";
    }
    displayProducts($sql);
    $_SESSION['scroll_position'] = isset($_GET['scroll_position']) ? $_GET['scroll_position'] : 0;
    ?>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script>
    function addToCart(productId) {
        var quantity = $('select[name="quantity_' + productId + '"]').val();

        
        var scrollPosition = $(window).scrollTop();

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
            }
        });
    }
</script>
<?php
include("./include/footer.php");
?>

</body>

</html>