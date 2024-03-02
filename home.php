<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ShopFlix - Your Online Shopping Destination</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Adjust carousel height and image size */
        #carouselExampleIndicators {
            max-height: 500px; /* Adjust the max-height as needed */
        }

        .carousel-item img {
            object-fit: cover;
            max-height: 500px; /* Adjust the max-height as needed */
        }

        /* Adjust carousel size */
        .carousel-inner {
            max-width: 100%; /* Adjust the max-width as needed */
            margin: auto; /* Center the carousel */
        }

        .carousel-caption {
            color: #000000;
        }

        .carousel-indicators li {
            background-color: #000000;
        }
        .carousel-indicators .active {
            background-color: #ffffff;
        }

        /* Style for product cards */
        .card {
            margin-bottom: 30px;
        }
        .card img {
            max-height: 250px;
            object-fit: cover;
        }

        /* Style for footer */
        footer {
            background-color: blue;
            color: #ffffff;
            padding: 40px 0;
        }
        footer a {
            color: #ffffff;
        }
        /* Custom Navbar Styling */
        .navbar-brand {
            font-size: 1.5rem;
        }
        .navbar-nav .nav-link {
            font-size: 1.2rem;
            color: #ffffff;
        }

        .navbar-nav .nav-link:hover {
            color: #ffffff;
        }

        /* Responsive Navbar */
        @media (max-width: 992px) {
            .navbar-nav .nav-link {
                font-size: 1rem;
            }
        }

        /* Search Bar Styling */
        .search-form {
            position: relative;
        }

        .search-input {
            padding-right: 40px; /* Adjust as needed */
        }

        .search-button {
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            width: 40px;
            border: none;
            background-color: transparent;
            color: #6c757d;
            cursor: pointer;
        }

        /* Social Media Icons in Footer */
        .social-icons {
            font-size: 1.5rem;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">☰ ShopFlix</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Electronics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Furniture</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Gym Equipment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Book Flights</a>
                    </li>
                  </ul>
                <form class="form-inline my-2 my-lg-0 search-form">
                    <input class="form-control mr-sm-2 search-input" type="search" placeholder="Search"
                        aria-label="Search">
                    <button class="btn btn-outline-light my-2 my-sm-0 search-button" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                <a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i> Cart</a>
                <a class="nav-link" href="login.php"><i class="fas fa-user"></i> Login</a>
            </div>
        </div>
    </nav>

    <section id="carouselSection">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="./images/nothing3.webp" alt="First slide">
                    <div class="carousel-caption d-none d-md-block">
                        <!-- <h5>Explore Our Latest Products</h5>
                        <p>Find the best deals on the latest products.</p> -->
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="./images/iphon.webp" alt="Second slide">
                    <div class="carousel-caption d-none d-md-block">
                        <!-- <h5>Electronics Sale</h5>
                        <p>Get amazing discounts on electronics items.</p> -->
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="./images/flight.webp" alt="Third slide">
                    <div class="carousel-caption d-none d-md-block">
                        <!-- <h5>Travel Essentials</h5>
                        <p>Travel comfortably with our exclusive travel essentials.</p> -->
                    </div>
                </div>
                <!-- Add more carousel items if needed -->
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>

    <section class="container mt-5">
        <h2 class="mb-4">Featured Products</h2>
        <div class="row">
            <!-- Product Card 1 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="product1.jpg" class="card-img-top" alt="Product 1">
                    <div class="card-body">
                        <h5 class="card-title">Product 1</h5>
                        <p class="card-text">Description of Product 1</p>
                        <a href="#" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
            <!-- Product Card 2 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="product2.jpg" class="card-img-top" alt="Product 2">
                    <div class="card-body">
                        <h5 class="card-title">Product 2</h5>
                        <p class="card-text">Description of Product 2</p>
                        <a href="#" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
            <!-- Product Card 3 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="product3.jpg" class="card-img-top" alt="Product 3">
                    <div class="card-body">
                        <h5 class="card-title">Product 3</h5>
                        <p class="card-text">Description of Product 3</p>
                        <a href="#" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
            <!-- Add more product cards here -->
        </div>
    </section>
    <section>

    
    </section>
    <!-- Service 4 - Bootstrap Brain Component -->
<section class="bg-light py-5 py-xl-8">
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-12 col-md-10 col-lg-8 col-xl-7">
        <h3 class="fs-6 mb-2 text-secondary text-center text-uppercase">What We Do?</h3>
        <h2 class="display-5 mb-5 text-center">We are giving you perfect solutions with our proficient services.</h2>
        <hr class="w-50 mx-auto mb-5 mb-xl-9 border-dark-subtle">
      </div>
    </div>
  </div>

  <div class="container overflow-hidden">
    <div class="row gy-4 gy-xl-0">
      <div class="col-12 col-sm-6 col-xl-3">
        <div class="card border-0 border-bottom border-primary shadow-sm">
          <div class="card-body text-center p-4 p-xxl-5">
            <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="currentColor" class="bi bi-chat-text text-primary mb-4" viewBox="0 0 16 16">
              <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z" />
              <path d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zM4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8zm0 2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z" />
            </svg>
            <h4 class="mb-4">Social Engagement</h4>
            <p class="mb-4 text-secondary">We can help you to create and manage social media campaigns that will engage your audience and promote your brand.</p>
            <a href="#!" class="fw-bold text-decoration-none link-primary">
              Learn More
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
              </svg>
            </a>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-xl-3">
        <div class="card border-0 border-bottom border-primary shadow-sm">
          <div class="card-body text-center p-4 p-xxl-5">
            <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="currentColor" class="bi bi-phone-flip text-primary mb-4" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M11 1H5a1 1 0 0 0-1 1v6a.5.5 0 0 1-1 0V2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v6a.5.5 0 0 1-1 0V2a1 1 0 0 0-1-1Zm1 13a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-2a.5.5 0 0 0-1 0v2a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-2a.5.5 0 0 0-1 0v2ZM1.713 7.954a.5.5 0 1 0-.419-.908c-.347.16-.654.348-.882.57C.184 7.842 0 8.139 0 8.5c0 .546.408.94.823 1.201.44.278 1.043.51 1.745.696C3.978 10.773 5.898 11 8 11c.099 0 .197 0 .294-.002l-1.148 1.148a.5.5 0 0 0 .708.708l2-2a.5.5 0 0 0 0-.708l-2-2a.5.5 0 1 0-.708.708l1.145 1.144L8 10c-2.04 0-3.87-.221-5.174-.569-.656-.175-1.151-.374-1.47-.575C1.012 8.639 1 8.506 1 8.5c0-.003 0-.059.112-.17.115-.112.31-.242.6-.376Zm12.993-.908a.5.5 0 0 0-.419.908c.292.134.486.264.6.377.113.11.113.166.113.169 0 .003 0 .065-.13.187-.132.122-.352.26-.677.4-.645.28-1.596.523-2.763.687a.5.5 0 0 0 .14.99c1.212-.17 2.26-.43 3.02-.758.38-.164.713-.357.96-.587.246-.229.45-.537.45-.919 0-.362-.184-.66-.412-.883-.228-.223-.535-.411-.882-.571ZM7.5 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1Z" />
            </svg>
            <h4 class="mb-4">Mobile Design</h4>
            <p class="mb-4 text-secondary">We can help you to design and develop mobile apps and websites that are user-friendly and visually appealing.</p>
            <a href="#!" class="fw-bold text-decoration-none link-primary">
              Learn More
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
              </svg>
            </a>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-xl-3">
        <div class="card border-0 border-bottom border-primary shadow-sm">
          <div class="card-body text-center p-4 p-xxl-5">
            <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="currentColor" class="bi bi-heart-pulse text-primary mb-4" viewBox="0 0 16 16">
              <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053.918 3.995.78 5.323 1.508 7H.43c-2.128-5.697 4.165-8.83 7.394-5.857.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17c3.23-2.974 9.522.159 7.394 5.856h-1.078c.728-1.677.59-3.005.108-3.947C13.486.878 10.4.28 8.717 2.01L8 2.748ZM2.212 10h1.315C4.593 11.183 6.05 12.458 8 13.795c1.949-1.337 3.407-2.612 4.473-3.795h1.315c-1.265 1.566-3.14 3.25-5.788 5-2.648-1.75-4.523-3.434-5.788-5Z" />
              <path d="M10.464 3.314a.5.5 0 0 0-.945.049L7.921 8.956 6.464 5.314a.5.5 0 0 0-.88-.091L3.732 8H.5a.5.5 0 0 0 0 1H4a.5.5 0 0 0 .416-.223l1.473-2.209 1.647 4.118a.5.5 0 0 0 .945-.049l1.598-5.593 1.457 3.642A.5.5 0 0 0 12 9h3.5a.5.5 0 0 0 0-1h-3.162l-1.874-4.686Z" />
            </svg>
            <h4 class="mb-4">SEO Services</h4>
            <p class="mb-4 text-secondary">We can help you to drive organic traffic and outrank competitors with our data-driven SEO strategies and optimize your content.</p>
            <a href="#!" class="fw-bold text-decoration-none link-primary">
              Learn More
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
              </svg>
            </a>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-xl-3">
        <div class="card border-0 border-bottom border-primary shadow-sm">
          <div class="card-body text-center p-4 p-xxl-5">
            <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="currentColor" class="bi bi-mouse text-primary mb-4" viewBox="0 0 16 16">
              <path d="M8 3a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 3zm4 8a4 4 0 0 1-8 0V5a4 4 0 1 1 8 0v6zM8 0a5 5 0 0 0-5 5v6a5 5 0 0 0 10 0V5a5 5 0 0 0-5-5z" />
            </svg>
            <h4 class="mb-4">24/7 Support</h4>
            <p class="mb-4 text-secondary">We offer 24/7 support to our clients. This means that you can always get help when you need it, no matter what time it is.</p>
            <a href="#!" class="fw-bold text-decoration-none link-primary">
              Learn More
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
              </svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

    <footer class="bg-dark text-white text-center text-lg-start">
        <div class="container p-4">
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase">ShopFlix</h5>
                    <p>
                        Your one-stop destination for online shopping.
                    </p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Useful Links</h5>
                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="#!" class="text-white">Feedback</a>
                        </li>
                        <li>
                            <a href="#!" class="text-white">Become a Seller</a>
                        </li>
                        <li>
                            <a href="#!" class="text-white">Contact Us</a>
                        </li>
                        <li>
                            <a href="#!" class="text-white">About Us</a>
                        </li>
                        <li>
                            <a href="#!" class="text-white">Login</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Follow Us</h5>
                    <ul class="list-unstyled mb-0 social-icons">
                        <li>
                            <a href="#!" class="text-white"><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li>
                            <a href="#!" class="text-white"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#!" class="text-white"><i class="fab fa-instagram"></i></a>
                        </li>
                        <li>
                            <a href="#!" class="text-white"><i class="fab fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            © 2024 All rights reserved: <a class="text-white" href="#">ShopFlix.com</a>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Font Awesome for the shopping cart icon -->
    <script src="https://kit.fontawesome.com/your-font-awesome-kit-id.js" crossorigin="anonymous"></script>

</body>

</html>
