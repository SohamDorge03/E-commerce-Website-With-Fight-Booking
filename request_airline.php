<?php
// Database connection
include("./include/connection.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $airline_name = $_POST['airline_name'];
    $contact_email = $_POST['contact_email'];
    
    // File upload handling for logo
    $logo_file = $_FILES['logo'];
    $logo_filename = $logo_file['name'];
    $logo_temp_path = $logo_file['tmp_name'];
    

    $document_file = $_FILES['document'];
    $document_filename = $document_file['name'];
    $document_temp_path = $document_file['tmp_name'];
    
    $upload_dir = "../admin/image";
    move_uploaded_file($logo_temp_path, $upload_dir . $logo_filename);
    move_uploaded_file($document_temp_path, $upload_dir . $document_filename);
    
    $sql = "INSERT INTO airline_requests (airline_name, contact_email, logo, document) VALUES ('$airline_name', '$contact_email', '$logo_filename', '$document_filename')";
    
    if (mysqli_query($conn, $sql)) {
        // Show success message using JavaScript
        echo "<script>alert('Data inserted successfully.');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airline Request Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .form-group {
            width: 500px;
        }
        .custom-shadow {
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); 
            border-radius: 10px; 
            padding: 20px; 
        }
    </style>
</head>
<body>
<?php include("./include/navbar.php"); ?>
<div class="container mt-5">
    <div class="d-flex justify-content-center"> 
        <div class="custom-shadow"> 
            <h2>Airline Request Form</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="airline_name">Airline Name:</label>
                    <input type="text" class="form-control" id="airline_name" name="airline_name" required maxlength="50">
                </div>
                <div class="form-group">
                    <label for="contact_email">Contact Email:</label>
                    <input type="email" class="form-control" id="contact_email" name="contact_email" required maxlength="50">
                </div>
                <div class="form-group">
                    <label for="logo">Logo:</label>
                    <input type="file" class="form-control-file" id="logo" name="logo">
                </div>
                <div class="form-group">
                    <label for="document">Document:</label>
                    <input type="file" class="form-control-file" id="document" name="document">
                </div>
                <button type="submit" class="form-control btn btn-primary">Submit Request</button>
            </form>
        </div>
    </div>
</div>
<?php include("./include/footer.php"); ?>
</body>
</html>
