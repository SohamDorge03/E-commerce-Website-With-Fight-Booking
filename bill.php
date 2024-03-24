<!DOCTYPE html>
<html>
<head>
    <title>Simple invoice in PHP</title>
    <style type="text/css">
        body {        
            font-family: Verdana;
        }
        
        div.invoice {
            border:1px solid #ccc;
            padding:10px;
            height:740pt;
            width:570pt;
        }

        div.company-address {
            border:1px solid #ccc;
            float:left;
            width:200pt;
        }
        
        div.invoice-details {
            border:1px solid #ccc;
            float:right;
            width:200pt;
        }
        
        div.customer-address {
            border:1px solid #ccc;
            float:right;
            margin-bottom:50px;
            margin-top:100px;
            width:200pt;
        }
        
        div.clear-fix {
            clear:both;
            float:none;
        }
        
        table {
            width:100%;
        }
        
        th {
            text-align: left;
        }
        
        td {
        }
        
        .text-left {
            text-align:left;
        }
        
        .text-center {
            text-align:center;
        }
        
        .text-right {
            text-align:right;
        }
        
        .generate-pdf-btn {
            margin-top: 20px;
        }
        
    </style>
</head>

<body>
<div class="invoice">
    <div class="company-address">
        ACME ltd
        <br />
        489 Road Street
        <br />
        London, AF3Z 7BP
        <br />
    </div>

    <div class="invoice-details">
        Invoice N°: 564
        <br />
        Date: <?php echo date("d/m/Y"); ?>
    </div>
    
    <div class="customer-address">
        To:
        <br />
        Mr. Bill Terence
        <br />
        123 Long Street
        <br />
        London, DC3P F3Z 
        <br />
    </div>
    
    <div class="clear-fix"></div>
        <table border='1' cellspacing='0'>
            <tr>
                <th width=100>Product ID</th>
                <th width=250>Description</th>
                <th width=80>Price</th>
                <th width=80>Quantity</th>
                <th width=100>Total</th>
            </tr>

        <?php
        $total = 0;
        $vat = 21;
        
        // Connect to your database
       include("./include/connection.php");

        // SQL to fetch data from order_items table
        $sql = "SELECT oi.product_id, p.name, p.price, oi.quantity
                FROM order_items oi
                INNER JOIN products p ON oi.product_id = p.product_id limit 5";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                $product_id = $row["product_id"];
                $description = $row["name"];
                $price = $row["price"];
                $quantity = $row["quantity"];
                $total_price = $price * $quantity;
                $total += $total_price;
                echo("<tr>");
                echo("<td class='text-center'>$product_id</td>");
                echo("<td>$description</td>");
                echo("<td class='text-right'>$price</td>");
                echo("<td class='text-center'>$quantity</td>");
                echo("<td class='text-right'>$total_price</td>");
                echo("</tr>");
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
        </table>
    </div>
   <section class="invoice">
       <div>
            <p>Thank you for shopping with us.</p>
            <p>Buy yourself an electronics life,</p>
            <p>shop at <a href="www.shopfilx.com">www.shopfilx.com</a></p>
        </div>
        <form action="genrate_pdf.php" method="post">
            <button type="submit" class="generate-pdf-btn">Generate PDF</button>
        </form>
   </section>
</body>

</html>
