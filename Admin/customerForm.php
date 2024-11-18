<?php
        $con = mysqli_connect("localhost", "root", "", "ppa");
        if (!$con) {
            die("Sorry, We are facing a technical issue");
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // SQL Query to fetch the user data with the given id from tbluser table
            $sql = "SELECT * FROM user WHERE id = '$id'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);

            // Check if the user exists with the given id
            if (!$row) {
                die("User not found");
            }
        } else {
            die("Invalid request");
        }

        // Close the database connection
        mysqli_close($con);
    ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/dea29e59b1.js" crossorigin="anonymous"></script> 
    <title>Document</title> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        
        input[type=text], input[type=password], textarea {  
        width: 100%;  
        padding: 15px;  
        margin: 5px 0 22px 0;  
        display: inline-block;  
        border: none;  
        background: #f1f1f1;  
        }  
        input[type=text]:focus, input[type=password]:focus {  
        background-color: rgba(0, 119, 255, 0.327);  
        outline: none;  
        }  
        div {  
                    padding: 10px 0;  
                }  
        hr {  
        border: 1px solid #f1f1f1;  
        margin-bottom: 25px;  
        }  
        .registerbtn {  
        background-color: #221fcaea;  
        color: white;  
        padding: 16px 20px;  
        margin: 8px 0;  
        border: none;  
        cursor: pointer;  
        width: 100%;  
        opacity: 0.9;  
        }  
        .registerbtn:hover {  
        opacity: 1;  
        }  
            
        </style>

</head>
<body>
<main>
        <form>  
          <div class="container">
            <form id="customorform">
                <h2>Customer Details</h2>
                <div class="content">
    
                    <div class="input-box">
                        <label for="cid">Custommer ID</label>
                        <input type="text"  class="form-control" placeholder="Enter Customer ID" name="id" id="id"  value="<?php echo $row['id']; ?>"required>
                    </div>
    
                    <div class="input-box">
                        <label for="name">First Name</label>
                        <input type="text" class="form-control" placeholder="Enter First Name" name="Fname" id="Fname"  value="<?php echo $row['Fname']; ?>" required >
                    </div>
    
                    <div class="input-box">
                        <label for="lastname">Last Name</label>
                        <input type="text" class="form-control" placeholder="Enter Last Name" name="Lname" id="Lname" value="<?php echo $row['Lname']; ?>" >
                    </div>
    
                    <div class="input-box">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" placeholder="Enter valid email" name="email" id="email" value="<?php echo $row['email']; ?>" >
                    </div>
    
                    <div class="input-box">
                        <label for="Address">Address</label>
                        <input type="text" class="form-control" placeholder="Enter your Address" name="address" id="address" value="<?php echo $row['address']; ?>">
                    </div>
    
                    <div class="input-box">
                        <label for="Contact">Contact Number</label>
                        <input type="text" class="form-control" placeholder="+94 ___________" name="contact" id="Contact" value="<?php echo $row['contact']; ?>" >
                    </div>
    
    
                    <div class="input-box">
                        <label for="picture">Add your picture</label>
                        <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="box" value="<?php echo $row['profile_photo']; ?>" required>
                    </div>
    
                
                </div>
    
                <div >
                    <button class="registerbtn" type="submit" id="submitBtn" >Submit</button>
                </div>
            </form>
        </div>    
          </form> 
    </main>
</body>
