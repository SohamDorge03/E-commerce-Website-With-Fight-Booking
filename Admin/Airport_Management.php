<?php
include("./include/connection.php"); // Include your database connection file

// Check if the form is submitted for adding or updating
if (isset($_POST['submit'])) {
    // Retrieve form data
    $state = isset($_POST["state"]) ? $_POST["state"] : "";
    $city = isset($_POST["city"]) ? $_POST["city"] : "";
    $airport_name = isset($_POST["airport_name"]) ? $_POST["airport_name"] : "";
    $airport_code = isset($_POST["airport_code"]) ? $_POST["airport_code"] : "";
    $location = isset($_POST["location"]) ? $_POST["location"] : "";

    if ($_POST['submit'] == 'Add') {
        // Prepare SQL statement to insert data into the database
        $sql = "INSERT INTO airports (state, city, airport_name, airport_code, location) 
                VALUES ('$state', '$city', '$airport_name', '$airport_code', '$location')";
    } elseif ($_POST['submit'] == 'Update') {
        // Prepare SQL statement to update data in the database
        $sql = "UPDATE airports 
                SET state='$state', city='$city', airport_name='$airport_name', location='$location' 
                WHERE airport_code='$airport_code'";
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

// Check if delete button is clicked
if(isset($_POST['delete'])){
    // Retrieve airport code to be deleted
    $airport_code = isset($_POST['airport_code']) ? $_POST['airport_code'] : "";

    // Prepare SQL statement to delete data from the database
    $delete_sql = "DELETE FROM airports WHERE airport_code = '$airport_code'"; // Adjusted to use airport_code

    // Execute SQL statement
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
    <title>Airport Management</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        h1 {
            color: navy;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1>Airport Management</h1>

        <!-- Button to Open the Add Airport Modal -->
        <button type="button" class="btn btn-primary btn-lg" id="button-add" data-toggle="modal"
            data-target="#airportModal">
            Add Airport
        </button>
    </div>
    <!-- The Add & Update Modal -->
    <div class="modal" id="airportModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Airport Details</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="state">State:</label>
                            <input type="text" class="form-control" id="state" name="state" required>
                        </div>
                        <div class="form-group">
                            <label for="city">City:</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                        <div class="form-group">
                            <label for="airport_name">Airport Name:</label>
                            <input type="text" class="form-control" id="airport_name" name="airport_name" required>
                        </div>
                        <div class="form-group">
                            <label for="airport_code">Airport Code:</label>
                            <input type="text" class="form-control" id="airport_code" name="airport_code" required>
                        </div>
                        <div class="form-group">
                            <label for="location">Location:</label>
                            <input type="text" class="form-control" id="location" name="location" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit" value="Add">Add</button>
                        <button type="submit" class="btn btn-success" name="submit" value="Update">Update</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Displaying Data in a Table -->
    <div class="container mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th>Airport Name</th>
                    <th>Airport Code</th>
                    <th>State</th>
                    <th>City</th>
                    <th>Location</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch data from the database
                $sql = "SELECT * FROM airports";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["airport_name"] . "</td>";
                        echo "<td>" . $row["airport_code"] . "</td>";
                        echo "<td>" . $row["state"] . "</td>";
                        echo "<td>" . $row["city"] . "</td>";
                        echo "<td>" . $row["location"] . "</td>";
                        echo "<td>
                                  <button type='button' class='btn btn-primary btn-sm' 
                                    data-toggle='modal' data-target='#airportModal'
                                    data-state='" . $row["state"] . "'
                                    data-city='" . $row["city"] . "'
                                    data-airport-name='" . $row["airport_name"] . "'
                                    data-airport-code='" . $row["airport_code"] . "'
                                    data-location='" . $row["location"] . "'
                                    onclick='populateForm(this)'>Edit</button>
                                    <form method='post' style='display:inline;'>
                                        <input type='hidden' name='airport_code' value='" . $row["airport_code"] . "'>
                                        <button type='submit' class='btn btn-danger btn-sm' name='delete'>Delete</button>
                                    </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No airports found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Function to populate form fields for editing
        function populateForm(button) {
            var modal = $('#airportModal');
            modal.find('#state').val(button.getAttribute('data-state'));
            modal.find('#city').val(button.getAttribute('data-city'));
            modal.find('#airport_name').val(button.getAttribute('data-airport-name'));
            modal.find('#airport_code').val(button.getAttribute('data-airport-code'));
            modal.find('#location').val(button.getAttribute('data-location'));
            // Change the submit button value to Update
            modal.find('[name=submit]').val('Update');
        }
    </script>

</body>

</html>
