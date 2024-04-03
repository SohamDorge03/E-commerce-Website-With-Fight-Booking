<?php
session_start();

include("./include/connection.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['captcha'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $captcha = $_POST['captcha'];

        // Validate CAPTCHA
        if($_SESSION['captcha'] !== $captcha) {
            $error = "Invalid CAPTCHA, please try again.";
        } else {
           
            $sql = "SELECT * FROM vendors WHERE email = '$email' AND password = '$password'";
            $result = $conn->query($sql);

            if ($result && $result->num_rows == 1) {
                $row = $result->fetch_assoc();
                if ($row['confirmed_vendor'] == 1) {
                    $_SESSION['vendor_id'] = $row['vendor_id'];
                    header("Location: d.php");
                    exit();
                } else {
                    $error = "Your account has not been confirmed yet. Please wait for confirmation.";
                }
            } else {
                
                $error = "Invalid email or password. Please try again.";
            }
        }
    } else {
     
        $error = "Please enter email, password, and CAPTCHA.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="sty.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <title>Shopflix Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: #ececec;
        }

        .box-area {
            width: 800px;
        }

        .right-box {
            padding: 40px 30px 40px 40px;
        }

        ::placeholder {
            font-size: 16px;
        }

        .rounded-4 {
            border-radius: 20px;
        }

        .rounded-5 {
            border-radius: 30px;
        }

        @media only screen and (max-width: 768px) {
            .box-area {
                margin: 0 10px;
            }

            .left-box {
                height: 100px;
                overflow: hidden;
            }

            .right-box {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center min-vh-100">

    <div class="row border rounded-5 p-3 bg-white shadow box-area">

        <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box"
             style="background: #480938;">
            <div class="featured-image mb-3">
                <img src="vendor.png" class="img-fluid" style="width: 350px;">
            </div>
            <p class="text-white fs-2"
               style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">Be Verified</p>
            <small class="text-white text-wrap text-center"
                   style="width: 17rem;font-family: 'Courier New', Courier, monospace;">"Fuel your multivendor website with our powerful platform."
            </small>
        </div>

        <div class="col-md-6 right-box">
            <div class="row align-items-center">
                <div class="header-text mb-4">
                    <h2>Hello, Vendor</h2>
                    <p>We are happy to have you back.</p>
                </div>
                <form method="post" action="">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-lg bg-light fs-6" name="email"  placeholder="Email address" required>
                    </div>
                    <div class="input-group mb-1">
                        <input type="password" class="form-control form-control-lg bg-light fs-6" name="password"
                               placeholder="Password" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-lg bg-light fs-6" name="captcha" placeholder="Enter CAPTCHA" required>
                        <img src="../include/captcha.php" alt="CAPTCHA Image" id="captcha_image" style="margin-left: 10px;"> <!-- Added ID for CAPTCHA image -->
                        <button class="btn btn-outline-dark rounded-4" type="button" id="refresh_captcha">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>

                    <?php if (!empty($error)) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $error; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <div class="input-group mb-5" style="margin-top: 25px;">
                        <button type="submit" class="btn btn-lg btn-primary w-100 fs-6 rounded-4">Login</button>
                        <a href="register.php" class="btn btn-lg btn-outline-dark w-100 fs-6 mt-3 rounded-4" class="btn btn-link btn-register">New Vendor? Register Yourself</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('refresh_captcha').addEventListener('click', function () {
        document.getElementById('captcha_image').src = '../include/captcha.php?rand=' + new Date().getTime(); // Corrected path and added 'captcha_image' ID
    });
</script>
</body>
</html>

