<?php

 include '../CONTROL/validationonlogin.php';

?>
<!DOCTYPE html>
<html>
<head>
    
    <title>Edit profile</title>
</head>
<body>
    <form id="editform" name="editform" method="post">
            <label for="name">Name:</label><br/>
            <input type="text" id="name" name="name" value="<?php echo $_SESSION['name']; ?>">

            <label for="email">Email:</label><br/>
            <input type="text" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">

            <label for="password">Password:</label><br/>
            <input type="text" id="password" name="password" value="<?php echo $_SESSION['password']; ?>">

            <label for="phonenumber">Phone number:</label>
            <input type="text" id="phonenumber" name="phonenumber" value="<?php echo $_SESSION['phonenumber']; ?>">

            <label for="blood">Blood group:</label>
            <input type="text" id="blood" name="blood" value="<?php echo $_SESSION['blood']; ?>">

            <button type="" id="submit" name="submit">Update</button>


        </div>

            
    </form>
    
</body>
</html>