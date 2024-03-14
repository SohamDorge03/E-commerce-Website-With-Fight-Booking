<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    #product1 {
      text-align: center;
    }

    #product1 .pro-container {
      display: flex;
      padding-top: 20px;
      gap: 30px;
      justify-content: center;
      flex-wrap: wrap;
    }

    #product1 .pro {
      width: 23%;
      min-width: 250px;
      padding: 10px 6px;
      border: 1px solid #cce7d0;
      border-radius: 25px;
      cursor: pointer;
      box-shadow: 20px 20px 30px rgba(0, 0, 0, 0.02);
      margin: 15px 0;
      transition: 0.2s ease;
      position: relative;
    }

    #product1 .pro:hover {
      box-shadow: 20px 20px 30px rgba(0, 0, 0, 0.06);
    }

    #product1 .pro img {
      width: 100%;
      border-radius: 20px;
    }

    #product1 .pro .des {
      text-align: start;
      padding: 10px 0;
    }

    #product1 .pro .des span {
      color: #606063;
      font-size: 12px;
    }

    #product1 .pro .des h5 {
      padding-top: 7px;
      color: #1a1a1a;
      font-size: 14px;
    }

    #product1 .pro .des i {
      font-size: 12px;
      color: rgb(243, 181, 25)
    }

    #product1 .pro .des h4 {
      font-size: 15px;
      padding-top: 7px;
      font-weight: 700;
      color: #088178;
    }

    #product1 .pro .cart {
      width: 40px;
      height: 40px;
      line-height: 40px;
      border-radius: 50px;
      background-color: #e8f6ea;
      font-weight: 500;
      color: #088178;
      border: 1px solid #cce7d0;
      position: absolute;
      bottom: 20px;
      right: 10px;
    }
  </style>
</head>
<body>
<section id="product1" class="section-p1">
  <h2>Featured Products</h2>
  <p>Summer Collection New Modern Design</p>
  <div class="pro-container">
    <?php
    include("include/connection.php");

    // Fetch products from the database
    $productSql = "SELECT * FROM products WHERE category_id = 2";
    $productResult = $conn->query($productSql);

    // Check if there are products
    if ($productResult !== false && $productResult->num_rows > 0) {
      echo '<div class="pro-container">';

      // Loop through each product and generate HTML
      while ($row = $productResult->fetch_assoc()) {
        echo '<div class="pro" style="width: 270px;">';
        echo '<img src="vendor/' . $row['img1'] . '" alt="" height="200px" data-toggle="modal" data-target="#productModal' . $row['product_id'] . '">';
        echo '<div class="des">';
        echo '<h5>' . $row['name'] . '</h5>';

        // Display discounted price with a strikethrough effect on original price if discount exists
        if ($row['discount_price'] !== null && $row['discount_price'] < $row['price']) {
          echo '<span class="original-price"><span style="text-decoration: line-through;">$' . $row['price'] . '</span></span>';
          echo '<span class="discounted-price" style="margin-left: 5px; font-size: 18px; font-weight: bold; margin-top: 1px;">$' . $row['discount_price'] . '</span>';
        } else {
          // If no discount, display the regular price
          echo '<span class="price" style=" font-size: 18px; font-weight: bold; margin-top: 1px;">$' . $row['price'] . '</span>';
        }

        // Display one-line description
        echo '<p class="description" style="margin-top: 1px;">' . substr($row['description'], 0, 50) . '...</p>';

        echo '</div>';

        echo '<a><i class="fal fa-shopping-cart cart"></i></a>';
        echo '</div>';

        // Create modal for each product
        echo '<div class="modal fade" id="productModal' . $row['product_id'] . '" tabindex="-1" role="dialog" aria-labelledby="productModalLabel' . $row['product_id'] . '" aria-hidden="true">';
        echo '<div class="modal-dialog modal-lg" role="document">';
        echo '<div class="modal-content">';
        echo '<div class="modal-header">';
        echo '<h5 class="modal-title" id="productModalLabel' . $row['product_id'] . '">' . $row['name'] . '</h5>';
        echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
        echo '<span aria-hidden="true">&times;</span>';
        echo '</button>';
        echo '</div>';
        echo '<div class="modal-body">';
        // Display all details from the product
        echo '<img src="vendor/' . $row['img1'] . '" alt="" style="max-width: 100%;">';
        echo '<p>Description: ' . $row['description'] . '</p>';
        echo '<p>Price: $' . $row['price'] . '</p>';
        if ($row['discount_price'] !== null && $row['discount_price'] < $row['price']) {
          echo '<p>Discounted Price: $' . $row['discount_price'] . '</p>';
        }
        echo '<p>Stock Quantity: ' . $row['stock_quantity'] . '</p>';
        // Include other details as needed
        echo '</div>';
        echo '<div class="modal-footer">';
        echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
        // Include any other buttons as needed
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
      }

      echo '</div>';
    } else {
      echo 'No products found.';
    }
    
    $conn->close();
    ?>
  </div>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
