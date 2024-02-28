<?php

include("./include/connection.php");
session_start();

$_SESSION = array();

session_destroy();

header("location: login.php");
exit;
?>
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if user_id is not set
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Query to check if the user's email is verified
$emailVerificationQuery = "SELECT confirmed_email FROM users WHERE user_id = $user_id";
$emailVerificationResult = mysqli_query($conn, $emailVerificationQuery);

if ($emailVerificationResult) {
    $row = mysqli_fetch_assoc($emailVerificationResult);

    // If email is not verified, redirect to verification page
    if (!$row['confirmed_email']) {
        header("Location: verify.php");
        exit();
    }
} else {
    echo "Error: " . $emailVerificationQuery . "<br>" . mysqli_error($conn);
}
?>