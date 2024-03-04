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
            background-image: url("d3.png");
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            color: #000;
        }

        .box-area {
            backdrop-filter: blur(1rem);
            width: 450px;
            padding: 40px;
            background-color: rgba(255, 255, 255, 0.8); /* Transparent white background */
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); /* Soft shadow */
        }

        #right-box {
            padding: 0 20px;
        }

        ::placeholder {
            font-size: 16px;
            color: #ccc;
        }

        .rounded-4 {
            border-radius: 20px;
        }

        @media only screen and (max-width: 768px) {
            .box-area {
                width: 90%;
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="row border rounded-5 p-3 shadow box-area">

            <div class="col-md-12 right-box" id="right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4 text-center">
                        <h2 class="text-dark">Welcome to Shopflix</h2>
                        <p class="text-dark">Login to your account to get started.</p>
                    </div>

                    <?php if(!empty($message)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $message; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form action="" method="POST" class="w-100">
                        <div class="mb-3">
                            <input type="text" class="form-control form-control-lg rounded-4" placeholder="Username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control form-control-lg rounded-4" placeholder="Password" name="password" required>
                        </div>
                        <div class="mb-3 d-flex justify-content-between">
                            <button type="submit" name="login" class="btn btn-lg btn-primary w-48 rounded-4">Login</button>
                            <a href="register.php" class="btn btn-lg btn-outline-dark w-48 rounded-4">New user? Register</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
