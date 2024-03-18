<?php
session_start();

if(!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warranty Table</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php
    include("./include/navbar.php");
    ?>
    <div class="container mt-5">
        <h2 class="mb-4">Warranty Information</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead style="background-color: #5F1E30;">
                    <tr style="color: wheat;">
                        <th>Warranty ID</th>
                        <th>User Name</th>
                        <th>Product Name</th>
                        <th>Start Date</th>
                        <th>Status</th>
                        <th>Payment</th>
                        <th>Months</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Establish database connection
                    include("./include/connection.php");

                    $query = "SELECT w.*, u.username, p.name as name 
                              FROM warranty w
                              JOIN users u ON w.user_id = u.user_id
                              JOIN products p ON w.product_id = p.product_id";
                    $result = mysqli_query($conn, $query);

                    // Check if query was successful
                    if ($result && mysqli_num_rows($result) > 0) {
                        // Loop through each row in the result set
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>' . $row['warranty_id'] . '</td>';
                            echo '<td>' . $row['username'] . '</td>';
                            echo '<td>' . $row['name'] . '</td>';
                            echo '<td>' . $row['start_date'] . '</td>';
                            echo '<td>' . $row['status'] . '</td>';
                            echo '<td>' . $row['payment'] . '</td>';
                            echo '<td>' . $row['months'] . '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="9">No data found.</td></tr>';
                    }                   
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
