<?php
include("./include/connection.php");
include("./include/navbar.php"); 
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
            margin-left: 20PX;
            
        }
    </style>
</head>
<body>

<div class="container mt-5 " id="container">
    <h2>Product List</h2>
    <table class="table">
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
                    echo "<td><img src='" . $row["img1"] . "' width='50' height='50'></td>";
                    echo "<td><img src='" . $row["img2"] . "' width='50' height='50'></td>";
                    echo "<td><img src='" . $row["img3"] . "' width='50' height='50'></td>";
                    echo "<td><img src='" . $row["img4"] . "' width='50' height='50'></td>";
                    echo "<td>" . $row["description"] . "</td>";
                    echo "<td>$" . $row["price"] . "</td>";
                    echo "<td>" . $row["stock_quantity"] . "</td>";
                    echo "<td>" . $row["discount_price"] . "</td>";
                    echo "<td>" . $row["category_id"] . "</td>";
                    echo "<td>" . $row["subcategory_id"] . "</td>";
                    echo "<td><button class='btn btn-success'>Confirm</button></td>";
                    echo "<td><button class='btn btn-danger'>Remove</button></td>";
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>


