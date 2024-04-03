<?php
include './include/connection.php';
session_start();

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

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action']) && isset($_GET['id'])) {
    $productId = $_GET['id'];
    
    if ($_GET['action'] == 'update') {
       
        $productToUpdate = getProductById($productId);
        if ($productToUpdate) {
            showUpdateForm($productToUpdate);
            exit();
        } else {
            echo "Product not found.";
        }
    } elseif ($_GET['action'] == 'delete') {
       
        deleteProduct($productId);
    }
}

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
            .container {
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
                    <textarea class="form-control" id="description" name="description" required><?php echo $product['description']; ?></textarea>
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
                    <label for="img1" class="form-label">Image 1</label>
                    <input type="file" class="form-control" id="img1" name="img1" accept="image/*">
                </div>
                <div class="mb-3">
                    <label for="img2" class="form-label">Image 2</label>
                    <input type="file" class="form-control" id="img2" name="img2" accept="image/*">
                </div>
                <div class="mb-3">
                    <label for="img3" class="form-label">Image 3</label>
                    <input type="file" class="form-control" id="img3" name="img3" accept="image/*">
                </div>
                <div class="mb-3">
                    <label for="img4" class="form-label">Image 4</label>
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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $productId = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stockQuantity = $_POST['stockQuantity'];

    updateProduct($productId, $name, $description, $price, $stockQuantity);
}

function updateProduct($productId, $name, $description, $price, $stockQuantity) {
    global $conn;

    $sql = "UPDATE products SET name='$name', description='$description', price=$price, stock_quantity=$stockQuantity";

    $targetDir = "products/";
    for ($i = 1; $i <= 4; $i++) {
        $fieldName = "img" . $i;
        if (isset($_FILES[$fieldName]) && $_FILES[$fieldName]["error"] == 0) {
            $newImg = uploadImage($_FILES[$fieldName], $targetDir);
            $sql .= ", img$i='$newImg'";
        }
    }

    $sql .= " WHERE product_id=$productId";

    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully";
    } else {
        echo "Error updating product: " . $conn->error;
    }
}

function uploadImage($file, $targetDir) {
    $targetFile = $targetDir . basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    if ($file["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    $allowedFormats = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowedFormats)) {
        echo "Sorry, only JPG, JPEG, PNG, GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        return "";
    } else {
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            return $targetFile;
        } else {
            echo "Sorry, there was an error uploading your file.";
            return "";
        }
    }
}

function deleteProduct($productId) {
    global $conn;

    $sql = "DELETE FROM products WHERE product_id = $productId";

    if ($conn->query($sql) === TRUE) {
        echo "Product deleted successfully";
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}

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
    <style>
        
        .card {
            height: 100% !important;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
       .card-img-top {
            height:200px !important;
            width: 190px !important; 
            object-fit: cover;
        }
        .btn-group .btn {
            margin-right: 10px; 
        }
        .container{
            margin-top: 70px !important;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Product List</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($products as $product): ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="<?php echo $product['img1']; ?>" class="card-img-top" alt="Product Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo truncateString($product['name'], 14); ?></h5>
                            <p class="card-text"><?php echo truncateString($product['description'], 10); ?></p>
                            <p class="card-text"><strong>Price: <?php echo $product['price']; ?></strong></p>
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

<?php
function truncateString($string, $word_limit) {
    $words = explode(" ", $string);
    if (count($words) > $word_limit) {
        return implode(" ", array_slice($words, 0, $word_limit)) . "...";
    } else {
        return $string;
    }
}
?>
