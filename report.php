<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report_issue - Shopflix</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .warranty-form {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        .form-group {
            margin-bottom: 20px;
            margin-top: 20px;
        }
        .abc label {
            font-weight: bold;
        }
        .abc input[type="text"],
        .abc textarea {
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
    <?php include('./include/navbar.php'); ?>

    <?php
    if(isset($_POST['submit'])){
        include("./include/connection.php");
        $productId = $_POST['productId'];
        $topic = $_POST['topic'];
        $description = $_POST['description'];

        $productId = mysqli_real_escape_string($conn, $productId);
        $topic = mysqli_real_escape_string($conn, $topic);
        $description = mysqli_real_escape_string($conn, $description);
        $sql = "INSERT INTO report_issue (user_id, product_id, description) VALUES (1, '$productId', '$description')";

        if ($conn->query($sql) === TRUE) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Submitted successfully
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error: ' . $sql . '<br>' . $conn->error . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
        }

        $conn->close();
    }
    ?>

    <div class="container abc" style="margin-top: 20px; margin-bottom:60px;">
        <h2 class="text-center mb-6"><b>Report Issues</b></h2>
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
            <button type="submit" class="send-btn" name="submit">Send to Our Support team</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
include("./include/footer.php");
?>