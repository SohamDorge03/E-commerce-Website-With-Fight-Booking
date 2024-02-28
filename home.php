<?php
session_start();

include("./include/connection.php");
?>


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
        #carouselExampleIndicators {
            height: 750px;
        }

        .carousel-item img {
            object-fit: cover;
            height: 760px;
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
    </style>
</head>

<body>
    <?php include("./include/navbar.php"); ?>

    <section id="carouselSection">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="./images/background.png" alt="First slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>First slide label</h5>
                        <p>Some representative placeholder content for the first slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="./Admin/image3/Air Asia.png" alt="Second slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Second slide label</h5>
                        <p>Some representative placeholder content for the second slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="./Admin/image3/IndiGo-Logo.png" alt="Third slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Third slide label</h5>
                        <p>Some representative placeholder content for the third slide.</p>
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


    <section>

    </section>

    <section>
        <h2 style="text-align: center;">Support's</h2>
        <div>
            <i class="fas fa-shipping-fast"></i>
            <h4>Free-Shipping</h4>
            <h6>Free-Shipping On Order Over $100</h6>
        </div>
        <div>
            <i class="fa-solid fa-timer"></i>
            <h4>Support 24/7</h4>
            <h6>Contact us 24 hours a day, 7 days a week</h6>
           
        </div>
        <div>
            <h4>Secure Payment</h4>
            <h6>We Ensure Secure Payment </h6>
        </div>
        <div>
            
            <h4>30 day Returns</h4>
           <h6>
           Simply return it within 30 days for an exchange.
           </h6> 
        </div>
    </section>

    <footer>
        <footer class="text-center text-lg-start text-white" style="background-color: #1c2331">
            <section class="d-flex justify-content-between p-4" style="background-color: #6351ce">
                <!-- Left -->
                <div class="me-5">
                    <span>Get connected with us on social networks:</span>
                </div>
                <!-- Left -->

                <!-- Right -->
                <div>
                    <a href="" class="text-white me-4">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="" class="text-white me-4">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="" class="text-white me-4">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="" class="text-white me-4">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="" class="text-white me-4">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="" class="text-white me-4">
                        <i class="fab fa-github"></i>
                    </a>
                </div>
                <!-- Right -->
            </section>
            <section class="">
                <div class="container text-center text-md-start mt-5">
                    <!-- Grid row -->
                    <div class="row mt-3">
                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                            <!-- Content -->
                            <h6 class="text-uppercase fw-bold">Company name</h6>
                            <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                            <p>
                                Here you can use rows and columns to organize your footer content. Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            </p>
                        </div>

                        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                            <h6 class="text-uppercase fw-bold">Contact</h6>
                            <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                            <p><i class="fas fa-home mr-3"></i> New York, NY 10012, US</p>
                            <p><i class="fas fa-envelope mr-3"></i> info@example.com</p>
                            <p><i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
                            <p><i class="fas fa-print mr-3"></i> + 01 234 567 89</p>
                        </div>

                        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                            <h6 class="text-uppercase fw-bold">Feedback</h6>
                            <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                            <form action="#" method="POST">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control form-control-sm" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control form-control-sm" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="feedback">Feedback</label>
                                    <textarea class="form-control form-control-sm" id="feedback" name="feedback" rows="5" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Submit Feedback</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
                © 2024 Allright:
                <a class="text-white" href="https://mdbootstrap.com/">ShopFlix.com</a>
            </div>
        </footer>

    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Font Awesome for the shopping cart icon -->
    <script src="https://kit.fontawesome.com/your-font-awesome-kit-id.js" crossorigin="anonymous"></script>

</body>

</html>