<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

include("./include/connection.php");


$fromDate = $toDate = "";


if (isset($_GET['from_date']) && isset($_GET['to_date'])) {

    $fromDate = $_GET['from_date'];
    $toDate = $_GET['to_date'];

    $sql = "SELECT 
                bd.demo_id, 
                bd.user_id, 
                u.first_name, 
                u.last_name, 
                u.address, 
                u.phone_number, 
                bd.product_id, 
                p.vendor_id, 
                v.company_name, 
                p.img1, 
                p.name AS product_name, 
                bd.demo_date,
                bd.Application_date,
                bd.status
            FROM 
                book_demo bd 
            INNER JOIN 
                users u ON bd.user_id = u.user_id 
            INNER JOIN 
                products p ON bd.product_id = p.product_id
            INNER JOIN 
                vendors v ON p.vendor_id = v.vendor_id
            WHERE 
                bd.demo_date BETWEEN '$fromDate' AND '$toDate'";
} else {
    $sql = "SELECT 
                bd.demo_id, 
                bd.user_id, 
                u.first_name, 
                u.last_name, 
                u.address, 
                u.phone_number, 
                bd.product_id, 
                p.vendor_id, 
                v.company_name, 
                p.img1, 
                p.name AS product_name, 
                bd.demo_date,
                bd.Application_date,
                bd.status
            FROM 
                book_demo bd 
            INNER JOIN 
                users u ON bd.user_id = u.user_id 
            INNER JOIN 
                products p ON bd.product_id = p.product_id
            INNER JOIN 
                vendors v ON p.vendor_id = v.vendor_id";
}

$result = $conn->query($sql);

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
    <?php include("./include/navbar.php"); ?>

    <div class="container mt-5">
        <h2>Book Demo Data</h2>
      
        <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="fromDate">From Date:</label>
                    <input type="date" class="form-control" id="fromDate" name="from_date" value="<?php echo $fromDate; ?>" max="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="toDate">To Date:</label>
                    <input type="date" class="form-control" id="toDate" name="to_date" value="<?php echo $toDate; ?>" max="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="form-group col-md-4 align-self-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        <table class="table">
            <thead style="background-color: #5F1E30;">
                <tr style="color: wheat;">
                    <th>Demo ID</th>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Product ID</th>
                    <th>Vendor ID</th>
                    <th>Company Name</th>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Demo Date</th>
                    <th>Application Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result === false) {
                    echo "<tr><td colspan='14'>Error: " . $conn->error . "</td></tr>";
                } else {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["demo_id"] . "</td>";
                            echo "<td>" . $row["user_id"] . "</td>";
                            echo "<td>" . $row["first_name"] . " " . $row["last_name"] . "</td>";
                            echo "<td>" . $row["address"] . "</td>";
                            echo "<td>" . $row["phone_number"] . "</td>";
                            echo "<td>" . $row["product_id"] . "</td>";
                            echo "<td>" . $row["vendor_id"] . "</td>";
                            echo "<td>" . $row["company_name"] . "</td>";
                            echo "<td><img src='../Vendor/" . $row["img1"] . "' height='50' width='50'></td>";
                            echo "<td>" . $row["product_name"] . "</td>";
                            echo "<td>" . $row["demo_date"] . "</td>";
                            echo "<td>" . $row["Application_date"] . "</td>";
                            echo "<td>";
                            echo "<button class='btn btn-danger btn-sm' onclick='removeDemo(" . $row["demo_id"] . ")'>Remove</button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='14'>No records found</td></tr>"; 
                    }
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function removeDemo(demoId) {
            if (confirm("Are you sure you want to remove this demo?")) {
               
                $.ajax({
                    url: 'remove_demo.php',
                    type: 'POST',
                    data: {
                        demo_id: demoId
                    },
                    success: function(response) {
                        alert('Demo removed successfully');
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        alert('Error removing demo');
                    }
                });
            }
        }
    </script>
</body>
</html>
