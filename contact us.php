<?php
include 'db_config.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $message = $_POST['message'];

    // SQL to insert data into ContactUs table
    $sql = "INSERT INTO contactus (name, email, phone_number, message)
    VALUES ('$name', '$email', '$phone_number', '$message')";

    if ($conn->query($sql) === TRUE) {
        header("Location: Contact Form Confirm HTML and css.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="contact us.css">
    <link rel="shortcut icon" type="image/jpg" href="C:\Users\hp\Desktop\College\First Semester\Introduction To Web Technologies\Notepad ++ Files\Project\favicon.ico"/> 
    
    <script src="https://kit.fontawesome.com/9088cc6401.js" crossorigin="anonymous"></script>
<style>
    
    
    .btn{
    width: 100%;
    padding: 0.5rem 1rem;
    font-size: 1.3rem;
    background-color: darkslategrey;
    cursor: pointer;
    outline: none;
    border: none;
    color: darkblue;
    transition: 0.3s;
}

.btn:hover{
    background-color: aqua;
    opacity: 0.8;
    transition: 0.3s all ease-in;
}
</style>
</head>
<body>
    <header>
       
        <div class="navbar">
            <a href="home.php">Home</a>
            <a href="products.php">Products</a>
            <a href="about us.html" >About Us</a>
            <a href="contact us.php" class="active">Contact</a>
            
        </div>
    </header>
    
    <div id="error_message"></div>
    <form method="post" action="contact us.php">
    <div class="container">
        <div class="contact-box">
            <div class="left">
            </div>
            <div class="right">
                <h2>Contact Us</h2>
               <input type="text" class="field" name="name" placeholder="Your Name" required>
                    <input type="email" class="field" name="email" placeholder="Your Email" required>
                    <input type="text" class="field" name="phone_number" placeholder="Your Phone number" required>
                    <textarea class="field area" name="message" placeholder="Message"></textarea>
                    <button type="submit" class="btn">Submit</button>
            </div>
        </div>
    </div>
        
    
    </form>
   
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
   
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  
    
</body>

</html>
