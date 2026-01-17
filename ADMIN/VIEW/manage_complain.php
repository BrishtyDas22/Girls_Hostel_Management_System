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

<link rel="stylesheet" href="../CSS/manage_complain.css"> 

<div id="student-management-box">
    <div class="form-section-container">
       
        
        <?php 
        if($error != "") 
            {
            echo "<div class='error-box'>$error</div>";
        }
        ?>

        <form action="../CONTROL/complain_control.php" method="post">
            <input type="hidden" name="input_id" id="input_id">

            <div class="field">
                <label>Username :</label>
                <input type="text" name="user_name" id="user_name" readonly>
            </div>

            <div class="field">
                <label>Description :</label>
                <input type="text" name="complain_text" id="complain_text" readonly>
            </div>

            <div class="field">
                <label>Status :</label>
                <input type="radio" name="status_option" id="pending_radio" value="Pending"> Pending
                <input type="radio" name="status_option" id="resolved_radio" value="Resolved"> Resolved
            </div>

            <div class="button-group">
                <button type="submit" name="update_btn" id="update-btn" class="action-btn update-btn">Update Status</button>
                <button type="submit" name="delete_btn" id="delete-btn" class="action-btn delete-btn">Delete Row</button>
                <button type="button" id="cancel-btn" class="action-btn cancel-btn" onclick="window.location.reload()">Cancel</button>
            </div>
        </form>
    </div>

    <div class="table-white-box">
        <h3>Complaints List:</h3>
        <table id="info-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = getAllComplains($conn);
                while($row = mysqli_fetch_assoc($result)) {
                    $jsData = "'".$row['complain_id']."', '".$row['username']."', '".$row['complain_description']."', '".$row['status']."'";
                    $status_class = ($row['status'] == 'Pending') ? 'status-pending' : 'status-resolved';

                    echo "<tr>
                            <td>".$row['complain_id']."</td>
                            <td>".$row['username']."</td>
                            <td>".$row['complain_catagory']."</td>
                            <td>".$row['complain_description']."</td>
                            <td class='$status_class'>".$row['status']."</td>
                            <td>
                                <button type='button' class='action-btn btn-edit' onclick=\"fillComplainForm($jsData, 'update')\">Edit</button>
                                <button type='button' class='action-btn btn-delete' onclick=\"fillComplainForm($jsData, 'delete')\">Delete</button>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="../JS/manage_complain.js"></script>