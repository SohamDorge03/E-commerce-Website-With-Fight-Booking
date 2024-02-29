<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Shopflix</title>
    <!-- Add Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        
        </style>
</head>
<body>
    <?php
    include("./include/navbar.php");
    ?>        
            <div id="container">
        <div id="sidebar">
            <h2>Admin Dashboard</h2>
            <ul>
                <li><a href="Manage_users.php"><i class="fas fa-users"></i> Manage Users</a></li>
                <li><a href="manage_products.php"><i class="fas fa-box"></i> Manage Products</a></li>
                <li><a href="manage_orders.php"><i class="fas fa-shopping-cart"></i> Manage Orders</a></li>
                <li><a href="manage_appointments.php"><i class="fas fa-calendar-alt"></i> Manage Appointments</a></li>
                <li><a href="manage_warranty.php"><i class="fas fa-shield-alt"></i> Manage Warranty</a></li>
                <li><a href="manage_demos.php"><i class="fas fa-video"></i> Manage Demos</a></li>
                <li><a href="Airport_Management.php"><i class="fas fa-plane-arrival"></i> Airport Management</a></li>
                <li><a href="Airline_Management.php"><i class="fas fa-plane-departure"></i> Airline Management</a></li>
                <li><a href="manage_flights.php"><i class="fas fa-fighter-jet"></i> Manage Flights</a></li>
                <li><a href="admin_settings.php"><i class="fas fa-cog"></i> Admin Settings</a></li>
                <li><a href="manage_booking.php"><i class="fas fa-cog"></i>manage booking</a></li>
                <div>
                    <li class="menu-item-has-children">
                        <a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i>Logout</a>
                    </li>
                </div>
            </ul>
        </div>
        <div id="main">
            <header id="header">
                <div class="menu-toggle" id="menu-toggle">&#9776;</div>
                <h1>Welcome to Shopflix Admin Dashboard</h1>
            </header>
            <div class="content">
            
            </div>
        </div>
    </div>
</body>
</html>
