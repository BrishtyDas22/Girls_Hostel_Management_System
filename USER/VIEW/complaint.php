<?php
session_start();
include("../MODEL/db.php");

if (!isset($_SESSION["username"])) {
    header("Location: Login.php");
    exit();
}

$conn = openConn();
$count_query = "SELECT COUNT(*) as total FROM notice WHERE status='received'";
$count_res = $conn->query($count_query);
$count_data = $count_res->fetch_assoc();


?>

<!DOCTYPE html>

<head>
   
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../CSS/complaintdesign.css">
    <script src="../JS/complaint_actions.js"></script>
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
    <p id="hms">HMS Sidebar</p>

    
    <a href="dashboard.php" id="overview"><img src="../images/webpage-list.gif" alt="overviewimg" id="overviewimg">Overview</a>
    <a href="complaint.php" id="complaints"><img src="../images/bad-review.gif" alt="complaints" id="complaintsimg">Complaints</a>
    <a href="notices.php" id="notices"><img src="../images/notice.gif" alt="notice" id="noticeimg">Notices</a>
    <a href="notification.php" id="notification">
        <img src="../images/new-message.gif" alt="notification" id="notificationimg">
        Notifications
        <?php if($count_data['total'] > 0): ?>
            <span class="red-circle"><?= $count_data['total'] ?></span>
        <?php endif; ?>
    </a>
    <a href="afterlogin.php" id="booknewroom"><img src="../images/add.gif" alt="newroom"id="booknewroomimg">New Room</a>
     <a href="feedback.php" id="givefeedback"><img src="../images/feedback.gif" alt="feedback" id="feedbackimg">Feedback</a>

</div>

<div id="complaint_dashboard">
    <label>Complaint Center</label>
    <hr>

    <?php if(isset($_SESSION['complaint_ok'])): ?>
        <p><?= $_SESSION['complaint_ok'];
         unset($_SESSION['complaint_ok']); ?></p>
    <?php endif; ?>

    <div class="complaint-form_container">
        <h3 id="form-title">Submit New Complaint</h3>
        <form action="../CONTROL/complaintprocess.php" method="POST">
            <input type="hidden" name="complaint_id" id="edit_cid">

            <label>Category</label><br>
            <select name="category" id="category" required>
                <option value="Select category">--Select Category--</option>
                <option value="Maintenance">Maintenance</option>
                <option value="WiFi">WiFi</option>
                <option value="Plumbing">Plumbing</option>
                <option value="Electrical">Electrical</option>
            </select>
            <br><br>

            <label>Description</label><br>
            <textarea name="description" id="description" rows="7" placeholder="Describe your issue..." required></textarea><br><br>

            <button type="submit" name="submit_complaint" id="submit-btn">Submit</button>
            <button type="reset" id="cancel-btn" onclick="window.location.reload();">Cancel</button>
        </form>
    </div>

    <hr>

    <h3>Your Complaints</h3>
    <table class="complaint-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $conn = openConn();
            $result = getUserComplaints($conn, $_SESSION['user_id']);
            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $statusColor = (($row['status']) == 'resolved') ? 'green' : 'orange';
                    $cid = $row['complaint_id']; 
                    $cat = $row['category'];
                    $desc = htmlspecialchars($row['Complaintdescription']);
                    
                    echo "<tr>
                            <td>$cid</td>
                            <td>$cat</td>
                            <td>" . htmlspecialchars($row['Complaintdescription']) . "</td>
                            <td class='status-text' style='color: $statusColor; font-weight: bold;'>{$row['status']}</td>
                            <td>
                                <button type='button' class='btn-edit' onclick=\"editComplaint('$cid', '$cat', '$desc')\">Edit</button>
                                <button type='button' class='btn-delete' onclick=\"confirmDelete('$cid')\">Delete</button>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr>
                <td id='no_complaints'>No complaints found.</td>
                
                </tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</div>