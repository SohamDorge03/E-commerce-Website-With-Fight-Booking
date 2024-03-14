<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warranty Claim</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .warranty-form {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .send-btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .send-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Warranty Claim</h2>
        <form class="warranty-form" method="post">
            <div class="form-group">
                <label for="productId">Product ID:</label>
                <input type="text" id="productId" name="productId" required>
            </div>
            <div class="form-group">
                <label for="topic">Topic:</label>
                <input type="text" id="topic" name="topic" required>
            </div>
            <div class="form-group">
                <label for="description">Description / Issues:</label>
                <textarea id="description" name="description" rows="5" required></textarea>
            </div>
            <button type="submit" class="send-btn" name="submit">Claim Now</button>
        </form>
    </div>

    <?php
    if(isset($_POST['submit'])){
     
include("./include/connection.php");
        // Retrieve form data
        $productId = $_POST['productId'];
        $topic = $_POST['topic'];
        $description = $_POST['description'];

        // Sanitize inputs to prevent SQL injection
        $productId = mysqli_real_escape_string($conn, $productId);
        $topic = mysqli_real_escape_string($conn, $topic);
        $description = mysqli_real_escape_string($conn, $description);

        // Insert data into database
        $sql = "INSERT INTO report_issue (user_id, product_id, description) VALUES (1, '$productId', '$description')";

        if ($conn->query($sql) === TRUE) {
            echo "<p class='text-success'>Warranty claim submitted successfully</p>";
        } else {
            echo "<p class='text-danger'>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }

        $conn->close();
    }
    ?>

</body>
</html>
