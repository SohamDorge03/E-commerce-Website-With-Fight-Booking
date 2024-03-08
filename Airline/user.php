<?php
include("./navbar.php");
include("./connection.php");

// Check if the Confirm button is clicked
if(isset($_POST['confirm'])) {
    $user_id = $_POST['user_id'];
    // Update the confirmation_admin_status to 1 (confirmed)
    $sql = "UPDATE airline_users SET confirmation_admin_status = 1 WHERE user_id = $user_id";
    mysqli_query($conn, $sql);
    // Show confirmation message
    echo "<script>alert('User confirmed successfully.');</script>";
}

// Check if the Remove button is clicked
if(isset($_POST['remove'])) {
    $user_id = $_POST['user_id'];
    // Remove the user data
    $sql = "DELETE FROM airline_users WHERE user_id = $user_id";
    mysqli_query($conn, $sql);
    // Show removal message
    echo "<script>alert('User removed successfully.');</script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Airline Users</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .container{
        margin-top: 70px !important;
        margin-left: 70px;
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <h2>Airline Users</h2>
  <table class="table">
    <thead>
      <tr>
        <th>User ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Confirmed Email</th>
        <th>Airline ID</th>
        <th>Profile Pic URL</th>
        <th>Address</th>
        <th>City</th>
        <th>State</th>
        <th>Confirmation Admin Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php

      $sql = "SELECT * FROM airline_users";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<td>" . $row['user_id'] . "</td>";
              echo "<td>" . $row['username'] . "</td>";
              echo "<td>" . $row['email'] . "</td>";
              echo "<td>" . ($row['confirmed_email'] ? 'Yes' : 'No') . "</td>";
              echo "<td>" . $row['airline_id'] . "</td>";
              echo "<td>" . $row['profile_pic_url'] . "</td>";
              echo "<td>" . $row['address'] . "</td>";
              echo "<td>" . $row['city'] . "</td>";
              echo "<td>" . $row['state'] . "</td>";
              echo "<td>" . $row['confirmation_admin_status'] . "</td>";
              echo "<td>
                        <form method='POST'>
                            <input type='hidden' name='user_id' value='" . $row['user_id'] . "'>
                            <button type='submit' class='btn btn-success' name='confirm'>Confirm</button>
                        </form>
                    </td>";
              echo "<td>
                        <form method='POST'>
                            <input type='hidden' name='user_id' value='" . $row['user_id'] . "'>
                            <button type='submit' class='btn btn-danger' name='remove'>Remove</button>
                        </form>
                    </td>";
              echo "</tr>";
          }
      } else {
          echo "<tr><td colspan='11'>No users found</td></tr>";
      }
      ?>
    </tbody>
  </table>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
