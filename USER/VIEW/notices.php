<?php
session_start();
include("../MODEL/db.php");

if (!isset($_SESSION["username"])) {
    header("Location: Login.php");
    exit();
}

$conn = openConn();

$sql = "SELECT notification_id, notices FROM notice ORDER BY notification_id DESC";
$result = $conn->query($sql);
$count_query = "SELECT COUNT(*) as total FROM notice WHERE status='received'";
$count_res = $conn->query($count_query);
$count_data = $count_res->fetch_assoc();


?>

<!DOCTYPE html>
<html>
<head>
    <title>Notice Board</title>
    <link rel="stylesheet" href="../CSS/notices.css">
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
    <a href="notices.php" id="notices" style="background-color: rgb(8, 242, 125); color: white;">
        <img src="../images/notice.gif" alt="notice" id="noticeimg">Notices
    </a>
    
    <a href="notification.php" id="notification">
        <img src="../images/new-message.gif" alt="notification" id="notificationimg">
        Notifications
        <?php if($count_data['total'] > 0): ?>
            <span class="red-circle"><?= $count_data['total'] ?></span>
        <?php endif; ?>
    </a>
    
    <a href="afterlogin.php" id="booknewroom"><img src="../images/add.gif" alt="newroom" id="booknewroomimg">New Room</a>
    <a href="../VIEW/feedback.php" id="givefeedback"><img src="../images/feedback.gif" alt="feedback" id="feedbackimg">Feedback</a>
</div>

<div id="my_notices">
    <div class="panel_header">
        <label>Notices Center</label>
    </div>
    <hr>

    <table class="notice-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>
                    <center>Description</center>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): 
                while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td>
                        <?= $row['notification_id'] ?>
                    </td>
                    <td>
                        <?= htmlspecialchars($row['notices']) ?>
                    
                    </td>
                </tr>
            <?php endwhile; else: ?>
                <tr>
                    <td id="no-notice-text">No notices available at this time.</td>
                </tr>
            <?php endif; ?>


        </tbody>
    </table>
</div>

</body>
</html>