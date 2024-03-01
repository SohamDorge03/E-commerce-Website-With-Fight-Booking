<?php
include("./include/connection.php");
include("./include/navbar.php"); 

if (isset($_POST['submit'])) {
    
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $pass = isset($_POST["pass"]) ? $_POST["pass"] : "";
    $airline_name = isset($_POST["airline_name"]) ? $_POST["airline_name"] : "";
    $logo = isset($_POST["logo"]) ? $_POST["logo"] : "";

    if ($_POST['submit'] == 'Add') {
        
        $sql = "INSERT INTO airlines (email, pass, airline_name, logo) 
                VALUES ('$email', '$pass', '$airline_name', '$logo')";
    } elseif ($_POST['submit'] == 'Update') {
        
        $airline_id = isset($_POST['airline_id']) ? $_POST['airline_id'] : "";
        $sql = "UPDATE airlines 
                SET email='$email', pass='$pass', airline_name='$airline_name', logo='$logo' 
                WHERE airline_id='$airline_id'";
    }

    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  Record ' . ($_POST['submit'] == 'Add' ? 'added' : 'updated') . ' successfully
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Error: ' . $sql . '<br>' . $conn->error . '</div>';
    }
}

if(isset($_POST['delete'])){
    $airline_id = isset($_POST['airline_id']) ? $_POST['airline_id'] : "";

    $delete_sql = "DELETE FROM airlines WHERE airline_id = '$airline_id'";

    if ($conn->query($delete_sql) === TRUE) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  Record deleted successfully
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Error deleting record: ' . $conn->error . '</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    
    <div class="container mt-5">
        <h1>Airline Management</h1>

        <button type="button" class="btn btn-primary btn-lg" id="button-add" data-toggle="modal"
            data-target="#airlineModal">
            Add Airline
        </button>
    </div>
    <div class="modal" id="airlineModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Airline Details</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="pass">Password:</label>
                            <input type="text" class="form-control" id="pass" name="pass" required>
                        </div>
                        <div class="form-group">
                            <label for="airline_name">Airline Name:</label>
                            <input type="text" class="form-control" id="airline_name" name="airline_name" required>
                        </div>
        
                        <div class="form-group">
                            <label for="logo">Logo:</label>
                            <input type="file" class="form-control" id="logo" name="logo" required>
                        </div>
                        <input type="hidden" id="airline_id" name="airline_id" value="">
                        <button type="submit" class="btn btn-primary" name="submit" value="Add">Add</button>
                        <button type="submit" class="btn btn-success" name="submit" value="Update">Update</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="container mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Airline Name</th>
                    <th>Logo</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
 
                $sql = "SELECT * FROM airlines";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["pass"] . "</td>";
                        echo "<td>" . $row["airline_name"] . "</td>";
                        echo "<td><img src='" . $row["logo"] . "' alt='Airline Logo' style='max-width: 100px; max-height: 100px;'></td>";
                        echo "<td>
                                  <button type='button' class='btn btn-primary btn-sm' 
                                    data-toggle='modal' data-target='#airlineModal'
                                    data-email='" . $row["email"] . "'
                                    data-pass='" . $row["pass"] . "'
                                    data-airline-name='" . $row["airline_name"] . "'
                                    data-logo='" . $row["logo"] . "'
                                    data-airline-id='" . $row["airline_id"] . "'
                                    onclick='populateForm(this)'>Edit</button>
                                    <form method='post' style='display:inline;'>
                                        <input type='hidden' name='airline_id' value='" . $row["airline_id"] . "'>
                                        <button type='submit' class='btn btn-danger btn-sm' name='delete'>Delete</button>
                                    </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No airlines found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
  
        function populateForm(button) {
            var modal = $('#airlineModal');
            modal.find('#email').val(button.getAttribute('data-email'));
            modal.find('#pass').val(button.getAttribute('data-pass'));
            modal.find('#airline_name').val(button.getAttribute('data-airline-name'));
            modal.find('#logo').val(button.getAttribute('data-logo'));
            modal.find('#airline_id').val(button.getAttribute('data-airline-id')); 
            modal.find('[name=submit]').val('Update');
        }
    </script>
</body>
</html>
