<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Clothing Ecommerce Website</title>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Spartan:wght@100;200;300;400;500;600;700;800;900&display=swap");


#feature .fe-box{
  width: 180px;
  text-align: center;
  padding: 25px 15px;
  box-shadow: 20px 20px 34px rgba(0, 0, 0, 0.03);
  border: 1px solid #cce7d0;
  border-radius: 4px;
  margin: 15px 0;
}

#feature .fe-box:hover {
  box-shadow: 10px 10px 54px rgba(70, 62, 221, 0.1);
}

#feature .fe-box h6{
  display: in-block;
  padding: 9px 8px 6px 8px;
  line-height: 1;
  border-radius: 4px;
  color: #088178;
  background-color: #fddde4;
}

#feature .fe-box img{
  width: 100%;
  margin-bottom: 10px;
    
}
  
#feature{
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  
}

#feature .fe-box:nth-child(2) h6{
  background-color: #cdebbc;
}


#feature .fe-box:nth-child(3) h6{
  background-color: #d1e8f2;
}

#feature .fe-box:nth-child(4) h6{
  background-color: #cdd4f8;
}

#feature .fe-box:nth-child(5) h6{
  background-color: #f6dbf6;
}

#feature .fe-box:nth-child(6) h6{
  background-color: #fff2e5;
}

#product1{
  text-align: center;
}

#product1 .pro-container{
    display: flex;
    padding-top: 20px;
    gap: 30px;
    justify-content: center;
    flex-wrap: wrap;
}

#product1 .pro{
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

#product .pro:hover{
   box-shadow: 20px 20px 30px rgba(0, 0, 0, 0.06);
}

#product1 .pro img{
  width: 100%;
  border-radius: 20px;
}

#product1 .pro .des{
  text-align: start;
  padding: 10px 0;
}

#product1 .pro .des span{
  color: #606063;
  font-size: 12px;
}

#product1 .pro .des h5{
  padding-top: 7px;
  color: #1a1a1a;
  font-size: 14px;
}

#product1 .pro .des i{
  font-size: 12px;
  color: rgb(243, 181, 25)
}

#product1 .pro .des h4{
  font-size: 15px;
  padding-top: 7px;
  font-weight: 700;
  color: #088178;
}

#product1 .pro .cart{
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

#banner{
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  background-image: url(ui.jpeg);
  width: 100%;
  height: 40vh;
  background-position: center;
  background-size: cover;
}

#banner h4{
  color: #fff;
  font-size: 16px;
}

#banner h2{
  color: #fff;
  font-size: 30px;
  padding: 10px 0;
}

#banner h2 span{
  color: #ef3636;
  
}

button.normal{
  color: #000;
  padding: 15px 30px;
  font-weight: 400;
  font-size: 14px;
  border-radius: 4px;
  background-color: #fff;
  border: none;
  outline: none;
  transition: 0.2s;
  cursor: pointer;
}

#banner button:hover{
  background-color: #088178;
  color: #fff;
}

#sm-banner .banner-box{
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-start;
  text-align: center;
  background-image: url(boat.jpg);
  min-width: 100px;
  height: 40vh;
  background-position: center;
  background-size: cover;
  padding: 30px
}

#sm-banner .banner-box2{
  background-image: url(https://i.postimg.cc/gJ7FHxHv/b10.jpg)
}

#sm-banner{
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
}

#sm-banner h4{
  color: #fff;
  font-size: 20px;
  font-weight: 300;
}

#sm-banner h2{
  color: #fff;
  font-size: 32px;
  font-weight: 800;
}

#sm-banner span{
  color: #0e0e0e;
  font-size: 16px;
  font-weight: 500;
  padding-bottom: 16px;
}

button.white{
  color: #000;
  padding: 15px 30px;
  font-weight: 400;
  font-size: 14px;
  border-radius: 4px;
  background-color: transparent;
  border: 1px solid #fff;
  outline: none;
  transition: 0.2s;
  cursor: pointer
}

#sm-banner .banner-box:hover button{
  background-color: #088178;
  color: #fff;
  border: 1px solid #088178;
    
}

#banner3{
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  padding: 0 80px;
}

#banner3 .banner-box{
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-start;
  text-align: center;
  background-image: url(https://i.postimg.cc/BQQHKtwh/b7.jpg);
  min-width: 30%;
  height: 30vh;
  background-position: center;
  background-size: cover;
  padding: 30px;
  margin-bottom: 20px
}

#banner3 h2{
  color: #fff;
  font-weight: 900;
  font-size: 22px;
}

#banner3 h3{
  color: #ec544e;
  font-weight: 800;
  font-size: 15px;
}

#banner3 .banner-img2{
  background-image: url(https://i.postimg.cc/SxP6qqdg/b4.jpg)
}

#banner3 .banner-img3{
   background-image: url(https://i.postimg.cc/m2th49nG/b18.jpg)
}

#newsletter  {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  background-image: url(https://i.postimg.cc/R0Bs4qqt/b14.png);
    background-repeat: no-repeat;
    background-position: 20% 30%;
  background-color: #041e42;
}

#newsletter h4{
  color: #fff;
  font-weight: 700;
  font-size: 22px;
}

#newsletter p{
  color: #818ea0;
  font-weight: 600;
  font-size: 14px;
}

#newsletter p span{
  color: #ffbd27;
  }

#newsletter input{
  height: 3.125rem;
  width: 100%;
  font-size: 14px;
  padding: 0 1.25em;
  border: 1px solid transparent;
  border-radius: 4px;
  outline: none;
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
}

#newsletter button{
  background-color: #088178;
  color: #fff;
  white-space: nowrap;

}

#newsletter .form{
  display: flex;
  width: 40%;
  
}

footer {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  position: relative;
}


footer .col{
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  margin-bottom: 20px;
  margin-left: 50px

}

footer .sec{
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;

  
}

footer .logo{
  margin-bottom: 20px;
}

footer h4{
  font-size: 14px;
  padding-bottom: 20px
}

footer p{
  font-size: 13px;
  margin: 0 0 8px 0;
}


footer a{
  font-size: 13px;
  text-decoration: none;
  color: #222;
  margin-bottom: 10px;
}

footer .follow{
  margin-top: 20px
}

footer .follow i{
  color: #465b52;
  padding-right: 5px;
  cursor: pointer;
  
}

footer .follow i:hover, footer a:hover {
  color: #088178;
 
}

footer .install .row img{
  border: 1px solid #088178; 
  border-radius: 6px;
    
}

footer .install img{
  margin: 10px 0 15px 0
}


footer .copyright{
  width: 100%;
  text-align: center
   
}
@media (max-width: 920px) {
  
  .section-p1 {
    padding: 40px 40px  
  }
  
  #navbar{
  display: flex;
  flex-direction: column;   
  align-items: flex-start;
  justify-content: flex-start;
  position: fixed;
  top: 0;
  right: -300px;
  height: 100vh;
  width: 300px;
  background-color: #E3E6F3;
  box-shadow: 0 40px 60px rgba(0, 0, 0, 0.1);
  padding: 80px 0 0 10px;
    transition: 0.3s
    }
  
  #navbar.active{
  right: 0;
}

  #navbar li{
    margin-bottom: 25px
  }
  
  #mobile{
display: flex;
  align-items: center
}
  #mobile i{
    font-size: 32px;
    color: #1a1a1a;
    padding-left: 20px
  }
  body #lg-bag{
    display: none
  }
  
  #close{
  display: initial;
  position: absolute;
  top: -280px;
  left: 20px;
  color: #222;
  font-size: 32px;  
}
  
  #lg-bag{
    display: none
  }
  
  .quantity{
    top: 15px;
  left: 83%;
  }
   
  #hero{
  height: 70vh;
  padding: 0 80px;
  background-position: top 30% right 30%
 }

  #feature {
  justify-content: center;
    
}
  
  #feature .fe-box {
    margin: 15px 15px
  }
  
  #product1 .pro-container{
    justify-content: center
  }
  
  #product1 .pro{
    margin: 15px;
  }
  
  #banner{
    height: 25vh
  }
  
  #sm-banner .banner-box{
    min-width: 100%;
    height: 30vh;
  }
  
  #banner3{
    padding: 0 40px
  }
  
  #banner3 .banner-box{
    width: 28%
  }
  
  #newsletter .form {
    width: 70%
  }
  
}

@media (max-width: 477px) {
  .section-p1{
    padding: 20px
  }
  
  #header{
    padding: 10px 30px;
  }
  
  .quantity{
    top: 7px;
  left: 80%;
  }
  
  #hero{
    padding: 0 20px;
    background-position: 55%;
  }
  
  h2 {
    font-size: 30px
  }
  
  h1{
    font-size: 28px
  }
  
  p{
    line-height: 24px;
    font-size: 10px;
  }
  
  #hero button{
    margin-right: 10px
  }
  
  #feature{
    justify-content: space-between;
  }
  
  #feature .fe-box{
    width: 155px;
    margin: 0 0 15px 0;
  }
  
  #product1 .pro{
    width: 100%
  }
  
  #banner{
    height: 40vh;
  }
  
  #sm-banner .banner-box{
    height: 40vh;
}
  
  #sm-banner .banner-box2 {
    margin-top: 20px;
  }
  
  #banner3{
    padding: 0 20px;
  }
  
  #banner3 .banner-box{
    width: 100%;
  }
  
  #newsletter .form{
    width:  100%
  }
  
  #newsletter{
    padding: 40px 20px;
  }
  
  footer .copyright{
    text-align: start;
  }
}
        </style>
        <link rel="stylesheet" href="style.css">
  <script src="https://kit.fontawesome.com/dad03e859c.js" crossorigin="anonymous"></script>

      <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alkatra&family=Berkshire+Swash&family=Comic+Neue:wght@700&family=Gentium+Book+Plus:wght@400;700&family=Lato:ital,wght@0,400;0,700;0,900;1,700&family=Lexend+Deca:wght@500&family=Lexend:wght@500&family=Montserrat:wght@500&family=Open+Sans:wght@500;800&family=Roboto:wght@100;400&family=Sue+Ellen+Francisco&family=Work+Sans:wght@400;700;900&display=swap" rel="stylesheet">
      
      <link href="https://fonts.googleapis.com/css2?family=Spartan:wght@100;200;300;400;500;600;700;800;900;&display:swap">
       <!----------x---------------Google font --------x----------------->

       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    
   </head>
   <body>

<?php
include("include/navbar.php");
?>
<div id="carouselExample" class="carousel slide ">
<div class="carousel-inner">
<div class="carousel-item active">
  <img src="f2.jpg" class="d-block w-100" alt="...">
</div>
<div class="carousel-item">
  <img src="lap.jpg" class="d-block w-100" alt="...">
</div>
<div class="carousel-item">
  <img src="iphone.jpg" class="d-block w-100" alt="...">
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
<img src="https://i.postimg.cc/PrN2Y6Cv/f1.png" alt="">
<h6>Free Shipping</h6>
</div>

<div class="fe-box">
<img src="https://i.postimg.cc/qvycxW4q/f2.png" alt="">
<h6>Online Order</h6>
</div>

<div class="fe-box">
<img src="https://i.postimg.cc/1Rdphyz4/f3.png" alt="">
<h6>Save Money</h6>
</div>

<div class="fe-box">
<img src="https://i.postimg.cc/GpYc2JFZ/f4.png" alt="">
<h6>Free Demo booking</h6>
</div>

<div class="fe-box">
<img src="https://i.postimg.cc/4yFCwmv6/f5.png" alt="">
<h6>Warrunty Services</h6>
</div>

<div class="fe-box">
<img src="https://i.postimg.cc/gJN1knTC/f6.png" alt="">
<h6>F24/7 Support</h6>
</div>

</section>

<section id="product1" class="section-p1">
<h2>Featured Products</h2>
<p>Summer Collection New Modern Design</p>
<div class="pro-container">
<?php
include("include/connection.php");

// Fetch products from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

// Check if there are products
if ($result->num_rows > 0) {
echo '<div class="pro-container">';

// Loop through each product and generate HTML
while ($row = $result->fetch_assoc()) {
    echo '<div class="pro">';
    echo '<img src="vendor/' . $row['img1'] . '" alt="" height="200px" >';
    echo '<div class="des">';
    echo '<h5>' . $row['name'] . '</h5>';
    echo '<div class="star">';
    echo '<i class="fas fa-star"></i>';
    echo '<i class="fas fa-star"></i>';
    echo '<i class="fas fa-star"></i>';
    echo '<i class="fas fa-star"></i>';
    echo '<i class="fas fa-star"></i>';
    echo '</div>';
    
    // Display discounted price with a strikethrough effect on original price
    if ($row['discount_price'] !== null && $row['discount_price'] < $row['price']) {
        echo '<p class="original-price">$' . $row['price'] . '</p>';
        echo '<p class="discounted-price">$' . $row['discount_price'] . '</p>';
    } else {
        // If no discount, display the regular price
        echo '<p class="price">$' . $row['price'] . '</p>';
    }

    // Display one-line description
    echo '<p class="description">' . substr($row['description'], 0, 50) . '...</p>';

    echo '</div>';
    
    echo '<a href=""><i class="fal fa-shopping-cart cart"></i></a>';
    echo '</div>';
}

echo '</div>';
} else {
echo 'No products found.';
}

// Close the database connection
$conn->close();
?>

</section>

<section id="banner" class="section-m1">
<!-- <h4> Repair Service</h4>
<h2>Up to <span>70% off </span> - All Tshirts and Accessories</h2> -->
<button class="btn normal">Explore more</button>
</section>

<section id="product1" class="section-p1">
<h2>New Arrivals</h2>
<p>Summer Collection New Modern Design</p>
<div class="pro-container">
<div class="pro">
  <img src="we1.jpg" alt="">
  <div class="des">
    <span>adidas</span>
    <h5>Carton Astronault Tshirts</h5>
    <div class="star">
      <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
    </div>
    <h4>$78</h4>
  </div>
  <a href=""><i class="fal fa-shopping-cart cart"></i></a>
</div>


<div class="pro">
  <img src="Designer (29).png" alt="">
  <div class="des">
    <span>adidas</span>
    <h5>Carton Leave Tshirts</h5>
    <div class="star">
      <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
    </div>
    <h4>$78</h4>
  </div>
  <a href=""><i class="fal fa-shopping-cart cart"></i></a>
</div>


<div class="pro">
  <img src="Designer (30).png" alt="">
  <div class="des">
    <span>adidas</span>
    <h5>Rose Multicolor Tshirts</h5>
    <div class="star">
      <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
    </div>
    <h4>$78</h4>
  </div>
  <a href=""><i class="fal fa-shopping-cart cart"></i></a>
</div>


<div class="pro">
  <img src="d2.jpg" alt="">
  <div class="des">
    <span>adidas</span>
    <h5>Pink Flower Tshirts</h5>
    <div class="star">
      <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
    </div>
    <h4>$78</h4>
  </div>
  <a href=""><i class="fal fa-shopping-cart cart"></i></a>
</div>



<div class="pro">
  <img src="https://i.postimg.cc/908J8S4q/n5.jpg" alt="">
  <div class="des">
    <span>adidas</span>
    <h5>Purple Flowering Tshirts</h5>
    <div class="star">
      <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
    </div>
    <h4>$78</h4>
  </div>
  <a href=""><i class="fal fa-shopping-cart cart"></i></a>
</div>



<div class="pro">
  <img src="https://i.postimg.cc/X7r8NsGQ/n7.jpg" alt="">
  <div class="des">
    <span>adidas</span>
    <h5>Short Knicker </h5>
    <div class="star">
      <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
    </div>
    <h4>$78</h4>
  </div>
  <a href=""><i class="fal fa-shopping-cart cart"></i></a>
</div>



<div class="pro">
  <img src="https://i.postimg.cc/JhrH0hYM/n8.jpg" alt="">
  <div class="des">
    <span>adidas</span>
    <h5>2 in 1 Double Routed</h5>
    <div class="star">
      <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
    </div>
    <h4>$78</h4>
  </div>
  <a href=""><i class="fal fa-shopping-cart cart"></i></a>
</div>



<div class="pro">
  <img src="https://i.postimg.cc/2Sq4mytJ/f8.jpg" alt="">
  <div class="des">
    <span>adidas</span>
    <h5>Ash Short</h5>
    <div class="star">
      <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
       <i class="fas fa-star"></i>
    </div>
    <h4>$78</h4>
  </div>
  <a href=""><i class="fal fa-shopping-cart cart"></i></a>
</div>

</div>
</section>

<section id="sm-banner" class="section-p1"> 
<div class="banner-box">
<!-- <h4>crazy deals</h4>
<h2>buy 1 get 1 free</h2> -->
<span>The best classic dress is on sales at cara</span>
<button class="btn white">Learn More</button> 

</div>

<div class="banner-box banner-box2">
<h4>spring/summer</h4>
<h2>upcoming season</h2>
<span>The best classic dress is on sales at cara</span>
<button class="btn white">Collection</button> 

</div>

</section>

<section id="banner3" class="section-p1">
<div class="banner-box">

<h2>SEASONAL SALES</h2>
<h3>Winter Collection -50% OFF</h3>

</div>

<div class="banner-box banner-img2">

<h2>SEASONAL SALES</h2>
<h3>Winter Collection -50% OFF</h3>

</div>

<div class="banner-box banner-img3">

<h2>SEASONAL SALES</h2>
<h3>Winter Collection -50% OFF</h3>

</div>

</section>

<section id="newsletter" class="section-p1">
<div class="newstext">
<h4>Sign Up for Newsletters</h4>
<p>Get Email updates about our latest shop and <span> special offers.</span> </p>
</div>
<div class="form">
<input type="text" placeholder="Your email address">
   <button class="btn normal">Sign Up</button>
</div>

</div>

</section>


<footer class="section-p1">

<div class="col">
<a href="#"><img class="logo" src="https://i.postimg.cc/x8ncvFjr/logo.png"></a>
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
  <a href="#">About Us</a>
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
  <h4>Install App</h4>
  <p>From App Store or Google Play</p>

  <div class="row">
  <img src="https://i.postimg.cc/Y2s5mLdR/app.jpg" alt="">
  <img src="https://i.postimg.cc/7YvyWTS6/play.jpg" alt="">
</div>
<p>Secured Payment Gateways</p>
<img src="https://i.postimg.cc/kgfzqVRW/pay.png" alt="">
   </div>
</div>

<div class="coypright">
  <p> © 2023 All rights reserved! made by Tunrayo </p>
</div>

</footer>



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<script src="script.js"></script>
</body>

</html>