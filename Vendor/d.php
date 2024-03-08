<?php
session_start();

// Check if the vendor ID is not set in the session
if (!isset($_SESSION['vendor_id'])) {
 
    header("Location: login.php");
    exit();
}



include './include/connection.php'; 

$customer_name = "";

if(isset($_SESSION['vendor_email'])) {
    $user_email = $_SESSION['vendor_email'];

    $sql = "SELECT username FROM vendors WHERE email = '$user_email'";
    $result = $conn->query($sql);

    if ($result === false) {
      
        $customer_name = "Error retrieving data: " . $conn->error;
    } else {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $customer_name = $row['username'];
        } else {
           
            $customer_name = "Guest"; 
        }
    }
} 
else {

    $customer_name = "Not logged in";
}

$conn->close();
?>

<?php
include('include/navbar.php');
?>

<div class="height-100 bg-light">
    <h4>Welcome, <?php echo $customer_name; ?></h4>
</div>
