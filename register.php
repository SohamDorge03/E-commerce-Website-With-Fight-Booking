<?php

include("./include/connection.php");
include("./include/navbar.php");
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['register'])) {
    // Escape user inputs for security
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $firstName = mysqli_real_escape_string($conn, $_POST['first_name']);
    $lastName = mysqli_real_escape_string($conn, $_POST['last_name']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);

    // Generate a 6-digit verification code
    $verificationCode = mt_rand(100000, 999999);

    // Your SQL query to insert user data into the database
    $sql = "INSERT INTO users (username, password, email, first_name, last_name, phone_number, gender, verify_code) 
            VALUES ('$username', '$password', '$email', '$firstName', '$lastName', '$phoneNumber', '$gender', '$verificationCode')";

    if (mysqli_query($conn, $sql)) {
        // Registration successful, send email verification
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'shopflix420@gmail.com';
        $mail->Password   = 'vabjcndouidetrnt';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;
        $mail->setFrom('shopflix420@gmail.com', 'SHOPFLIX');
        $mail->addAddress($email, 'test');
        $mail->isHTML(true);
        $mail->Subject = 'Email verification from Shopflix';
        $mail->Body = "Your Shopflix account verification code: $verificationCode";

        if ($mail->send()) {
            // Email sent successfully
            $_SESSION['username'] = $username;
            // Redirect to verification page or any other desired page
            header("Location: verify.php");
            exit();
        } else {
            // Error sending email
            echo "Error sending email: " . $mail->ErrorInfo;
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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
    <title>User Registration</title>
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
                        <p class="text-dark">Create your account to get started.</p>
                    </div>
                    <form action="" method="POST">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-lg bg-light text-dark fs-6 rounded-4" placeholder="Username" name="username" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control form-control-lg bg-light text-dark fs-6 rounded-4" placeholder="Password" name="password" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control form-control-lg bg-light text-dark fs-6 rounded-4" placeholder="Email" name="email" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-lg bg-light text-dark fs-6 rounded-4" placeholder="First Name" name="first_name" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-lg bg-light text-dark fs-6 rounded-4" placeholder="Last Name" name="last_name" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="tel" class="form-control form-control-lg bg-light text-dark fs-6 rounded-4" placeholder="Phone Number" name="phone_number">
                        </div>
                        <div class="input-group mb-3">
                            <select class="form-select form-select-lg bg-light text-dark fs-6 rounded-4" name="gender" required>
                                <option value="" disabled selected>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="input-group mb-3 d-flex justify-content-between">
                            <button type="submit" name="register" class="btn btn-lg btn-primary w-100 fs-6 rounded-4">Register</button>
                            <a href="login.php" class="btn btn-lg btn-outline-dark w-100 fs-6 mt-3 rounded-4">Already have an account? Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
