<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
     <title>ShopFlix.in</title>

  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
</head>

<body>
   <?php
include('./include/navbar.php');
   ?>
  
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
    <script src="javascript.js" type="module"></script>
</body>

</html>