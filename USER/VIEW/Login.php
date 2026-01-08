<?php
include("../CONTROL/validationonlogin.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
       <link rel="stylesheet" href ="../CSS/Login.css">
</head>
<body>
    <img src="../images/3d-house.png" alt="Home Logo" width="60px" height="60px" id="home_logo" onclick="location.href='frontpage1.php'">

<div class="login-box">

    <form method="post" id="login_form" action="">
        <img src="../images/login.png" alt="login logo" width="80px" height="80px" id="login_image">
        <br>

        <label>Username:</label>
        <input type="text" name="name" id="name" value="<?php echo $name  ?>">

        <label>Email:</label>
        <input type="text" name="email" id="email" value="<?php echo $email  ?>">
       

        <label>Password:</label>
        <input type="password" name="password" id="password" value="<?php echo $password ?>">
    

        <button type="submit" id="login_button">Login</button>
        <a href="registration1.php" id="register_link">Don't have an account? Register here</a>
    </form>
<?php
    if(!empty($name_error)){
        echo '<div class="error">'.$name_error.'</div>';
    }
    if(!empty($email_error)){
        echo '<div class="error">'.$email_error.'</div>';
    }
    if(!empty($password_error)){
        echo '<div class="error">'.$password_error.'</div>';
    }
    if(!empty($success_msg)){
        echo '<div class="success">'.$success_msg.'</div>';
    }
    ?>

</div>

</body>
</html>