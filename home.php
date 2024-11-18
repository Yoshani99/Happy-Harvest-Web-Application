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

// Check if choice is set in POST data
if (isset($_POST['choice'])) {
    // Retrieve choice from POST data
    $choice = $_POST['choice'];

    // Prepare SQL statement to insert the choice into database
    $sql = "INSERT INTO `selectpro` (`id`, `num`) VALUES (NULL, '$choice')";

    // Execute SQL statement
    if ($con->query($sql) === TRUE) {
        echo "Choice successfully recorded!";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}

// Fetch count of items from database table
$sql_count = "SELECT COUNT(*) AS total_items FROM selectpro";
$result = $con->query($sql_count);

if ($result->num_rows > 0) {
    // Fetching count of items
    $row = $result->fetch_assoc();
    $total_items = $row["total_items"];
} else {
    $total_items = 0;
}

// Close database connection
$con->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>HappyHarvest Shop</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HappyHarvest Shop</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-ZbNDqN4Y1YtF4YQXBCUg2Fw4bCnBmT1gsI9Vb5nreZMWyF1hJ/Es5hKzPzVxdnETfWmoWpZIL5ftAV4CfzBv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    
    <style>
        .slideshow-container {
            position: relative;
            margin:50px;
            align-items: center;
        }
        .slide {
            display: none;
        }
        .slide img {
            width: 60%;
            height: min-content;
        }

        .card {
  position: relative;
  max-width: 800px;
  margin: 0 auto;
}

.card img {vertical-align: middle;}

.card .content {
  position: absolute;
  bottom: 0;
  background: rgb(0, 0, 0); /* Fallback color */
  background: rgba(0, 0, 0, 0.5); /* Black background with 0.5 opacity */
  color: #f1f1f1;
  width: 100%;
  padding: 20px;
}
    </style>
</head>

<body>

  <div class="header">
    <img src="Image/hh.png.png" alt="HappyHarvest Shop Logo" width="150px" height="150px">
    <h1>HappyHarvest Shop</h1> <br>
    <p>Welcome to <b>HappyHarvest Shop</b> for choose your best..</p>
</div>


<div class="navbar">
    <a href="#" class="active">Home</a>
    <a href="products.php">Products</a>
    <a href="about us.html">About Us</a>
    <a href="contact us.php">Contact</a>
    <a href="Feedback Form HTML.php">Feedback</a>
    <a href="login.php" class="admin-icon"><i class="fas fa-user-shield"></i> Admin</a>

    </div>
    <div class="main">
    <h2>Happy Harvest </h2>
    <h5>Good Begininhg and The Best Ending</h5>
    <h2>Everything is best...</h2>

    <div class="container">
  <img src="Image/img/k.png" alt="Notebook" style="width:100%;">
  <div class="content">
     </div>
</div>
    </div>
   
    
        <div class="main">
            <h2>Happy Harvest</h2>
            <h5>Best tyhings for you, 2024</h5>
            <div class="slideshow-container">
                <div class="slide">
                    <img src="Image/9.jpg" alt="Slide 1">
                   
                </div>
                <div class="slide">
                    <img src="Image/Shopping-basket.jpg" alt="Slide 2">
                    
                </div>
                <div class="slide">
                    <img src="Image/istockphoto-1385768827-612x612.jpg" alt="Slide 3">
                    
                </div>
               
            </div>
           
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="footer-logo">
                <img src="Image/hh.png.png" alt="Foodshop Logo">
            </div>
            <div class="footer-contact">
                <h3>Happy Harvest Foodshop</h3>
                <p><strong></strong> 223/4,<br>
                                    Kalawellawa,<br>
                                     Mathugama.
                  </p><br>
                <p><strong>Phone:</strong> 076-0567844</p><br>
                <p><strong>Email:</strong> happyharvestfoodshop@gmail.com.com</p>
            </div>
            <div class="footer-social">
                <h4>Connect With Us</h4>
                <ul>
                    <li><a href="https://www.facebook.com/happyharvestfoodshop"><img src="Image/3225194_app_facebook_logo_media_popular_icon.png" alt="Facebook"></a></li>
                    <li><a href="https://api.whatsapp.com/send?phone=1234567890"><img src="Image/3225179_app_logo_media_popular_social_icon.png" alt="WhatsApp"></a></li>
                    <li><a href="mailto:info@happyharvestfoodshop.com"><img src="Image/3225192_app_googleplus_logo_media_popular_icon.png" alt="Gmail"></a></li>
                    <li><a href="https://www.linkedin.com/company/happyharvestfoodshop"><img src="Image/3225190_app_linkedin_logo_media_popular_icon.png" alt="LinkedIn"></a></li>
                </ul>
                
            </div>
        </div>
    </footer>
      

    <script>
       var slideIndex = 0;
        showSlides();

        function showSlides() {
            var slides = document.getElementsByClassName("slide");
            for (var i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) {
                slideIndex = 1;
            }
            slides[slideIndex - 1].style.display = "block";
            setTimeout(showSlides, 3000); // Change slide every 3 seconds
        }

       
    </script>

</body>

</html>
