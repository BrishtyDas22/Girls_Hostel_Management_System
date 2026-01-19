<?php

session_start();
if(!isset($_SESSION["user_id"])){
    header("Location: ../VIEW/Login.php");
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
    
    <title>Edit profile</title>
    <link rel="stylesheet" href="../CSS/editprofiledesign.css">
</head>
<body>


     <div id="header_design">

    <h1 id="header_text">Edit your Profile</h1>

        <img src="../images/machine.png" alt="logo" id="header_logo">

    
    </div>



    <div class="editprofile">
    <form action="../CONTROL/edituserprofile.php" method="post" enctype="multipart/form-data" class="editform">
    
    <div id="picupload">
        <img src="<?php echo $_SESSION['profile_pic'] ?? '../images/user.png'; ?>" alt="profile_image" id="picupload-design">
        <br>
       <input type="file" name="profile_image" id="actual-file-input" style="display: none;" onchange="updateFileName()"/>
    
    <button type="button" id="pbutton" onclick="document.getElementById('actual-file-input').click()"> Choose Image</button>

    <button type="submit" id="submit-btn2" name="submit">Update Profile</button>
    
    <span id="filet">No file chosen</span>
    </div>

    <label>Profile Management</label>
    <hr>
    
    <label for="name">Name:</label><br/>
    <input type="text" id="name" name="name" value="<?php echo $_SESSION["username"]; ?>">
    <hr>

    <label for="email">Email:</label><br/>
    <input type="text" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
    <hr>

    <label for="phonenumber">Phone number:</label>
    <input type="text" id="phonenumber" name="phonenumber" value="<?php echo $_SESSION['phonenumber']; ?>">
    <hr>

    <label for="blood">Blood group:</label>
    <input type="text" id="blood" name="blood" value="<?php echo $_SESSION['blood']; ?>">
    <hr>

    <label for="password"> New Password (leave blank to keep current):</label>
    <input type="password" id="password" name="password">
    <hr>

    <button type="submit" id="submit-btn" name="submit">Update </button> 
 
            
            <div class="error">
                <?php
                if(isset($_SESSION["update_err"])){
                    echo  $_SESSION['update_err'];
                    unset($_SESSION["update_err"]);
                }

                    ?>
            </div>


            <div class="success">
                <?php
                if(isset($_SESSION["update_ok"])){
                    echo  $_SESSION['update_ok'];
                    unset($_SESSION["update_ok"]);
                   echo '<br><a href="../VIEW/afterlogin.php">Click here to return home</a>';
                }

                    ?>
            </div>
    </form>

</div>
<button type="button" id="logout" onclick="handlelogout()" >Logout</button></a>
 <script src="../JS/confirmlogout.js"></script>



    
    
</body>
</html>