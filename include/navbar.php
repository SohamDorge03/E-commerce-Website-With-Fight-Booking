<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Shopflix</title>
    <!-- Add Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            transition: background-color 0.3s ease;
        }
        
        .container {
            display: flex;
            margin: 0;
            padding: 0;
        }
        .sidebar {
            width: 250px;
            background-color: #44688f;
            color: #fff;
            height: 100vh;
            overflow-y: auto;
            padding-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
            transform: translateX(0);
        }
        .sidebar.hide {
            transform: translateX(-100%);
            width: 0;
            transition: width 0.3s ease;
        }
        .sidebar h2 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }
        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .sidebar ul li {
            margin-bottom: 10px;
        }
        .sidebar ul li a {
            display: block;
            padding: 10px;
            color: #fff;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .sidebar ul li a i {
            margin-right: 10px;
        }
        .sidebar ul li a:hover {
            background-color: #5c87b7;
        }
        main {
            flex: 1;
            background-color: #fff;
            transition: margin-left 0.3s ease;
        }
        main.full-width {
            margin-left: 0;
        }
        header {
            background-color: #44688f;
            color: #fff;
            padding: 20px;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }
        header h1 {
            margin: 0;
            font-size: 24px;
        }
        header .menu-toggle {
            color: #fff;
            font-size: 24px;
            cursor: pointer;
            padding-right: 20px;
        }
        @media only screen and (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                height: auto;
                transform: translateX(-100%);
                position: absolute;
                z-index: 1;
            }
            .sidebar.hide {
                transform: translateX(0);
            }
            main {
                margin-left: 0;
            }
            main.full-width {
                margin-left: 0;
            }
            header {
                position: fixed;
                width: 100%;
                z-index: 2;
            }
        }
    </style>
    </head>
<body>
    <div class="container">
        <div class="sidebar">
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
        <main>
            <header>
                <div class="menu-toggle" id="menu-toggle">&#9776;</div>
                <h1>Welcome to Shopflix Admin Dashboard</h1>
               
            </header>
            <div class="content">
            
            </div>
        </main>
        <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('hide');
            document.querySelector('main').classList.toggle('full-width');
        });
    </script>
</body>
</html>