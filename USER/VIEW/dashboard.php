
<?php
session_start();
include("../MODEL/db.php");

if (!isset($_SESSION["username"])) {
    header("Location: Login.php");
    exit();
}

$user_check = $_SESSION["username"];
$conn = openConn();
$check_status = "SELECT status FROM payment WHERE username='$user_check' ORDER BY booking_id DESC LIMIT 1";
$res = $conn->query($check_status);
$row = $res->fetch_assoc();

if ($row['status'] !== 'approved') {
    header("Location: afterlogin.php"); 
    exit();
}
?>
<!DOCTYPE html>

<head>
   
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../CSS/dashboarddesign.css">
</head>
<body>

 <div id="header_design">
    <h1 id="header_text">User's Dashboard</h1>

    <a href="../VIEW/editprofile.php">
        <img src="<?php echo $_SESSION['profile_pic'] ?? '../images/user.png'; ?>" alt="user-logo" id="user_logo">
    </a>
    <img src="../images/machine.png" alt="logo" id="header_logo">
    <h2>Welcome <?= $_SESSION["username"] ?></h2>
</div>

<div id="sidebar">
    <a href="dashboard.php" id="overview">Overview</a>
    <a href="complaint.php" id="complaints">Complaints</a>
    <a href="notices.php" id="notices">Notices</a>
    <a href="notification.php" id="notification">Notifications</a>
    <a href="afterlogin.php" id="booknewroom">Book New Room</a>
</div>

 
    
</body>
</html>