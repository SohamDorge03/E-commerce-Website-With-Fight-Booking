<?php
// Include mpdf library
include("admin/vendor/autoload.php");
// Start capturing output into a buffer
ob_start();

// Include your HTML invoice
include 'bill.php';

// Get the captured output
$html = ob_get_contents();

// Close the buffer
ob_end_clean();

// Create mpdf object
$mpdf = new \Mpdf\Mpdf();

// Write HTML to PDF
$mpdf->WriteHTML($html);

// Output the PDF
$mpdf->Output('invoice.pdf', 'D'); // D for download, you can use I for inline display

// Exit to prevent additional output
exit;
?>
