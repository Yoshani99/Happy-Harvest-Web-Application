<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard | Korsat X Parmaga</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/style.css">


    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    
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
                    <span class="title">happy harvest food shop</span>
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
                <h2>Loyalty Customers</h2>
            </div>
            <ssection class="content">
            <div class="container-fluid">
                <!-- <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-tool"> -->
                                    <a href="customerForm.php">
                                    <button type="button" class="btn" id="btn">Register New User</button>
                                    </a>
                                <!-- </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </ssection>

        <!-- ================= Table ================ -->
            <table>

              <tbody>
                <tr>
                    <td width="60px">
                        <div class="imgBx"><img src="assets/imgs/customer02.jpg" alt=""></div>
                    </td>
                    <td>
                        <h4>David <br> <span>Italy</span></h4>
                    </td>
                    <td><h4> 0718213970 </h4></td>
                    <td><button class="btn">View</button><button class="btn">Delete</button></td>
                </tr>

                <tr>
                    <td width="60px">
                        <div class="imgBx"><img src="assets/imgs/customer01.jpg" alt=""></div>
                    </td>
                    <td>
                        <h4>Amit <br> <span>India</span></h4>
                    </td>
                    <td><h4> 0718213970 </h4></td>
                    <td><button class="btn">View</button><button class="btn">Delete</button></td>
                </tr><tr>
                    <td width="60px">
                        <div class="imgBx"><img src="assets/imgs/customer02.jpg" alt=""></div>
                    </td>
                    <td>
                        <h4>David <br> <span>Italy</span></h4>
                    </td>
                    <td><h4> 0718213970 </h4></td>
                    <td><button class="btn">View</button><button class="btn">Delete</button></td>
                </tr>

                <tr>
                    <td width="60px">
                        <div class="imgBx"><img src="assets/imgs/customer01.jpg" alt=""></div>
                    </td>
                    <td>
                        <h4>Amit <br> <span>India</span></h4>
                    </td>
                    <td><h4> 0718213970 </h4></td>
                    <td><button class="btn">View</button><button class="btn">Delete</button></td>
                </tr>

                 
                </tr>
</tbody>
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