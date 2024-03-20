<html lang="en">

<head>

  <style>
    /* Option 2: Import via CSS */
    @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css");


    #product1 {
      text-align: center;
    }

    #product1 .pro-container {
      display: flex;
      padding-top: 20px;
      gap: 30px;
      justify-content: center;
      flex-wrap: wrap;
    }

    #product1 .pro {
      width: 23%;
      min-width: 250px;
      padding: 10px 6px;
      border: 1px solid #cce7d0;
      border-radius: 25px;
      cursor: pointer;
      box-shadow: 20px 20px 30px rgba(0, 0, 0, 0.02);
      margin: 15px 0;
      transition: 0.2s ease;
      position: relative;
    }

    #product1 .pro:hover {
      box-shadow: 20px 20px 30px rgba(0, 0, 0, 0.06);
    }

    #product1 .pro img {
      width: 100%;
      border-radius: 20px;
    }

    #product1 .pro .des {
      text-align: start;
      padding: 10px 0;
    }

    #product1 .pro .des span {
      color: #606063;
      font-size: 12px;
    }

    #product1 .pro .des h5 {
      padding-top: 7px;
      color: #1a1a1a;
      font-size: 14px;
    }

    #product1 .pro .des i {
      font-size: 12px;
      color: rgb(243, 181, 25)
    }

    #product1 .pro .des h4 {
      font-size: 15px;
      padding-top: 7px;
      font-weight: 700;
      color: #088178;
    }

    #product1 .pro .cart {
      width: 40px;
      height: 40px;
      line-height: 40px;
      border-radius: 50px;
      background-color: #e8f6ea;
      font-weight: 500;
      color: #088178;
      border: 1px solid #cce7d0;
      position: absolute;
      bottom: 20px;
      right: 10px;
    }
  </style>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopflix Ecommerce Website</title>
  <link rel="stylesheet" href="styles/home.css">
  <script src="https://kit.fontawesome.com/dad03e859c.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Alkatra&family=Berkshire+Swash&family=Comic+Neue:wght@700&family=Gentium+Book+Plus:wght@400;700&family=Lato:ital,wght@0,400;0,700;0,900;1,700&family=Lexend+Deca:wght@500&family=Lexend:wght@500&family=Montserrat:wght@500&family=Open+Sans:wght@500;800&family=Roboto:wght@100;400&family=Sue+Ellen+Francisco&family=Work+Sans:wght@400;700;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Spartan:wght@100;200;300;400;500;600;700;800;900;&display:swap">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


</head>

<body>

  <?php
  include("include/navbar.php");

  ?>

  <div id="carouselExample" class="carousel slide ">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="image/red (1).jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="image/Electro (1).jpg" class="d-block w-100" alt="...">
      </div>

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <section id="feature" class="section-p1">
    <div class="fe-box">
      <img src="./image/sup3.png" alt="">
      <h6>Free Shipping</h6>
    </div>

    <div class="fe-box">
      <img src="./image/on.png" alt="">
      <h6>Online Order</h6>
    </div>

    <div class="fe-box">
      <img src="./image/sa.png" alt="">
      <h6>Save Money</h6>
    </div>

    <div class="fe-box">
      <img src="./image/de.png" alt="">
      <h6>Free Demo booking</h6>
    </div>

    <div class="fe-box">
      <img src="./image/wa.png" alt="">
      <h6>Warrunty Services</h6>
    </div>

    <div class="fe-box">
      <img src="./image/op.png" alt="">
      <h6>F24/7 Support</h6>
    </div>

  </section>
  <section class="products">
    <h1 style="text-align: center;">New Arrival Products</h1>
    <?php
// Display products
include("./include/connection.php");

function displayProducts($sql)
{
    global $conn;
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        echo '<div class="pro-container" style="display: flex; padding-top: 10px; gap: 25px; justify-content: center; flex-wrap: wrap;">';
        while ($row = $result->fetch_assoc()) {
            $productId = $row['product_id'];
            echo '<div class="pro" style="width: 18%; min-width: 250px; padding: 10px 20px; border: 1px solid #cce7d0; border-radius: 25px; cursor: pointer; box-shadow: 20px 20px 30px rgba(0, 0, 0, 0.02); margin: 15px 0; transition: 0.2s ease; position: relative;">';
            echo '<a href="product_details.php?productId=' . $productId . '">';
            echo '<img src="vendor/' . $row['img1'] . '" alt="" height="200px" style="width: 100%; border-radius: 20px;">';
            echo '</a>';
            echo '<div class="des" style="text-align: start; padding: 10px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">';
            echo '<h5 style="padding-top: 7px; color: #1a1a1a; font-size: 14px; overflow: hidden; text-overflow: ellipsis;">' . substr($row['name'], 0, 43) . '</h5>';
            echo '<span class="price" style="font-size: 18px; font-weight: bold; margin-top: 1px;">' . $row['price'] . '</span>';
            echo '<span class="stock" style="font-size: 16px; font-weight: thin; margin-top: 1px; margin-left: 30px; color: green" >In stock  ' . $row['stock_quantity'] . '</span>';
            echo '<p class="description" style="margin-top: 1px; color: #606063; font-size: 12px; overflow: hidden; text-overflow: ellipsis;">' . substr($row['description'], 0, 30) . '...</p>';

          

            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
        echo '<div style="text-align: center; margin-top: 20px; margin-bottom:40px;">';
        echo '<a href="shop.php" class="btn btn-primary">View More <i class="fas fa-arrow-right"></i></a>';
        echo '</div>';
    } else {
        echo 'No products found.';
    }
}

$sql = "SELECT * FROM products ORDER BY product_id DESC LIMIT 9";
displayProducts($sql);
?>
</div>
</div>

  </section>



<section class="GYM tool">
<h1 style="text-align: center;">GYM Tool</h1>


<?php
// Display products
include("./include/connection.php");

function displayProducts1($sql1)
{
    global $conn;
    $result = $conn->query($sql1);
    if ($result && $result->num_rows > 0) {
        echo '<div class="pro-container" style="display: flex; padding-top: 10px; gap: 25px; justify-content: center; flex-wrap: wrap;">';
        while ($row = $result->fetch_assoc()) {
            $productId = $row['product_id'];
            echo '<div class="pro" style="width: 18%; min-width: 250px; padding: 10px 20px; border: 1px solid #cce7d0; border-radius: 25px; cursor: pointer; box-shadow: 20px 20px 30px rgba(0, 0, 0, 0.02); margin: 15px 0; transition: 0.2s ease; position: relative;">';
            echo '<a href="product_details.php?productId=' . $productId . '">';
            echo '<img src="vendor/' . $row['img1'] . '" alt="" height="200px" style="width: 100%; border-radius: 20px;">';
            echo '</a>';
            echo '<div class="des" style="text-align: start; padding: 10px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">';
            echo '<h5 style="padding-top: 7px; color: #1a1a1a; font-size: 14px; overflow: hidden; text-overflow: ellipsis;">' . substr($row['name'], 0, 43) . '</h5>';
            echo '<span class="price" style="font-size: 18px; font-weight: bold; margin-top: 1px;">' . $row['price'] . '</span>';
            echo '<span class="stock" style="font-size: 16px; font-weight: thin; margin-top: 1px; margin-left: 30px; color: green" >In stock  ' . $row['stock_quantity'] . '</span>';
            echo '<p class="description" style="margin-top: 1px; color: #606063; font-size: 12px; overflow: hidden; text-overflow: ellipsis;">' . substr($row['description'], 0, 30) . '...</p>';

            // Check if user is logged in
           

            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
        echo '<div style="text-align: center; margin-top: 20px; margin-bottom:40px;">';
        echo '<a href="gym.php" class="btn btn-primary">View More <i class="fas fa-arrow-right"></i></a>';
        echo '</div>';
    } else {
        echo 'No products found.';
    }
}

$sql1 = "SELECT * FROM products WHERE category_id = 1 limit 5";
displayProducts1($sql1);
?>
</div>
</div>

</section>




<section class="Furniture">
<h1 style="text-align: center;">Furniture</h1>

<?php
// Display products
include("./include/connection.php");

function displayProducts2($sql3)
{
    global $conn;
    $result = $conn->query($sql3);
    if ($result && $result->num_rows > 0) {
        echo '<div class="pro-container" style="display: flex; padding-top: 10px; gap: 25px; justify-content: center; flex-wrap: wrap;">';
        while ($row = $result->fetch_assoc()) {
            $productId = $row['product_id'];
            echo '<div class="pro" style="width: 18%; min-width: 250px; padding: 10px 20px; border: 1px solid #cce7d0; border-radius: 25px; cursor: pointer; box-shadow: 20px 20px 30px rgba(0, 0, 0, 0.02); margin: 15px 0; transition: 0.2s ease; position: relative;">';
            echo '<a href="product_details.php?productId=' . $productId . '">';
            echo '<img src="vendor/' . $row['img1'] . '" alt="" height="200px" style="width: 100%; border-radius: 20px;">';
            echo '</a>';
            echo '<div class="des" style="text-align: start; padding: 10px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">';
            echo '<h5 style="padding-top: 7px; color: #1a1a1a; font-size: 14px; overflow: hidden; text-overflow: ellipsis;">' . substr($row['name'], 0, 43) . '</h5>';
            echo '<span class="price" style="font-size: 18px; font-weight: bold; margin-top: 1px;">' . $row['price'] . '</span>';
            echo '<span class="stock" style="font-size: 16px; font-weight: thin; margin-top: 1px; margin-left: 30px; color: green" >In stock  ' . $row['stock_quantity'] . '</span>';
            echo '<p class="description" style="margin-top: 1px; color: #606063; font-size: 12px; overflow: hidden; text-overflow: ellipsis;">' . substr($row['description'], 0, 30) . '...</p>';

          
            echo '</div>';
            echo '</div>';
        }
        echo '<div style="text-align: center; margin-top: 20px; margin-bottom:40px;">';
        echo '<a href="furniture.php" class="btn btn-primary">View More <i class="fas fa-arrow-right"></i></a>';
        echo '</div>';
    } else {
        echo 'No products found.';
    }
}

$sql3 = "SELECT * FROM products WHERE category_id = 2 limit 5";
displayProducts2($sql3);
?>
</div>
</div>
</section>



  <section class="Electronics">
  <h1 style="text-align: center;">Electronics</h1>
 
  <?php
// Display products
include("./include/connection.php");

function displayProducts3($sql3)
{
    global $conn;
    $result = $conn->query($sql3);
    if ($result && $result->num_rows > 0) {
        echo '<div class="pro-container" style="display: flex; padding-top: 10px; gap: 25px; justify-content: center; flex-wrap: wrap;">';
        while ($row = $result->fetch_assoc()) {
            $productId = $row['product_id'];
            echo '<div class="pro" style="width: 18%; min-width: 250px; padding: 10px 20px; border: 1px solid #cce7d0; border-radius: 25px; cursor: pointer; box-shadow: 20px 20px 30px rgba(0, 0, 0, 0.02); margin: 15px 0; transition: 0.2s ease; position: relative;">';
            echo '<a href="product_details.php?productId=' . $productId . '">';
            echo '<img src="vendor/' . $row['img1'] . '" alt="" height="200px" style="width: 100%; border-radius: 20px;">';
            echo '</a>';
            echo '<div class="des" style="text-align: start; padding: 10px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">';
            echo '<h5 style="padding-top: 7px; color: #1a1a1a; font-size: 14px; overflow: hidden; text-overflow: ellipsis;">' . substr($row['name'], 0, 43) . '</h5>';
            echo '<span class="price" style="font-size: 18px; font-weight: bold; margin-top: 1px;">' . $row['price'] . '</span>';
            echo '<span class="stock" style="font-size: 16px; font-weight: thin; margin-top: 1px; margin-left: 30px; color: green" >In stock  ' . $row['stock_quantity'] . '</span>';
            echo '<p class="description" style="margin-top: 1px; color: #606063; font-size: 12px; overflow: hidden; text-overflow: ellipsis;">' . substr($row['description'], 0, 30) . '...</p>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
        // Add View More button
        echo '<div style="text-align: center; margin-top: 20px; margin-bottom:40px;">';
        echo '<a href="electronics.php" class="btn btn-primary">View More <i class="fas fa-arrow-right"></i></a>';
        echo '</div>';
    } else {
        echo 'No products found.';
    }
}

$sql3 = "SELECT * FROM products WHERE category_id = 3 LIMIT 5";
displayProducts3($sql3);
?>
</div>
</div>

  </section>


  <section style="padding-top: 20px;">
    <div class="container">
        <h1 class="text-center">Supporting Airlines</h1>
        <div class="d-flex justify-content-center align-items-center">
            <?php
            // Include the connection file
            include("include/connection.php");

            // Query to retrieve data from the Airlines table
            $sql = "SELECT * FROM airlines";

            // Execute the query
            $result = $conn->query($sql);

            // Check if there are rows in the result
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    // Display airline logo images
                    echo "<div style='width: 120px; height: 120px; margin: 10px; overflow: hidden;'>";
                    echo "<img src='admin" . $row["logo"] . "' alt='" . $row["airline_name"] . " Logo' style='width: 100%; height: auto;'>";
                    echo "</div>";
                }
            } else {
                // If no airlines are found
                echo "No airlines found.";
            }

            // Close the database connection
            $conn->close();
            ?>
        </div>
    </div>
</section>

  

  <footer class="section-p1">

    <div class="col">
      <!-- <a href="#"><img class="logo" src="https://i.postimg.cc/x8ncvFjr/logo.png"></a> -->
      <h4>Contact</h4>
      <p><strong>Address:<strong>349, Olorilogbon street, Onigbogbo Lagos</p>
      <p><strong>Phone:</strong>+23456876199, +23458903120</p>
      <p><strong>Hours:</strong>10.00 - 18.00, Mon - Sat</p>
      <div class="follow">

        <h4>Follow Us</h4>
        <div class="icon">
          <i class="fab fa-facebook-f"></i>
          <i class="fab fa-instagram"></i>
          <i class="fab fa-twitter"></i>
          <i class="fab fa-youtube"></i>
          <i class="fab fa-pinterest-p"></i>
        </div>
      </div>
    </div>

    <div class="sec">
      <div class="col">
        <h4>About</h4>
        <a href="about_us.php">About Us</a>
        <a href="#">Delivery Information</a>
        <a href="#">Privacy Policy</a>
        <a href="#">Terms and Condition</a>
        <a href="#">Contact Us</a>
      </div>

      <div class="col">
        <h4>My Account</h4>
        <a href="#">Sign In</a>
        <a href="#">View Cart</a>
        <a href="#">My Account</a>
        <a href="#">My Wishlist</a>
        <a href="#">Track my Order</a>
        <a href="#">Help</a>

      </div>

      <div class="col install">
        <p>Secured Payment Gateways</p>
        <img src="https://i.postimg.cc/kgfzqVRW/pay.png" alt="">
      </div>
    </div>

    <div class="coypright">
      <p> © 2023 All rights reserved! made by Shopflix </p>
    </div>

  </footer>



  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


  <script src="script.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script>
function addToCart(productId) {
    var quantity = $('select[name="quantity_' + productId + '"]').val();

    // Store the current scroll position
    var scrollPosition = $(window).scrollTop();

    $.ajax({
        type: "POST",
        url: "add_to_cart.php",
        data: {
            product_id: productId,
            quantity: quantity
        },
        success: function(response) {
            // Reload the content of the main content area
            $('.pro-container').load(window.location.href + ' .pro-container > *');

            // Set the scroll position back to where it was
            $(window).scrollTop(scrollPosition);

            // Show Bootstrap alert
            $('.alert').html('<strong>Success!</strong> Product added to cart.').addClass('alert-success').removeClass('d-none');
        }
    });
}
</script>
</body>

</html>