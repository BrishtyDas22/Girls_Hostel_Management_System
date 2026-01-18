<?php
include('forallpages.php');
include('../MODEL/db1.php');
$conn = openConn();
$error = "";
if (isset($_SESSION['error']))
     {
         $error = $_SESSION['error']; unset($_SESSION['error']);
          }
if (isset($_SESSION['success'])) 
    { 
        $msg = $_SESSION['success']; 
        echo "<script>alert('$msg');</script>";
         unset($_SESSION['success']);
          }
?>
<link rel="stylesheet" href="../CSS/assign_staff.css">
<div id="student-management-box">

    <div class="form-section-container">
        <?php if($error != "") {
             echo "<div class='error-box'>$error</div>";
              } ?>
        <form action="../CONTROL/staff_control.php" method="post">
            <input type="hidden" name="staff_id" id="staff_id">
            <div class="field">
                <label>Staff Name :</label>
                <input type="text" name="staff_name" id="staff_name">
            </div>
            <div class="field">
                <label>Complain ID :</label>
                <input type="text" name="complain_id" id="complain_id">
            </div>
            <div class="button-group">
                <button type="submit" name="add" id="add-btn" class="action-btn add-btn">Assign Staff</button>
                <button type="button" id="cancel-btn" class="action-btn" onclick="window.location.reload()">Cancel</button>
                <button type="submit" name="update" id="update-btn" class="action-btn update-btn" style="display:none;" onclick="return validateAction('update')">Update Assignment</button>
                <button type="submit" name="delete" id="delete-btn" class="action-btn delete-btn" style="display:none;" onclick="return validateAction('delete')">Delete Assignment</button>
            </div>
        </form>
    </div>
    <div class="table-white-box">
        <div class="table-section-container">
            <table id="info-table">
                <thead>
                    <tr><th>ID</th><th>Complain ID</th><th>Staff Name</th><th>Work Status</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    <?php
                    $result = getAllStaff($conn);
                    while($row = $result->fetch_assoc()) {
                        echo "<tr onclick=\"fillStaffForm('".$row['staff_id']."', '".$row['staff_name']."', '".$row['complain_id']."', 'update')\">
                                <td>".$row['staff_id']."</td>
                                <td>".$row['complain_id']."</td>
                                <td>".$row['staff_name']."</td>
                                <td>".$row['work_status']."</td>
                                <td>
                                    <button type='button' class='btn-edit' onclick=\"event.stopPropagation(); fillStaffForm('".$row['staff_id']."', '".$row['staff_name']."', '".$row['complain_id']."', 'update')\">Edit</button>
                                    <button type='button' class='btn-delete' onclick=\"event.stopPropagation(); fillStaffForm('".$row['staff_id']."', '".$row['staff_name']."', '".$row['complain_id']."', 'delete')\">Delete</button>
                                </td>
                              </tr>";
                    } 
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="../JS/assign_staff.js"></script>