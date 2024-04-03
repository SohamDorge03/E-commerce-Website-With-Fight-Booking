<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact Us - Shopflix</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    color: #333;
  }

  .container {
    max-width: 800px;
    margin: 50px auto;
    padding: 0 15px;
  }

  h1, h2, h3 {
    color: #333;
  }

  .contact-info {
    margin-bottom: 30px;
  }

  .contact-info h3 {
    font-size: 26px;
    margin-bottom: 10px;
  }

  .contact-info p {
    font-size: 18px;
    margin-bottom: 8px;
  }

  .contact-form {
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
  }

  .form-group {
    margin-bottom: 20px;
  }

  .form-group label {
    font-weight: bold;
  }

  .form-control {
    border-radius: 5px;
  }

  .form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
  }

  .btn-primary {
    background-color: #007bff;
    border-color: #007bff;
  }

  .btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
  }

  .dummy-map {
    width: 100%;
    height: 400px;
    border-radius: 10px;
    margin-top: 30px;
    overflow: hidden;
  }

  .dummy-map img {
    width: 100%;
    height: auto;
    display: block;
  }

  .shopflix-headquarters {
    padding-top: 20px;
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 15px;
    text-align: center;
  }

  .shopflix-address {
    font-size: 20px;
    margin-bottom: 30px;
    text-align: center;
    font-weight: bold;
  }
</style>
</head>
<body>
<?php
include("./include/navbar.php");
?>

<div class="container">
  <h1 class="text-center mb-5">Contact Us</h1>

 
  <div class="row contact-info">
    <div class="col-md-6">
      <h3>Contact Details</h3>
      <p><strong>Address:</strong> Shopflix Headquarter, near Shyam Mandir, Vesu, Surat, Gujarat</p>
      <p><strong>Email:</strong> shopflix420@gmail.com</p>
      <p><strong>Phone:</strong>7623979355</p>
    </div>
    <div class="col-md-6">
      <h3>Business Hours</h3>
      <p><strong>Monday - Friday:</strong> 9:00 AM - 6:00 PM</p>
      <p><strong>Saturday:</strong> 10:00 AM - 4:00 PM</p>
      <p><strong>Sunday:</strong> Closed</p>
    </div>
  </div>

  <!-- Contact Form -->
  <div class="contact-form">
    <h2 class="mb-4">Send Us a Message</h2>
    <form method="post">
      <div class="form-group">
        <label for="name">Your Name:</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
      </div>
      <div class="form-group">
        <label for="email">Your Email:</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
      </div>
      <div class="form-group">
        <label for="message">Message:</label>
        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Enter your message" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary" name="submit">Send Message</button>
    </form>
  </div>

  <!-- Shopflix Headquarters -->
  <div class="shopflix-headquarters">
    Shopflix Headquarter
  </div>


  <div class="dummy-map">
    <img src="./image/map.jpg" alt="Dummy Map Image">
  </div>
  <div class="shopflix-address mt-5">
  Near Shyam Mandir, Vesu, Surat, Gujarat 394210
  </div>
</div>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    include("./include/connection.php");
    $name = $_POST["name"];
    $email = $_POST["email"];
    $description = $_POST["message"];

    $sql = "INSERT INTO contact_us (name, email, description) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sss", $name, $email, $description);
        if ($stmt->execute()) {
            
            echo '<script>alert("Thank you! Your message has been sent successfully.");</script>';
        } else {
           
            echo '<script>alert("Oops! Something went wrong. Please try again later.");</script>';
        }
    } else {
    
        echo '<script>alert("Oops! Something went wrong. Please try again later.");</script>';
    }
    $stmt->close();
    $conn->close();
}
?>
<?php
include("./include/footer.php");
?>

</body>
</html>
