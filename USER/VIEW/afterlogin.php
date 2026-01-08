<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: Login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<body>
    <h2>Welcome to Dashboard</h2>
    <p><b>Name:</b> <?php echo $_SESSION["username"]; ?></p>
    <p><b>Email:</b> <?php echo $_SESSION["email"]; ?></p>
    <p><b>Phone:</b> <?php echo $_SESSION["phonenumber"]; ?></p>
    <p><b>Blood Group:</b> <?php echo $_SESSION["blood"]; ?></p>

    <br>
    <a href="../CONTROL/logout.php">Logout</a>
</body>
</html>
