<?php

include("./include/connection.php");
include("./include/navbar.php");

if(isset($_POST['remove_product_id'])) {
    $remove_product_id = $_POST['remove_product_id'];

    $remove_sql = "DELETE FROM products WHERE product_id = $remove_product_id";

    if ($conn->query($remove_sql) === TRUE) {
        echo "Product removed successfully";
        exit;
    } else {
        echo "Error removing product: " . $conn->error;
        exit;
    }
}

if (isset($_POST['confirm_product_id'])) {
    // Retrieve the product ID
    $product_id = $_POST['confirm_product_id'];

    // Query to update the confirmation status of the product
    $update_sql = "UPDATE products SET confirmation_status = 1 WHERE product_id = $product_id";

    // Execute the query
    if ($conn->query($update_sql) === TRUE) {
        echo "Confirmation status updated successfully";
        exit; // Exit after echoing response to prevent further HTML output
    } else {
        echo "Error updating confirmation status: " . $conn->error;
        exit; // Exit after echoing response to prevent further HTML output
    }
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #container{
            margin-top: 120px;
         
        }
        .description-cell {
    max-width: 200px; /* Adjust the width as needed */
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    cursor: pointer;
}

.full-description {
    white-space: normal;
    position: absolute;
    background-color: #fff;
    border: 1px solid #ccc;
    padding: 10px;
    z-index: 100;
    max-width: 400px; /* Adjust the width as needed */
}
</style>
</head>
<body>

<div class="container " id="container">
    <h2>Product List</h2>
    <table class="table ">
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Name</th>
                <th>Image 1</th>
                <th>Image 2</th>
                <th>Image 3</th>
                <th>Image 4</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stock Quantity</th>
                <th>Discount Price</th>
                <th>Category ID</th>
                <th>Subcategory ID</th>
                <th>Confirmation Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["product_id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . ($row["img1"] ? "<img src='../Vendor/" . $row["img1"] . "' width='50' height='50'>" : "-") . "</td>";
                    echo "<td>" . ($row["img2"] ? "<img src='../Vendor/" . $row["img2"] . "' width='50' height='50'>" : "-") . "</td>";
                    echo "<td>" . ($row["img3"] ? "<img src='../Vendor/" . $row["img3"] . "' width='50' height='50'>" : "-") . "</td>";
                    echo "<td>" . ($row["img4"] ? "<img src='../Vendor/" . $row["img4"] . "' width='50' height='50'>" : "-") . "</td>";
                    
                    echo "<td class='description-cell'>" . $row["description"] . "</td>";

                    echo "<td>$" . $row["price"] . "</td>";
                    echo "<td>" . $row["stock_quantity"] . "</td>";
                    echo "<td>" . $row["discount_price"] . "</td>";
                    echo "<td>" . $row["category_id"] . "</td>";
                    echo "<td>" . $row["subcategory_id"] . "</td>";
                    echo "<td>" . ($row["confirmation_status"] ? 'Confirmed' : 'Not Confirmed') . "</td>";
                    echo "<td><button class='btn btn-success' onclick='confirmProduct(" . $row['product_id'] . ")'>Confirm</button></td>";
                    echo "<td><button class='btn btn-danger' onclick='removeProduct(" . $row['product_id'] . ")'>Remove</button></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='14'>No products found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function() {
    var descriptionCells = document.querySelectorAll('.description-cell');

    descriptionCells.forEach(function(cell) {
        cell.addEventListener('mouseover', function() {
            var words = cell.textContent.split(' ');
            if (words.length > 30 && !cell.querySelector('.full-description')) {
                var fullDescription = document.createElement('div');
                fullDescription.className = 'full-description';
                fullDescription.textContent = cell.textContent;
                cell.appendChild(fullDescription);
            }
        });

        cell.addEventListener('mouseout', function() {
            var fullDescription = cell.querySelector('.full-description');
            if (fullDescription) {
                fullDescription.remove();
            }
        });
    });
});

function removeProduct(productId) {
    if (confirm('Are you sure you want to remove this product?')) {
        $.ajax({
            url: window.location.href, // Send AJAX request to the same page
            type: 'POST',
            data: { remove_product_id: productId },
            success: function(response) {
                alert('Product removed successfully');
                // Reload the page to reflect changes
                location.reload();
            },
            error: function(xhr, status, error) {
                alert('Error removing product');
            }
        });
    }
}

function confirmProduct(productId) {
    if (confirm('Are you sure you want to confirm this product?')) {
        $.ajax({
            url: window.location.href, // Send AJAX request to the same page
            type: 'POST',
            data: { confirm_product_id: productId }, // Send product ID to server
            success: function(response) {
                alert('Confirmation status updated successfully');
                // Reload the page to reflect changes
                location.reload();
            },
            error: function(xhr, status, error) {
                alert('Error updating confirmation status');
            }
        });
    }
}
</script>
</body>
</html>
