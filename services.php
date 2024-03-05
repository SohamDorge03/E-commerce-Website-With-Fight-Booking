<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Responsive Section Services</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet" />
  <style>
    :root {
  --main-color: #3f51b5;
  --bg-color: #f4f4f4;
  --text-color: #333;
}

* {
  padding: 0;
  margin: 0;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}

body {
  background-color: var(--bg-color);
}

.container {
  width: 100%;
  max-width: 1200px;
  margin: 0 auto;
  padding: 50px 20px;
}

.container h2 {
  text-align: center;
  margin-bottom: 40px;
  font-size: 2.5rem;
  color: var(--main-color);
}

.row {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 30px;
}

.service {
  background-color: #fff;
  padding: 30px;
  border-radius: 10px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  text-align: center;
  transition: all 0.3s ease;
}

.service:hover {
  transform: translateY(-10px);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

.service i {
  display: block;
  font-size: 3rem;
  margin-bottom: 20px;
  color: var(--main-color);
}

.service h3 {
  font-size: 1.8rem;
  margin-bottom: 15px;
  color: var(--text-color);
}

.service p {
  font-size: 1rem;
  color: var(--text-color);
}

    </style>
</head>
<body>
  <div class="container">
    <h2>Our Services</h2>
    <div class="row">
      <div class="service">
        <a href="supp.php">
          <i class="ri-service-fill"></i>
          <h3>24/7 Support</h3>
          <p>Get round-the-clock assistance whenever you need it.</p>
        </a>
      </div>
      <a href="dem.php">
        <div class="service">
          <i class="ri-video-line"></i>
          <h3>Book a Demo</h3>
          <p>Experience our products through personalized demonstrations.</p>
        </div>
      </a>
      <div class="service">
        <i class="ri-refresh-line"></i>
        <h3>Easy Returns</h3>
        <p>Seamlessly return your purchases with our hassle-free process.</p>
      </div>
      <div class="service">
        <i class="ri-shield-user-line"></i>
        <h3>Claim Warranty</h3>
        <p>Secure your purchases with our comprehensive warranty coverage.</p>
      </div>
      <div class="service">
        <i class="ri-chat-smile-3-line"></i>
        <h3>Share Your Feedback</h3>
        <p>Let us know your thoughts and help us improve our services.</p>
      </div>
      <div class="service">
        <i class="ri-star-line"></i>
        <h3>Rate Us Now</h3>
        <p>Share your rating and feedback with us.</p>
      </div>
      <div class="service">
        <i class="ri-settings-4-line"></i>
        <h3>Account Settings</h3>
        <p>Manage your account settings and preferences.</p>
      </div>
      <div class="service">
        <i class="ri-shopping-bag-2-line"></i>
        <h3>Your Orders</h3>
        <p>Track and manage your orders efficiently.</p>
      </div>
    </div>
  </div>
</body>
</html>
