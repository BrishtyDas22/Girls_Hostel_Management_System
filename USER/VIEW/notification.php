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
    <title>Notification Center</title>
    <link rel="stylesheet" href="../CSS/notificationdesign.css">
</head>
<body>

<div id="header_design">
    <h1 id="header_text">User's Dashboard</h1>
    <a href="../VIEW/editprofile.php">
        <img src="<?php echo $_SESSION['profile_pic'] ?? '../images/user.png'; ?>" alt="user-logo" id="user_logo">
    </a>
    <img src="../images/machine.png" alt="logo" id="header_logo">
    <h2>Welcome <?= htmlspecialchars($_SESSION["username"]) ?></h2>
</div>

<div id="sidebar">
    <p id="hms">HMS Sidebar</p>
    <a href="dashboard.php" id="overview"><img src="../images/webpage-list.gif" alt="overview" id="overviewimg">Overview</a>
    <a href="complaint.php" id="complaints"><img src="../images/bad-review.gif" alt="complaints" id="complaintsimg">Complaints</a>
    <a href="notices.php" id="notices"><img src="../images/notice.gif" alt="notice" id="noticeimg">Notices</a>
    
    <a href="notification.php" id="notification">
    <img src="../images/new-message.gif" alt="notification" id="notificationimg">
    Notifications
    <span id="notif-badge" class="red-circle" style="display:none;"></span>
</a>
    
    <a href="afterlogin.php" id="booknewroom"><img src="../images/add.gif" alt="newroom" id="booknewroomimg">New Room</a>
    <a href="feedback.php" id="givefeedback"><img src="../images/feedback.gif" alt="feedback" id="feedbackimg">Feedback</a>
</div>

<div id="my_notification">
    <div class="panel_header">
        <label>Notification Center</label>
        <a href="../CONTROL/notificationprocess.php?action=mark_read" class="mark-read-btn">Mark all read</a>
    </div>
    <hr>
    <div id="notif_list_container" class="notification_list"></div>
</div>

<script src="../JS/AJAX/notification.ajax.js"></script>

</body>
</html>