<style>
    footer {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        position: relative;
        
    }

    footer .col {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        margin-bottom: 20px;
        margin-left: 50px;
    }

    footer .sec {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    footer .logo {
        margin-bottom: 20px;
    }

    footer h4 {
        font-size: 18px;
        padding-bottom: 20px;
        font-weight: bold;
    }

    footer p {
        font-size: 13px;
        margin: 0 0 8px 0;
        font-weight: bold;
    }

    footer a {
        font-size: 13px;
        text-decoration: none;
        color: #222;
        margin-bottom: 10px;
        font-weight: bold;
        
    }

    footer .follow {
        margin-top: 20px;
    }

    footer .follow i {
        color: #465b52;
        padding-right: 5px;
        cursor: pointer;
    }

    footer .follow i:hover,
    footer a:hover {
        color: #088178;
    }

    footer .install .row img {
        border: 1px solid #088178;
        border-radius: 6px;
    }

    footer .install img {
        margin: 10px 0 15px 0;
    }

    footer .copyright {
        width: 100%;
        text-align: center;
    }

    @media (max-width: 920px) {
        .section-p1 {
            padding: 40px 40px;
        }

        #navbar {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-start;
            position: fixed;
            top: 0;
            right: -300px;
            height: 100vh;
            width: 300px;
            background-color: #e3e6f3;
            box-shadow: 0 40px 60px rgba(0, 0, 0, 0.1);
            padding: 80px 0 0 10px;
            transition: 0.3s;
        }

        #navbar.active {
            right: 0;
        }

        #navbar li {
            margin-bottom: 25px;
        }

        #mobile {
            display: flex;
            align-items: center;
        }

        #mobile i {
            font-size: 32px;
            color: #1a1a1a;
            padding-left: 20px;
        }

        body #lg-bag {
            display: none;
        }

        #close {
            display: initial;
            position: absolute;
            top: -280px;
            left: 20px;
            color: #222;
            font-size: 32px;
        }

        #lg-bag {
            display: none;
        }

        .quantity {
            top: 15px;
            left: 83%;
        }

        #hero {
            height: 70vh;
            padding: 0 80px;
            background-position: top 30% right 30%;
        }

        #feature {
            justify-content: center;
        }

        #feature .fe-box {
            margin: 15px 15px;
        }

        #product1 .pro-container {
            justify-content: center;
        }

        #product1 .pro {
            margin: 15px;
        }

        #banner {
            height: 25vh;
        }

        #sm-banner .banner-box {
            min-width: 100%;
            height: 30vh;
        }

        #banner3 {
            padding: 0 40px;
        }

        #banner3 .banner-box {
            width: 28%;
        }

        #newsletter .form {
            width: 70%;
        }
    }

    @media (max-width: 477px) {
        .section-p1 {
            padding: 20px;
        }

        #header {
            padding: 10px 30px;
        }

        .quantity {
            top: 7px;
            left: 80%;
        }

        #hero {
            padding: 0 20px;
            background-position: 55%;
        }

        h2 {
            font-size: 30px;
        }

        h1 {
            font-size: 28px;
        }

        p {
            line-height: 24px;
            font-size: 10px;
        }

        #hero button {
            margin-right: 10px;
        }

        #feature {
            justify-content: space-between;
        }

        #feature .fe-box {
            width: 155px;
            margin: 0 0 15px 0;
        }

        #product1 .pro {
            width: 100%;
        }

        #banner {
            height: 40vh;
        }

        #sm-banner .banner-box {
            height: 40vh;
        }

        #sm-banner .banner-box2 {
            margin-top: 20px;
        }

        #banner3 {
            padding: 0 20px;
        }

        #banner3 .banner-box {
            width: 100%;
        }

        #newsletter .form {
            width: 100%;
        }

        #newsletter {
            padding: 40px 20px;
        }

        footer .copyright {
            text-align: start;
        }
    }
</style>

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<footer class="section-p1">
    <div class="sec">
        <div class="col">
            <!-- <a href="#"><img class="logo" src="https://i.postimg.cc/x8ncvFjr/logo.png"></a> -->
            <h4>Contact</h4>
            <p><strong>Address:</strong> Shopflix Headquarter, near Shyam Mandir, Vesu, Surat, Gujarat</p>
            <p><strong>Phone:</strong> 456876199, 458903120</p>
            <p><strong>Hours:</strong> 10.00 - 18.00, Mon - Sat</p>
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
        <div class="col">
            <h4>About</h4>
            <a href="./about_us.php">About Us</a>
            <a href="./privacy.php">Privacy Policy</a>
            <a href="./term.php">Terms and Condition</a>
            <a href="./contact.php">Contact Us</a>
        </div>
        <div class="col">
            <h4>My Account</h4>
            <a href="./register.php">Sign In</a>
            <a href="./cart.php">View Cart</a>
            <a href="Report.php">Report issue</a>
            <a href="./order.php">Track my Order</a>
            <a href="./feedback.php">Feedback</a>
        </div>
        <div class="col install">
            <p>Secured Payment Gateways</p>
            <img src="https://i.postimg.cc/kgfzqVRW/pay.png" alt="">
        </div>
    </div>
    <div class="copyright">
        <p> © 2023 All rights reserved! made by Shopflix </p>
    </div>
</footer>
