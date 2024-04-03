<?php

include("admin/vendor/autoload.php");
ob_start();


include 'bill.php';

$html = ob_get_contents();

ob_end_clean();

$mpdf = new \Mpdf\Mpdf();

$mpdf->WriteHTML($html);

$mpdf->Output('invoice.pdf', 'D'); 

exit;
?>
