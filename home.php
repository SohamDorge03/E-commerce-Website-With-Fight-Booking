<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/4/4a/Amazon_icon.svg" />  -->
     <title>ShopFlix.in</title>

    <!--css file-->
    <link rel="stylesheet" href="./styles/home.css" />

    <!--font awesome-->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    <style>
        /* Footer styles */
        .footer {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            position: relative;
            bottom: 0;
            width: 100%;
        }
        .footer .container {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .footer .social-media a {
            color: #fff;
            text-decoration: none;
            font-size: 20px;
            margin: 0 10px;
        }
        .footer .social-media a:hover {
            color: #ccc;
        }
        .footer p {
            margin: 0;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="container1 container-header">
            <div class="logo-container border-white">
                <!-- <div class="logo">ShopFlix</div> -->
                <span class="logo">Shop</span><span class="logo" style="color:rgb(154, 121, 204)">Flix</span>
                <!-- <span class="dotin">.in</span> -->
            </div>
            <div class="search-container">
                <select class="search-select">
                    <option value="All">All</option>
                    <option value="Electronic">Electronic</option>
                    <option value="Furnitutre">Furnitutre</option>
                    <option value="Gym Equipment">Gym Equipment</option>
                    <option value="Flight Booking">flight Booking</option>
                </select>
                <input type="text" class="search-input" />
                <div class="search-icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>

            </div>
            <div class="cart-container border-white">
                <i class="fa-solid fa-cart-shopping"></i>
                Cart
            </div>
          <a href="login.php" class="logi">Login</a>
        </div>
    </header>

    <!--navigation-->
    <nav class="nav">
        <div class="container container-nav">
            <ul>
                <li class="border-white" id="open-nav-sidebar">
                    <span class="open-nav-slider">
                        <i class="fa-solid fa-bars"></i>
                        All
                    </span>
                </li>
                <li class="border-white"><a href="#">Best Sellers</a></li>
                <li class="border-white"><a href="#">Today's Deals</a></li>
                <li class="border-white"><a href="services.php">Customer Service</a></li>
                <li class="border-white"><a href="./electronics.php">Electronic</a></li>
                <li class="border-white"><a href="./gym.php">Gym Eqipment</a></li>
                <li class="border-white"><a href="./furniture.php">Furniture</a></li>
                <li class="border-white"><a href="../air">Flight Booking</a></li>
                <li class="border-white"><a href="#">About Us</a></li>
                </li>
            </ul>
        </div>
    </nav>
 
    <!-- sidebar navigation -->
    <div class="sidebar-container-navigation" id="sidebar-container-navigation-id">
        <div class="sidebar-left-part">
            <div class="sidebar-top">
                <i class="fa-solid fa-circle-user"></i>
                <h2>Hello, <span>ShopFlix Users</span></h2>
            </div>
            <div class="sidebar-wrap">
                <div class="sidebar-item">
                    <h2>Trending</h2>
                    <p>Best Sellers</p>
                    <p>New Releases</p>
                    <!-- <p>Movers and Shakers</p> -->
                </div>
                <div class="sidebar-item">
                    <h2>Electronic</h2>
                    <p>Washing Machin</p>
                    <p>Smart TV</p>
                    <p>Fridge</p>
                    <p>Microwave</p>
                    <p>Mobile</p>
                </div>
                <div class="sidebar-item">
                    <h2>Furniture</h2>
                    <p>Sofa</p>
                    <p>Chair</p>
                    <p>Bed</p>
                    <p>Table</p>
                </div>
                <div class="sidebar-item">
                    <h2>Gym Eqipment</h2>
                    <p>Dumballes</p>
                    <p>Trademeal</p>
                    <p>skipping rope</p>
                </div>
                <div class="sidebar-item">
                    <h2>Help & Settings</h2>
                    <p>Your Account</p>
                    <p>Customer Service</p>
                    <p>Log Out</p>
                </div>
            </div>
        </div>
        <button id="sidebar-navigation-close">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>




    <!-- image slider -->
    <section style="margin-top:100x;">
        <div class="image-container" style="margin-top: 20x;">
            <div class="image-list">
                <div class="image-item">
                    <img src="https://m.media-amazon.com/images/I/71cp9PVuTfL._SX3000_.jpg" />
                </div>
                <div class="image-item">
                    <img src="https://m.media-amazon.com/images/I/61GnAucagBL._SX3000_.png" />
                </div>
                <div class="image-item">
                    <img src="https://m.media-amazon.com/images/I/71qlKqpJnlL._SX3000_.jpg" />
                </div>
                <div class="image-item">
                    <img src="https://m.media-amazon.com/images/I/71cQMXCLSvL._SX3000_.jpg" />
                </div>
                <div class="image-item">
                    <img src="https://m.media-amazon.com/images/I/61aURrton0L._SX3000_.jpg" />
                </div>
                <div class="image-item">
                    <img src="https://m.media-amazon.com/images/I/61O72XhcEkL._SX3000_.jpg" />
                </div>
                <div class="image-item">
                    <img src="https://m.media-amazon.com/images/I/61VuJdpjvaL._SX3000_.jpg" />
                </div>
                <div class="image-item">
                    <img src="https://m.media-amazon.com/images/I/61UrRx+3LLL._SX3000_.jpg" />
                </div>
            </div>

            <div class="image-btn-container">

                <button class="slider-btn" id="slide-btn-left"><i class="fa-solid fa-chevron-left"></i></button>
                <button class="slider-btn" id="slide-btn-right"><i class="fa-solid fa-chevron-right"></i></i></button>
            </div>
        </div>
    </section>


    product container card
    <main class="main">
        <div class="card-product-container container">
            <div class="card-product">
                <h2>Up to 60% off | Styles for Men</h2>
                <div class="card-product-nested-card">
                    <div class="card-nested">
                        <img
                            src="https://images-eu.ssl-images-amazon.com/images/G/31/img22/Fashion/Gateway/BAU/BTF-Refresh/May/PF_MF/MF-1-186-116._SY116_CB636110853_.jpg" />
                        <p>clothing</p>
                    </div>
                    <div class="card-nested">
                        <img
                            src="https://images-eu.ssl-images-amazon.com/images/G/31/img22/Fashion/Gateway/BAU/BTF-Refresh/May/PF_MF/MF-3-186-116._SY116_CB636110853_.jpg" />
                        <p>Footwear</p>
                    </div>
                    <div class="card-nested">
                        <img
                            src="https://images-eu.ssl-images-amazon.com/images/G/31/img22/BAU/Oct/186X116_3._SY116_CB606110532_.jpg" />
                        <p>Watches</p>
                    </div>
                    <div class="card-nested">
                        <img
                            src="https://images-eu.ssl-images-amazon.com/images/G/31/img22/Fashion/Gateway/BAU/BTF-Refresh/May/PF_MF/MF-4-186-116._SY116_CB636110853_.jpg" />
                        <p>Bags & language</p>
                    </div>
                </div>
                <button class="card-product-btn">see more</button>
            </div>
            <div class="card-product">
                <h2>Redefine your living room</h2>
                <div class="card-product-nested-card">
                    <div class="card-nested">
                        <img
                            src="https://images-eu.ssl-images-amazon.com/images/G/31/IMG20/Furniture/furniture_node_1/372_232_03_low._SY116_CB605507312_.jpg" />
                        <p>Sofa cum beds</p>
                    </div>
                    <div class="card-nested">
                        <img
                            src="https://images-eu.ssl-images-amazon.com/images/G/31/IMG20/Furniture/furniture_node_1/372_232_04_low._SY116_CB605507312_.jpg" />
                        <p>Office chairs & study</p>
                    </div>
                    <div class="card-nested">
                        <img
                            src="https://images-eu.ssl-images-amazon.com/images/G/31/IMG20/Furniture/furniture_node_1/372_232_01_low._SY116_CB605507312_.jpg" />
                        <p>Bean bags</p>
                    </div>
                    <div class="card-nested">
                        <img
                            src="https://images-eu.ssl-images-amazon.com/images/G/31/IMG20/Furniture/furniture_node_1/372_232_02_low._SY116_CB605507312_.jpg" />
                        <p>Explore all</p>
                    </div>
                </div>
                <button class="card-product-btn">Visit our furniture store</button>
            </div>
            <div class="card-product">
                <h2>Top rated, premium quality | Amazon Brands &</h2>
                <div class="card-product-nested-card">
                    <div class="card-nested">
                        <img
                            src="https://images-eu.ssl-images-amazon.com/images/G/31/img22/BAU/Oct/186X116_1._SY116_CB606110532_.jpg" />
                        <p>Home Products</p>
                    </div>
                    <div class="card-nested">
                        <img
                            src="https://images-eu.ssl-images-amazon.com/images/G/31/img22/BAU/Oct/186X116_5._SY116_CB606110532_.jpg" />
                        <p>Furniture</p>
                    </div>
                    <div class="card-nested">
                        <img
                            src="https://images-eu.ssl-images-amazon.com/images/G/31/img22/BAU/Oct/186X116_3._SY116_CB606110532_.jpg" />
                        <p>Daily essentials</p>
                    </div>
                    <div class="card-nested">
                        <img
                            src="https://images-eu.ssl-images-amazon.com/images/G/31/img22/BAU/Oct/186X116_8._SY116_CB606110532_.jpg" />
                        <p>Fashion</p>
                    </div>
                </div>
                <button class="card-product-btn">see more</button>
            </div>
            <div class="card-product">
                <h2>Top rated, premium quality | Amazon Brands &</h2>
                <div class="card-product-nested-card">
                    <div class="card-nested">
                        <img
                            src="https://images-eu.ssl-images-amazon.com/images/G/31/img22/BAU/Oct/186X116_1._SY116_CB606110532_.jpg" />
                        <p>Home Products</p>
                    </div>
                    <div class="card-nested">
                        <img
                            src="https://images-eu.ssl-images-amazon.com/images/G/31/img22/BAU/Oct/186X116_5._SY116_CB606110532_.jpg" />
                        <p>Furniture</p>
                    </div>
                    <div class="card-nested">
                        <img
                            src="https://images-eu.ssl-images-amazon.com/images/G/31/img22/BAU/Oct/186X116_3._SY116_CB606110532_.jpg" />
                        <p>Daily essentials</p>
                    </div>
                    <div class="card-nested">
                        <img
                            src="https://images-eu.ssl-images-amazon.com/images/G/31/img22/BAU/Oct/186X116_8._SY116_CB606110532_.jpg" />
                        <p>Fashion</p>
                    </div>
                </div>
                <button class="card-product-btn">see more</button>
            </div>
        </div>

        <div class="card-product-container container productBackgraound">
            <div class="card-product">
                <h2>Top rated, premium quality | Amazon Brands &</h2>
                <div class="card-product-nested-card">
                    <div class="card-nested">
                        <img
                            src="https://images-eu.ssl-images-amazon.com/images/G/31/img22/BAU/Oct/186X116_1._SY116_CB606110532_.jpg" />
                        <p>Home Products</p>
                    </div>
                    <div class="card-nested">
                        <img
                            src="https://images-eu.ssl-images-amazon.com/images/G/31/img22/BAU/Oct/186X116_5._SY116_CB606110532_.jpg" />
                        <p>Furniture</p>
                    </div>
                    <div class="card-nested">
                        <img
                            src="https://images-eu.ssl-images-amazon.com/images/G/31/img22/BAU/Oct/186X116_3._SY116_CB606110532_.jpg" />
                        <p>Daily essentials</p>
                    </div>
                    <div class="card-nested">
                        <img
                            src="https://images-eu.ssl-images-amazon.com/images/G/31/img22/BAU/Oct/186X116_8._SY116_CB606110532_.jpg" />
                        <p>Fashion</p>
                    </div>
                </div>
                <button class="card-product-btn">see more</button>
            </div>
            <div class="card-product">
                <h2>Top rated, premium quality | Amazon Brands &</h2>
                <div class="card-product-nested-card">
                    <div class="card-nested">
                        <img
                            src="https://images-eu.ssl-images-amazon.com/images/G/31/img22/BAU/Oct/186X116_1._SY116_CB606110532_.jpg" />
                        <p>Home Products</p>
                    </div>
                    <div class="card-nested">
                        <img
                            src="https://images-eu.ssl-images-amazon.com/images/G/31/img22/BAU/Oct/186X116_5._SY116_CB606110532_.jpg" />
                        <p>Furniture</p>
                    </div>
                    <div class="card-nested">
                        <img
                            src="https://images-eu.ssl-images-amazon.com/images/G/31/img22/BAU/Oct/186X116_3._SY116_CB606110532_.jpg" />
                        <p>Daily essentials</p>
                    </div>
                    <div class="card-nested">
                        <img
                            src="https://images-eu.ssl-images-amazon.com/images/G/31/img22/BAU/Oct/186X116_8._SY116_CB606110532_.jpg" />
                        <p>Fashion</p>
                    </div>
                </div>
                <button class="card-product-btn">see more</button>
            </div>
            <div class="card-product">
                <h2>Top rated, premium quality | Amazon Brands &</h2>
                <div class="card-product-nested-card">
                    <div class="card-nested">
                        <img
                            src="https://images-eu.ssl-images-amazon.com/images/G/31/img22/BAU/Oct/186X116_1._SY116_CB606110532_.jpg" />
                        <p>Home Products</p>
                    </div>
                    <div class="card-nested">
                        <img
                            src="https://images-eu.ssl-images-amazon.com/images/G/31/img22/BAU/Oct/186X116_5._SY116_CB606110532_.jpg" />
                        <p>Furniture</p>
                    </div>
                    <div class="card-nested">
                        <img
                            src="https://images-eu.ssl-images-amazon.com/images/G/31/img22/BAU/Oct/186X116_3._SY116_CB606110532_.jpg" />
                        <p>Daily essentials</p>
                    </div>
                    <div class="card-nested">
                        <img
                            src="https://images-eu.ssl-images-amazon.com/images/G/31/img22/BAU/Oct/186X116_8._SY116_CB606110532_.jpg" />
                        <p>Fashion</p>
                    </div>
                </div>
                <button class="card-product-btn">see more</button>
            </div>
            <div class="card-product">
                <h2>Top rated, premium quality | Amazon Brands &</h2>
                <div class="card-product-nested-card">
                    <div class="card-nested">
                        <img
                            src="https://images-eu.ssl-images-amazon.com/images/G/31/img22/BAU/Oct/186X116_1._SY116_CB606110532_.jpg" />
                        <p>Home Products</p>
                    </div>
                    <div class="card-nested">
                        <img
                            src="https://images-eu.ssl-images-amazon.com/images/G/31/img22/BAU/Oct/186X116_5._SY116_CB606110532_.jpg" />
                        <p>Furniture</p>
                    </div>
                    <div class="card-nested">
                        <img
                            src="https://images-eu.ssl-images-amazon.com/images/G/31/img22/BAU/Oct/186X116_3._SY116_CB606110532_.jpg" />
                        <p>Daily essentials</p>
                    </div>
                    <div class="card-nested">
                        <img
                            src="https://images-eu.ssl-images-amazon.com/images/G/31/img22/BAU/Oct/186X116_8._SY116_CB606110532_.jpg" />
                        <p>Fashion</p>
                    </div>
                </div>
                <button class="card-product-btn">see more</button>
            </div>
        </div>

    
    today's deals
    <section class="today_deals_container">
        <div class="today_deals_heading">
            <h1>Today's Deals</h1>
            <p><a href="#">See all deals</a></p>
        </div>

        <div class="today_deals_product_container">
            <div class="today_deals_btn_container">
                <button  class="today_deal_btn" id="today_deal_btn_prev">
                    <i class="fa-solid fa-angle-left"></i>
                </button>
                <button class="today_deal_btn" id="today_deal_btn_next">
                    <i class="fa-solid fa-angle-right"></i>
                </button>
            </div>

            <div class="today_deals_product_list">
                <div class="today_deals_product_item">
                    <img src="https://m.media-amazon.com/images/I/411mbYGYIdL._AC_SY200_.jpg"/>
                    <div class="discount_Contaienr">
                        <a href="#">Up to 52% off</a>
                        <a href="#">Deal of the day</a>
                    </div>
                    <p>adidas and Campus Footwear</p>
                </div>

                <div class="today_deals_product_item">
                    <img src="https://m.media-amazon.com/images/I/411mbYGYIdL._AC_SY200_.jpg"/>
                    <div class="discount_Contaienr">
                        <a href="#">Up to 52% off</a>
                        <a href="#">Deal of the day</a>
                    </div>
                    <p>adidas and Campus Footwear</p>
                </div>

                <div class="today_deals_product_item">
                    <img src="https://m.media-amazon.com/images/I/411mbYGYIdL._AC_SY200_.jpg"/>
                    <div class="discount_Contaienr">
                        <a href="#">Up to 52% off</a>
                        <a href="#">Deal of the day</a>
                    </div>
                    <p>adidas and Campus Footwear</p>
                </div>

                <div class="today_deals_product_item">
                    <img src="https://m.media-amazon.com/images/I/411mbYGYIdL._AC_SY200_.jpg"/>
                    <div class="discount_Contaienr">
                        <a href="#">Up to 52% off</a>
                        <a href="#">Deal of the day</a>
                    </div>
                    <p>adidas and Campus Footwear</p>
                </div>

                <div class="today_deals_product_item">
                    <img src="https://m.media-amazon.com/images/I/411mbYGYIdL._AC_SY200_.jpg"/>
                    <div class="discount_Contaienr">
                        <a href="#">Up to 52% off</a>
                        <a href="#">Deal of the day</a>
                    </div>
                    <p>adidas and Campus Footwear</p>
                </div>
            </div>
        </div>
    </section>
    </section>
    </main>
    <footer class="footer">
        <div class="container">
            <div class="social-media">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <!-- Add more social media icons and links as needed -->
            </div>
        </div>
        <p>&copy; 2024 ShopFlix.in. All rights reserved.</p>
    </footer>
    <script src="javascript.js" type="module"></script>
</body>

</html>