<?php
include('forallpages.php');
include('../MODEL/db1.php');
$conn = openConn();

$error = "";
if (isset($_SESSION['error'])) 
    {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
?>

<link rel="stylesheet" href="../CSS/manage_feedback.css"> 

<div id="student-management-box">
    <div class="form-section-container">

        
        <?php if($error != "")
             { 
                echo "<div class='error-box'>$error</div>";
                 } 
                 ?>

        <form action="../CONTROL/feedback_control.php" method="post">
            <input type="hidden" name="f_id" id="f_id">

            <div class="field">
                <label>Username :</label>
                <input type="text" name="username" id="username" readonly>
            </div>
            <div class="field">
                <label>Admin Reply :</label>
                <input type="text" name="reply" id="reply" placeholder="Type your reply here...">
            </div>

            <div class="button-group">
                <button type="submit" name="update" id="update-btn" class="action-btn update-btn">Save Reply</button>
                <button type="submit" name="delete" id="delete-btn" class="action-btn delete-btn" onclick="return confirm('Delete this entire feedback?')">Delete Row</button>
                <button type="button" id="cancel-btn" class="action-btn" onclick="window.location.reload()">Cancel</button>
            </div>
        </form>
    </div>

    <div class="table-white-box">
        <div class="table-section-container">
            <h3>User Feedbacks:</h3>
            <table id="info-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Room</th>
                        <th>Feedback</th>
                        <th>Comments</th>
                        <th>Reply</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = getAllFeedback($conn);
                    while($row = $result->fetch_assoc()) {
                        $replyText = addslashes($row['reply']);
                        // Database theke ana data JS arguments hisebe guchiye rakha hoyeche
                        $jsArguments = "'".$row['feedback_id']."', '".$row['username']."', '".$replyText."'";
                        
                        echo "<tr>
                                <td>".$row['feedback_id']."</td>
                                <td>".$row['username']."</td>
                                <td>".$row['room_num']."</td>
                                <td>".$row['user_feedback']."</td>
                                <td>".$row['comments']."</td>
                                <td>".$row['reply']."</td>
                                <td>
                                    <button type='button' class='btn-edit' onclick=\"fillFeedbackForm($jsArguments, 'update')\">Edit/Reply</button>
                                    <button type='button' class='btn-delete' onclick=\"fillFeedbackForm($jsArguments, 'delete')\">Delete</button>
                                </td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="../JS/manage_feedback.js"></script>