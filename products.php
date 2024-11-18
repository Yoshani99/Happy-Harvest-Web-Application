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

// Fetch product details from database
$sql = "SELECT * FROM `product_details`";
$result = $con->query($sql);

// Close database connection
$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="products.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <header>
        <div class="navbar">
            <a href="home.php">Home</a>
            <a href="products.php" class="active">Products</a>
            <a href="about us.html">About Us</a>
            <a href="contact us.php">Contact</a>
            <a href="Shopping Cart.php">Cart</a>
        </div>

       
        </div>
    </header>

    <section id="popular-bundle-pack">
        <div class="product-heading">
            <h3>Popular Products</h3>
        </div>
        <div class="product-container">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="product-box">
                        <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['Name']; ?>">
                        <strong><?php echo $row['Name']; ?></strong>
                        <span>Quantity: <?php echo $row['Quantity']; ?></span>
                        <span>Price: Rs. <?php echo $row['Price']; ?></span>
                        <button class="cart-btn" data-id="<?php echo $row['product_ID']; ?>">Add to Cart</button>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No products found.</p>
            <?php endif; ?>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('.cart-btn').click(function() {
                var productId = $(this).data('id');
                $.post('add_to_cart.php', { product_id: productId }, function(response) {
                    var res = JSON.parse(response);
                    if (res.status === 'success') {
                        alert(res.message);
                        // Update cart count
                        var cartCount = $('#cart-count').text();
                        cartCount = parseInt(cartCount) + 1;
                        $('#cart-count').text(cartCount);
                    } else {
                        alert(res.message);
                    }
                });
            });
        });
    </script>
</body>
</html>
