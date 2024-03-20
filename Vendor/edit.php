<?php
include './include/connection.php';
session_start();

// Check if the vendor ID is not set in the session
if (!isset($_SESSION['vendor_id'])) {
 
    header("Location: login.php");
    exit();
}


include './include/navbar.php';

$vendor_id = $_SESSION['vendor_id'];

function getProductById($product_id) {
    global $conn;
    $sql = "SELECT * FROM products WHERE product_id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

// Handle product update and delete
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action']) && isset($_GET['id'])) {
    $productId = $_GET['id'];
    
    if ($_GET['action'] == 'update') {
        // Update action
        $productToUpdate = getProductById($productId);
        if ($productToUpdate) {
            showUpdateForm($productToUpdate);
        } else {
            echo "Product not found.";
        }
    } elseif ($_GET['action'] == 'delete') {
        // Delete action
        deleteProduct($productId);
    }
}

// Function to show update form
function showUpdateForm($product) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Update Product</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
      <style>
        .container{
          margin-top: 100px !important;
        }
      </style>
    </head>
    <body>
      <div class="container mt-5">
        <h2>Update Product</h2>
        <form action="" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $product['product_id']; ?>">
          <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $product['name']; ?>" required>
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $product['description']; ?></textarea>
          </div>
          <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>" required>
          </div>
          <div class="mb-3">
            <label for="stockQuantity" class="form-label">Stock Quantity</label>
            <input type="number" class="form-control" id="stockQuantity" name="stockQuantity" value="<?php echo $product['stock_quantity']; ?>" required>
          </div>
          <div class="mb-3">
            <label for="discountPrice" class="form-label">Discount Price</label>
            <input type="text" class="form-control" id="discountPrice" name="discountPrice" value="<?php echo $product['discount_price']; ?>">
          </div>
          <div class="mb-3">
            <label for="img1" class="form-label">Image 1</label>
            <input type="file" class="form-control" id="img1" name="img1" accept="image/*">
          </div>
          <div class="mb-3">
        <label for="img2" class="form-label">Image 2 (Optional)</label>
        <input type="file" class="form-control" id="img2" name="img2" accept="image/*">
      </div>
      <div class="mb-3">
        <label for="img3" class="form-label">Image 3 (Optional)</label>
        <input type="file" class="form-control" id="img3" name="img3" accept="image/*">
      </div>
      <div class="mb-3">
        <label for="img4" class="form-label">Image 4 (Optional)</label>
        <input type="file" class="form-control" id="img4" name="img4" accept="image/*">
      </div>
         
          <button type="submit" class="btn btn-primary" name="update">Update Product</button>
        </form>
      </div>
    </body>
    </html>
    <?php
    exit();
}


// Function to handle product update form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $productId = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stockQuantity = $_POST['stockQuantity'];
    $discountPrice = $_POST['discountPrice'];

    // Call function to update product
    updateProduct($productId, $name, $description, $price, $stockQuantity, $discountPrice);
}

// Function to update product
function updateProduct($productId, $name, $description, $price, $stockQuantity, $discountPrice) {
    global $conn;

    // Check if a new image is uploaded 
    if (isset($_FILES["img1"]) && $_FILES["img1"]["error"] == 0) {
        $targetDir = "products/";
        $newImg1 = uploadImage($_FILES["img1"], $targetDir);
        // Update the product with the new image path
        $sql = "UPDATE products SET name='$name', description='$description', price=$price, stock_quantity=$stockQuantity,  img1='$newImg1' WHERE product_id=$productId";
    } else {
        // Update the product without changing the existing image path
        $sql = "UPDATE products SET name='$name', description='$description', price=$price, stock_quantity=$stockQuantity,  WHERE product_id=$productId";
    }

    // Check if a new image is uploaded
    if (isset($_FILES["img1"]) && $_FILES["img1"]["error"] == 0) {
        $targetDir = "products/";
        $newImg1 = uploadImage($_FILES["img1"], $targetDir);
        // Update the product with the new image path
        $sql = "UPDATE products SET name='$name', description='$description', price=$price, stock_quantity=$stockQuantity,  img1='$newImg1' WHERE product_id=$productId";
    } else {
        // Update the product without changing the existing image path
        $sql = "UPDATE products SET name='$name', description='$description', price=$price, stock_quantity=$stockQuantity,  WHERE product_id=$productId";
    }
    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully";
    } else {
        echo "Error updating product: " . $conn->error;
    }
}

// Function to handle image uploads
function uploadImage($file, $targetDir) {
    $targetFile = $targetDir . basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($file["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowedFormats = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowedFormats)) {
        echo "Sorry, only JPG, JPEG, PNG, GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        return "";
    } else {
        // If everything is ok, try to upload file
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            return $targetFile;
        } else {
            echo "Sorry, there was an error uploading your file.";
            return "";
        }
    }
}

// Function to delete a product
function deleteProduct($productId) {
    global $conn;

    $sql = "DELETE FROM products WHERE product_id = $productId";

    if ($conn->query($sql) === TRUE) {
        echo "Product deleted successfully";
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}

// Fetch products for the specific vendor
function getVendorProducts($vendor_id) {
    global $conn;
    $sql = "SELECT * FROM products WHERE vendor_id = $vendor_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

$products = getVendorProducts($vendor_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h2>Product List</h2>
    
    <div class="row">
      <?php foreach ($products as $product): ?>
        <div class="col-md-4 mb-4">
          <div class="card">
            <img src="<?php echo $product['img1']; ?>" class="card-img-top" alt="Product Image">
            <div class="card-body">
              <h5 class="card-title" ><?php echo $product['name']; ?></h5>
              <p class="card-text"><?php echo $product['description']; ?></p>
              <p class="card-text"><strong>Price: $<?php echo $product['price']; ?></strong></p>
              <p class="card-text"><strong>Stock Quantity: <?php echo $product['stock_quantity']; ?></strong></p>
 
              <div class="btn-group" role="group">
                <a href="?action=update&id=<?php echo $product['product_id']; ?>" class="btn btn-warning">Update</a>
                <a href="?action=delete&id=<?php echo $product['product_id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</body>
</html>
