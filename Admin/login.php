<?php
session_start(); // Start the session

include("/wamp64/www/major project/Admin/include/connection.php");

if(isset($_POST['login'])){
    // Escape user inputs for security
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Your SQL query to check if the admin data exists in the database
    $sql = "SELECT * FROM admin_table WHERE username='$username' AND password='$password'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) { // If admin data exists
        // Admin login successful, set session variables
        $_SESSION['username'] = $username;
        // Redirect to admin dashboard or any other desired page
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Invalid username or password.";
    }

    // Close connection
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>Shopflix Login |</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: #ececec;
        }

        .box-area {
            width: 850px;
        }

        #right-box {
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

            #right-box {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <div class="row border rounded-5 p-3 bg-white shadow box-area">

            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box left-box1" style="background: #480938;">
                <div class="featured-image mb-3">
                    <img src="./image/login.png" class="img-fluid" style="width: 250px;" alt="Login">
                </div>
                <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">SHOPFLIX</p>
                <small class="text-white text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Security is not a Product, But a Process.</small>
            </div>
            <div class="col-md-6 right-box" id="right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2>Hello,Admin</h2>
                        <p>We are happy to have you back.</p>
                    </div>
                    <form action="" method="POST">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="Username" name="username" required>
                        </div>
                        <div class="input-group mb-1">
                            <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password" name="password" required>
                        </div>
                        <div class="input-group mb-4 d-flex justify-content-between">
                            <div class="form-group">
                                <div class="input-group mb-1">
                                    <input type="text" class="form-control form-control-lg bg-light fs-6" id="captcha" name="captcha" placeholder="Captcha" required>
                                    <div class="input-group-append">
                                        <img src="/major project/Admin/include/captcha.php?rand=<?php echo uniqid(); ?>" alt="CAPTCHA" id="captcha_image" />
                                        <button class="btn btn-outline-secondary" type="button" id="refresh_captcha">
                                            <i class="fas fa-sync-alt"></i> <!-- Refresh icon -->
                                            Refresh
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <button type="submit" name="login" class="btn btn-lg btn-primary w-100 fs-6">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('refresh_captcha').addEventListener('click', function() {
            document.getElementById('captcha_image').src = '/major project/Admin/include/captcha.php?rand=' + new Date().getTime();
        });
    </script>
</body>

</html>
