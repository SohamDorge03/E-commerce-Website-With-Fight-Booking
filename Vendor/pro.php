<?php
session_start();
include './include/connection.php';

// Check if the vendor ID is not set in the session
if (!isset($_SESSION['vendor_id'])) {
 
    header("Location: login.php");
    exit();
}


include './include/navbar.php';
// For now until login is done

$vendor_id = $_SESSION['vendor_id'];

// Fetch all categories
function getAllCategories() {
    global $conn;
    $sql = "SELECT * FROM categories";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

function getAllSubcategories() {
    global $conn;
    $sql = "SELECT * FROM subcategories";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

$categories = getAllCategories();
$subcategories = getAllSubcategories();

function addProduct($name, $img1, $img2, $img3, $img4, $description, $price, $stockQuantity, $discountPrice, $category_id, $subcategory_id, $vendor_id) {
  global $conn;

  $sql = "INSERT INTO products (name, img1, img2, img3, img4, description, price, stock_quantity, discount_price, category_id, subcategory_id, vendor_id) 
          VALUES ('$name', '$img1', '$img2', '$img3', '$img4', '$description', $price, $stockQuantity, $discountPrice, $category_id, $subcategory_id, $vendor_id)";

  if ($conn->query($sql) === TRUE) {
      echo "Product added successfully";
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
}


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $stockQuantity = $_POST['stockQuantity'];
        $discountPrice = $_POST['discountPrice'];
        $category_id = $_POST['category_id'];
        $subcategory_id = $_POST['subcategory_id'];

        // Handle image uploads
        $targetDir = "products/";
        $img1 = uploadImage($_FILES["img1"], $targetDir);
        $img2 = uploadImage($_FILES["img2"], $targetDir);
        $img3 = uploadImage($_FILES["img3"], $targetDir);
        $img4 = uploadImage($_FILES["img4"], $targetDir);

        addProduct($name, $img1, $img2, $img3, $img4, $description, $price, $stockQuantity, $discountPrice, $category_id, $subcategory_id, $vendor_id);
    }
}
// Function to handle image uploads
function uploadImage($file, $targetDir) {
  if (!isset($file['tmp_name']) || $file['tmp_name'] === '') {
      return ""; // If no file is uploaded, return an empty string
  }

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
          echo "The file ". htmlspecialchars( basename( $file["name"])). " has been uploaded.";
          return $targetFile;
      } else {
          echo "Sorry, there was an error uploading your file.";
          return "";
      }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Insert Product</title>
  <style>
    .uploadDiv{
      display: flex;
     
    }
  </style>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container  " style="width: 600px; margin-top: 100px;">
    <h2>Add Product</h2>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="name" class="form-label">Product Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
      </div>
      <div class="uploadDiv" >

     
      <div class="mb-3">
        <label for="img1" class="form-label">Image 1</label>
        <input type="file" class="form-control" id="img1" name="img1" accept="image/*" required>
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
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
      </div>
      <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="text" class="form-control" id="price" name="price" required>
      </div>
      <div class="mb-3">
        <label for="stockQuantity" class="form-label">Stock Quantity</label>
        <input type="number" class="form-control" id="stockQuantity" name="stockQuantity" required>
      </div>
      <div class="mb-3">
        <label for="discountPrice" class="form-label">Discount Price</label>
        <input type="text" class="form-control" id="discountPrice" name="discountPrice">
      </div>
      <div class="mb-3">
        <label for="category_id" class="form-label">Category</label>
        <select class="form-select" id="category_id" name="category_id" required>
          <option value="" selected disabled>Select Category</option>
          <?php foreach ($categories as $category): ?>
            <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="mb-3">
        <label for="subcategory_id" class="form-label">Subcategory</label>
        <select class="form-select" id="subcategory_id" name="subcategory_id" required>
          <option value="" selected disabled>Select Subcategory</option>
          <?php foreach ($subcategories as $subcategory): ?>
            <option value="<?php echo $subcategory['subcategory_id']; ?>"><?php echo $subcategory['name']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <button type="submit" class="btn btn-primary" name="submit">Add Product</button>
    </form>
  </div>
</body>
</html>

