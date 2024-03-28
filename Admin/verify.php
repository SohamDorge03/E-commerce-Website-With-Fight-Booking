<?php
session_start();

include("./include/connection.php");

$error = "";

if (isset($_POST['verify'])) {
    $enteredCode = mysqli_real_escape_string($conn, $_POST['verification_code']);

    $username = $_SESSION['username'] ?? '';
    $email = $_SESSION['email'] ?? '';

    $sql = "SELECT * FROM users WHERE username = '$username' AND email = '$email' AND verify_code = '$enteredCode' AND confirmed_email = 0";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $rowCount = mysqli_num_rows($result);

        if ($rowCount == 1) {
            $updateSql = "UPDATE users SET confirmed_email = 1 WHERE username = '$username'";
            if (mysqli_query($conn, $updateSql)) {
                header("Location: login.php");
                exit();
            } else {
                $error = "Error updating database: " . mysqli_error($conn);
            }
        } else {
            $error = "Invalid verification code. Please try again.";
        }
    } else {
        $error = "Error: " . $sql . "<br>" . mysqli_error($conn);
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
    <title>Email Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
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
        <h2>Email Verification</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="verification_code">Enter Verification Code:</label>
                <input type="text" class="form-control" id="verification_code" name="verification_code" required>
            </div>
            <button type="submit" name="verify" class="btn btn-primary">Verify</button>
            <?php if ($error) : ?>
                <div class="alert alert-danger mt-3" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
        </form>
    </div>
</body>

</html>
