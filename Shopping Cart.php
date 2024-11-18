<?php
session_start();

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

// Fetch count of items from the cart session
$total_items = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

// Fetch details of selected items from the database
$cart_items = isset($_SESSION['cart']) ? array_values($_SESSION['cart']) : [];
$placeholders = implode(',', array_fill(0, count($cart_items), '?'));
$stmt = $con->prepare("SELECT * FROM `product_details` WHERE product_ID IN ($placeholders)");

if ($stmt) {
    $stmt->bind_param(str_repeat('i', count($cart_items)), ...$cart_items);
    $stmt->execute();
    $result = $stmt->get_result();
}

// Close database connection
$con->close();

$totalCost = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
    
    <script src="https://kit.fontawesome.com/9088cc6401.js" crossorigin="anonymous"></script>
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

* {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background: #f1f1f1;
}

.navbar {
    background-color: #333;
    overflow: hidden;
}

.navbar a {
    float: left;
    display: block;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

.navbar a:hover {
    background-color: #ddd;
    color: black;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

h1 {
    margin-bottom: 20px;
}

.cart {
    display: flex;
    flex-wrap: wrap;
}

.products {
    flex: 0.75;
}

.product {
    display: flex;
    width: 100%;
    height: 200px;
    background: white;
    margin-bottom: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.product img {
    width: 200px;
    height: 100%;
    object-fit: cover;
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
}

.product-info {
    padding: 20px;
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.product-quantity {
    display: flex;
    align-items: center;
}

.product-quantity button {
    background: none;
    border: none;
    font-size: 18px;
    cursor: pointer;
    margin: 0 10px;
}

.product-name,
.product-price {
    margin-bottom: 10px;
}

.remove {
    background-color: red;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    align-self: flex-start;
}

.remove:hover {
    background-color: darkred;
}

.cart-total {
    flex: 0.25;
    margin-left: 20px;
    padding: 20px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.cart-total p {
    display: flex;
    justify-content: space-between;
    margin-bottom: 30px;
    font-size: 18px;
}

.cart-total a {
    display: block;
    text-align: center;
    background-color: #32b350;
    color: white;
    padding: 10px 0;
    border-radius: 5px;
    text-decoration: none;
}

.cart-total a:hover {
    background-color: #74d88b;
}

@media screen and (max-width: 700px) {
    .product {
        flex-direction: column;
        height: auto;
    }
    
    .product img {
        width: 100%;
        height: auto;
        border-top-right-radius: 10px;
        border-bottom-left-radius: 0;
    }
    
    .product-info {
        padding: 10px;
    }
    
    .remove {
        padding: 5px 10px;
        font-size: 14px;
    }
    
    .product-quantity button {
        font-size: 14px;
    }
    
    .cart-total {
        margin-left: 0;
        margin-top: 20px;
    }
}

@media screen and (max-width: 900px) {
    .cart {
        flex-direction: column;
    }
    
    .cart-total {
        margin-left: 0;
        margin-bottom: 20px;
    }
}

@media screen and (max-width: 1220px) {
    .container {
        max-width: 95%;
    }
}
</style>
<body>
<div class="navbar">
    <a href="home.php">Home</a>
    <a href="products.php" class="active">Products</a>
   
</div>

<div class="container">
    <h1>Shopping Cart</h1>

    <div class="cart">
        <div class="products">
            <?php if (isset($result) && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="product">
                        <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['Name']; ?>">
                        <div class="product-info">
                            <h3 class="product-name"><?php echo $row['Name']; ?></h3>
                            <h4 class="product-price">Rs. <?php echo $row['Price']; ?></h4>
                            <div class="product-quantity">
                                <button class="decrease-quantity" data-id="<?php echo $row['product_ID']; ?>">-</button>
                                <span class="quantity" id="quantity_<?php echo $row['product_ID']; ?>">1</span>
                                <button class="increase-quantity" data-id="<?php echo $row['product_ID']; ?>">+</button>
                            </div>
                            <button class="remove" data-id="<?php echo $row['product_ID']; ?>">Remove</button>
                        </div>
                    </div>
                    <?php $totalCost += $row['Price']; ?>
                <?php endwhile; ?>
            <?php else: ?>
                <h2>No items in the cart.</h2>
            <?php endif; ?>
        </div>

        <div class="cart-total">
            <p>
                <span>Total Price</span>
                <span id="totalPrice">Rs. <?php echo $totalCost; ?></span>
            </p>
            <a href="Details For Checkout HTML.php">Proceed to Checkout</a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    function updateTotalPrice() {
        let totalPrice = 0;
        $('.product').each(function() {
            const price = parseFloat($(this).find('.product-price').text().replace('Rs. ', ''));
            const quantity = parseInt($(this).find('.quantity').text());
            totalPrice += price * quantity;
        });
        $('#totalPrice').text('Rs. ' + totalPrice.toFixed(2));
    }

    $('.increase-quantity').click(function() {
        const productId = $(this).data('id');
        const quantityElement = $('#quantity_' + productId);
        let quantity = parseInt(quantityElement.text());
        quantity++;
        quantityElement.text(quantity);
        updateTotalPrice();
    });

    $('.decrease-quantity').click(function() {
        const productId = $(this).data('id');
        const quantityElement = $('#quantity_' + productId);
        let quantity = parseInt(quantityElement.text());
        if (quantity > 1) {
            quantity--;
            quantityElement.text(quantity);
            updateTotalPrice();
        }
    });

    $('.remove').click(function() {
        const productId = $(this).data('id');
        const productElement = $(this).closest('.product');
        $.post('remove_from_cart.php', { product_id: productId }, function(response) {
            const res = JSON.parse(response);
            if (res.status === 'success') {
                alert(res.message);
                productElement.remove();
                updateTotalPrice();
            } else {
                alert(res.message);
            }
        });
    });
});

$(document).ready(function() {
    function updateTotalPrice() {
        let totalPrice = 0;
        $('.product').each(function() {
            const price = parseFloat($(this).find('.product-price').text().replace('Rs. ', ''));
            const quantity = parseInt($(this).find('.quantity').text());
            totalPrice += price * quantity;
        });
        $('#totalPrice').text('Rs. ' + totalPrice.toFixed(2));
    }

    $('.increase-quantity').click(function() {
        const productId = $(this).data('id');
        const quantityElement = $('#quantity_' + productId);
        let quantity = parseInt(quantityElement.text());
        quantity++;
        quantityElement.text(quantity);
        updateTotalPrice();
    });

    $('.decrease-quantity').click(function() {
        const productId = $(this).data('id');
        const quantityElement = $('#quantity_' + productId);
        let quantity = parseInt(quantityElement.text());
        if (quantity > 1) {
            quantity--;
            quantityElement.text(quantity);
            updateTotalPrice();
        }
    });

    $('.remove').click(function() {
        const productId = $(this).data('id');
        const productElement = $(this).closest('.product');
        $.post('remove_from_cart.php', { product_id: productId }, function(response) {
            const res = JSON.parse(response);
            if (res.status === 'success') {
                alert(res.message);
                productElement.remove();
                updateTotalPrice();
            } else {
                alert(res.message);
            }
        });
    });
});

</script>
</body>
</html>
