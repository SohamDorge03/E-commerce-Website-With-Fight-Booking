<?php
// Include the mPDF library
require_once __DIR__ . '/vendor/autoload.php';

// Include the database connection file
include("./include/connection.php");

// Initialize an empty variable to store the PDF content
$pdf_content = '';

// Check if the necessary parameters are passed via GET request
if (isset($_GET['from_date']) && isset($_GET['to_date']) && isset($_GET['vendor_id'])) {
    $from_date = $conn->real_escape_string($_GET['from_date']);
    $to_date = $conn->real_escape_string($_GET['to_date']);
    $vendor_id = $conn->real_escape_string($_GET['vendor_id']);

    // Query to fetch vendor sales report for a specific vendor
    if($_GET['vendor_id'] == 'all') {
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
        $vendor_id = $_GET['vendor_id'];
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
        // Initialize mPDF object
        $mpdf = new \Mpdf\Mpdf();

        // Start building the PDF content
        $pdf_content .= '<h1>Vendor Sales Report</h1>';
        $pdf_content .= '<table border="1" cellspacing="0" cellpadding="5">
                            <thead>
                                <tr>
                                    <th>Vendor ID</th>
                                    <th>Vendor Company</th>
                                    <th>Total Quantity Sold</th>
                                </tr>
                            </thead>
                            <tbody>';

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            $pdf_content .= '<tr>
                                <td>' . $row["vendor_id"] . '</td>
                                <td>' . $row["company_name"] . '</td>
                                <td>' . $row["total_quantity"] . '</td>
                            </tr>';
        }

        // Close the table
        $pdf_content .= '</tbody></table>';

        // Write PDF content
        $mpdf->WriteHTML($pdf_content);

        // Output PDF
        $mpdf->Output('vendor_sales_report.pdf', 'D');
    } else {
        echo "No results found";
    }
}

// Close connection
$conn->close();
?>
