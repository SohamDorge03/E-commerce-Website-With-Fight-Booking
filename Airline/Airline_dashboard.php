<?php


include("./navbar.php");
include("./connection.php");

if(isset($_SESSION['airline_name'])) {
    $customer_name = $_SESSION['airline_name'];
} else {
    // Redirect to login page if session variable is not set
    header("Location: log.php");
    exit();
}
?>

<div class="height-60">
    <h4>Welcome, <?php echo $customer_name; ?></h4> <!-- Displaying the customer name -->
</div>
