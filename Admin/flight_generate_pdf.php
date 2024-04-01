<?php
require('vendor/autoload.php');


$from_date = isset($_GET['from_date']) ? $_GET['from_date'] : '';
$to_date = isset($_GET['to_date']) ? $_GET['to_date'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';


include("./include/connection.php");


$sql = "SELECT * FROM booked_flights WHERE 1=1";
if (!empty($from_date) && !empty($to_date)) {
    $sql .= " AND booked_date BETWEEN '$from_date 00:00:00' AND '$to_date 23:59:59'";
}
if (!empty($status)) {
    $sql .= " AND payment_status = '$status'";
}

$res = mysqli_query($conn, $sql);

if (!$res) {
 
    echo "Error: " . mysqli_error($conn);
} elseif (mysqli_num_rows($res) > 0) {
    
    $html = '<style>';
    $html .= '.table { width: 100%; border-collapse: collapse; }';
    $html .= '.table td, .table th { border: 1px solid #ddd; padding: 8px; }';
    $html .= '.table th { background-color: #f2f2f2; }';
    $html .= '</style>';
    $html .= '<table class="table">';
    $html .= '<tr><th>Booking ID</th><th>Flight ID</th><th>User ID</th><th>Take Seats</th><th>Flight Class</th><th>Transaction ID</th><th>Total Amount</th><th>Payment Status</th><th>Booked Date</th></tr>';
    while ($row = mysqli_fetch_assoc($res)) {
        $html .= '<tr>';
        $html .= '<td>' . $row['booking_id'] . '</td>';
        $html .= '<td>' . $row['flight_id'] . '</td>';
        $html .= '<td>' . $row['user_id'] . '</td>';
        $html .= '<td>' . $row['take_seats'] . '</td>';
        $html .= '<td>' . $row['flight_class'] . '</td>';
        $html .= '<td>' . $row['TransactionID'] . '</td>';
        $html .= '<td>' . $row['total_amount'] . '</td>';
        $html .= '<td>' . $row['payment_status'] . '</td>';
        $html .= '<td>' . $row['booked_date'] . '</td>';
        $html .= '</tr>';
    }
    $html .= '</table>';

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($html);
    $file = 'booked_flights_report_' . time() . '.pdf';
    $mpdf->Output($file, 'D');
    exit;
} else {
   
    echo "No data found matching the criteria.";
}


mysqli_close($conn);
?>
