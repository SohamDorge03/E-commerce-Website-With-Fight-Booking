<?php
    include("./include/navbar.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); 
            border-radius: 10px; 
            padding: 20px; 
        }
    </style>
</head>
<body>
    <div class="container mt-5" style="margin-bottom:60px;">
        <div class="row justify-content-center">
            <div class="col-md-6 form-container"> 
                <h2 class="mb-4">Feedback Form</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="form-control btn btn-success" style="margin-bottom: 10px; margin-top:30px;">Submit Feedback</button>
                </form>
            </div>
        </div>
    </div>
    <?php
include("./include/footer.php");
?>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    include("./include/connection.php");
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $sql = "INSERT INTO feedback (email, description) VALUES ('$email', '$description')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Feedback submitted successfully.');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
