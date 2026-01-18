<?php
session_start();
include("../MODEL/db.php");

if (!isset($_SESSION["username"])) {
    header("Location: Login.php");
    exit();
}

$username = $_SESSION['username']; 



$conn = openConn();
$count_query = "SELECT COUNT(*) as total FROM notice WHERE status='received'";
$count_res = $conn->query($count_query);
$count_data = $count_res->fetch_assoc();


?>

<!DOCTYPE html>
<html>
<head>
   
    <title>Feedback</title>
    <link rel="stylesheet" href="../CSS/feedbackdesign.css">
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

<div id="feedback_dashboard">
    <label>Give feedback</label>
    <hr>

<form action="../CONTROL/feedbackprocess.php" method="POST">
        <div class="form-group">
            <label>Experience Category:</label>
            <select name="feedback_category" required>
                <option value="">--Select feedback--</option>
                <option value="Very Good">Very Good</option>
                <option value="Good">Good</option>
                <option value="Moderate">Moderate</option>
                <option value="Bad">Bad</option>
            </select>
        </div>

        <div class="form-group">
            <label>Comments:</label>
            <textarea name="comment" required placeholder="Describe your experience..."></textarea>
        </div>

        <button type="submit" name="submit_feedback" class="submit-btn">Post Feedback</button>
    </form>

    <br><hr><br>

    <label>My Feedback History</label>
    <table class="feedback-table">
        <thead>
            <tr>
                <th>Category</th>
                <th>Comment</th>
                <th>Admin Reply</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql_list = "SELECT * FROM feedback_table WHERE username = '$username' ORDER BY feedback_id DESC";
            $res_list = $conn->query($sql_list);

            if ($res_list->num_rows > 0) {
                while($row = $res_list->fetch_assoc()) {
                    $reply = !empty($row['get_reply']) ? $row['get_reply'] : "Waiting for reply...";
                    
                    echo "<tr>
                            <td>{$row['feedback']}</td>
                            <td>{$row['comment']}</td>
                            <td><i>$reply</i></td>
                            <td>
                              <button type=\"submit\" class='edit-link' onclick='fillFeedbackForm(\"{$row['feedback_id']}\", \"{$row['feedback']}\", \"{$row['comment']}\")'>Edit</button> 
                                <a href='../CONTROL/feedbackprocess.php?delete_id={$row['feedback_id']}' 
                                   class='delete-link' onclick='return confirm(\"Delete this?\")'>Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4' align='center'>No feedback found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<script src="../JS/fillfeedback.js"></script>
        </body>
        </html>
