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

// Fetch products
$sql = "SELECT * FROM `product_details`";
$result = $con->query($sql);

// Include FPDF library
require('fpdf186/fpdf.php');

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

// Close database connection
$con->close();
?>
