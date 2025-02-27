<?php
session_start();

if(!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

?>
<?php

include("./include/connection.php");
include("./include/navbar.php");

if (isset($_POST['submit'])) {

    $state = isset($_POST["state"]) ? $_POST["state"] : "";
    $city = isset($_POST["city"]) ? $_POST["city"] : "";
    $airport_name = isset($_POST["airport_name"]) ? $_POST["airport_name"] : "";
    $airport_code = isset($_POST["airport_code"]) ? $_POST["airport_code"] : "";
    $location = isset($_POST["location"]) ? $_POST["location"] : "";

    if ($_POST['submit'] == 'Add') {
        $sql = "INSERT INTO airports (state, city, airport_name, airport_code, location) 
                VALUES ('$state', '$city', '$airport_name', '$airport_code', '$location')";
    } elseif ($_POST['submit'] == 'Update') {

        $sql = "UPDATE airports 
                SET state='$state', city='$city', airport_name='$airport_name', location='$location' 
                WHERE airport_code='$airport_code'";
    }

    if ($conn->query($sql) === TRUE) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  Record ' . ($_POST['submit'] == 'Add' ? 'added' : 'updated') . ' successfully
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </button>
              </div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  Error: ' . $sql . '<br>' . $conn->error . '
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </button>
              </div>';
    }
}


if (isset($_POST['delete'])) {

    $airport_code = isset($_POST['airport_code']) ? $_POST['airport_code'] : "";

    $delete_sql = "DELETE FROM airports WHERE airport_code = '$airport_code'";

    if ($conn->query($delete_sql) === TRUE) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  Record deleted successfully
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </button>
              </div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  Error deleting record: ' . $conn->error . '
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </button>
              </div>';
    }
}
?>
<div class="content">
    <div class="container mt-5">
        <h2>Airport Management</h2>

        <button type="button" class="btn btn-success btn-sm-6" id="button-add" data-toggle="modal" data-target="#airportModal">
            Add Airport
        </button>
    </div>

    <div class="modal" id="airportModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Airport Details</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

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
                        <button type="submit" class="btn btn-primary" name="submit" value="Add" style="margin-top: 20px;">Add</button>
                        <button type="submit" class="btn btn-success" name="submit" value="Update" style="margin-top: 20px;">Update</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="container mt-5">
        <table class="table">
            <thead style="background-color: #5F1E30;">
                <tr style="color:wheat">
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
                $sql = "SELECT * FROM airports";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
    
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
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function populateForm(button) {
        var modal = $('#airportModal');
        modal.find('#state').val(button.getAttribute('data-state'));
        modal.find('#city').val(button.getAttribute('data-city'));
        modal.find('#airport_name').val(button.getAttribute('data-airport-name'));
        modal.find('#airport_code').val(button.getAttribute('data-airport-code'));
        modal.find('#location').val(button.getAttribute('data-location'));
        modal.find('[name=submit]').val('Update');
    }
</script>
