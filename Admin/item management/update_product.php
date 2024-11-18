<?php
session_start();

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ppa";

// Create database connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check database connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Fetch product details
if (isset($_GET['id'])) {
    $product_ID = $_GET['id'];
    $sql = "SELECT * FROM `product_details` WHERE `product_ID`='$product_ID'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Product not found.";
        exit;
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_product'])) {
        $product_ID = $_POST['product_ID'];
        $name = $_POST['name'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];

        // Handle image upload
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $uploadOk = 1;

        if (!empty($_FILES["image"]["name"])) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            if ($_FILES["image"]["size"] > 5000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            if ($uploadOk == 1) {
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                $sql = "UPDATE `product_details` SET `Name`='$name', `Quantity`='$quantity', `Price`='$price', `image`='$target_file' WHERE `product_ID`='$product_ID'";
            }
        } else {
            $sql = "UPDATE `product_details` SET `Name`='$name', `Quantity`='$quantity', `Price`='$price' WHERE `product_ID`='$product_ID'";
        }

        if ($con->query($sql) === TRUE) {
            echo "Product updated successfully!";
        } else {
            echo "Error updating product: " . $con->error;
        }
    }
}

// Close database connection
$con->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/items.css">
    <link rel="shortcut icon" href="images/fav-icon.png" />
</head>

<body>
    <div class="container">
        <button class="btn btn-primary" onclick="window.location.href='items.php'">Back to Product Management</button>

        <div class="update-product-form mt-5">
            <h3>Update Product</h3>
            <form method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="product_ID" value="<?php echo $product['product_ID']; ?>">
                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $product['Name']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" name="quantity" class="form-control" value="<?php echo $product['Quantity']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" value="<?php echo $product['Price']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" class="form-control">
                    <?php if (!empty($product['image'])): ?>
                        <img src="<?php echo $product['image']; ?>" alt="product image" class="img-thumbnail mt-2" width="150">
                    <?php endif; ?>
                </div>
                <button type="submit" name="update_product" class="btn btn-success">Update Product</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
