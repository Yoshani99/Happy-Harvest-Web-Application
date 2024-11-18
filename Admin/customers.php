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
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $delete_id = $_GET['id'];
    $delete_query = mysqli_query($con, "DELETE FROM `user` WHERE id = $delete_id");
    if ($delete_query) {
        $_SESSION['message'] = 'Product has been deleted';
    } else {
        $_SESSION['message'] = 'Product could not be deleted';
    }
    header("Location: customers.php");
    exit(); // Stop further execution after redirect
}

// Rest of your code for displaying customers...
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin Dashboard</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<!-- =============== Navigation ================ -->
<div class="container">
    <div class="navigation">
        <ul>
            <li>
                <a href="#">
                    <span class="icon">
                      <!-- <ion-icon name="logo-apple"></ion-icon>--> 
                    </span>
                    <span class="title">Happy Harvest Food Shop</span>
                </a>
            </li>

            <li>
                <a href="index.php">
                    <span class="icon">
                        <ion-icon name="home-outline"></ion-icon>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="loyaltycustomers.php">
                    <span class="icon">
                        <ion-icon name="people-outline"></ion-icon>
                    </span>
                    <span class="title">Loyalty Customers</span>
                </a>
            </li>
            <li>
                <a href="customers.php">
                    <span class="icon">
                        <ion-icon name="people-outline"></ion-icon>
                    </span>
                    <span class="title">Admins</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <ion-icon name="chatbubble-outline"></ion-icon>
                    </span>
                    <span class="title">Messages</span>
                </a>
            </li>

            <li>
                <a href="./items.php">
                    <span class="icon">
                        <ion-icon name="help-outline"></ion-icon>
                    </span>
                    <span class="title">Item Management</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <ion-icon name="settings-outline"></ion-icon>
                    </span>
                    <span class="title">Settings</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                    </span>
                    <span class="title">Password</span>
                </a>
            </li>

            <li>
                <a href="/home.php">
                    <span class="icon">
                        <ion-icon name="log-out-outline"></ion-icon>
                    </span>
                    <span class="title">Sign Out</span>
                </a>
            </li>
        </ul>
    </div>
     <!-- ========================= Main ==================== -->
     <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>

            <div class="search">
                <label>
                    <input type="text" placeholder="Search here">
                    <ion-icon name="search-outline"></ion-icon>
                </label>
            </div>

            <div class="user">
                <img src="assets/imgs/customer01.jpg" alt="">
            </div>
        </div>
        <!-- ================= New Customers ================ -->
        <div class="recentCustomers">
            <div class="cardHeader">
                <h2>Recent Customers</h2>
            </div>

            

            
                <tr>
                <?php
                // PHP code for database connection
                $servername = "localhost"; // Change this to your database server name
                $username = "root"; // Change this to your database username
                $password = ""; // Change this to your database password
                $dbname = "ppa"; // Change this to your database name

                // Create connection
                $con = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if (mysqli_connect_errno()) {
                    die("Failed to connect to MySQL: " . mysqli_connect_error());
                }

                // SQL Query to retrieve all advertisements from the database
                $sql = "SELECT * FROM user";

                // Execute the query against the database
                $result = mysqli_query($con, $sql);

                // Check if there are any advertisements found
                if (mysqli_num_rows($result) > 0) {
                    echo "<table>";
                    echo "<tr><th>id</th><th>Profile Photo</th><th>Username</th><th>Contacat Number</th><th>Email</th></tr>";
                    // Loop through the results and display the advertisements
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td width='60px'><div class='imgBx'><img src='../" . $row['profile_photo'] ."'></div></td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['contact_number'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo '<td><a href="customers.php?id='.$row['id'].'" onclick="return confirm(\'Are you sure you want to delete this?\');"><button class="btn" id="delete">Delete</button></a>';
                        echo '<a href="UpdatePro.php?id='.$row['id'].'"><button class="btn">Update</button></a></td>';
                        echo "</tr>";
                    
                    }
                } else {
                    echo "No advertisements found.";
                }
                

                
                //mysqli_close($con);
                ?>
                
            </table>
        </div>
    </div>
</div>
</div>
    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>