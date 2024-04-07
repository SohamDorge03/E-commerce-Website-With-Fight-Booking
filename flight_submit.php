<?php

require("./config.php");
include("./include/connection.php");
include("./include/navbar.php");

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendEmail($to, $subject, $body) {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'shopflix420@gmail.com';
    $mail->Password   = 'vabjcndouidetrnt';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;
    $mail->setFrom('shopflix420@gmail.com', 'SHOPFLIX');
    $mail->addAddress($to);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;

    if ($mail->send()) {
        return true;
    } else {
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['stripeToken'])) {
    if (isset($_SESSION['u'])) {
        $user_id = $_SESSION['u'];
        $total_amount = $_SESSION['total_price'];
        $flight_id = isset($_SESSION['flight_id']) ? $_SESSION['flight_id'] : null;

        if ($flight_id) {
            try {
                $token = $_POST['stripeToken'];
                $amount = $total_amount * 100;

                $data = \Stripe\Charge::create([
                    'amount' => $amount,
                    'currency' => 'INR',
                    'description' => 'Flight Booking Payment',
                    'source' => $token,
                ]);

                $payment_status = "success";
                $transaction_id = $data->id;

                $_SESSION['transaction_id'] = $transaction_id;
                $booking_id = $_SESSION['booking_id'];

                $update_sql = "UPDATE booked_flights SET payment_status = 'success', TransactionID = '$transaction_id' WHERE booking_id = $booking_id";
                if (mysqli_query($conn, $update_sql)) {
                    // Fetch flight class and airline_id from flights table
                    $flight_info_query = "SELECT flight_class, airline_id FROM flights WHERE flight_id = $flight_id";
                    $flight_info_result = mysqli_query($conn, $flight_info_query);
                    if ($flight_info_result && mysqli_num_rows($flight_info_result) > 0) {
                        $row = mysqli_fetch_assoc($flight_info_result);
                        $flight_class = $row['flight_class'];
                        $airline_id = $row['airline_id'];

                        // Update booked_flights table with flight class and airline_id
                        $update_flight_info_sql = "UPDATE booked_flights SET flight_class = '$flight_class', airline_id = $airline_id WHERE booking_id = $booking_id";
                        if (mysqli_query($conn, $update_flight_info_sql)) {
                            echo "<div class='container mt-5'>
                                    <div class='row justify-content-center'>
                                        <div class='col-md-6'>
                                            <div class='alert alert-success text-center' role='alert'>
                                                Payment successful
                                            </div>
                                            <a href='Ticket.php?booking_id=$booking_id' class='btn btn-primary'>View Ticket</a>";
                                            
                            // Fetch booking data for ticket download link
                            $booking_query = "SELECT * FROM booked_flights WHERE booking_id = $booking_id";
                            $booking_result = mysqli_query($conn, $booking_query);
                            if ($booking_result && mysqli_num_rows($booking_result) > 0) {
                                $booking_data = mysqli_fetch_assoc($booking_result);

                                echo "<a href='ticket_pdf.php?booking_id=".$booking_data['booking_id']."' class='btn btn-primary' style='margin-left:20px;'>Download Ticket</a>";
                            } else {
                                echo "Booking data not found.";
                            }
                                            
                            echo "</div>
                                    </div>
                                </div>";

                            $email_query = "SELECT email FROM users WHERE user_id = $user_id";
                            $email_result = mysqli_query($conn, $email_query);
                            if ($email_result && mysqli_num_rows($email_result) > 0) {
                                $user_row = mysqli_fetch_assoc($email_result);
                                $user_email = $user_row['email'];

                                // Prepare email content
                                $passenger_query = "SELECT name, seatno, gateno, pnr_no FROM passenger WHERE booking_id = $booking_id";
                                $passenger_result = mysqli_query($conn, $passenger_query);
                                if ($passenger_result && mysqli_num_rows($passenger_result) > 0) {
                                    $seats_info = "";
                                    $count = 1;
                                    while ($passenger_row = mysqli_fetch_assoc($passenger_result)) {
                                        $passenger_name = $passenger_row['name'];
                                        $seat_no = $passenger_row['seatno'];
                                        $gate_no = $passenger_row['gateno'];
                                        $pnr_no = $passenger_row['pnr_no'];
                                        $seats_info .= "<br>Passenger $count: $passenger_name - Seat No: $seat_no - Gate No: $gate_no";
                                        $count++;
                                    }
                                } else {
                                    $seats_info = "Seat Information not available";
                                }

                                // Fetch airline name and flight code
                                $flight_query = "SELECT a.airline_name, f.flight_code FROM airlines a INNER JOIN flights f ON a.airline_id = f.airline_id WHERE f.flight_id = $flight_id";
                                $flight_result = mysqli_query($conn, $flight_query);
                                if ($flight_result && mysqli_num_rows($flight_result) > 0) {
                                    $flight_row = mysqli_fetch_assoc($flight_result);
                                    $airline_name = $flight_row['airline_name'];
                                    $flight_code = $flight_row['flight_code'];
                                } else {
                                    $airline_name = "Airline Name";
                                    $flight_code = "Flight Code";
                                }

                                // Fetch PNR number
                                $pnr_query = "SELECT DISTINCT pnr_no FROM passenger WHERE booking_id = $booking_id LIMIT 1";
                                $pnr_result = mysqli_query($conn, $pnr_query);
                                $pnr_row = mysqli_fetch_assoc($pnr_result);
                                $pnr_no = $pnr_row['pnr_no'];

                                // Send email
                                $to = $user_email;
                                $subject = 'Flight Booking Details';
                                $body = "Thank you for booking your flight with us!<br><br>
                                        Flight Code: $flight_code<br>
                                        $seats_info<br>
                                        Airline Name: $airline_name<br>
                                        PNR Number: $pnr_no<br>
                                        HAPPY JOURNEY <br>
                                        Regards,<br>
                                         The SHOPFLIX Team";
                                $email_sent = sendEmail($to, $subject, $body);

                                if (!$email_sent) {
                                    echo "<div class='alert alert-danger mt-3' role='alert'>
                                            Error sending email. Please contact customer support.
                                        </div>";
                                }
                            } else {
                                echo "<div class='alert alert-danger mt-3' role='alert'>
                                        Error: User email not found.
                                    </div>";
                            }
                        } else {
                            echo "Error updating flight info: " . mysqli_error($conn);
                        }
                    } else {
                        echo "No flight info found.";
                    }
                } else {
                    echo "Error updating data: " . mysqli_error($conn);
                }

            } catch (\Stripe\Exception\InvalidRequestException $e) {
                echo 'Stripe Error: ' . $e->getMessage();
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
        } else {
            echo "Flight ID is not set in session.";
        }
    } else {
        echo "User not logged in.";
    }
} else {
    echo "Invalid request.";
}
?>
