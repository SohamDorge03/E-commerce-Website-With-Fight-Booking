<?php
session_start();

// Check if the vendor ID is not set in the session
if (!isset($_SESSION['vendor_id'])) {
    header("Location: login.php");
    exit();
}

include './include/connection.php'; 

?>

<?php
include('include/navbar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
            margin-top: 70px !important;
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
            color: #333;
        }

        .stats {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .stat {
            width: 200px;
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .stat:hover {
            transform: translateY(-5px);
        }

        .stat h2 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
        }

        .stat p {
            font-size: 36px;
            font-weight: bold;
            color: #007bff;
            margin: 20px 0;
        }
    

        @media screen and (max-width: 768px) {
            .stat {
                width: calc(50% - 40px);
            }
        }

        @media screen and (max-width: 576px) {
            .stat {
                width: calc(100% - 40px);
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Dashboard</h1>
        <div class="stats">
            <?php
            include("./include/connection.php");
            
            // SQL query to count the products category-wise
            $sql_query = "SELECT categories.name, COUNT(products.product_id) AS total_products 
                          FROM products 
                          INNER JOIN categories ON products.category_id = categories.category_id 
                          WHERE products.vendor_id = {$_SESSION['vendor_id']} 
                          GROUP BY categories.name";
            
            $result = $conn->query($sql_query);
            if ($result === false) {
                echo "<p>Error: " . $conn->error . "</p>";
            } else {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='stat'>";
                    echo "<h2>{$row['name']}</h2>";
                    echo "<p>{$row['total_products']}</p>";
                    echo "</div>";
                }
            }
            $sql_queries = array(
                "SELECT COUNT(*) AS Orders FROM orders INNER JOIN order_items ON orders.order_id = order_items.order_id INNER JOIN products ON order_items.product_id = products.product_id INNER JOIN vendors ON products.vendor_id = vendors.vendor_id WHERE vendors.vendor_id = {$_SESSION['vendor_id']}",
                "SELECT COUNT(*) AS Products FROM products WHERE vendor_id = {$_SESSION['vendor_id']}",
                "SELECT COUNT(*) AS book_demo FROM book_demo INNER JOIN products ON book_demo.product_id = products.product_id INNER JOIN vendors ON products.vendor_id = vendors.vendor_id WHERE vendors.vendor_id = {$_SESSION['vendor_id']}"
            );
            
            foreach ($sql_queries as $sql_query) {
                $result = $conn->query($sql_query);
                if ($result === false) {
                    echo "<p>Error: " . $conn->error . "</p>";
                } else {
                    $row = $result->fetch_assoc();
                    echo "<div class='stat'>";
                    foreach ($row as $key => $value) {
                        echo "<h2>$key</h2>";
                        echo "<p>$value</p>";
                    }
                    echo "</div>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
<?php
// Close connection
$conn->close();
?>
