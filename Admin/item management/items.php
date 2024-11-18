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

// Handle product deletion
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM `product_details` WHERE `product_ID`='$delete_id'";
    if ($con->query($sql) === TRUE) {
        echo "Product deleted successfully!";
    } else {
        echo "Error deleting product: " . $con->error;
    }
}

// Fetch products
$sql = "SELECT * FROM `product_details`";
$result = $con->query($sql);

// Function to generate PDF
function generatePDF() {
    require('fpdf186/fpdf.php'); // Include FPDF library
    
    // Create new PDF instance
    $pdf = new FPDF();
    $pdf->AddPage();
    
    // Set font
    $pdf->SetFont('Arial', 'B', 12);
    
    // Title
    $pdf->Cell(0, 10, 'Product Details', 0, 1, 'C');
    
    // Table headers
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(30, 10, 'ID', 1, 0, 'C');
    $pdf->Cell(60, 10, 'Name', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Quantity', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Price', 1, 1, 'C');
    
    global $result;
    
    // Table data
    $pdf->SetFont('Arial', '', 10);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pdf->Cell(30, 10, $row['product_ID'], 1, 0, 'C');
            $pdf->Cell(60, 10, $row['Name'], 1, 0, 'L');
            $pdf->Cell(30, 10, $row['Quantity'], 1, 0, 'C');
            $pdf->Cell(40, 10, 'Rs.' . $row['Price'], 1, 1, 'R');
        }
    } else {
        $pdf->Cell(160, 10, 'No products found.', 1, 1, 'C');
    }
    
    // Output PDF as a file (download)
    $pdf->Output('D', 'items_details.pdf');
}

// Close database connection
$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ID Trade Centre</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/items.css">
    <link rel="shortcut icon" href="images/fav-icon.png" />
    <style>
        body {
            margin: 0px;
            padding: 0px;
            font-family: poppins;
            background-color: #E0E0E0;
        }
        .category-box {
            margin: 5px;
            border: 1px solid black;
        }
        #popular-bundle-pack {
            border: 1px solid black;
        }
        .btnclass {
            align-items: left;
            border-width: 25px;
        }
        /* Updated button styles */
        .btn-box {
            margin-top: 10px;
        }
        .product-box {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            width: 100%;
            height: 100%;
        }
        .product-box img {
            max-width: 100%;
            height: auto;
        }
        .product-box h4 {
            margin-top: 10px;
        }
        .product-box .quantity,
        .product-box .price {
            display: block;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="product-heading">
            <h2>Items Management</h2>
        </div>

        <div class="btn-box">
            <button class="btn btn-primary" onclick="window.location.href='index.php'">Dashboard</button>
            <button class="btn btn-success" onclick="window.location.href='add_product.php'">Add Product</button>
            <button class="btn btn-info" onclick="generatePDF()">Generate PDF</button>
        </div>

        <div class="product-container">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="product-box">';
                    echo "<img alt='product image' src='" . $row['image'] . "'>";
                    echo "<h4>" . $row['Name'] . "</h4>";
                    echo "<span class='quantity'>Quantity: " . $row['Quantity'] . "</span>";
                    echo "<span class='price'>Price: Rs." . $row['Price'] . "</span>";
                    echo '<button class="btn btn-danger"><a href="?delete_id=' . $row['product_ID'] . '" class="text-white">Delete</a></button>';
                    echo '<button class="btn btn-primary"><a href="update_product.php?id=' . $row['product_ID'] . '" class="text-white">Update</a></button>';
                    echo "</div>";
                }
            } else {
                echo "No products found.";
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function generatePDF() {
            window.location.href = 'generate_pdf.php';
        }
    </script>
</body>
</html>
