<?php
session_start();

if(!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

?>
<?php
include("./include/connection.php");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userSql = "SELECT * FROM users";
$userResult = $conn->query($userSql);

if ($userResult === false) {
    die("Error executing the user query: " . $conn->error);
}

$vendorSql = "SELECT * FROM vendors";
$vendorResult = $conn->query($vendorSql);

if ($vendorResult === false) {

    die("Error executing the vendor query: " . $conn->error);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User, Airline User, and Vendor Data</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }
        .custom-table {
            width: 100%;
            margin-bottom: 1rem;
            border-radius: 0.25rem;
            overflow-x: auto;
        }
        th,
        td {
            white-space: nowrap;
            
        }

        .table-responsive {
            overflow-x: auto;
            
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }

        .section-heading {

            margin-top: 20px;
        }
    </style>
</head>

<body>

    <?php include("./include/navbar.php"); ?>

    <div class="container">
        <div class="section-heading">
            <h2>User Data</h2>
        </div>
        <div class="table-responsive">
            <table class="table custom-table" style="background-color: #5F1E30;">
                <thead >
                    <tr style="color:wheat;">
                        <th>User ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Gender</th>
                        <th>Email Confirmed</th>
                        <th>Address</th>
                        <th>Verify Code</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    if ($userResult->num_rows > 0) {
                        while ($row = $userResult->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["user_id"] . "</td>";
                            echo "<td>" . $row["first_name"] . "</td>";
                            echo "<td>" . $row["last_name"] . "</td>";
                            echo "<td>" . $row["username"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["phone_number"] . "</td>";
                            echo "<td>" . $row["gender"] . "</td>";
                            echo "<td>" . ($row["confirmed_email"] ? "Yes" : "No") . "</td>";
                            echo "<td>" . $row["address"] . "</td>";
                            echo "<td>" . $row["verify_code"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10'>No user data found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        
        <div class="section-heading">
            <h2>Vendors Data</h2>
        </div>
        <div class="table-responsive">
            <table class="table custom-table" style="background-color: #5F1E30;">
                <thead>
                    <tr style="color: wheat;">
                        <th>Vendor ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Confirmed Email</th>
                        <th>Company Name</th>
                        <th>Phone Number</th>
                       
                        <th>Address</th>
                       
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($vendorResult->num_rows > 0) {
                        while ($row = $vendorResult->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["vendor_id"] . "</td>";
                            echo "<td>" . $row["username"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["password"] . "</td>";
                            echo "<td>" . ($row["confirmed_email"] ? "Yes" : "No") . "</td>";
                            echo "<td>" . $row["company_name"] . "</td>";
                            echo "<td>" . $row["phone_number"] . "</td>";
                            
                            echo "<td>" . $row["address"] . "</td>";
                           
                            echo "<td>" . $row["confirmed_vendor"] . "</td>";
                            echo "<td>
                            <button class='btn btn-success btn-sm' onclick='confirmVendor(" . $row["vendor_id"] . ")'>Confirm</button>
                            <button class='btn btn-danger btn-sm' onclick='deleteVendor(" . $row["vendor_id"] . ")'>Delete</button>
                          </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='14'>No vendor data found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>


        <script>
    function confirmVendor(vendorId) {
        $.ajax({
            url: 'confirm_vendor.php',
            type: 'POST',
            data: {
                vendor_id: vendorId
            },
            success: function(response) {
                
                $('#customAlert').removeClass('alert-danger').addClass('alert-success');
                $('#alertMessage').text('Vendor confirmed successfully');
                $('#customAlert').fadeIn();

                setTimeout(function() {
                    location.reload();
                }, 2000);
            },
            error: function(xhr, status, error) {
             
                $('#customAlert').removeClass('alert-success').addClass('alert-danger');
                $('#alertMessage').text('Error toggling vendor status');
                $('#customAlert').fadeIn();
            }
        });
    }

    function deleteVendor(vendorId) {
        if (confirm("Are you sure you want to delete this vendor?")) {
            $.ajax({
                url: 'delete_vendor.php',
                type: 'POST',
                data: {
                    vendor_id: vendorId
                },
                success: function(response) {
                   
                    $('#customAlert').removeClass('alert-danger').addClass('alert-success');
                    $('#alertMessage').text('Vendor deleted successfully');
                    $('#customAlert').fadeIn();

                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                },
                error: function(xhr, status, error) {
                   
                    $('#customAlert').removeClass('alert-success').addClass('alert-danger');
                    $('#alertMessage').text('Error deleting vendor');
                    $('#customAlert').fadeIn();
                }
            });
        }
    }
</script>


</body>

</html>