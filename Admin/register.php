<?php
session_start();

include("./include/connection.php");

$error = "";

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$error = "";

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    if (strlen($password) < 8) {
        $error = " Password must be at least 8 characters long.";
    } elseif ($password !== $confirmPassword) {
        $error = " Passwords do not match.";
    } else {

        $verificationCode = mt_rand(100000, 999999);

        $sql = "INSERT INTO Admins (username, email, password, verify_code, confirmed_email) VALUES ('$username', '$email', '$password', '$verificationCode', 0)";
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
            $mail->addAddress($email, $username);
            $mail->isHTML(true);
            $mail->Subject = 'Email Verification from Your Website';
            $mail->Body = "Your verification code: $verificationCode";

            if ($mail->send()) {
                $_SESSION['verification_code'] = $verificationCode;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                header("Location: verify.php");
                exit();
            } else {
                $error = "&#10060; Error sending email: " . $mail->ErrorInfo;
            }
        } else {
            $error = "&#10060; Error: " . $sql . "<br>" . mysqli_error($conn);
        }
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
    <title>Admin Registration</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 900px; 
            margin: 50px auto;
        }

        .card {
            border: none;
            border-radius: 10px;
            margin-top: 150px;
            box-shadow: 10px 10px 10px rgba(0.5, 0.5, 0.5, 0.1);
            height: 500px; 
            text-align: center;
            justify-content: center;
        }

        .card-img {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
            object-fit: cover;
            height: 100%;
            width: 100%;
            max-height: 400px;
        }

        .card-body {
            padding: 30px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 5px;
        }

        .btn-primary {
            width: 100%;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="row g-0">
                <div class="col-md-5">
                    <img src="./image/login.png" class="card-img" alt="...">
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <h3 style="margin-bottom:40px;"><strong>Admin Registration</strong></h3>
                        <form action="" method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Name" name="username" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Email" name="email" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password" name="password" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" required>
                            </div>
                            <button type="submit" name="register" class="btn btn-primary">Register</button>
                        </form>
                        <?php if ($error) : ?>
                            <div class="alert alert-danger mt-3 alert-dismissible fade show" role="alert">
                                <?php echo $error; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                    </div>
                    <p>Already have an account? <a href="login.php">Login</a></p> 
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
