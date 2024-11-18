<?php
session_start();

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    if (($key = array_search($product_id, $_SESSION['cart'])) !== false) {
        unset($_SESSION['cart'][$key]);
    }

    echo json_encode(["status" => "success", "message" => "Product removed from cart"]);
} else {
    echo json_encode(["status" => "error", "message" => "Product ID not set"]);
}
?>
