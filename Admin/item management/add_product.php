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

// Ensure the uploads directory exists
$target_dir = "uploads/";
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_product'])) {
        $name = $_POST['name'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];

        // Handle image upload
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $uploadOk = 1;

        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size (5MB limit)
        if ($_FILES["image"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            // if everything is ok, try to upload file
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $sql = "INSERT INTO `product_details` (`Name`, `Quantity`, `Price`, `image`) VALUES ('$name', '$quantity', '$price', '$target_file')";
                if ($con->query($sql) === TRUE) {
                    echo "Product added successfully!";
                } else {
                    echo "Error: " . $sql . "<br>" . $con->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
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
    <title>Add Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/items.css">
    <link rel="shortcut icon" href="images/fav-icon.png" />
</head>

<body>
    <div class="container">
        <button class="btn btn-primary" onclick="window.location.href='items.php'">Back to Product Management</button>

        <div class="add-product-form">
            <h3>Add New Product</h3>
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Product Name" required>
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" name="quantity" class="form-control" placeholder="Quantity" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" placeholder="Price" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" class="form-control" required>
                </div>
                <button type="submit" name="add_product" class="btn btn-success">Add Product</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
