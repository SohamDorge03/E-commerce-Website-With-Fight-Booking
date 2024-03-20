<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopFlix Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
  
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

      

        a {
            text-decoration: none;
        }

        /* Minimalistic Scrollbar */
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
            overflow-y: auto; /* Enable vertical scrolling */
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
        a{
            text-decoration: none !important;
        }
    </style>
</head>

<body id="body-pd ">
    <header class="header" id="header">
        <div class="header_logo">
            <div class="header_img">
                <img src="https://i.imgur.com/hczKIze.jpg" alt="ShopFlix Logo">
            </div>
            <div class="header_title ">ShopFlix Admin</div>
        </div>
    </header>

    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <div class="nav_logo">
                    <i class="fas fa-store nav_logo-icon"></i>
                    <span class="nav_logo-name">ShopFlix Vendors</span>
                </div>
                <div class="nav_list">
                    <a href="./d.php" class="nav_link <?php echo basename($_SERVER['PHP_SELF']) == 'd.php' ? 'active' : ''; ?>">
                        <i class="fas fa-th-large nav_icon"></i>
                        <span class="nav_name">Dashboard</span>
                    </a>
            
                    <a href="./pro.php" class="nav_link <?php echo basename($_SERVER['PHP_SELF']) == 'pro.php' ? 'active' : ''; ?>">
                        <i class="fas fa-box nav_icon"></i>
                        <span class="nav_name">Products</span>
                    </a>
                    <a href="./edit.php" class="nav_link <?php echo basename($_SERVER['PHP_SELF']) == 'edit.php' ? 'active' : ''; ?>">
                        <i class="fas fa-box nav_icon"></i>
                        <span class="nav_name">Listings</span>
                    </a>
                    <a href="orders.php" class="nav_link <?php echo basename($_SERVER['PHP_SELF']) == 'orders.php' ? 'active' : ''; ?>">
                        <i class="fas fa-shopping-bag nav_icon"></i>
                        <span class="nav_name">Orders</span>
                    </a>
                  
                    </a>
                    <a href="demo.php" class="nav_link <?php echo basename($_SERVER['PHP_SELF']) == 'demo.php' ? 'active' : ''; ?>">
                        <i class="fas fa-cogs nav_icon"></i>
                        <span class="nav_name">Demos</span>
                    </a>
            
                    <a href="logout.php" class="nav_link <?php echo basename($_SERVER['PHP_SELF']) == 'login.php' ? 'active' : ''; ?>">
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
                // Remove 'active' class from all links
                linkColor.forEach(l => l.classList.remove('active'));

                // Add 'active' class only to the clicked link
                this.classList.add('active');
            }

            linkColor.forEach(l => l.addEventListener('click', colorLink))

            // Your code to run since DOM is loaded and ready
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"> </script>
   
</body>

</html>
