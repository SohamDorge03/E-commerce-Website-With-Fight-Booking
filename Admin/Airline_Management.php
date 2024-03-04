<?php
include("./include/connection.php");
include("./include/navbar.php");

// Define the target directory for file uploads
$target_dir = "./upload/";
if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $delete_id = $_GET['id'];

    // Perform deletion operation
    $sql = "DELETE FROM airlines WHERE airline_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        // Redirect back to the same page after successful deletion
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    } else {
        // Handle deletion failure
        echo "Error deleting record: " . $conn->error;
    }
}

// Handle form submission for adding a new airline
if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass']; // Note: You should hash the password for security reasons
    $airline_name = $_POST['airline_name'];
    $logo = isset($_FILES["logo"]["name"]) ? $target_dir . basename($_FILES["logo"]["name"]) : '';

    // File upload handling for adding a new airline
    if(isset($_FILES["logo"]["name"])) {
        $target_file = $target_dir . basename($_FILES["logo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a valid image
        $check = getimagesize($_FILES["logo"]["tmp_name"]);
        if($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["logo"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars(basename($_FILES["logo"]["name"])). " has been uploaded.";
                $logo = $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Insert data into database
    $sql = "INSERT INTO airlines (email, pass, airline_name, logo) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $email, $pass, $airline_name, $logo);
    
    if ($stmt->execute()) {
        echo "<script>alert('New airline added successfully');</script>";
        // Redirect to prevent form resubmission
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airline Management</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container" style="margin-top: 100px;">
    <h2>Airline Management</h2>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAirlineModal">
        Add Airline
    </button>
    <br><br>
    <table class="table">
        <thead>
            <tr>
                <th>Airline ID</th>
                <th>Email</th>
                <th>Airline Name</th>
                <th>Logo</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Retrieve data from database and display in table
            $sql = "SELECT airline_id, email, airline_name, logo FROM airlines";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row['airline_id']."</td>";
                    echo "<td>".$row['email']."</td>";
                    echo "<td>".$row['airline_name']."</td>";
                    echo "<td><img src='".$row['logo']."' alt='logo' style='max-width:100px; max-height:100px;'></td>";
                    echo "<td>
                            <a href='#' class='btn btn-info edit-btn' data-toggle='modal' data-target='#editAirlineModal' data-airline-id='".$row['airline_id']."' data-email='".$row['email']."' data-airline-name='".$row['airline_name']."' data-logo='".$row['logo']."'>Edit</a>
                            <a href='" . $_SERVER['PHP_SELF'] . "?action=delete&id=" . $row['airline_id'] . "' class='btn btn-danger'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No airlines found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Add Airline Modal -->
<div class="modal fade" id="addAirlineModal" tabindex="-1" role="dialog" aria-labelledby="addAirlineModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAirlineModalLabel">Add Airline</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addAirlineForm" method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="pass">Password:</label>
                        <input type="password" class="form-control" id="pass" name="pass" required>
                    </div>
                    <div class="form-group">
                        <label for="airline_name">Airline Name:</label>
                        <input type="text" class="form-control" id="airline_name" name="airline_name">
                    </div>
                    <div class="form-group">
                        <label for="logo">Logo:</label>
                        <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Airline Modal -->
<div class="modal fade" id="editAirlineModal" tabindex="-1" role="dialog" aria-labelledby="editAirlineModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAirlineModalLabel">Edit Airline</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editAirlineForm" method="POST" action="" enctype="multipart/form-data">
                    <input type="hidden" name="edit_airline_id" id="edit_airline_id">
                    <div class="form-group">
                        <label for="edit_email">Email:</label>
                        <input type="email" class="form-control" id="edit_email" name="edit_email" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_pass">Password:</label>
                        <input type="password" class="form-control" id="edit_pass" name="edit_pass" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_airline_name">Airline Name:</label>
                        <input type="text" class="form-control" id="edit_airline_name" name="edit_airline_name">
                    </div>
                    <div class="form-group">
                        <label for="edit_logo">Logo:</label>
                        <input type="file" class="form-control" id="edit_logo" name="edit_logo" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit_edit">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
// Handle form submission for editing
if(isset($_POST['submit_edit'])) {
    $edit_airline_id = $_POST['edit_airline_id'];
    $edit_email = $_POST['edit_email'];
    $edit_pass = $_POST['edit_pass'];
    $edit_airline_name = $_POST['edit_airline_name'];
    $edit_logo = isset($_FILES["edit_logo"]["name"]) ? $target_dir . basename($_FILES["edit_logo"]["name"]) : $_POST['edit_logo'];

    // File upload handling for editing
    if(isset($_FILES["edit_logo"]["name"])) {
        $target_file_edit = $target_dir . basename($_FILES["edit_logo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file_edit,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit_edit"])) {
            $check = getimagesize($_FILES["edit_logo"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check file size
        if ($_FILES["edit_logo"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["edit_logo"]["tmp_name"], $target_file_edit)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["edit_logo"]["name"])). " has been uploaded.";
                $edit_logo = $target_file_edit;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Update data in database
    $sql = "UPDATE airlines SET email='$edit_email', pass='$edit_pass', airline_name='$edit_airline_name', logo='$edit_logo' WHERE airline_id=$edit_airline_id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Airline updated successfully');</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function(){
        $('.edit-btn').click(function(){
            var airline_id = $(this).data('airline-id');
            var email = $(this).data('email');
            var airline_name = $(this).data('airline-name');
            var logo = $(this).data('logo');

            $('#edit_airline_id').val(airline_id);
            $('#edit_email').val(email);
            $('#edit_airline_name').val(airline_name);
            $('#edit_logo').val('');
        });
    });
</script>

</body>
</html>
