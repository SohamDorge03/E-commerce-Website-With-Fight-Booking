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
    HTML CSSResult Skip Results Iframe
/* Created By : Mohammad Al Hefel */
:root {
  --main-color: #3f51b5;
}
* {
  padding: 0;
  margin: 0;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
.container {
  width: 100%;
  height: 100vh;
  padding: 0 8%;
}
.container h2 {
  text-align: center;
  padding-top: 6%;
  margin-bottom: 60px;
  font-size: 1.8rem;
  font-weight: 600;
  position: relative;
}
.container h2::after {
  content: "";
  position: absolute;
  bottom: -8px;
  left: 50%;
  transform: translateX(-50%);
  width: 100px;
  height: 5px;
  background-color: var(--main-color);
  border-radius: 20px;
}
.row {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 30px;
}
.row .service {
  padding: 25px 15px;
  background: transparent;
  font-size: 15px;
  border-radius: 5px;
  text-align: center;
  cursor: pointer;
  transition: 0.5s;
}
.row .service:hover {
  color: #fff;
  background-color: var(--main-color);
  transform: scale(1.05);
}
.row .service i {
  color: var(--main-color);
  margin-bottom: 20px;
  font-size: 40px;
  transition: 0.5s;
}
.row .service:hover i {
  color: #fff;
}
.row .service h2 {
  font-weight: 600;
  margin-bottom: 20px;
}
  </style>
</head>
<body>
  <section class="container">
    <h2>Our Sevices</h2>
    <div class="row">
      <div class="service">
        <i class="ri-macbook-line"></i>
        <h3>Web Design</h3>
        <p></p>
      </div>
      <div class="service">
        <i class="ri-store-3-line"></i>
        <h3>Marketing</h3>
        <p>.</p>
      </div>
      <div class="service">
        <i class="ri-database-2-line"></i>
        <h3>Data Analysis</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
      </div>
      <div class="service">
        <i class="ri-palette-line"></i>
        <h3>Graphic Design</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
      </div>
      <div class="service">
        <i class="ri-android-line"></i>
        <h3>App Development</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
      </div>
     
    </div>
  </section>
</body>

</html>