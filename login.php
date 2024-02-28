<?php
session_start(); // Start the session

include("./include/connection.php");

$message = "";

if(isset($_POST['login'])){
    // Escape user inputs for security
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Your SQL query to check user credentials and fetch user ID
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Login successful, fetch user ID and set session variables
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $username;
        
        // Redirect to user dashboard or any other desired page
        header("Location: home.php");
        exit();
    } else {
        $message = "Invalid username or password";
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
    <title>User Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: #ffffff;
            background-image: url("./image/background.png");
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

        <div class="row border rounded-5 p-3  shadow box-area">

            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box left-box1">
                <div class="featured-image mb-3">
                    <img src="./image/login.png" class="img-fluid" style="width: 250px;" alt="Register">
                </div>
                <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">SHOPFLIX</p>
                <small class="text-white text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Join us and start shopping today!</small>
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

</body>

</html>
