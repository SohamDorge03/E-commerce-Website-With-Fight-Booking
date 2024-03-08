<?php
include("./include/navbar.php");
include("./include/connection.php");

// Check if a POST request is made and demo_id is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["demo_id"])) {
    $demoId = $_POST["demo_id"];
    
    // Delete the demo from the database
    $sql = "DELETE FROM book_demo WHERE demo_id = $demoId";
    
    if ($conn->query($sql) === TRUE) {
        echo "Demo removed successfully";
    } else {
        echo "Error removing demo: " . $conn->error;
    }
    
    $conn->close();
    exit; // Terminate script execution after handling the AJAX request
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Demo Data</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container{
            margin-top: 70px !important;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2>Book Demo Data</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Demo ID</th>
                <th>User ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Product ID</th>
                <th>Vendor ID</th>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Demo Date</th>
                <th>Application_date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // SQL query
            $sql = "SELECT 
                        bd.demo_id, 
                        bd.user_id, 
                        u.first_name, 
                        u.last_name, 
                        u.address, 
                        u.phone_number, 
                        bd.product_id, 
                        p.vendor_id, 
                        p.img1, 
                        p.name AS name, 
                        bd.demo_date,
                        bd.Application_date, 
                        bd.status 
                    FROM 
                        book_demo bd 
                    INNER JOIN 
                        users u ON bd.user_id = u.user_id 
                    INNER JOIN 
                        products p ON bd.product_id = p.product_id";

            $result = $conn->query($sql);

            if ($result === false) {
                // Handle query error
                echo "Error: " . $conn->error;
            } else {
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["demo_id"] . "</td>";
                        echo "<td>" . $row["user_id"] . "</td>";
                        echo "<td>" . $row["first_name"] . " " . $row["last_name"] . "</td>";
                        echo "<td>" . $row["address"] . "</td>";
                        echo "<td>" . $row["phone_number"] . "</td>";
                        echo "<td>" . $row["product_id"] . "</td>";
                        echo "<td>" . $row["vendor_id"] . "</td>";
                        echo "<td><img src='../Vendor/" . $row["img1"] . "' height='50' width='50'></td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["demo_date"] . "</td>";
                        echo "<td>" . $row["Application_date"] . "</td>";
                        echo "<td>" . $row["status"] . "</td>";
                        echo "<td>";
                        echo "<button class='btn btn-success confirm-btn' data-demo-id='" . $row["demo_id"] . "'>Confirm</button>";
                        echo "<button class='btn btn-danger remove-btn' data-demo-id='" . $row["demo_id"] . "'>Remove</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='12'>No records found</td></tr>";
                }
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function(){
        // Confirm button click event
        $(".confirm-btn").click(function(){
            var demoId = $(this).data("demo-id");
            // Perform AJAX request to change status and show confirmation message
            $.post("confirm_demo.php", {demo_id: demoId}, function(data){
                alert(data); // Display confirmation message
                location.reload(); // Reload the page to reflect changes
            });
        });

        // Remove button click event
        $(".remove-btn").click(function(){
            var demoId = $(this).data("demo-id");
            // Perform AJAX request to remove data
            $.post("", {demo_id: demoId}, function(data){
                // Display confirmation message or error
                alert(data);
                location.reload(); // Reload the page to reflect changes
            });
        });
    });
</script>

</body>
</html>
