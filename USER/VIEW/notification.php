<?php
session_start();
include("../MODEL/db.php");

if (!isset($_SESSION["username"])) {
    header("Location: Login.php");
    exit();
}

$conn = openConn();


$sql = "SELECT notification_id, notification, status FROM notice ORDER BY notification_id DESC";
$result = $conn->query($sql);

$count_query = "SELECT COUNT(*) as total FROM notice WHERE status='received'";
$count_res = $conn->query($count_query);
$count_data = $count_res->fetch_assoc();
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
        <?php if($count_data['total'] > 0): ?>
            <span class="red-circle"><?= $count_data['total'] ?></span>
        <?php endif; ?>
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

    <div class="notification_list">
        <?php if ($result && $result->num_rows > 0): 

            while($row = $result->fetch_assoc()): ?>


            <div class="notif_card <?= ($row['status'] == 'received') ? 'unread' : '' ?>">
                <div class="notif_icon">
                    <img src="../images/notice.gif" width="30">
                </div>
                <div class="notif_content">
                    <h4><?= htmlspecialchars($row['notification']) ?></h4>
                    <p>Status: <p><?= ($row['status']) ?></p></p>
                </div>
            </div>
        <?php endwhile; else: ?>
            <div id="no-notification">No notifications found.</div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>