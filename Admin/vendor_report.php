<?php
session_start();

if(!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

?>


<?php
include("./include/connection.php");

// Initialize an empty variable to store the table HTML
$table_output = '';

// Fetch all vendors from the database
$sql_vendors = "SELECT DISTINCT p.vendor_id, v.company_name
                FROM products p
                INNER JOIN vendors v ON p.vendor_id = v.vendor_id";
$result_vendors = $conn->query($sql_vendors);

// Check for query execution error
if ($result_vendors === false) {
    // Handle query error
    echo "Error fetching vendors: " . $conn->error;
} else {
    // Initialize an empty array to store vendor options
    $vendor_options = [];

    // Store vendor options in the array
    if ($result_vendors->num_rows > 0) {
        while ($row_vendor = $result_vendors->fetch_assoc()) {
            $vendor_options[] = $row_vendor;
        }
    } else {
        echo "No vendors found";
    }

    // Check if form is submitted with dates and a vendor ID
    if(isset($_POST['from_date']) && isset($_POST['to_date'])) {
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];
        
        // Check if specific vendor or all vendors is selected
        if($_POST['vendor_id'] == 'all') {
            // Query to fetch sales report for all vendors
            $sql = "SELECT p.vendor_id, v.company_name, SUM(oi.quantity) AS total_quantity
                    FROM order_items oi
                    INNER JOIN products p ON oi.product_id = p.product_id
                    INNER JOIN orders o ON oi.order_id = o.order_id
                    INNER JOIN vendors v ON p.vendor_id = v.vendor_id
                    WHERE o.order_date BETWEEN '$from_date' AND '$to_date'
                    GROUP BY p.vendor_id";
        } else {
            // Specific vendor selected, query only for that vendor
            $vendor_id = $_POST['vendor_id'];
            $sql = "SELECT p.vendor_id, v.company_name, SUM(oi.quantity) AS total_quantity
                    FROM order_items oi
                    INNER JOIN products p ON oi.product_id = p.product_id
                    INNER JOIN orders o ON oi.order_id = o.order_id
                    INNER JOIN vendors v ON p.vendor_id = v.vendor_id
                    WHERE o.order_date BETWEEN '$from_date' AND '$to_date'
                    AND p.vendor_id = $vendor_id
                    GROUP BY p.vendor_id";
        }

        $result = $conn->query($sql);

        if ($result === false) {
            // Handle query error
            echo "Error: " . $conn->error;
        } elseif ($result->num_rows > 0) {
            // Start building the table
            $table_output .= '<table class="table">
                                <thead>
                                    <tr>
                                        <th>Vendor ID</th>
                                        <th>Vendor Company</th>
                                        <th>Total Quantity Sold</th>
                                    </tr>
                                </thead>
                                <tbody>';

            // Output data of each row
            while($row = $result->fetch_assoc()) {
                $table_output .= '<tr>
                                    <td>' . $row["vendor_id"] . '</td>
                                    <td>' . $row["company_name"] . '</td>
                                    <td>' . $row["total_quantity"] . '</td>
                                </tr>';
            }

            // Close the table
            $table_output .= '</tbody></table>';
        } else {
            $table_output = '<p>No results found</p>';
        }
    }
}

// Close connection
$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Vendor Sales Report</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .form-group {
            margin-bottom: 0; /* Remove bottom margin to align inputs in a single line */
        }
    </style>
</head>
<body>
<?php

include("./include/navbar.php");
?>
<div class="container mt-5">
    <h2>Vendor Sales Report</h2>
    <form method="post">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="vendor">Select Vendor:</label>
                    <select class="form-control" id="vendor" name="vendor_id">
                        <option value="all">All Vendors</option>
                        <?php
                        // Display options for each vendor
                        foreach($vendor_options as $vendor) {
                            echo '<option value="' . $vendor["vendor_id"] . '">' . $vendor["company_name"] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="from_date">From Date:</label>
                    <input type="date" class="form-control" id="from_date" name="from_date" max="<?php echo date('Y-m-d'); ?>" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="to_date">To Date:</label>
                    <input type="date" class="form-control" id="to_date" name="to_date" max="<?php echo date('Y-m-d'); ?>" required>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Generate Report</button>
                <a href="vendor_report_pdf.php?from_date=<?php echo urlencode($_POST['from_date'] ?? ''); ?>&to_date=<?php echo urlencode($_POST['to_date'] ?? ''); ?>&vendor_id=<?php echo urlencode($_POST['vendor_id'] ?? ''); ?>" class="btn btn-success ml-2" target="_blank">Generate PDF</a>
            </div>
        </div>
    </form>
    
    <!-- Display the table -->
    <?php echo $table_output; ?>
</div>

</body>
</html>
