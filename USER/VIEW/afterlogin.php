<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: Login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
    
    <title>Welcome to Hostel</title>
</head>
<link rel="stylesheet" href="../CSS/afterlogindesign.css">
<body>
    <div id="header_design">

    <h1 id="header_text">Room Your Book</h1>

    <a href="../VIEW/editprofile.php"><img src="../images/user.png" alt="user-logo" id="user_logo"></a>
        <img src="../images/machine.png" alt="logo" id="header_logo">

    <h2>Welcome <?= $_SESSION["username"] ?></h2>
    
    </div>

    <div id="room_info">
        <form method="post" id="booking-form">
            <img src="../images/2bed.jpg" alt="room1.png" id="room1_img">
            <h3>Room Info:</h3>
            <label id="r1">Room No:</label>
            <label id="p1">Price:</label>
            <p id ="r1_info"><b><i>Fully furnished with cleaning services provided twice a week. Includes high-speed internet and access to the common room.</i></b></p>
        </form>


    </div>


    <br>
    <a href="../CONTROL/logout.php">Logout</a>
</body>
</html>
