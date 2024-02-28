<?php
// Replace these variables with your actual database credentials
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
        /* Add a top margin to the table */
        .container {
            margin-top: 20px; /* Adjust this value as needed */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>User Data</h2>
        <table class="table table-striped">
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
                    <th>Profile Pic URL</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Pincode</th>
                    <th>verify_code</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Display user data
                if ($userResult->num_rows > 0) {
                    while($row = $userResult->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row["user_id"]."</td>";
                        echo "<td>".$row["first_name"]."</td>";
                        echo "<td>".$row["last_name"]."</td>";
                        echo "<td>".$row["username"]."</td>";
                        echo "<td>".$row["email"]."</td>";
                        echo "<td>".$row["phone_number"]."</td>";
                        echo "<td>".$row["gender"]."</td>";
                        echo "<td>".($row["confirmed_email"] ? "Yes" : "No")."</td>";
                        echo "<td>".$row["profile_pic_url"]."</td>";
                        echo "<td>".$row["address"]."</td>";
                        echo "<td>".$row["city"]."</td>";
                        echo "<td>".$row["state"]."</td>";
                        echo "<td>".$row["pincode"]."</td>";
                        echo "<td>".$row["verify_code"]."</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='14'>No user data found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <h2>Airline User Data</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Confirmed Email</th>
                    <th>Airline ID</th>
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
                    while($row = $airlineResult->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row["user_id"]."</td>";
                        echo "<td>".$row["username"]."</td>";
                        echo "<td>".$row["email"]."</td>";
                        echo "<td>".$row["password"]."</td>";
                        echo "<td>".($row["confirmed_email"] ? "Yes" : "No")."</td>";
                        echo "<td>".$row["airline_id"]."</td>";
                        echo "<td>".$row["profile_pic_url"]."</td>";
                        echo "<td>".$row["address"]."</td>";
                        echo "<td>".$row["city"]."</td>";
                        echo "<td>".$row["state"]."</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No airline user data found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <h2>Vendors Data</h2>
        <table class="table table-striped">
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
                    while($row = $vendorResult->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row["vendor_id"]."</td>";
                        echo "<td>".$row["username"]."</td>";
                        echo "<td>".$row["email"]."</td>";
                        echo "<td>".$row["password"]."</td>";
                        echo "<td>".($row["confirmed_email"] ? "Yes" : "No")."</td>";
                        echo "<td>".$row["company_name"]."</td>";
                        echo "<td>".$row["phone_number"]."</td>";
                        echo "<td>".$row["website_url"]."</td>";
                        echo "<td>".$row["profile_pic_url"]."</td>";
                        echo "<td>".$row["address"]."</td>";
                        echo "<td>".$row["city"]."</td>";
                        echo "<td>".$row["state"]."</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='12'>No vendor data found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
