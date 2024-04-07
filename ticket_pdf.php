<?php

include('admin/vendor/autoload.php');


include("./include/connection.php");

function numberToWords($number) {
    $words = array(
        'zero',
        'one',
        'two',
        'three',
        'four',
        'five',
        'six',
        'seven',
        'eight',
        'nine'
    );
    $num_arr = str_split($number);
    $word = '';
    foreach ($num_arr as $num) {
        $word .= $words[$num] . ' ';
    }
    return trim($word);
}

if (isset($_GET['booking_id'])) {

    $booking_id = $_GET['booking_id'];

    $sql = "SELECT bf.booking_id, bf.take_seats, bf.booked_date, bf.TransactionID, bf.flight_class, bf.total_amount,
    GROUP_CONCAT(p.name) AS passenger_names, 
    f.flight_code, 
    a.airline_name,
    a1.airport_name AS source_airport,
    a2.airport_name AS destination_airport,
    f.source_date,
    f.source_time,
    GROUP_CONCAT(p.seatno) AS seat_numbers,
    p.gateno
    FROM booked_flights bf
    JOIN passenger p ON bf.booking_id = p.booking_id
    JOIN flights f ON bf.flight_id = f.flight_id
    JOIN airlines a ON f.airline_id = a.airline_id
    JOIN airports a1 ON f.dep_airport_id = a1.airport_id
    JOIN airports a2 ON f.arr_airport_id = a2.airport_id
    WHERE bf.booking_id = $booking_id
    GROUP BY bf.booking_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        
        $mpdf = new \Mpdf\Mpdf();

     
        ob_start();
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Flight Ticket</title>
            <style>
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

                .detail {
                    margin-top: 20px;
                }

                .detail-container {
                    margin-bottom: 10px;

                }

                .detail-label {
                    font-weight: bold;
                }

                .detail-value {
                    margin-left: 10px;
                    
                }
            </style>
        </head>

        <body>
            <?php
            
            while ($row = $result->fetch_assoc()) {
                // Convert total amount to words
                $total_amount_words = numberToWords($row['total_amount']);
            ?>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 offset-md-3 mt-5">
                            <div class="card">
                                <div class="card-header">
                                    <h3>BOARDING PASS</h3>
                    
                                </div>
                                <div class="details">
                                    <div class="detail">
                                        <p><strong>Passenger Names:</strong> <?php echo $row['passenger_names']; ?></p>
                                        <div class="detail-container">
                                            <div class="detail-label"><strong>From:</strong></div>
                                            <div class="detail-value"><?php echo $row['source_airport']; ?></div>
                                        </div>
                                        
                                        <div class="detail-container">
                                            <div class="detail-label"><strong>To:</strong></div>
                                            <div class="detail-value"><?php echo $row['destination_airport']; ?></div>
                                        </div>
                                        <div class="detail-container">
                                            <div class="detail-label"><strong>Airline:</strong></div>
                                            <div class="detail-value"><?php echo $row['airline_name']; ?></div>
                                        </div>
                                        <div class="detail-container">
                                            <div class="detail-label"><strong>Date:</strong></div>
                                            <div class="detail-value"><?php echo $row['source_date']; ?></div>
                                        </div>
                                        <div class="detail-container">
                                            <div class="detail-label"><strong>Time:</strong></div>
                                            <div class="detail-value"><?php echo $row['source_time']; ?></div>
                                        </div>
                                        <div class="detail-container">
                                            <div class="detail-label"><strong>Flight Code:</strong></div>
                                            <div class="detail-value"><?php echo $row['flight_code']; ?></div>
                                        </div>
                                        <div class="detail-container">
                                            <div class="detail-label"><strong>Flight Class:</strong></div>
                                            <div class="detail-value"><?php echo $row['flight_class']; ?></div>
                                        </div>
                                        <div class="detail-container">
                                            <div class="detail-label"><strong>Gate Number:</strong></div>
                                            <div class="detail-value"><?php echo $row['gateno']; ?></div>
                                        </div>
                                        <div class="detail-container">
                                            <div class="detail-label"><strong>Seat Numbers:</strong></div>
                                            <div class="detail-value"><?php echo $row['seat_numbers']; ?></div>
                                        </div>
                                        <div class="detail-container">
    <div class="detail-label"><strong>Total Amount:</strong></div>
    <div class="detail-value"><?php echo $row['total_amount']; ?>/-</div>
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

       
        $html = ob_get_contents();

        ob_end_clean();

        $mpdf->WriteHTML($html);

        $mpdf->Output('ticket.pdf', 'I');
    } else {
        echo "0 results";
    }

    $conn->close();
}
?>
