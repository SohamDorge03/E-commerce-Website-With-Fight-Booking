<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopFlix Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

        :root {
            --header-height: 3rem;
            --nav-width: 254px;
            --first-color: #387de6;
            --first-color-light: #AFA5D9;
            --white-color: #F7F6FB;
            --body-font: 'poppins', sans-serif;
            --normal-font-size: 16px;
            --z-fixed: 100;
        }

        *,
        ::before,
        ::after {
            box-sizing: border-box;
        }

        body {
            position: relative;
            margin: var(--header-height) 0 0 0;
            padding: 0 1rem;
            font-family: var(--body-font);
            font-size: var(--normal-font-size);
            transition: .5s;
        }

        a {
            text-decoration: none !important;
        }

        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #fff;
            border-radius: 27px;
        }

        ::-webkit-scrollbar-track {
            background-color: #ddd;
        }

        .header {
            width: 100%;
            height: var(--header-height);
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1rem;
            background-color: var(--white-color);
            z-index: var(--z-fixed);
            transition: .5s;
        }
        .header_logo {
            display: flex;
            align-items: center;
        }
        
        .header_img {
            width: 35px;
            height: 35px;
            display: flex;
            justify-content: center;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 1rem;
        }

        .header_img img {
            width: 40px;
        }

        .header_title {
            color: var(--first-color);
            font-weight: 700;
            font-size: 1.5rem;
        }

        .l-navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--nav-width);
            height: 100vh;
            background-color: var(--first-color);
            padding: .5rem 1rem 0 0;
            transition: .5s;
            z-index: var(--z-fixed);
            overflow-y: auto; 
        }

        .nav {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;

        }

        .nav_logo,
        .nav_link {
            display: grid;
            grid-template-columns: max-content max-content;
            align-items: center;
            column-gap: 1.5rem;
            padding: .5rem 0 .5rem 1.5rem;
        }

        .nav_logo {
            margin-bottom: 2rem;
        }

        .nav_logo-icon {
            font-size: 1.25rem;
            color: var(--white-color);
        }

        .nav_logo-name {
            color: var(--white-color);
            font-weight: 700;
        }

        .nav_link {
            position: relative;
            color: var(--first-color-light);
            margin-bottom: 1.5rem;
            transition: .3s;
        }

        .nav_link:hover {
            color: var(--white-color);
        }

        .nav_icon {
            font-size: 1.25rem;
        }

        .body-pd {
            padding-left: calc(var(--nav-width) + 1rem);
        }

        .active {
            color: var(--white-color);
        }

        .active::before {
            content: '';
            position: absolute;
            left: 0;
            width: 2px;
            height: 32px;
            background-color: var(--white-color);
        }

        .height-100 {
            height: 100vh;
        }

        @media screen and (min-width: 768px) {
            body {
                margin: calc(var(--header-height) + 1rem) 0 0 0;
                padding-left: calc(var(--nav-width) + 2rem);
            }

            .header {
                height: calc(var(--header-height) + 1rem);
                padding: 0 2rem 0 calc(var(--nav-width) + 2rem);
            }

            .header_img {
                width: 40px;
                height: 40px;
            }

            .header_img img {
                width: 45px;
            }

            .l-navbar {
                padding: 1rem 1rem 0 0;
            }

            .body-pd {
                padding-left: calc(var(--nav-width) + 1rem);
            }
        }
    </style>
    <script src="script.js"></script>
</head>

<body id="body-pd">
    <header class="header" id="header">
        <div class="header_logo">
            <div class="header_img">
                <img src="https://i.imgur.com/hczKIze.jpg" alt="ShopFlix Logo">
            </div>
            <div class="header_title">ShopFlix Admin</div>
        </div>
    </header>

    <div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <div>
            <div class="nav_logo">
                <i class="fas fa-store nav_logo-icon"></i>
                <span class="nav_logo-name">ShopFlix Admin</span>
            </div>
            <div class="nav_list">
                <a href="dashboard.php" class="nav_link <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>">
                    <i class="fas fa-th-large nav_icon"></i>
                    <span class="nav_name">Dashboard</span>
                </a>
                <a href="Manage_users.php" class="nav_link <?php echo basename($_SERVER['PHP_SELF']) == 'Manage_users.php' ? 'active' : '' ?>">
                    <i class="fas fa-user nav_icon"></i>
                    <span class="nav_name">Users</span>
                </a>
                <a href="cat.php" class="nav_link <?php echo basename($_SERVER['PHP_SELF']) == 'cat.php' ? 'active' : '' ?>">
                    <i class="fas fa-box nav_icon"></i>
                    <span class="nav_name">Category</span>
                </a>
                <a href="product.php" class="nav_link <?php echo basename($_SERVER['PHP_SELF']) == 'product.php' ? 'active' : '' ?>">
                    <i class="fas fa-box nav_icon"></i>
                    <span class="nav_name">Products</span>
                </a>
                <a href="order.php" class="nav_link <?php echo basename($_SERVER['PHP_SELF']) == 'order.php' ? 'active' : '' ?>">
                    <i class="fas fa-shopping-bag nav_icon"></i>
                    <span class="nav_name">Orders</span>
                </a>


                <a href="Demos.php" class="nav_link <?php echo basename($_SERVER['PHP_SELF']) == 'Demos.php' ? 'active' : '' ?>">
                    <i class="fas fa-cogs nav_icon"></i>
                    <span class="nav_name">Demos</span>
                </a>
                <a href="Airport_management.php" class="nav_link <?php echo basename($_SERVER['PHP_SELF']) == 'Airport_management.php' ? 'active' : '' ?>">
                    <i class="fas fa-map nav_icon"></i>
                    <span class="nav_name">Airport</span>
                </a>
                <a href="Airline_management.php" class="nav_link <?php echo basename($_SERVER['PHP_SELF']) == 'Airline_management.php' ? 'active' : '' ?>">
                    <i class="fas fa-plane nav_icon"></i>
                    <span class="nav_name">Airline</span>

                </a>
                <a href="airline_confirm.php" class="nav_link <?php echo basename($_SERVER['PHP_SELF']) == 'airline_confirm.php' ? 'active' : '' ?>">
                    <i class="fas fa-plane nav_icon"></i>
                    <span class="nav_name">Airline Request</span>

                </a>
                <a href="flight_Management.php" class="nav_link <?php echo basename($_SERVER['PHP_SELF']) == 'flight_Management.php' ? 'active' : '' ?>">
                    <i class="fas fa-plane-departure nav_icon"></i>
                    <span class="nav_name">Flights</span>
                </a>
                <a href="manage_booking.php" class="nav_link <?php echo basename($_SERVER['PHP_SELF']) == 'manage_booking.php' ? 'active' : '' ?>">
                    <i class="fas fa-book nav_icon"></i>
                    <span class="nav_name">Booking</span>
                </a>
                <a href="feedback.php" class="nav_link <?php echo basename($_SERVER['PHP_SELF']) == 'feedback.php' ? 'active' : '' ?>">
                    <i class="fas fa-calendar-alt nav_icon"></i>
                    <span class="nav_name">Feedback</span>
                </a>
                <a href="order_report.php" class="nav_link <?php echo basename($_SERVER['PHP_SELF']) == 'order_report.php' ? 'active' : '' ?>">
                    <i class="fas fa-book nav_icon"></i>
                    <span class="nav_name">Order Reports</span>
                </a>
                <a href="vendor_report.php" class="nav_link <?php echo basename($_SERVER['PHP_SELF']) == 'vendor_report.php' ? 'active' : '' ?>">
                    <i class="fas fa-book nav_icon"></i>
                    <span class="nav_name">Vendor Reports</span>
                </a>

                <a href="flight_report.php" class="nav_link <?php echo basename($_SERVER['PHP_SELF']) == 'flight_report.php' ? 'active' : '' ?>">
                    <i class="fas fa-book nav_icon"></i>
                    <span class="nav_name">Booking Reports</span>
                </a>
                <a href="financial_report.php" class="nav_link <?php echo basename($_SERVER['PHP_SELF']) == 'financial_report.php' ? 'active' : '' ?>">
                    <i class="fas fa-book nav_icon"></i>
                    <span class="nav_name">Financial report</span>
                </a>
                <a href="logout.php" class="nav_link <?php echo basename($_SERVER['PHP_SELF']) == 'logout.php' ? 'active' : '' ?>">
                    <i class="fas fa-sign-out-alt nav_icon"></i>
                    <span class="nav_name">Logout</span>
                </a>
            </div>
        </div>
    </nav>
</div>
    <div class="container">
       
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function (event) {

            const showNavbar = (toggleId, navId, bodyId, headerId) => {
                const toggle = document.getElementById(toggleId),
                    nav = document.getElementById(navId),
                    bodypd = document.getElementById(bodyId),
                    headerpd = document.getElementById(headerId)

                
                if (toggle && nav && bodypd && headerpd) {
                    toggle.addEventListener('click', () => {
                     
                        nav.classList.toggle('show')
                     
                        toggle.classList.toggle('bx-x')
                       
                        bodypd.classList.toggle('body-pd')
                        
                        headerpd.classList.toggle('body-pd')
                    })
                }
            }

            showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

            const linkColor = document.querySelectorAll('.nav_link')

            function colorLink() {
                
                linkColor.forEach(l => l.classList.remove('active'));

                
                this.classList.add('active');
            }

            linkColor.forEach(l => l.addEventListener('click', colorLink))

            
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"> </script>
    
</body>

</html>
