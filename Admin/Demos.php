<?php
include("./include/navbar.php");
include("./include/connection.php");

$deleteSuccess = false; // Flag to indicate successful deletion

// Check if the remove action is triggered
if(isset($_POST['remove_demo']) && isset($_POST['demo_id'])) {
    // Sanitize the input to prevent SQL injection
    $demo_id = mysqli_real_escape_string($conn, $_POST['demo_id']);

    // Delete the row from the database
    $sql = "DELETE FROM book_demo WHERE demo_id = $demo_id";

    if ($conn->query($sql) === TRUE) {
        $deleteSuccess = true; // Set the flag to true upon successful deletion
        echo "Demo removed successfully"; // Echo only the message
    } else {
        echo "Error removing demo: " . $conn->error; // Echo only the error message
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo Bookings</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .container{
            margin-top: 100px;
            margin-left: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Demo Bookings</h2>
        <?php
        // Display success message if deletion was successful
        if($deleteSuccess) {
            echo "<div class='alert alert-success' role='alert'>Demo removed successfully</div>";
        }
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Demo ID</th>
                    <th>User ID</th>
                    <th>Product ID</th>
                    <th>Demo Date</th>
                    <th>Status</th>
                    <th>Actions</th> <!-- New column for buttons -->
                </tr>
            </thead>
            <tbody>
                <?php
                // Prepare and execute query
                $sql = "SELECT * FROM book_demo";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["demo_id"] . "</td>";
                        echo "<td>" . $row["user_id"] . "</td>";
                        echo "<td>" . $row["product_id"] . "</td>";
                        echo "<td>" . $row["demo_date"] . "</td>";
                        echo "<td>" . $row["status"] . "</td>";
                        echo "<td>"; // Start actions column
                        echo "<button class='btn btn-success btn-confirm' data-demo-id='" . $row["demo_id"] . "'>Confirm</button>";
                        echo "&nbsp;"; // Add some space between buttons
                        echo "<button class='btn btn-danger btn-remove' data-demo-id='" . $row["demo_id"] . "'>Remove</button>";
                        echo "</td>"; // End actions column
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No demo bookings found</td></tr>";
                }

                // Close connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function(){
            // Handle Confirm button click
            $(document).on("click", ".btn-confirm", function(){
                var demo_id = $(this).data("demo-id");
                $.post("confirm_demo.php", {demo_id: demo_id}, function(data){
                    // Update status field on success
                    alert(data);
                    location.reload(); // Reload the page to reflect changes
                });
            });

            // Handle Remove button click
            $(document).on("click", ".btn-remove", function(){
                var demo_id = $(this).data("demo-id");
                if(confirm("Are you sure you want to remove this demo?")) {
                    $.post("", {remove_demo: true, demo_id: demo_id}, function(data){
                        // Display alert message returned from PHP script
                        alert(data);
                        if(data.includes("successfully")) {
                            location.reload(); // Reload the page only if deletion was successful
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
