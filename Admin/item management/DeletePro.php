<?php
session_start();

// Check if product ID is set in GET parameters
if(isset($_GET['id'])) {
    // Retrieve product ID from GET parameters
    $product_id = $_GET['id'];

    // PHP code for database connection
    $servername = "localhost"; // Change this to your database server name
    $username = "root"; // Change this to your database username
    $password = ""; // Change this to your database password
    $dbname = "ppa"; // Change this to your database name

    // Create connection
    $con = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Prepare SQL statement to delete the product from the database
    $sql = "DELETE FROM `product_details` WHERE `product_ID` = $product_id";

    // Execute SQL statement
    if ($con->query($sql) === TRUE) {
        header("Location:cart.php");
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }

    // Close database connection
    $con->close();
} else {
    // If product ID is not set in GET parameters, show an error message
    echo "Product ID not provided.";
}
?>
