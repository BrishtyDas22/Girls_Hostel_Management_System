<?php include("../CONTROL/reset_logic.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="../CSS/forgetpass.css">
</head>
<body>
    <img src="../images/3d-house.png" alt="Home Logo" width="60px" height="60px" id="home_logo" 
         onclick="location.href='Login.php'">

    <div class="login-box">
        <form method="post" action="" id="login_form">


            <h2>Forget Password</h2>
            <br>
            <label>Username:</label>
            <input type="text" name="name" id="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>">

            <label>New Password:</label>
            <input type="password" name="new_password" id="new_password">

            <label>Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirm_password">

            <button type="submit" name="reset_btn" id="login_button">Reset Password</button>
            <a href="Login.php" id="register_link">Go back to Login</a>
        </form>

        <?php
        if(!empty($error_msg)){
            echo '<div class="error">'.$error_msg.'</div>';
        }
        if(!empty($success_msg)){
            echo '<div class="success">'.$success_msg.'</div>';
        }
        ?>
    </div>
</body>
</html>