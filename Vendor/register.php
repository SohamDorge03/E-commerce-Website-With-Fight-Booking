<?php
session_start();

include("./include/connection.php");
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$errors = [];

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $companyName = mysqli_real_escape_string($conn, $_POST['company_name']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

   
    if (strlen($password) != 8) {
        $errors[] = "Password must be exactly 8 characters.";
    }

   
    if (strlen($phoneNumber) != 10) {
        $errors[] = "Phone number must be exactly 10 digits.";
    }

  
    if (!strpos($email, '@')) {
        $errors[] = "Email must contain the '@' symbol.";
    }

    
    $checkEmailQuery = "SELECT * FROM vendors WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $checkEmailQuery);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        $errors[] = "Email already exists. Please use a different email.";
    }

    
    $checkUsernameQuery = "SELECT * FROM vendors WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $checkUsernameQuery);
    $existingUsername = mysqli_fetch_assoc($result);

    if ($existingUsername) {
        $errors[] = "Username already taken. Please choose a different username.";
    }

   
    $checkCompanyQuery = "SELECT * FROM vendors WHERE company_name = '$companyName' LIMIT 1";
    $result = mysqli_query($conn, $checkCompanyQuery);
    $company = mysqli_fetch_assoc($result);

    if ($company) {
        $errors[] = "Company name already exists. Please use a different company name.";
    }

   
    if (empty($errors)) {
       
        $verificationCode = mt_rand(100000, 999999);

        $sql = "INSERT INTO vendors (username, password, email, company_name, phone_number, address, verify_code) 
        VALUES ('$username', '$password', '$email', '$companyName', '$phoneNumber', '$address', '$verificationCode')";

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
                $_SESSION['vendor_username'] = $username;
                header("Location: verify.php");
                exit();
            } else {
                $errors[] = "Error sending email: " . $mail->ErrorInfo;
            }
        } else {
            $errors[] = "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 950px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            margin-top: 130px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            display: flex;
        }

        .image-container {
            flex: 1;
            margin-right: 30px;
        }

        .image-container img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .form-container {
            flex: 1;
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

        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="image-container">
            <img src="login.png" alt="Image">
        </div>
        <div class="form-container">
            <h2>Vendor Registration</h2>
            <?php if (!empty($errors)) : ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $error) : ?>
                        <div><?php echo $error; ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <form action="" method="POST">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username" name="username" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email" name="email" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Company Name" name="company_name" required>
                </div>
                <div class="form-group">
                    <input type="tel" class="form-control" placeholder="Phone Number" name="phone_number" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Address" name="address" required>
                </div>
                <button type="submit" name="register" class="btn btn-primary rounded-4">Register</button>
            </form>
        </div>
    </div>
</body>

</html>
