<?php
require './include/connection.php';
require './PHPMailer/PHPMailer.php';
require './PHPMailer/Exception.php';
require './PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Check for database connection errors
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize PHPMailer
$mail = new PHPMailer(true);

// Set SMTP settings
$mail->isSMTP();
$mail->Host       = 'smtp.gmail.com';
$mail->SMTPAuth   = true;
$mail->Username   = 'shopflix420@gmail.com';
$mail->Password   = 'vabjcndouidetrnt';
$mail->SMTPSecure = 'tls';
$mail->Port       = 587;
$mail->setFrom('shopflix420@gmail.com', 'SHOPFLIX');

// Check if confirm or cancel actions are triggered
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle confirmation
    if (isset($_POST['confirm'])) {
        $request_id = $_POST['request_id'];

        // Update confirmed status in the airline_requests table
        $sql = "UPDATE airline_requests SET status = 'Approved' WHERE request_id = '$request_id'";
        if (mysqli_query($conn, $sql)) {
            // Send email
            $mail->addAddress($_POST['contact_email']); // Adding recipient's email
            $mail->isHTML(true);
            $mail->Subject = 'Your Request Approval';
            $mail->Body = 'Your request has been approved.';

            if ($mail->send()) {
                echo "Confirmation successful and email sent.";
            } else {
                echo "Confirmation successful but email sending failed: " . $mail->ErrorInfo;
            }
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }

    // Handle cancellation
    if (isset($_POST['cancel'])) {
        $request_id = $_POST['request_id'];

        // Delete the request from the airline_requests table
        $sql = "DELETE FROM airline_requests WHERE request_id = '$request_id'";
        if (mysqli_query($conn, $sql)) {
            echo "Request canceled.";
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    }
}

// Retrieve all requests
$sql = "SELECT * FROM airline_requests";
$result = mysqli_query($conn, $sql);

// Check if $result is defined
if (!$result) {
    echo "Error fetching data: " . mysqli_error($conn);
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Confirmation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to cancel this request?");
        }
    </script>
</head>
<body>
    <?php
    include("./include/navbar.php");
    ?>
<div class="container">
    <h2>Admin Confirmation</h2>
    <table class="table">
        <thead>
        <tr style="background-color:#5f1e30; color:wheat;">
            <th>Request ID</th>
            <th>Airline Name</th>
            <th>Contact Email</th>
            <th>Logo</th>
            <th>Status</th>
            <th>Date Requested</th>
            <th>Last Updated</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['request_id']; ?></td>
                <td><?php echo $row['airline_name']; ?></td>
                <td><?php echo $row['contact_email']; ?></td>
                <td><?php echo $row['logo']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><?php echo $row['date_requested']; ?></td>
                <td><?php echo $row['last_updated']; ?></td>
                <td>
                    <?php if ($row['status'] == 'Pending') { ?>
                        <form action="" method="POST">
                            <input type="hidden" name="request_id" value="<?php echo $row['request_id']; ?>">
                            <input type="hidden" name="contact_email" value="<?php echo $row['contact_email']; ?>">
                            <button type="submit" class="btn btn-primary" name="confirm">Confirm</button>
                        </form>
                        <form action="" method="POST" onsubmit="return confirmDelete();">
                            <input type="hidden" name="request_id" value="<?php echo $row['request_id']; ?>">
                            <button type="submit" class="btn btn-danger" name="cancel">Cancel</button>
                        </form>
                    <?php } elseif ($row['status'] == 'Approved') { ?>
                        <button type="button" class="btn btn-primary" disabled>Confirmed</button>
                    <?php } else { ?>
                        <p>Status: <?php echo $row['status']; ?></p>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
<?php
}

mysqli_close($conn);
?>