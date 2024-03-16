<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boarding Pass</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            text-align: center;
            justify-content: center;
        }

        .boarding-pass {
            display: inline-block;
            width: 70%;
            height: 300px; /* Increased height to accommodate additional details */
            margin: 120px;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            font-family: sans-serif;
            font-size: 16px;
            position: relative;
            overflow: hidden; /* Hide overflow content */
        }

        .header {
            background-color: #273138;
            color: #fff;
            padding: 5px;
            border-top-left-radius: 25px;
            border-top-right-radius: 25px;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            display: flex;
            align-items: center;
        }

        .company-logo {
            width: 70px;
            height: 50px;
            margin-left: 10px;
            border: round;
        }

        .company-name {
            font-weight: bold;
            flex: 1;
        }

        .passenger-info,
        .flight-info {
            padding: 10px;
            display: flex; /* Adjust layout for passenger and flight info */
        }

        h3 {
            margin: 0;
            color: #137dc8;
            font-size: 24px;
            margin-bottom: 2px;
        }

        .left-side {
            flex: 1;
            display: flex;
            flex-direction: column;   
        }
        .left-side1{
        border-right: 5px dotted #ccc; /* Add dotted line to separate from right-side */
            padding-right: 5px; /* Add padding to separate text from the dotted line */
        }
        .right-side {
            flex: 1;
            display: flex;
            flex-direction: column;
            margin-left: 15px; /* Add margin to separate from left side */
        }

        .barcode {
            text-align: center;
            margin-top: 20px;
            margin-right: 120px;
            height: 50px; /* Adjust barcode container height */
            background-color: #09bb8b; /* Add background color */
            position: relative;
        }
    </style>
</head>
<body>
<?php
include("./include/connection.php");

// SQL query to fetch data with joins
$sql = "SELECT bf.*, u.username, f.source_date, f.dest_date, f.price, a.logo, a.airline_name
        FROM booked_flights bf 
        INNER JOIN users u ON bf.user_id = u.user_id 
        INNER JOIN flights f ON bf.flight_id = f.flight_id
        INNER JOIN airlines a ON bf.airline_id = a.airline_id";
$result = $conn->query($sql);

// Check if the query was successful
if (!$result) {
    // Query failed, print the error message
    echo "Error: " . $conn->error;
} else {
    // Query was successful, proceed with fetching data
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="boarding-pass">
                <div class="header">
                    <img src="./Admin/<?php echo $row['logo']; ?>" alt="Airline Logo" class="company-logo">
                    <h2 class="company-name"><?php echo $row['airline_name']; ?></h2>
                </div>
                <div class="passenger-info">
                    <div class="right-side">
                        <h3>PASSENGER</h3>
                        <p>NAME</p>
                        <p>Username:<?php echo $row['username']; ?></p>
                    </div>
                    <div class="right-side">
                        <h3>FROM</h3>
                        <p>source_date:<?php echo $row['source_date']; ?></p>
                        <p>Destination Date:<?php echo $row['dest_date']; ?></p>
                        <p>Price:<?php echo $row['price']; ?></p>
                    </div>
                    <div class="right-side">
                        <h3>FLIGHT</h3>
                        <p><?php echo $row['flight_class']; ?></p>
                    </div>
                    <div class="left-side left-side1">
                        <h3>Seats</h3>
                        <p><?php echo $row['take_seats']; ?></p>
                    </div>
                    <div class="barcode right-side">
                        <img src="https://barcode.tec-it.com/barcode.ashx?data=<?php echo $row['TransactionID']; ?>&multiplebarcodes=true&translate-esc=on" alt="" srcset="">
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        echo "0 results";
    }
}

// Close the database connection
$conn->close();
?>
</body>
</html>
