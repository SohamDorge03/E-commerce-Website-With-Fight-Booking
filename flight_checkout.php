<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container mt-3">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Price: Rs. <?php echo $total_price; ?></h5>
                        <form action="flight_submit.php" method="post">
                            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                    data-key="<?php echo $Publishablekey; ?>"
                                    data-amount="<?php echo $total_price * 100; ?>"
                                    data-name="Shopflix"
                                    data-description="Shopflix"
                                    data-image="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQiUuPgu-yLEY2NbaZa7MdSibC9nDZQZ8AjEGH022Vpvw&s"
                                    data-currency="INR"
                                    data-email="shopfilx420@gmail.com">
                            </script>
                            <input type="hidden" name="total_amount" value="<?php echo $total_price; ?>">
                            <input type="hidden" name="stripeToken" value="<?php echo $_SESSION['u'] . random_int(1000,2000); ?> ">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>