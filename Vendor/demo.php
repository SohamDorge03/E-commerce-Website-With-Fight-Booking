<?php
    session_start();

    if (!isset($_SESSION['vendor_id'])) {
        header("Location: login.php");
        exit();
    }

    include("./include/navbar.php");
    include("./include/connection.php");

    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/Exception.php';
    require 'PHPMailer/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["demo_id"]) && isset($_POST["demo_date"])) {
            $demoId = $_POST["demo_id"];
            $demoDate = $_POST["demo_date"];
            $currentDate = date("Y-m-d H:i:s");

            if (strtotime($demoDate) <= strtotime($currentDate)) {
                echo "<script>alert('Please select a date and time after the current date and time.');</script>";
            } else {
                // Update the database
                $sql = "UPDATE book_demo SET status = 'Confirm', demo_date = ? WHERE demo_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $demoDate, $demoId);

                if ($stmt->execute()) {
                    
                    $getUserEmailQuery = "SELECT u.email FROM book_demo bd INNER JOIN users u ON bd.user_id = u.user_id WHERE bd.demo_id = ?";
                    $stmt = $conn->prepare($getUserEmailQuery);
                    $stmt->bind_param("i", $demoId);
                    $stmt->execute();
                    $userEmailResult = $stmt->get_result();

                    if ($userEmailResult->num_rows > 0) {
                        $row = $userEmailResult->fetch_assoc();
                        $userEmail = $row["email"];

                    
                        $mail = new PHPMailer(true);
                        $mail->isSMTP();
                        $mail->Host       = 'smtp.gmail.com';
                        $mail->SMTPAuth   = true;
                        $mail->Username   = 'shopflix420@gmail.com';
                        $mail->Password   = 'vabjcndouidetrnt';
                        $mail->SMTPSecure = 'tls';
                        $mail->Port       = 587;
                        $mail->setFrom('shopflix420@gmail.com', 'SHOPFLIX');
                        $mail->addAddress($userEmail, 'User');
                        $mail->isHTML(true);
                        $mail->Subject = 'Demo Booking Confirmation';
                        $mail->Body = "<h1>Your demo booking with Demo ID:$demoId </h1> <h2 style='color:green;'> has been confirmed on $currentDate. Demo Date and Time: $demoDate </h2>";


                
                        try {
                            $mail->send();
                            echo "<script>alert('Demo confirmed successfully. Confirmation email sent.');</script>";
                        } catch (Exception $e) {
                            echo "<script>alert('Demo confirmed successfully, but there was an error sending the confirmation email: {$mail->ErrorInfo}');</script>";
                        }
                    } else {
                        echo "<script>alert('Error: User email not found.');</script>";
                    }
                } else {
                    echo "<script>alert('Error confirming demo: {$conn->error}');</script>";
                }
            }
        } elseif (isset($_POST['remove_demo_id'])) {
            $demoId = $_POST['remove_demo_id'];

            
            $sql = "DELETE FROM book_demo WHERE demo_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $demoId);

            if ($stmt->execute()) {
                echo "<script>alert('Demo data removed successfully.');</script>";
            } else {
                echo "<script>alert('Error removing demo data: {$conn->error}');</script>";
            }
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Book Demo Data</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css">
        <style>
            .container {
                margin-top: 70px !important;
                margin-left: 20px;
            }
            .confirm-btn {
                margin-top: 10px;
                
            }
        </style>
    </head>
    <body>

    <div class="container mt-5">
        
        <h2>Book Demo Data</h2>

        <table class="table">
        <div class="alert alert-danger alert-dismissible fade show" id="validationAlert" style="display: none;" role="alert">
        Please select a date between 
        <strong><?= date('Y-m-d', strtotime('+1 day')) ?></strong> and 
        <strong><?= date('Y-m-d', strtotime('+1 week')) ?></strong>.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
            <thead>
                <tr>
                    <th>Demo ID</th>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Product ID</th>
                    <th>Vendor ID</th>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Demo Date</th>
                    <th>Application_date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $vendorIds = $_SESSION['vendor_id'];

                    $sql = "SELECT 
                                bd.demo_id, 
                                bd.user_id, 
                                u.first_name, 
                                u.last_name, 
                                u.address, 
                                u.phone_number, 
                                bd.product_id, 
                                p.vendor_id, 
                                p.img1, 
                                p.name AS name, 
                                bd.demo_date,
                                bd.Application_date, 
                                bd.status 
                            FROM 
                                book_demo bd  
                            INNER JOIN 
                                users u ON bd.user_id = u.user_id 
                            INNER JOIN 
                                products p ON bd.product_id = p.product_id
                            WHERE 
                                p.vendor_id = ?";

                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $vendorIds);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                    
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["demo_id"] . "</td>";
                            echo "<td>" . $row["user_id"] . "</td>";
                            echo "<td>" . $row["first_name"] . " " . $row["last_name"] . "</td>";
                            echo "<td>" . $row["address"] . "</td>";
                            echo "<td>" . $row["phone_number"] . "</td>";
                            echo "<td>" . $row["product_id"] . "</td>";
                            echo "<td>" . $row["vendor_id"] . "</td>";
                            echo "<td><img src='" . $row["img1"] . "' height='50' width='50'></td>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td><form action='' method='post'>
                            <input type='hidden' name='demo_id' value='" . $row["demo_id"] . "'>
                            <input type='datetime-local' name='demo_date' value='" . $row["demo_date"] . "'>
                            <input type='submit' class='btn btn-success confirm-btn' value='Confirm'>
                        </form></td>";
                            echo "<td>" . $row["Application_date"] . "</td>";
                            echo "<td>" . $row["status"] . "</td>";
                            echo "<td>";
                            echo "<button class='btn btn-danger remove-btn' data-demo-id='" . $row["demo_id"] . "'>Remove</button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='12'>No records found</td></tr>";
                    }
                    $stmt->close();
                    ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>

    <script>
        $(document).ready(function(){
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                startDate: '+1d', 
                endDate: '+1w'    
            });

            $('.timepicker').timepicker({
                showMeridian: false,
                minuteStep: 1,
                defaultTime: false
            });

            $('.remove-btn').click(function() {
                var demoId = $(this).data('demo-id');
                if (confirm("Are you sure you want to remove this demo data?")) {
                    $.ajax({
                        url: 'remove_demo.php',
                        method: 'POST',
                        data: { demo_id: demoId },
                        success: function(response) {
                            alert(response);
                            location.reload(); 
                        },
                        error: function(xhr, status, error) {
                            alert("Error: " + error);
                        }
                    });
                }
            });

            $('form').submit(function(event) {
                var form = $(this);
                var submitButton = form.find('.confirm-btn'); // Select the confirm button within the form
                
                var selectedDate = new Date($('[name="demo_date"]').val());
                var minDate = new Date();
                minDate.setDate(minDate.getDate() + 1); 
                var maxDate = new Date();
                maxDate.setDate(maxDate.getDate() + 7); 

                if (selectedDate < minDate || selectedDate > maxDate) {
                    $('#validationAlert').show();
                    event.preventDefault(); 
                } else {
                    $('#validationAlert').hide();
                    submitButton.prop('disabled', true); // Disable the confirm button
                }
            });
        });
    </script>
    </body>
    </html>
