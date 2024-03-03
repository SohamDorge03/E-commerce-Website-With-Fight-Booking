
<?php

include("./include/connection.php");

// Check if connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data from the users table
$userSql = "SELECT * FROM users";
$userResult = $conn->query($userSql);

if ($userResult === false) {
    // Query execution failed
    die("Error executing the user query: " . $conn->error);
}

// SQL query to fetch data from the airline_users table
$airlineSql = "SELECT * FROM airline_users";
$airlineResult = $conn->query($airlineSql);

if ($airlineResult === false) {
    // Query execution failed
    die("Error executing the airline query: " . $conn->error);
}

// SQL query to fetch data from the vendors table
$vendorSql = "SELECT * FROM vendors";
$vendorResult = $conn->query($vendorSql);

if ($vendorResult === false) {
    // Query execution failed
    die("Error executing the vendor query: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User, Airline User, and Vendor Data</title>
    <!-- Bootstrap CSS -->
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
            white-space: nowrap; /* Prevent line breaks in table cells */
        }

        .table-responsive {
            overflow-x: auto; /* Make tables responsive */
        }

        /* Styling for even and odd rows */
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
        <!-- User Data Table -->
        <div class="section-heading">
            <h2>User Data</h2>
        </div>
        <div class="table-responsive">
            <table class="table custom-table">
                <thead>
                    <tr>
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
                    // Display user data
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

        <!-- Airline User Data Table -->
        <div class="section-heading">
            <h2>Airline User Data</h2>
        </div>
        <div class="table-responsive">
            <table class="table custom-table">
                <thead>
                    <tr>
                         <th>Airline ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Confirmed Email</th>
                       
                        <th>Profile Pic URL</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>State</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Display airline user data
                    if ($airlineResult->num_rows > 0) {
                        while ($row = $airlineResult->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["airline_id"] . "</td>";
                            echo "<td>" . $row["username"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["password"] . "</td>";
                            echo "<td>" . ($row["confirmed_email"] ? "Yes" : "No") . "</td>";
                            echo "<td>" . $row["profile_pic_url"] . "</td>";
                            echo "<td>" . $row["address"] . "</td>";
                            echo "<td>" . $row["city"] . "</td>";
                            echo "<td>" . $row["state"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10'>No airline user data found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Vendors Data Table -->
        <div class="section-heading">
            <h2>Vendors Data</h2>
        </div>
        <div class="table-responsive">
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th>Vendor ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Confirmed Email</th>
                        <th>Company Name</th>
                        <th>Phone Number</th>
                        <th>Website URL</th>
                        <th>Profile Pic URL</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>State</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Display vendor data
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
                            echo "<td>" . $row["website_url"] . "</td>";
                            echo "<td>" . $row["profile_pic_url"] . "</td>";
                            echo "<td>" . $row["address"] . "</td>";
                            echo "<td>" . $row["city"] . "</td>";
                            echo "<td>" . $row["state"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='12'>No vendor data found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>

<?php
// Close database connection
$conn->close();
?>
</div>
