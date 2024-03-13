<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopflix Vendor Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 400px;
            max-width: 90%;
            margin-top: 100px;
            margin-bottom: 50px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
            text-transform: uppercase;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            color: #495057;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #ffffff;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            padding: 14px 20px;
            font-size: 16px;
            transition: background-color 0.3s ease;
            width: 100%;
            box-sizing: border-box;
            text-transform: uppercase;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        input[type="submit"]:focus {
            outline: none;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: inline-block;
            width: 120px;
            vertical-align: top;
            color: #495057;
            text-transform: uppercase;
        }

        .form-group input,
        .form-group textarea {
            width: calc(100% - 130px);
            display: inline-block;
            vertical-align: top;
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 10px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #007bff;
            outline: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>✨ Shopflix</h2>
        <h2> Vendor Registration</h2>
        <form name="registrationForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirmed_email">Confirm Email:</label>
                <input type="email" id="confirmed_email" name="confirmed_email" required>
            </div>
            <div class="form-group">
                <label for="company_name">Company Name:</label>
                <input type="text" id="company_name" name="company_name" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="text" id="phone_number" name="phone_number" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea id="address" name="address" required></textarea>
            </div>
            <input type="submit" value="Register">
           
                <p>Already have an account? <a href="login.php">Login here</a></p>
            
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include_once("./include/connection.php");

        // Retrieve form data
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmed_email = $_POST['confirmed_email'];
        $company_name = $_POST['company_name'];
        $phone_number = $_POST['phone_number'];
        $address = $_POST['address'];

        // Insert data into the database
        $sql = "INSERT INTO vendors (username, email, password, company_name, phone_number, address) 
                VALUES ('$username', '$email', '$password', '$company_name', '$phone_number', '$address')";

        if (mysqli_query($conn, $sql)) {
            // Data inserted successfully
            echo "<script>alert('Registration successful!')</script>";
        } else {
            // Error occurred while inserting data
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
    }
    ?>

</body>

</html>