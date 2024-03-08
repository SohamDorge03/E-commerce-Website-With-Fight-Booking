<?php
session_start();
include 'connection.php'; 

// Check if email session variable is set
if(isset($_SESSION['email'])) {
    $user_email = $_SESSION['email'];
    
    // Prepare SQL query
    $sql = "SELECT airline_name FROM airlines WHERE email = '$user_email'";

    $result = $conn->query($sql);

    // Check for errors
    if ($result === false) {
        // Handle query error
        $customer_name = "Error retrieving data";
    } else {
        // Check if any rows were returned
        if ($result->num_rows > 0) {
            // Fetch the row and extract the customer name
            $row = $result->fetch_assoc();
            $customer_name = $row['airline_name'];
        } else {
            // No rows found, set customer name to Guest
            $customer_name = "Guest"; 
        }
    }
} else {
    // Session variable 'email' is not set
    $customer_name = "Not logged in";
}
if(isset($_GET['username'])) {
    $username = $_GET['username'];
} else {
    $username = ""; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="./dash.css">
    <script src="script.js"></script>
</head>

<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="header_img"> <img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> <a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">ShopFlix</span> </a>
                <div class="nav_list"> <a href="Airline_dashboard.php" class="nav_link active"> <i class='bx bx-grid-alt nav_icon'></i>
                        <span class="nav_name">Dashboard</span> </a> <a href="user.php" class="nav_link"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Users</span> </a>
                         <a href="#" class="nav_link"> <i class='bx bx-message-square-detail nav_icon'></i> <span class="nav_name">Airports</span> </a>
                          <a href="Flights.php" class="nav_link"> <i class='bx bx-bookmark nav_icon'></i> <span class="nav_name">Flight's</span> </a> 
                        <a href="#" class="nav_link"> <i class='bx bx-folder nav_icon'></i> <span class="nav_name">bookings</span> </a>
                        <a href="#" class="nav_link"> <i class='bx bx-folder nav_icon'></i> <span class="nav_name">Report's</span> </a>
                </div>
            </div> <a href="log.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> </a>
        </nav>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {

            const showNavbar = (toggleId, navId, bodyId, headerId) => {
                const toggle = document.getElementById(toggleId),
                    nav = document.getElementById(navId),
                    bodypd = document.getElementById(bodyId),
                    headerpd = document.getElementById(headerId)

                // Validate that all variables exist
                if (toggle && nav && bodypd && headerpd) {
                    toggle.addEventListener('click', () => {
                        // show navbar
                        nav.classList.toggle('show')
                        // change icon
                        toggle.classList.toggle('bx-x')
                        // add padding to body
                        bodypd.classList.toggle('body-pd')
                        // add padding to header
                        headerpd.classList.toggle('body-pd')
                    })
                }
            }

            showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

            /*===== LINK ACTIVE =====*/
            const linkColor = document.querySelectorAll('.nav_link')

            function colorLink() {
                if (linkColor) {
                    linkColor.forEach(l => l.classList.remove('active'))
                    this.classList.add('active')
                }
            }
            linkColor.forEach(l => l.addEventListener('click', colorLink))

            // Your code to run since DOM is loaded and ready
        });
    </script>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"> </script>
<!--Container Main end-->

</html>
