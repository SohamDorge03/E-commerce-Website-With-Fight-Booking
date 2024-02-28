<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ShopFlix - Your Online Shopping Destination</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Add your custom CSS file if you have one -->
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
