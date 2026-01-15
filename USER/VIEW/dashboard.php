
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
    
    <a href="dashboard.php" id="overview"><img src="../images/webpage-list.gif" alt="overviewimg" id="overviewimg">Overview</a>
    <a href="complaint.php" id="complaints"><img src="../images/bad-review.gif" alt="complaints" id="complaintsimg">Complaints</a>
    <a href="notices.php" id="notices"><img src="../images/notice.gif" alt="notice" id="noticeimg">Notices</a>
    <a href="notification.php" id="notification"><img src="../images/new-message.gif" alt="notification" id="notificationimg">Notifications</a>
    <a href="afterlogin.php" id="booknewroom"><img src="../images/add.gif" alt="newroom"id="booknewroomimg">New Room</a>
</div>

 
    
</body>
</html>