<?php
session_start();

// Check if cart session exists, if not create one
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Check if product_id is set in POST data
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    
    // Check if the product is already in the cart
    if (!in_array($product_id, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $product_id;
    }
    
    echo json_encode(["status" => "success", "message" => "Product added to cart"]);
} else {
    echo json_encode(["status" => "error", "message" => "Product ID not set"]);
}
?>
