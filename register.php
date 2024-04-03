<?php

include("./include/connection.php");
include("./include/navbar.php");

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
        }

        .container {
            color: #fff;
            position: relative;
            z-index: 1;
        }

        .box-area {
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

    <div class="container d-flex justify-content-center align-items-center  ">

        <div class="row  rounded-5     box-area">
            <?php
            if (isset($_POST['register'])) {
                // Escape user inputs for security
                $username = mysqli_real_escape_string($conn, $_POST['username']);
                $password = mysqli_real_escape_string($conn, $_POST['password']);
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $firstName = mysqli_real_escape_string($conn, $_POST['first_name']);
                $lastName = mysqli_real_escape_string($conn, $_POST['last_name']);
                $phoneNumber = mysqli_real_escape_string($conn, $_POST['phone_number']);
                $gender = mysqli_real_escape_string($conn, $_POST['gender']);
                $address = mysqli_real_escape_string($conn, $_POST['address']);

                // Check if email already exists
                $check_email_query = "SELECT * FROM users WHERE email='$email'";
                $check_email_result = mysqli_query($conn, $check_email_query);


                $check_query = "SELECT * FROM users WHERE username='$username'";
                $check_result = mysqli_query($conn, $check_query);
                if (mysqli_num_rows($check_email_result) > 0) {
                    // Email already exists
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Email already exists!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                }
                elseif (mysqli_num_rows($check_result) > 0) {

                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    username already exists!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                } else {
                    
                    $errors = [];
                    if (strlen($password) < 8) {
                        $errors[] = 'Password must be at least 8 characters long.';
                    }
                    if (!preg_match('/[a-zA-Z]/', $password) || !preg_match('/[0-9]/', $password)) {
                        $errors[] = 'Password must contain a mix of letters and numbers.';
                    }
                    if (strlen($phoneNumber) != 10) {
                        $errors[] = 'Phone number must be 10 characters long.';
                    }

                    if (!empty($errors)) {
                      
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                        foreach ($errors as $error) {
                            echo $error . '<br>';
                        }
                        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    } else {
                        
                        $verificationCode = mt_rand(100000, 999999);

                        $sql = "INSERT INTO users (username, password, email, first_name, last_name, phone_number, gender, address, verify_code) 
                            VALUES ('$username', '$password', '$email', '$firstName', '$lastName', '$phoneNumber', '$gender', '$address', '$verificationCode')";

                        if (mysqli_query($conn, $sql)) {
                            
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
                                $_SESSION['username'] = $username;
                                
                                echo "<script>
                                        window.location.href = 'verify.php';
                                    </script>";
                                exit();
                            } else {
                              
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Error sending email: ' . $mail->ErrorInfo . '
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                            }
                        } else {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Error: ' . $sql . '<br>' . mysqli_error($conn) . '
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                        }
                    }
                }
                
                mysqli_close($conn);
            }
            ?>
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box left-box1">
                <div class="featured-image mb-3">
                    <img src="./image/login.png" class="img-fluid" style="width: 250px;" alt="Register">
                </div>
                <p class="text-dark fs-2" style="font-family: 'Courier New', Courier, monospace; color: black; font-weight: 600;">SHOPFLIX</p>
                <small class="text-dark text-wrap text-center" style="width: 17rem; color: black; font-family: 'Courier New', Courier, monospace;">Join us and start shopping today!</small>
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
                            <input type="text" class="mr-3 form-control form-control-lg bg-light text-dark fs-6 rounded-4" placeholder="First Name" name="first_name" required>
                            <input type="text" class="form-control form-control-lg bg-light text-dark fs-6 rounded-4" placeholder="Last Name" name="last_name" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="tel" class=" form-control form-control-lg bg-light text-dark fs-6 rounded-4" placeholder="Phone Number" name="phone_number">
                            <select class=" ml-3 form-select form-select-lg bg-light text-dark fs-6 rounded-4" name="gender" required>
                                <option value="" disabled selected>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-lg bg-light text-dark fs-6 rounded-4" placeholder="Address" name="address" required>
                        </div>
                        <div class="input-group mb-3">
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

    <script>
    
        setTimeout(function() {
            document.querySelector('.alert').style.display = 'none';
        }, 3000);
    </script>

</body>

</html>
