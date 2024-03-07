<?php
include("./include/navbar.php");
include("./include/connection.php");
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Dashboard</h1>
        <div class="stats">
            <?php
            // Fetch data from tables
            $sql_queries = array(
                "SELECT COUNT(*) AS airlines FROM airlines",
                "SELECT COUNT(*) AS users FROM users",
                "SELECT COUNT(*) AS bookings FROM booked_flights",
                "SELECT COUNT(*) AS orders FROM orders",
                "SELECT COUNT(*) AS vendors FROM vendors",
                "SELECT COUNT(*) AS products FROM products",
                // "SELECT COUNT(*) AS warranty_claims FROM warranty_claims",
                "SELECT COUNT(*) AS airports FROM airports",
                // "SELECT COUNT(*) AS demo_bookings FROM demo_bookings",
                // "SELECT COUNT(*) AS returns FROM returns",
                // "SELECT COUNT(*) AS feedbacks FROM feedbacks",
                // "SELECT AVG(rating) AS average_rating FROM ratings"
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
