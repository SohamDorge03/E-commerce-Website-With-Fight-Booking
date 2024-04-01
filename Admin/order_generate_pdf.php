<?php
require('vendor/autoload.php');


$from_date = isset($_GET['from_date']) ? $_GET['from_date'] : '';
$to_date = isset($_GET['to_date']) ? $_GET['to_date'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';


$con = mysqli_connect('localhost', 'root', '', 'shopflix');

$sql = "SELECT * FROM orders WHERE 1=1";
if (!empty($from_date) && !empty($to_date)) {
    $sql .= " AND order_date BETWEEN '$from_date' AND '$to_date'";
}
if (!empty($status) && $status != "All Details") {
    $sql .= " AND status = '$status'";
}

$res = mysqli_query($con, $sql);

if (mysqli_num_rows($res) > 0) {
    $html = '<style>';
    $html .= '.table { width: 100%; border-collapse: collapse; }';
    $html .= '.table td, .table th { border: 1px solid #ddd; padding: 8px; text-align: center; }'; 
    $html .= '.table th { background-color: #f2f2f2; }';
    $html .= '</style>';
    $html .= '<table class="table">';
    $html .= '<tr><th>Order ID</th><th>User ID</th><th>Order Date</th><th>Status</th><th>Total Amount</th></tr>';
    while ($row = mysqli_fetch_assoc($res)) {
        $html .= '<tr>';
        $html .= '<td>' . $row['order_id'] . '</td>';
        $html .= '<td>' . $row['user_id'] . '</td>';
        $html .= '<td>' . $row['order_date'] . '</td>';
        $html .= '<td>' . $row['status'] . '</td>';
        $html .= '<td>' . $row['total_amount'] . '</td>';
        $html .= '</tr>';
    }
    $html .= '</table>';

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($html);
    $file = 'order_report_' . time() . '.pdf';
    $mpdf->Output($file, 'D');
    exit;
} else {
    echo "Data not found";
}
?>
