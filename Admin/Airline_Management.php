


<?php
include("./include/navbar.php");
include("./include/connection.php");

// Function to sanitize input data
function sanitize($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Check if the form is submitted for adding an airline
if (isset($_POST['submit'])) {
    // Retrieve form data and sanitize
    $email = sanitize($_POST["email"]);
    $password = sanitize($_POST["password"]);
    $airline_name = sanitize($_POST["name"]);

    // Check if a file is uploaded
    if (isset($_FILES['logo'])) {
        $logo_tmp_name = $_FILES['logo']['tmp_name'];
        $logo_name = $_FILES['logo']['name'];
        $logo_path = "./image3/" . $logo_name;
        move_uploaded_file($logo_tmp_name, $logo_path);
    } else {
        $logo_path = null;
    }

    // Check if the email already exists in the database
    $check_email_sql = "SELECT email FROM airlines WHERE email = '$email'";
    $result = $conn->query($check_email_sql);

    if ($result->num_rows > 0) {
        echo '<div class="alert alert-danger" role="alert">Error: Email already exists.</div>';
    } else {
        $sql = "INSERT INTO airlines (email, pass, airline_name, logo) 
                VALUES ('$email', '$password', '$airline_name', '$logo_path')";

        if ($conn->query($sql) === TRUE) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      New airline added successfully
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error: ' . $sql . '<br>' . $conn->error . '</div>';
        }
    }
}

// Check if delete button is clicked
if (isset($_POST['delete'])) {
    $email = sanitize($_POST['email']);
    $delete_sql = "DELETE FROM airlines WHERE email = '$email'";

    if ($conn->query($delete_sql) === TRUE) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  Airline deleted successfully
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Error deleting airline: ' . $conn->error . '</div>';
    }
}

// Check if update button is clicked
if (isset($_POST['update'])) {
    $email = sanitize($_POST["email"]);
    $password = sanitize($_POST["password"]);
    $airline_name = sanitize($_POST["name"]);

    if (isset($_FILES['logo'])) {
        $logo_tmp_name = $_FILES['logo']['tmp_name'];
        $logo_name = $_FILES['logo']['name'];
        $logo_path = "./image3/" . $logo_name;
        move_uploaded_file($logo_tmp_name, $logo_path);
    } else {
        $logo_path = null;
    }

    $update_sql = "UPDATE airlines SET pass = '$password', airline_name = '$airline_name', logo = '$logo_path' WHERE email = '$email'";

    if ($conn->query($update_sql) === TRUE) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  Airline details updated successfully
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Error updating airline details: ' . $conn->error . '</div>';
    }
}
?>
 <div id="container">
        <div id="sidebar">
            <h2>Admin Dashboard</h2>
            <ul>
                <li><a href="Manage_users.php"><i class="fas fa-users"></i> Manage Users</a></li>
                <li><a href="manage_products.php"><i class="fas fa-box"></i> Manage Products</a></li>
                <li><a href="manage_orders.php"><i class="fas fa-shopping-cart"></i> Manage Orders</a></li>
                <li><a href="manage_appointments.php"><i class="fas fa-calendar-alt"></i> Manage Appointments</a></li>
                <li><a href="manage_warranty.php"><i class="fas fa-shield-alt"></i> Manage Warranty</a></li>
                <li><a href="manage_demos.php"><i class="fas fa-video"></i> Manage Demos</a></li>
                <li><a href="Airport_Management.php"><i class="fas fa-plane-arrival"></i> Airport Management</a></li>
                <li><a href="Airline_Management.php"><i class="fas fa-plane-departure"></i> Airline Management</a></li>
                <li><a href="manage_flights.php"><i class="fas fa-fighter-jet"></i> Manage Flights</a></li>
                <li><a href="admin_settings.php"><i class="fas fa-cog"></i> Admin Settings</a></li>
                <li><a href="manage_booking.php"><i class="fas fa-cog"></i>manage booking</a></li>
                <div>
                    <li class="menu-item-has-children">
                        <a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i>Logout</a>
                    </li>
                </div>
            </ul>
        </div>
        <div id="main">
            <header id="header">
                <div class="menu-toggle" id="menu-toggle">&#9776;</div>
                <h1>Welcome to Shopflix Admin Dashboard</h1>
            </header>
            <div class="content">
            
     

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .h1 {
            color: navy;
            margin-bottom: 30px;
        }
    </style>

<body>
    <div class="container mt-5">
        <h1>Airline Management</h1>

        <!-- Button to Open the Add Airline Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAirlineModal">
            Add Airline
        </button>
    </div>

    <!-- Add Airline Modal -->
    <div class="modal fade" id="addAirlineModal" tabindex="-1" role="dialog" aria-labelledby="addAirlineModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAirlineModalLabel">Add Airline</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Password:</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group">
                            <label>Airline Name:</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label>Logo:</label>
                            <input type="file" class="form-control-file" name="logo">
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Airline Modal -->
    <?php
    // Fetch data from the database for editing
    $edit_sql = "SELECT * FROM airlines";
    $edit_result = $conn->query($edit_sql);

    if ($edit_result->num_rows > 0) {
        while ($edit_row = $edit_result->fetch_assoc()) {
            echo "<div class='modal fade' id='editModal" . $edit_row['email'] . "' tabindex='-1' role='dialog' aria-labelledby='editModalLabel" . $edit_row['email'] . "' aria-hidden='true'>
                        <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h5 class='modal-title' id='editModalLabel" . $edit_row['email'] . "'>Edit Airline</h5>
                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>
                                <div class='modal-body'>
                                    <form method='post' enctype='multipart/form-data'>
                                        <div class='form-group'>
                                            <label>Password:</label>
                                            <input type='password' class='form-control' name='password' required>
                                        </div>
                                        <div class='form-group'>
                                            <label>Airline Name:</label>
                                            <input type='text' class='form-control' name='name' value='" . $edit_row["airline_name"] . "'>
                                        </div>
                                        <div class='form-group'>
                                            <label>Logo:</label>
                                            <input type='file' class='form-control-file' name='logo'>
                                        </div>
                                        <button type='submit' class='btn btn-primary' name='update'>Update</button>
                                        <input type='hidden' name='email' value='" . $edit_row["email"] . "'>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>";
        }
    }
    ?>

    <!-- Displaying Airline Data in a Table -->
    <div class="container mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Airline Name</th>
                    <th>Logo</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch data from the database
                $sql = "SELECT * FROM airlines";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["airline_name"] . "</td>";
                        if ($row["logo"]) {
                            echo "<td><img src='" . $row['logo'] . "' alt='logo' style='max-width: 100px; max-height: 100px;'></td>";
                        } else {
                            echo "<td>No logo</td>";
                        }
                        echo "<td>
                                  <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editModal" . $row['email'] . "'>Edit</button>
                                  <form method='post' style='display:inline;'>
                                    <input type='hidden' name='email' value='" . $row["email"] . "'>
                                    <button type='submit' class='btn btn-danger' name='delete'>Delete</button>
                                  </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No airlines found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
   
    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</div>
        </div>
    </div>