<?php
// Start the session
session_start();

    // Include database connection
    include("./include/connection.php");

    // Function to verify CAPTCHA
    function verifyCaptcha($userCaptcha) {
        if(isset($_SESSION['captcha']) && strtolower($userCaptcha) == strtolower($_SESSION['captcha'])) {
            return true;
        } else {
            return false;
        }
    }

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve user input
        $email = $_POST["email"];
        $password = $_POST["password"];
        $captcha = $_POST["captcha"];

        // Validate user input (You should also add more validation as needed)
        if (!empty($email) && !empty($password) && !empty($captcha)) {
            // Verify CAPTCHA
            if (verifyCaptcha($captcha)) {
                // Prepare SQL statement to fetch user from database
                $stmt = $conn->prepare("SELECT * FROM admins WHERE email = ? AND password = ?");
                $stmt->bind_param("ss", $email, $password);

                // Execute SQL statement
                $stmt->execute();

                // Get result
                $result = $stmt->get_result();

                // Check if user exists
                if ($result->num_rows == 1) {
                    // User exists, redirect to dashboard
                    $_SESSION["email"] = $email; // Store user email in session
                    header("Location: dashboard.php");
                    exit();
                } else {
                    // User does not exist or invalid credentials
                    $error = "Invalid email or password.";
                }
            } else {
                // CAPTCHA verification failed
                $error = "Invalid CAPTCHA, please try again.";
            }
        } else {
            // Invalid input
            $error = "Please enter email, password, and CAPTCHA.";
        }
    }

    // Generate CAPTCHA
    $randomNumber = substr(rand(),0,5); // Generate random number
    $_SESSION['captcha'] = $randomNumber; // Store random number in session
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
                <img src="./image/login.png" class="img-fluid" style="width: 250px;">
            </div>
            <p class="text-white fs-2"
               style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">Be Verified</p>
            <small class="text-white text-wrap text-center"
                   style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Join experienced Designers
                on this platform.
            </small>
        </div>

        <div class="col-md-6 right-box">
            <div class="row align-items-center">
                <div class="header-text mb-4">
                    <h2>Hello, Admin</h2>
                    <p>We are happy to have you back.</p>
                </div>
                <form method="post" action="">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-lg bg-light fs-6" name="email"
                               placeholder="Email address" required>
                    </div>
                    <div class="input-group mb-1">
                        <input type="password" class="form-control form-control-lg bg-light fs-6" name="password"
                               placeholder="Password" required>
                    </div>
                    <?php if (isset($error)) { ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php } ?>
                    <div class="input-group mb-4 d-flex justify-content-between">
                        <div class="form-group">
                            <div class="input-group mb-1">
                                <input type="text" class="form-control form-control-lg bg-light text-dark fs-6 rounded-4"
                                       id="captcha" name="captcha" placeholder="Captcha" required>
                                <div class="input-group-append">
                                    <img src="./include/captcha.php?rand=<?php echo uniqid(); ?>" alt="CAPTCHA"
                                         id="captcha_image"/>
                                    <button class="btn btn-outline-dark rounded-4" type="button" id="refresh_captcha">
                                        <i class="fas fa-sync-alt"></i>
                                        Refresh
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <button type="submit" class="btn btn-lg btn-primary w-100 fs-6">Login</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    document.getElementById('refresh_captcha').addEventListener('click', function () {
        document.getElementById('captcha_image').src = './include/captcha.php?rand=' + new Date().getTime();
    });
</script>
</body>
</html>
