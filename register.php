<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 500px;
            width: 100%;
        }

        h2 {
            color: #007bff;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-control {
            border-radius: 20px;
            border: 2px solid #007bff;
            padding: 15px;
            margin-bottom: 20px;
            width: 100%;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 20px;
            padding: 15px;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn-container .btn {
            flex-basis: 48%;
        }

        /* Custom select styling */
        .custom-select {
            border-radius: 20px;
            border: 2px solid #007bff;
            padding: 15px;
            margin-bottom: 20px;
            width: 100%;
        }

        .custom-select:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="form-container">
            <h2>Welcome to Shopflix</h2>
            <form action="" method="POST">

                <input type="text" class="form-control" placeholder="Username" name="username" required>

                <input type="password" class="form-control" placeholder="Password" name="password" required>

                <input type="email" class="form-control" placeholder="Email" name="email" required>

                <input type="text" class="form-control" placeholder="First Name" name="first_name" required>

                <input type="text" class="form-control" placeholder="Last Name" name="last_name" required>

                <input type="tel" class="form-control" placeholder="Phone Number" name="phone_number">

                <select class="custom-select" name="gender" required>
                    <!-- <option value="">Select Gender</option> -->
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>

                <div class="btn-container">
                    <button type="submit" name="register" class="btn btn-primary">Register</button>

                    <a href="login.php" class="btn btn-outline-dark">Already have an account? Login</a>
                </div>

            </form>
        </div>
    </div>

</body>

</html>
