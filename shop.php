<?php
include("./include/navbar.php");

?>

<style>
    .flex {
        display: grid;
        padding: 32px;
        grid-template-columns: 333px auto;
        gap: 2px;
        background-color: #fffff2;
    }
</style>

<div class="flex">
    <!-- Left sidebar -->
    <div class="sidebar">
        <?php
        // Include database connection
        include("include/connection.php");

        function fetchCategoryNames()
        {
            global $conn;

            $sql = "SELECT * FROM categories"; // Assuming you have a 'categories' table
            $result = $conn->query($sql);

            $categoryNames = array();

            // Check if the query was successful
            if ($result) {
                // Check if there are rows returned
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $categoryNames[$row['category_id']] = $row['name'];
                    }
                }
            } else {
                // Handle SQL query error
                echo "Error: " . $conn->error;
            }

            return $categoryNames;
        }

        // Function to fetch subcategory names from the database based on the selected category
        function fetchSubcategoryNames($categoryId)
        {
            global $conn;

            $sql = "SELECT * FROM subcategories WHERE category_id = $categoryId";
            $result = $conn->query($sql);

            $subcategoryNames = array();

            // Check if the query was successful
            if ($result) {
                // Check if there are rows returned
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $subcategoryNames[$row['subcategory_id']] = $row['name'];
                    }
                }
            } else {
                // Handle SQL query error
                echo "Error: " . $conn->error;
            }

            return $subcategoryNames;
        }

        // Display category filter options
        $categories = fetchCategoryNames();
        if ($categories) {
            echo "<h4>Categories</h4>";
            echo "<form method='GET'>";
            echo "<ul>";

            foreach ($categories as $categoryId => $categoryName) {
                $checked = isset($_GET['category']) && in_array($categoryId, $_GET['category']) ? 'checked' : '';
                echo "<li><input type='checkbox' name='category[]' value='$categoryId' $checked>$categoryName</li>";
            }

            echo "</ul>";
            echo "<input type='submit' value='Apply'>";
            echo "</form>";
        } else {
            echo "No categories found.";
        }

        // Display subcategory filter options based on selected category
        if (isset($_GET['category'])) {
            $selectedCategories = $_GET['category'];
            $_SESSION['selected_category'] = $selectedCategories; 

            echo "<h4>Subcategories</h4>";
            echo "<form method='GET'>";
            echo "<ul>";

            foreach ($selectedCategories as $selectedCategory) {
                $subcategories = fetchSubcategoryNames($selectedCategory);
                if ($subcategories) {
                    foreach ($subcategories as $subcategoryId => $subcategoryName) {
                        $checked = isset($_GET['subcategory']) && in_array($subcategoryId, $_GET['subcategory']) ? 'checked' : '';
                        echo "<li><input type='checkbox' name='subcategory[]' value='$subcategoryId' $checked>$subcategoryName</li>";
                    }
                } else {
                    echo "No subcategories found for the selected category.";
                }
            }
            echo "</ul>";
            echo "<input type='submit' value='Apply'>";
            echo "</form>";
        }
        ?>

        <!-- Price range filter options -->
        <h4>Price Range</h4>
        <form method="GET">
            <ul>
                <li><input type="checkbox" name="price_range[]" value="0-2000">0 - 2000</li>
                <li><input type="checkbox" name="price_range[]" value="2001-5000">2001 - 5000</li>
                <li><input type="checkbox" name="price_range[]" value="5001-10000">5001 - 10000</li>
                <li><input type="checkbox" name="price_range[]" value="10001-20000">10001 - 20000</li>
                <li><input type="checkbox" name="price_range[]" value="20001-50000">20001 - 50000</li>
                <li><input type="checkbox" name="price_range[]" value="50000">Above 50000</li>
            </ul>
            <input type="submit" value="Apply">
        </form>
    </div>

    <!-- Main content -->
    <div class="main-content">
        <?php
        // Function to display products
        function displayProducts($sql)
        {
            global $conn;

            $result = $conn->query($sql);

            // Check if there are products
            if ($result) {
                if ($result->num_rows > 0) {
                    echo '<div class="pro-container" style="display: flex; padding-top: 20px; gap: 30px; justify-content: center; flex-wrap: wrap;">';

                    // Loop through each product and generate HTML
                    while ($row = $result->fetch_assoc()) {
                        $productId = $row['product_id'];

                        echo '<div class="pro" style="width: 23%; min-width: 250px; padding: 10px 20px; border: 1px solid #cce7d0; border-radius: 25px; cursor: pointer; box-shadow: 20px 20px 30px rgba(0, 0, 0, 0.02); margin: 15px 0; transition: 0.2s ease; position: relative;">';
                        echo '<a href="product_details.php?productId=' . $productId . '">'; // Anchor tag for product details page
                        echo '<img src="vendor/' . $row['img1'] . '" alt="" height="200px" style="width: 100%; border-radius: 20px;">';
                        echo '</a>'; // Closing anchor tag
                        echo '<div class="des" style="text-align: start; padding: 10px 0;">';
                        echo '<h5 style="padding-top: 7px; color: #1a1a1a; font-size: 14px;">' . $row['name'] . '</h5>';
                        echo '<span class="price" style=" font-size: 18px; font-weight: bold; margin-top: 1px;">' . $row['price'] . '</span>';
                        echo '<p class="description" style="margin-top: 1px; color: #606063; font-size: 12px;">' . substr($row['description'], 0, 50) . '...</p>';
                        echo '</div>';
                        echo '</div>';
                    }

                    echo '</div>';
                } else {
                    echo 'No products found.';
                }
            } else {
                // Handle SQL query error
                echo "Error: " . $conn->error;
            }
        }

        // Store current scroll position in session
        $_SESSION['scroll_position'] = isset($_SESSION['scroll_position']) ? $_SESSION['scroll_position'] : 0;

        // Construct the base SQL query
        $sql = "SELECT * FROM products WHERE 1";

        // Check if subcategories are selected
        if (isset($_GET['subcategory'])) {
            // Get the selected subcategories
            $selectedSubcategories = $_GET['subcategory'];
            $selectedSubcategories = implode(',', $selectedSubcategories);

            // Append the WHERE clause to filter by selected subcategories
            $sql .= " AND subcategory_id IN ($selectedSubcategories)";
        } else if (isset($_GET['category'])) {
            // Get the selected categories
            $selectedCategories = $_GET['category'];

            // Append the WHERE clause to filter by selected categories and their subcategories
            $categorySubquery = "SELECT subcategory_id FROM subcategories WHERE category_id IN (" . implode(',', $selectedCategories) . ")";
            $sql .= " AND subcategory_id IN ($categorySubquery)";
        }

        // Check if price range is selected and add it to the WHERE clause
        if (isset($_GET['price_range'])) {
            $priceRanges = $_GET['price_range'];
            $priceConditions = [];

            foreach ($priceRanges as $priceRange) {
                $ranges = explode('-', $priceRange);
                if (count($ranges) === 2) {
                    $minPrice = $ranges[0];
                    $maxPrice = $ranges[1];
                    $priceConditions[] = "(price BETWEEN $minPrice AND $maxPrice)";
                } else {
                    $minPrice = 50000;
                    $priceConditions[] = "(price >= $minPrice)";
                }
            }

            // Combine multiple price conditions using OR
            $sql .= " AND (" . implode(" OR ", $priceConditions) . ")";
        }

        // Display the products based on the constructed SQL query
        displayProducts($sql);

        // Store the current scroll position in session
        $_SESSION['scroll_position'] = isset($_GET['scroll_position']) ? $_GET['scroll_position'] : 0;
        ?>
    </div>
</div>

</body>

</html>
