<?php
session_start();

include("./include/connection.php");

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$error = "";

if (isset($_POST['verify'])) {
    $enteredCode = mysqli_real_escape_string($conn, $_POST['verification_code']);

    $sql = "SELECT * FROM users WHERE username = '$username' AND verify_code = '$enteredCode' AND confirmed_email = 0";
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>Email Verification</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: #ffffff;
            background-image: url("./image/background.png");
            color: #000;
        }

        .container {
            color: #000;
            position: relative;
            z-index: 1;
        }

        .box-area {
            backdrop-filter: blur(1rem);
            width: 400px;
            margin: auto;
            margin-top: 50px;
            padding: 20px;
            border-radius: 15px;
        }

        .rounded-4 {
            border-radius: 20px;
        }

        .mb-3 {
            margin-bottom: 1rem !important;
        }

        .alert {
            margin-top: 1rem;
        }

        @media only screen and (max-width: 768px) {
            .box-area {
                width: 90%;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="box-area border rounded-4 shadow">

            <h2 class="mb-3">Email Verification</h2>

            <form action="" method="POST">
                <div class="mb-3">
                    <label for="verification_code" class="form-label">Enter Verification Code:</label>
                    <input type="text" class="form-control rounded-4" id="verification_code" name="verification_code" required>
                </div>
                <?php if ($error) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <button type="submit" name="verify" class="btn btn-primary rounded-4">Verify</button>
            </form>

        </div>

    </div>

</body>

</html>
