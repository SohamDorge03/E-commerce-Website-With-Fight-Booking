<?php
include("./include/connection.php");


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["addCategory"])) {
        $newCategoryName = $_POST["newCategoryName"];
        $insertCategorySql = "INSERT INTO categories (name) VALUES ('$newCategoryName')";
        $conn->query($insertCategorySql);
    } elseif (isset($_POST["addSubcategory"])) {
        $newSubcategoryName = $_POST["newSubcategoryName"];
        $categoryId = $_POST["categoryId"];
        $insertSubcategorySql = "INSERT INTO subcategories (name, category_id) VALUES ('$newSubcategoryName', $categoryId)";
        $conn->query($insertSubcategorySql);
    } elseif (isset($_POST["removeCategory"])) {
        $categoryId = $_POST["categoryId"];
        $deleteCategorySql = "DELETE FROM categories WHERE category_id = $categoryId";
        $conn->query($deleteCategorySql);
    } elseif (isset($_POST["removeSubcategory"])) {
        $subcategoryId = $_POST["subcategoryId"];
        $deleteSubcategorySql = "DELETE FROM subcategories WHERE subcategory_id = $subcategoryId";
        $conn->query($deleteSubcategorySql);
    }
}
 

$categorySql = "SELECT * FROM categories";
$categoryResult = $conn->query($categorySql);

if ($categoryResult === false) {
  
    die("Error executing the category query: " . $conn->error);
}

 
$subCategorySql = "SELECT * FROM subcategories";
$subCategoryResult = $conn->query($subCategorySql);

if ($subCategoryResult === false) {
   
    die("Error executing the subcategory query: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories and Subcategories</title>
  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0/css/bootstrap.min.css">
    <style>
    
        .container {
            margin-top: 50px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;

        }

        .custom-table {
            width: 100%;
            margin-bottom: 1rem;
            border-radius: 0.25rem;
            overflow-x: auto;
        


        }

        th,
        td {
            white-space: nowrap;  
        }

        .table-responsive {
            overflow-x: auto; 
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }

        .section-heading {
            margin-top: 20px;
        }

        .form-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <?php include("./include/navbar.php"); ?>

    <div class="container">
      

      

        <div class="section-heading">
            <h2>Manage Categories</h2>
        </div>
        <div class="table-responsive">
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th>Category ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                      
                    if ($categoryResult->num_rows > 0) {
                        while ($row = $categoryResult->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["category_id"] . "</td>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>
                                <form method='post'>
                                    <input type='hidden' name='categoryId' value='" . $row["category_id"] . "'>
                                    <button type='submit' name='removeCategory' class='btn btn-danger btn-sm'>Remove</button>
                                </form>
                            </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No category data found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
      
  

        <div class="section-heading">
            <h2>Manage Subcategories</h2>
        </div>
        <div class="table-responsive">
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th>Subcategory ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
 
                    if ($subCategoryResult->num_rows > 0) {
                        while ($row = $subCategoryResult->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["subcategory_id"] . "</td>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . getCategoryName($row["category_id"], $conn) . "</td>";
                            echo "<td>
                                <form method='post'>
                                    <input type='hidden' name='subcategoryId' value='" . $row["subcategory_id"] . "'>
                                    <button type='submit' name='removeSubcategory' class='btn btn-danger btn-sm'>Remove</button>
                                </form>
                            </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No subcategory data found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
 

        <div class="section-heading">
            <h2>Add Category</h2>
        </div>
        <div class="form-container">
            <form method="post" class="mb-4">
                <div class="mb-3">
                    <label for="newCategoryName" class="form-label">New Category Name:</label>
                    <input type="text" class="form-control" id="newCategoryName" name="newCategoryName" required>
                </div>
                <button type="submit" name="addCategory" class="btn btn-success">Add Category</button>
            </form>
        </div>

   
<div class="section-heading">
    <h2>Add Subcategory</h2>
</div>
<div class="form-container">
    <form method="post" class="mb-4">
        <div class="mb-3">
            <label for="newSubcategoryName" class="form-label">New Subcategory Name:</label>
            <input type="text" class="form-control" id="newSubcategoryName" name="newSubcategoryName" required>
        </div>
        <div class="mb-3">
            <label for="categoryId" class="form-label">Select Category:</label>
            <select class="form-control" id="categoryId" name="categoryId" required>
                <?php
                // Populate dropdown with category options
                $categorySql = "SELECT * FROM categories";
                $categoryResult = $conn->query($categorySql);

                if ($categoryResult->num_rows > 0) {
                    while ($row = $categoryResult->fetch_assoc()) {
                        echo "<option value='" . $row["category_id"] . "'>" . $row["name"] . "</option>";
                    }
                } else {
                    echo "<option disabled>No categories available</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" name="addSubcategory" class="btn btn-success">Add Subcategory</button>
    </form>
</div>

    </div>
</body>

</html>

<?php


function getCategoryName($categoryId, $conn)
{
    $categoryNameSql = "SELECT name FROM categories WHERE category_id = $categoryId";
    $result = $conn->query($categoryNameSql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["name"];
    }
    return "N/A";
}

$conn->close();

?>
