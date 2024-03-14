<?php

require("./stripe-php-master/init.php");
$Publishablekey = "pk_test_51OshcYDwlRClWlNgaIrilFCEEDVPyO9oVTHps5V7q32KDcSFzWl0Wq68Jk1XGpRxDoOiMKOTXKvyMYbTl3VEJSAJ00DpITSQU1";
$Secretkey="sk_test_51OshcYDwlRClWlNggV46yeHPYFCUI43Y9t6grzly250wYHBaUGAKux8qygCO58YMYTMNXxSztq1Ibcl2boaCqZYf00dmSowxfj";

\Stripe\Stripe::setApiKey($Secretkey);
?>
