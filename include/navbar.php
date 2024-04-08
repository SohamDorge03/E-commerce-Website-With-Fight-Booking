<?php
session_start();
if (isset($_SESSION['u'])) {
  $user_id = $_SESSION['u'];
} else {
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

  <style>
    html {
      scroll-behavior: smooth;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Arial", sans-serif;
    }

    .section-p1 {
      padding: 30px 60px;
    }

    .section-m1 {
      padding: 30px 0;

    }


    #header,
    #new {

      width: 100%;
      overflow: hidden;
      z-index: 100;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 15px 40px;
      background-color: #fff;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    #new {
      top: 60px;
    }

    #navbar,
    .swanavbar {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .quantity {
      background-color: #3552dc;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #fff;
      position: absolute;
      top: -8px;
      left: 56%;
      padding: 3px 8px;
      font-size: 12px;
    }

    #mobile {
      display: none;
      align-items: center;
    }

    #close {
      display: none;
    }

    #navbar li,
    .swanavbar li {
      list-style: none;
      padding: 0 15px;
      position: relative;
    }

    #navbar li a,
    .swanavbar li a {
      text-decoration: none;
      font-size: 14px;
      font-weight: 600;
      color: #333;
      transition: 10s ease;
    }

    #navbar li a:hover,
    .swanavbar li a:hover,
    #navbar li a.active,
    .swanavbar li a.active {
      color: #088178;
    }

    #navbar li a:hover::after,
    .swanavbar li a:hover::after,
    #navbar li a.active::after,
    .swanavbar li a.active::after {
      content: " ";
      width: 30%;
      height: 2px;
      background: #088178;
      position: absolute;
      bottom: -4px;
      left: 15px;
    }

    #navbar li a,
    .swanavbar .navlink {
      text-decoration: none;
      font-size: 14px;
      font-weight: 600;
      color: #333;
      transition: 50000ms ease;
    }
  </style>
</head>

<body>

  <section id="header" style="padding: 15px 77px;">

    <a href="#" style="text-decoration: none; color: #007eff; font-weight: 700; font-size:30px;">✨ ShopFlix </a>


    <ul id="navbar">
      <style>
        .search-cont {
          display: flex;
          align-items: center;
        }

        .search-input,
        .search-btn {

          padding: 4px;
          margin: 6px;
          font-size: 16px;
          border: 2px solid #ffc107;

        }

        .search-input {
          flex: 1;
        }

        .search-btn {
          background-color: white;
          color: #000;
          border: none;

          cursor: pointer;
        }
      </style>
      <form action="search.php" method="GET">
        <div class="search-cont">
          <input type="text" id="search-input" name="q" class="search-input" placeholder="Search products...">
          <button type="submit" id="search-btn" class="search-btn"><i class="fas fa-search"></i></button>
        </div>
      </form>

      <li><a href="index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Home</a></li>
      <li><a href="shop.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'shop.php' ? 'active' : ''; ?>">Shop</a></li>

      <li><a href="about_us.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'about_us.php' ? 'active' : ''; ?>">About</a></li>
      <li><a href="contact.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>">Contact</a></li>

      </head>

      <body>
        <style>
          .dropdown {
            position: relative;
            display: inline-block;

          }
          .dropdown-toggle{
            font-weight: bold !important;
          }

          .dropdown-content {
            display: none;
            position: fixed;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 180;
            top: 63px;
          }

          .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none !important;
            display: block;
          }

          .dropdown-content a:hover {
            background-color: #ddd;
          }

          .dropdown.show .dropdown-content {
            display: block;
  
          }

          #loginDropdown.show {
            color: blue;

          }
        </style>


        <?php
        include('connection.php');
        ?>
        <?php
        if (isset($_SESSION['u'])) {
          echo '<li><a href="logout.php" class="btn">log out</a></li>';
        } else {
          echo '
            <div class="dropdown">
                <button class="btn dropdown-toggle" id="loginDropdown" onclick="toggleDropdown()">
                   Login
                </button>
                <div class="dropdown-content" id="dropdownContent">
                    <a href="Vendor/login.php" style="">Vendor Login</a>
                    <a href="Airline/log.php">Airline Login</a>
                    <a href="login.php">User Login</a>
                </div>
            </div>';

          echo '<li style=" margin-left: -20px;   font-weight: 600;"><a href="register.php" class="btn">Regestration </a></li>';
        }

        ?>

        <?php
        if (isset($_SESSION['u'])) {

          $sql_cart_quantity = "SELECT SUM(quantity) AS cart_quantity FROM cart WHERE user_id = $user_id";
          $result_cart_quantity = $conn->query($sql_cart_quantity);

          if ($result_cart_quantity) {
            $row_cart_quantity = $result_cart_quantity->fetch_assoc();
            $cart_quantity = $row_cart_quantity['cart_quantity'];
          } else {

            $cart_quantity = 0;
          }
          echo "<li><a href='cart.php' id='lg-cart' class='btn'><i class='fal fa-shopping-cart'></i></a> <span class='quantity'>" .  $cart_quantity . "</span> </li>   <li><a href='#' id='close'><i class='far fa-times'></i></a></li>";
        } else {
        }
        ?>

    </ul>
    </div>
    <script>
      function toggleDropdown() {
        var dropdownContent = document.getElementById("dropdownContent");
        var loginDropdown = document.getElementById("loginDropdown");
        loginDropdown.classList.toggle("show");
        if (dropdownContent.style.display === "block") {
          dropdownContent.style.display = "none";
        } else {
          dropdownContent.style.display = "block";
        }
      }
    </script>
  </section>

  <section id="new" class="swanavbar" style="padding: 15px 77px;">
    <style>
      .navlink .active {
        color: blue;

      }
    </style>
    <a class="navlink <?php echo basename($_SERVER['PHP_SELF']) == 'electronics.php' ? 'active' : ''; ?>" href="electronics.php">Electronic</a>
    <a class="navlink <?php echo basename($_SERVER['PHP_SELF']) == 'furniture.php' ? 'active' : ''; ?>" href="furniture.php">Furniture</a>
    <a class="navlink <?php echo basename($_SERVER['PHP_SELF']) == 'gym.php' ? 'active' : ''; ?>" href="gym.php">Gym tools</a>
    <a class="navlink <?php echo basename($_SERVER['PHP_SELF']) == 'search_flight.php' ? 'active' : ''; ?>" href="search_flight.php">Book a Flight</a>
    <a class="navlink <?php echo basename($_SERVER['PHP_SELF']) == 'trading_products.php' ? 'active' : ''; ?>" href="trading_products.php">Tranding products</a>
    <a class="navlink <?php echo basename($_SERVER['PHP_SELF']) == 'feedback.php' ? 'active' : ''; ?>" href="feedback.php">Feedback</a>
    <a class="navlink <?php echo basename($_SERVER['PHP_SELF']) == 'book_demo.php' ? 'active' : ''; ?>" href="book_demo.php">Book a demo</a>
    <a class="navlink <?php echo basename($_SERVER['PHP_SELF']) == 'request_airline.php' ? 'active' : ''; ?>" href="request_airline.php">Request airline</a>
    <a class="navlink <?php echo basename($_SERVER['PHP_SELF']) == 'report.php' ? 'active' : ''; ?>" href="report.php">Report issues</a>
  </section>

  <script>
    function toggleDropdown() {
      var dropdownContent = document.getElementById("dropdownContent");
      var loginDropdown = document.getElementById("loginDropdown");
      loginDropdown.classList.toggle("show");
      if (dropdownContent.style.display === "block") {
        dropdownContent.style.display = "none";
      } else {
        dropdownContent.style.display = "block";
      }
    }


    window.onclick = function(event) {
      if (!event.target.matches('.btn.dropdown-toggle')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }
  </script>


</body>

</html>