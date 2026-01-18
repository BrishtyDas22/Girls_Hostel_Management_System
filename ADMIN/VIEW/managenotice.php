<?php
include('forallpages.php');
include('../MODEL/db1.php');
$conn = openConn();
$error = "";
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
?>

<link rel="stylesheet" href="../CSS/manage_notice.css">

<div id="student-management-box">
    <div class="form-section-container">
        <?php 
        if($error != "")
         { 
            echo "<div class='error-box'>$error</div>";
             }
             
              ?>
        <form action="../CONTROL/notice_control.php" method="post">
            <input type="hidden" name="notice_id" id="notice_id">
            <div class="field">
                <label>Username :</label>
                <input type="text" name="username" id="username">
            </div>
            <div class="field">
                <label>Description :</label>
                <textarea name="description" id="description"></textarea>
            </div>
            <div class="button-group">
                <button type="submit" name="add" id="add-btn" class="action-btn add-btn">Add Notice</button>
                <button type="button" id="cancel-btn" class="action-btn" onclick="window.location.reload()">Cancel</button>
                <button type="submit" name="update" id="update-btn" class="action-btn update-btn" style="display:none;" onclick="return validateAction('update')">Update Notice</button>
                <button type="submit" name="delete" id="delete-btn" class="action-btn delete-btn" style="display:none;" onclick="return validateAction('delete')">Delete Notice</button>
            </div>
        </form>
    </div>

    <div class="table-white-box">
        <div class="table-section-container">
            <h3>Notice Table:</h3>
            <table id="info-table">
                <thead>
                    <tr><th>ID</th><th>User</th><th>Description</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    <?php
                    $result = getAllNotices($conn);
                    while($row = $result->fetch_assoc()) {
                        echo "<tr onclick=\"fillNoticeForm('".$row['notice_id']."', '".$row['username']."', '".$row['description']."', 'update')\">
                                <td>".$row['notice_id']."</td>
                                <td>".$row['username']."</td>
                                <td>".$row['description']."</td>
                                <td>
                                    <button type='button' class='btn-edit'>Edit</button>
                                    <button type='button' class='btn-delete' onclick=\"event.stopPropagation(); fillNoticeForm('".$row['notice_id']."', '".$row['username']."', '".$row['description']."', 'delete')\">Delete</button>
                                </td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="../JS/manage_notice.js"></script>