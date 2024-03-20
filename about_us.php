<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>About Us - Shopflix</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    color: #333;
    /* padding-top: 50px; */
    padding-bottom: 50px;
  }

  .container {
    max-width: 800px;
    margin: 0 auto;
  }

  .section-header {
    text-align: center;
    margin-bottom: 50px;
  }

  .section-title {
    font-size: 36px;
    font-weight: bold;
    color: #333;
    margin-bottom: 30px;
  }

  .section-content {
    font-size: 18px;
    line-height: 1.8;
    margin-bottom: 30px;
  }

  .lead {
    font-size: 20px;
    font-weight: bold;
    color: #333;
    margin-bottom: 10px;
  }

  .team-member {
    margin-bottom: 30px;
    text-align: center;
  }

  .team-member img {
    width: 150px;
    height: 150px; /* Set a fixed size for all team member images */
    object-fit: cover;
    border-radius: 50%;
    margin-bottom: 10px;
  }
</style>
</head>
<body>
<?php
include("./include/navbar.php");
?>
<!-- Page Content -->
<div class="container">
  <div class="jumbotron text-center">
    <h1 class="display-4">About Us</h1>
    <p class="lead">Discover more about Shopflix - Your Ultimate Shopping Destination</p>
  </div>

  <!-- Mission and Vision Section -->
  <div class="section-header">
    <h2 class="section-title">Our Mission & Vision</h2>
  </div>
  <div class="section-content">
    <p class="lead">Mission:</p>
    <p>To provide top-quality products and exceptional services, ensuring customer satisfaction and loyalty.</p>
    <p class="lead">Vision:</p>
    <p>To be the preferred online platform, offering a seamless shopping experience and innovative solutions.</p>
  </div>

  <!-- About Shopflix Section -->
  <div class="section-header">
    <h2 class="section-title">About Shopflix</h2>
  </div>
  <div class="section-content">
    <p>Shopflix is your go-to destination for a wide range of products, including electronics, furniture, and gym equipment. With a focus on quality, reliability, and convenience, we strive to make your shopping experience enjoyable and hassle-free.</p>
    <p>Our commitment to excellence extends to our flight booking services, ensuring you have access to seamless travel solutions at competitive prices.</p>
  </div>

  <!-- Team Section -->
  <div class="section-header">
    <h2 class="section-title">Meet Our Team</h2>
  </div>
<!-- Team Section -->
<div class="section-header">
  <h2 class="section-title">Meet Our Team</h2>
</div>
<div class="row">
  <div class="col-md-3">
    <div class="team-member">
      <a href="https://www.linkedin.com/in/bhargavtiwari">
        <img src="b1.jpg" alt="Team Member 1">
      </a>
      <h4>Bhargav Tiwari</h4>
      <p>Founder & CEO</p>
    </div>
  </div>
  <div class="col-md-3">
    <div class="team-member">
      <a href="https://www.linkedin.com/in/soham-dorge">
        <img src="s1.jpg" alt="Team Member 2">
      </a>
      <h4>Soham Dorge</h4>
      <p>Head of Operations</p>
    </div>
  </div>
  <div class="col-md-3">
    <div class="team-member">
      <a href="https://www.linkedin.com/in/yagneshprajapati">
        <img src="y1.jpg" alt="Team Member 3">
      </a>
      <h4>Yagnesh Prajapati</h4>
      <p>CTO</p>
    </div>
  </div>
  <div class="col-md-3">
    <div class="team-member">
      <a href="https://www.linkedin.com/in/vishalsaw">
        <img src="v1.jpg" alt="Team Member 4">
      </a>
      <h4>Vishal Saw</h4>
      <p>Marketing Manager</p>
    </div>
  </div>
</div>


</body>
</html>
