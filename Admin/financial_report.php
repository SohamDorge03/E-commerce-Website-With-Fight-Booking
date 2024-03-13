    <?php
    session_start();

    if (!isset($_SESSION['email'])) {
        header("Location: login.php");
        exit();
    }

    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Financial Reports</title>
        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <style>
            .card {
                margin-bottom: 20px;
            }

            .card-header {
                background-color: yellow;
                color: #C70039;

            }

            .card-body {
                background-color: #f8f9fa;
            }
        </style>
    </head>

    <body>
        <?php
        include("./include/navbar.php");
        ?>
        <div class="container mt-5">
            <H1>Financial Reports</H1>
            <div class="row">
                <!-- Total Revenue of Booked Flights -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Actual Total Revenue of Booked Flights</h5>
                        </div>
                        <div class="card-body">
                            <?php
                            include("./include/connection.php");
                            $sql = "SELECT YEAR(booked_date) AS year, MONTH(booked_date) AS month, SUM(total_amount) AS total_revenue FROM booked_flights GROUP BY YEAR(booked_date), MONTH(booked_date)";
                            $result = $conn->query($sql);
                            if ($result === false) {
                                echo "Error executing the SQL query: " . $conn->error;
                            } elseif ($result->num_rows > 0) {
                                echo "<table class='table'>";
                                echo "<thead><tr><th>Year</th><th>Month</th><th>Total Revenue</th></tr></thead>";
                                echo "<tbody>";
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["year"] . "</td>";
                                    echo "<td>" . date('F', mktime(0, 0, 0, $row["month"], 1)) . "</td>"; // Convert month number to month name
                                    echo "<td>$" . number_format($row["total_revenue"], 2) . "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                                echo "</table>";
                            } else {
                                echo "<p>No revenue data found.</p>";
                            }
                            $conn->close();
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Total Revenue of Booked Flights after Shopflix fee -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Total Revenue of Booked Flights after Shopflix Fee</h5>
                        </div>
                        <div class="card-body">
                            <?php
                            include("./include/connection.php");
                            $sql = "SELECT YEAR(booked_date) AS year, MONTH(booked_date) AS month, SUM(total_amount) AS total_revenue FROM booked_flights GROUP BY YEAR(booked_date), MONTH(booked_date)";
                            $result = $conn->query($sql);
                            if ($result === false) {
                                echo "Error executing the SQL query: " . $conn->error;
                            } elseif ($result->num_rows > 0) {
                                echo "<table class='table'>";
                                echo "<thead><tr><th>Year</th><th>Month</th><th>Total Revenue after Shopflix Fee</th></tr></thead>";
                                echo "<tbody>";
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["year"] . "</td>";
                                    echo "<td>" . date('F', mktime(0, 0, 0, $row["month"], 1)) . "</td>"; // Convert month number to month name
                                    // Calculate the total revenue after deducting 5% fee
                                    $total_revenue_after_fee = $row["total_revenue"] * 0.95;
                                    echo "<td>$" . number_format($total_revenue_after_fee, 2) . "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                                echo "</table>";
                            } else {
                                echo "<p>No revenue data found.</p>";
                            }
                            $conn->close();
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Total Revenue by Airline -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Total Revenue by Airline</h5>
                        </div>
                        <div class="card-body">
                            <?php
                            include("./include/connection.php");
                            $sql = "SELECT airlines.airline_name, SUM(booked_flights.total_amount) AS total_revenue FROM booked_flights JOIN flights ON booked_flights.flight_id = flights.flight_id JOIN airlines ON flights.airline_id = airlines.airline_id GROUP BY airlines.airline_name";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<div class="card mb-3">';
                                    echo '<div class="card-body">';
                                    echo '<h5 class="card-title">' . $row["airline_name"] . '</h5>';
                                    echo '<p class="card-text">Total Revenue: $' . number_format($row["total_revenue"], 2) . '</p>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            } else {
                                echo "<p>No revenue data found.</p>";
                            }
                            $conn->close();
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Total Revenue by Airport -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Total Revenue by Airport</h5>
                        </div>
                        <div class="card-body">
                            <?php
                            include("./include/connection.php");
                            $sql = "SELECT airports.airport_name, SUM(booked_flights.total_amount) AS total_revenue FROM booked_flights JOIN flights ON booked_flights.flight_id = flights.flight_id JOIN airports ON flights.dep_airport_id = airports.airport_id GROUP BY airports.airport_name";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<div class="card mb-3">';
                                    echo '<div class="card-body">';
                                    echo '<h5 class="card-title">' . $row["airport_name"] . '</h5>';
                                    echo '<p class="card-text">Total Revenue: $' . number_format($row["total_revenue"], 2) . '</p>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            } else {
                                echo "<p>No revenue data found.</p>";
                            }
                            $conn->close();
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Total Revenue by User -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Total Revenue by User</h5>
                        </div>
                        <div class="card-body">
                            <?php
                            include("./include/connection.php");
                            $sql = "SELECT users.username, SUM(booked_flights.total_amount) AS total_revenue FROM booked_flights JOIN users ON booked_flights.user_id = users.user_id GROUP BY users.username";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<div class="card mb-3">';
                                    echo '<div class="card-body">';
                                    echo '<h5 class="card-title">' . $row["username"] . '</h5>';
                                    echo '<p class="card-text">Total Revenue: $' . number_format($row["total_revenue"], 2) . '</p>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            } else {
                                echo "<p>No revenue data found.</p>";
                            }
                            $conn->close();
                            ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0"> vendors are selling the most products</h5>
                            </div>
                            <div class="card-body">
                                <?php
                                // Include your database connection file here
                                include("./include/connection.php");

                                // SQL query to fetch vendors with the most sales
                                $sql = "SELECT vendors.company_name, COUNT(order_items.order_id) AS total_sales
            FROM order_items
            JOIN products ON order_items.product_id = products.product_id
            JOIN vendors ON products.vendor_id = vendors.vendor_id
            GROUP BY vendors.company_name
            ORDER BY total_sales DESC";

                                $result = $conn->query($sql);

                                // Check if there are results
                                if ($result && $result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        // Display each vendor's sales in a card format
                                        echo '<div class="card">';
                                        echo '<div class="card-body">';
                                        echo '<h5 class="card-title">' . $row["company_name"] . '</h5>';
                                        echo '<p class="card-text">Total Sales: ' . $row["total_sales"] . '</p>';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                } else {
                                    echo "No vendors found with sales.";
                                }

                                // Close the database connection
                                $conn->close();
                                ?>

                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>

    </html>