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




    <form action="../CONTROL/edituserprofile.php" method="post" class= editform>
            <label for="name">Name:</label><br/>
            <input type="text" id="name" name="name" value="<?php echo $_SESSION["username"]; ?>">

            <label for="email">Email:</label><br/>
            <input type="text" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">

            <label for="phonenumber">Phone number:</label>
            <input type="text" id="phonenumber" name="phonenumber" value="<?php echo $_SESSION['phonenumber']; ?>">

            <label for="blood">Blood group:</label>
            <input type="text" id="blood" name="blood" value="<?php echo $_SESSION['blood']; ?>">

            <label for="password"> New Password (leave blank to keep current):</label>
            <input type="password" name="password">

            <button type="submit" id="submit" name="submit">Update</button>   
            
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
    
</body>
</html>