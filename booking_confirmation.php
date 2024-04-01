<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Booking Confirmation</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Your booking details:</h5>
                <ul>
                    <li><strong>Flight ID:</strong> <?php echo $_GET['flight_id']; ?></li>
                    <li><strong>Number of Passengers:</strong> <?php echo $_GET['passengers']; ?></li>
                    
                </ul>
                <p>Your booking is confirmed. Please proceed with payment.</p>
                
                <a href="payment_option.php" class="btn btn-primary">Proceed to Payment</a>
            </div>
        </div>
    </div>
</body>
</html>
