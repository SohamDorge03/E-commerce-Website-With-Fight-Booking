<?php
session_start(); // Starting the session

if (!isset($_SESSION['airline_id'])) {
    // Redirect to the login page if not logged in
    header("Location: log.php");
    exit();
}
include("./navbar.php");
include("./connection.php");
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
            
            // Check if 'airline_id' session variable is set
            if(isset($_SESSION['airline_id'])) {
                // Use the session variable in the SQL queries
                $sql_query1 = "SELECT COUNT(*) AS Booked_Flights FROM booked_flights WHERE airline_id = {$_SESSION['airline_id']}";
                $sql_query2 = "SELECT COUNT(*) AS Flights FROM flights WHERE airline_id = {$_SESSION['airline_id']}";
                $sql_query3 = "SELECT COUNT(*) AS Airports FROM airports"; // Count airports
                $sql_query4 = "SELECT COUNT(*) AS Location FROM airports"; // Count airports
                $sql_query5 = "SELECT COUNT(*) AS Passenger FROM passenger"; // Count passengers

                $result1 = $conn->query($sql_query1);
                $result2 = $conn->query($sql_query2);
                $result3 = $conn->query($sql_query3); // Execute query for airports count
                $result4 = $conn->query($sql_query4);
                $result5 = $conn->query($sql_query5); // Execute query for passengers count

                if ($result1 === false || $result2 === false || $result3 === false || $result4 === false || $result5 === false) {
                    echo "<p>Error: " . $conn->error . "</p>";
                } else {
                    $row1 = $result1->fetch_assoc();
                    $row2 = $result2->fetch_assoc();
                    $row3 = $result3->fetch_assoc(); // Fetch result for airports count
                    $row4 = $result4->fetch_assoc();
                    $row5 = $result5->fetch_assoc(); // Fetch result for passengers count

                    echo "<div class='stat'>";
                    foreach ($row1 as $key => $value) {
                        echo "<h2>$key</h2>";
                        echo "<p>$value</p>";
                    }
                    echo "</div>";

                    echo "<div class='stat'>";
                    foreach ($row2 as $key => $value) {
                        echo "<h2>$key</h2>";
                        echo "<p>$value</p>";
                    }
                    echo "</div>";

                    // Display airports count
                    echo "<div class='stat'>";
                    foreach ($row3 as $key => $value) {
                        echo "<h2>$key</h2>";
                        echo "<p>$value</p>";
                    }
                    echo "</div>";

                    // Display passengers count
                    echo "<div class='stat'>";
                    foreach ($row4 as $key => $value) {
                        echo "<h2>$key</h2>";
                        echo "<p>$value</p>";
                    }
                    echo "</div>";
                    echo "<div class='stat'>";
                    foreach ($row5 as $key => $value) {
                        echo "<h2>$key</h2>";
                        echo "<p>$value</p>";
                    }
                    echo "</div>";
                }
            } else {
                // Handle case when 'airline_id' session variable is not set
                echo "<p>Error: 'airline_id' session variable is not set.</p>";
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
