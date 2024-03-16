<?php

include("./include/connection.php");
include("./include/navbar.php");
// Check if form is submitted
if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $captcha = $_POST['captcha'];

    // Validate captcha
    if($captcha !== $_SESSION['captcha']) {
        $message = "Invalid captcha.";
    } else {
        // Prepare SQL query to check if the user exists
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = $conn->query($sql);

        // Check if any rows are returned
        if ($result->num_rows > 0) {
            // User exists, redirect to home.php
            $row = $result->fetch_assoc();
            $_SESSION['u'] = $row['user_id'];
      echo '<script>
      
      window.location.href = "./index.php";
    </script>';
            exit();
        } else {
            // User does not exist, display error message
            $message = "Invalid username or password.";
        }
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>User Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: #ffffff;
        }

        .container {
            color: #fff;
            position: relative;
            z-index: 1;
        }

        .box-area {
            backdrop-filter: blur(1rem);
            width: 850px;
        }

        #right-box {
            padding: 40px 30px 40px 40px;
        }

        ::placeholder {
            font-size: 16px;
            color: #ccc;
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
            }

            #right-box {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <div class="row border rounded-5 p-3  shadow box-area">

            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box left-box1">
                <div class="featured-image mb-3">
                    <img src="./image/d.png" class="img-fluid" style="width: 400px;" alt="Register">
                </div>
            </div>
            <div class="col-md-6 right-box" id="right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2 class="text-dark">Welcome to Shopflix</h2>
                        <p class="text-dark">Login to your account to get started.</p>
                    </div>

                    <?php if(!empty($message)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $message; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form action="" method="POST">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-lg bg-light text-dark fs-6 rounded-4" placeholder="Username" name="username" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control form-control-lg bg-light text-dark fs-6 rounded-4" placeholder="Password" name="password" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-lg bg-light text-dark fs-6 rounded-4" placeholder="Enter Captcha" name="captcha" required>
                            <img id="captchaImage" src="./include/captcha.php" alt="Captcha Image">
                            <button type="button" onclick="refreshCaptcha()" class="btn btn-outline-secondary"><i class="fas fa-sync"></i></button>
                        </div>
                        <div class="input-group mb-3 d-flex justify-content-between">
                            <button type="submit" name="login" class="btn btn-lg btn-primary w-100 fs-6 rounded-4">Login</button>
                            <a href="register.php" class="btn btn-lg btn-outline-dark w-100 fs-6 mt-3 rounded-4">New user? Register</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function refreshCaptcha() {
            var captchaImage = document.getElementById('captchaImage');
            captchaImage.src = './include/captcha.php?' + new Date().getTime();
        }
    </script>
</body>

</html>
