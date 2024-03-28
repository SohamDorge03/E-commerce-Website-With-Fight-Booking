<?php
// Include mpdf library
include('admin/vendor/autoload.php');

// Connect to your MySQL database (replace with your actual database credentials)
include("./include/connection.php");

if (isset($_GET['booking_id'])) {

    // Get the booking_id from the URL
    $booking_id = $_GET['booking_id'];

    // Fetch data for the ticket
    $sql = "SELECT bf.booking_id, bf.take_seats, bf.booked_date, bf.TransactionID, 
    p.name AS passenger_name, 
    f.flight_code, 
    a.airline_name,
    a1.airport_name AS source_airport,
    a2.airport_name AS destination_airport,
    f.source_date,
    f.source_time,
    p.seatno,
    p.gateno
    FROM booked_flights bf
    JOIN passenger p ON bf.booking_id = p.booking_id
    JOIN flights f ON bf.flight_id = f.flight_id
    JOIN airlines a ON f.airline_id = a.airline_id
    JOIN airports a1 ON f.dep_airport_id = a1.airport_id
    JOIN airports a2 ON f.arr_airport_id = a2.airport_id
    WHERE bf.booking_id = $booking_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Initialize mPDF
        $mpdf = new \Mpdf\Mpdf();

        // Start buffer capture
        ob_start();
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Flight Ticket</title>
            <style>
                /* Add your CSS styles here */
                .card {
                    border: 1px solid #ccc;
                    border-radius: 10px;
                    padding: 20px;
                    margin-bottom: 20px;
                }

                .card-header {
                    background-color: #00008B;
                    color: wheat;
                    padding: 10px;
                    border-bottom: 1px solid #ccc;
                    text-align: center;
                }

                .detail1,.detail2,.detail3,.detail4,.detail5,.detail6,.detail7,.detail8{
                    margin-top: 20px;
                }

            </style>
        </head>

        <body>
            <?php
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
            ?>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 offset-md-3 mt-5">
                            <div class="card">
                                <div class="card-header">
                                    <h3>BOARDING PASS</h3>
                                    <img src="image.png" alt="Airline Logo" class="airline-logo">
                                </div>
                                <div class="details">
                                    <div class="detail">
                                        <p class="p1"><strong>Passenger Name:</strong> <?php echo $row['passenger_name']; ?></p>
                                        <div class="detail1">
                                            <label class="p2"><strong>From:</strong></label>
                                            <div class="p2-details"><?php echo $row['source_airport']; ?></div>
                                        </div>
                                        <div class="detail2">
                                            <label class="p6"><strong>Airline:</strong></label>
                                            <div class="p6-details"><?php echo $row['airline_name']; ?></div>
                                        </div>
                                        <div class="detail3">
                                            <label class="p7"><strong>To:</strong></label>
                                            <div class="p7-details"><?php echo $row['destination_airport']; ?></div>
                                        </div>
                                        <div class="detail4">
                                            <label class="p3"><strong>Date:</strong></label>
                                            <div class="p3-details"><?php echo $row['source_date']; ?></div>
                                        </div>
                                        <div class="detail5">
                                            <label class="p8"><strong>Time:</strong></label>
                                            <div class="p8-details"><?php echo $row['source_time']; ?></div>
                                        </div>
                                        <div class="detail6">
                                            <label class="p4"><strong>Flight Code:</strong></label>
                                            <div class="p4-details"><?php echo $row['flight_code']; ?></div>
                                        </div>
                                        <div class="detail7">
                                            <label class="p5"><strong>Gate Number:</strong></label>
                                            <div class="p5-details"><?php echo $row['gateno']; ?></div>
                                        </div>
                                        <div class="detail8">
                                            <label class="p9"><strong>Seat Number:</strong></label>
                                            <div class="p9-details"><?php echo $row['seatno']; ?></div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            <?php
            }
            ?>
        </body>

        </html>
<?php

        // Get the generated HTML content from the buffer
        $html = ob_get_contents();

        // Clean the output buffer
        ob_end_clean();

        // Write HTML content to PDF
        $mpdf->WriteHTML($html);

        // Output PDF as inline
        $mpdf->Output('ticket.pdf', 'I');
    } else {
        echo "0 results";
    }

    $conn->close();
}
?>