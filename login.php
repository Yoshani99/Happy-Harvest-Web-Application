<?php
session_start();
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get email and password from form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitize inputs to prevent SQL injection
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Query to check if the user exists with provided email and password
    $query = "SELECT * FROM user WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);

    // Check if query executed successfully
    if ($result) {
        // Check if any row is returned
        if (mysqli_num_rows($result) > 0) {
            // User exists, set session variables and redirect to admin panel
            $_SESSION['email'] = $email;
            header("Location: ./Admin"); // Change this according to your admin panel page URL
            exit();
        } else {
            // User not found, redirect to login page with an error message
            $_SESSION['error'] = "Invalid email or password.";
            header("Location: login.php");
            exit();
        }
    } else {
        // Error in query execution
        echo "Error: " . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
}
?>


<!DOCTYPE html>

<!--This is a login page made up with HTML,CSS and javascript-->

<html>

    <head>

        <title>
            
            Login In/Sign Up
        
        </title>

        <link type="text/css" rel="stylesheet" href="Login And Registration CSS.css">

        <script src="https://kit.fontawesome.com/5471644867.js" crossorigin="anonymous"></script>
        
        

    </head>

    <body>

        <section class="imp">

            <section>

            <div class="login show" id="one">

                <div class="textbox slide-left2">

                <div class="head">

                    <h1>
                        
                        Sign In to Happy Harvest Shop
                    
                    </h1>

                    <ul>

                        <li>
                            
                            <i class="fab fa-facebook-f" style = "cursor: pointer;"></i>
                        
                        </li>

                        <li>
                            
                            <i class="fab fa-google-plus-g" style = "cursor: pointer;"></i>
                        
                        </li>

                        <li>
                            
                            <i class="fab fa-linkedin-in" style = "cursor: pointer;"></i>
                        
                        </li>

                    </ul>

                    <h3 style = "cursor: pointer;">
                        
                        or use your E-mail ID
                    
                    </h3>

                </div>

                    <form action="./login.php" method="post">

                        <input type="text" name="email" id="email" placeholder="EMAIL" required>
                        <input type="password" name="password" id="password" placeholder="PASSWORD" required>
                        <button type="submit" class = 'sign_in_btn' value="Login">
                                SIGN IN
                        </button>
                       
                    </form>
                </div>
            </div>
            </section>
        </section>
        <script src="Login And Registration JS.js"></script>
        <script>
            function login() {
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    // Simulated login check (replace with actual AJAX call in real implementation)
    if (email === "admin@example.com" && password === "password123") {
        window.location.href = "./Admin";
    } else {
        alert("Invalid email or password.");
    }
}
</script>
    </body>
</html>

