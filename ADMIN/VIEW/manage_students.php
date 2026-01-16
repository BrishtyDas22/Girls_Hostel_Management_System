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

<link rel="stylesheet" href="../CSS/manage_students.css">

<div id="student-management-box">
    <div class="form-section-container">
        <?php if($error != "") { 
            
            echo "<div class='error-box'>$error</div>"; 
            
            } 
            ?>

        <form action="../CONTROL/student_control.php" method="post">
            <div class="field">
                <label>Full Name :</label>
                <input type="text" name="name" id="name">
            </div>
            <div class="field">
                <label>Email Address :</label>
                <input type="text" name="email" id="email">
            </div>
            <div class="field">
                <label>Phone Number :</label>
                <input type="text" name="phone" id="phone">
            </div>
            <div class="field">
                <label>Blood Group :</label>
                <input type="text" name="blood" id="blood">
            </div>
            <div class="field">
                <label>Password :</label>
                <input type="text" name="password" id="password"> 
            </div>
            <div class="field">
                <label>Confirm Password :</label>
                <input type="text" name="c_password" id="c_password">
            </div>

            <div class="button-group">
                <button type="submit" name="add" id="add-btn" class="action-btn add-btn">Add Student</button>
                <button type="button" id="cancel-btn" class="action-btn" onclick="window.location.reload()">Cancel</button>
                
                <button type="submit" name="update" id="update-btn" class="action-btn update-btn" style="display:none;" onclick="return validateAction('update')">Update Student</button>
                <button type="submit" name="delete" id="delete-btn" class="action-btn delete-btn" style="display:none;" onclick="return validateAction('delete')">Delete Student</button>
            </div>
        </form>
    </div>

    <div class="table-white-box">
        <div class="table-section-container">
            <h3>Registered Students Table:</h3>
            <table id="info-table">
                <thead>
                    <tr>
                        <th>ID</th> <th>Name</th> <th>Email</th> <th>Phone</th> <th>Blood</th>
                        <th>Password</th> <th>Confirm Pass</th> <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = getAllStudents($conn);
                    while($row = $result->fetch_assoc()) {
                    
                        echo "<tr onclick=\"fillStudentForm('".$row['name']."', '".$row['email']."', '".$row['phonenumber']."', '".$row['blood']."', '".$row['password']."', '".$row['c_password']."', 'update')\">
                                <td>".$row['ID']."</td> 
                                <td>".$row['name']."</td> 
                                <td>".$row['email']."</td>
                                <td>".$row['phonenumber']."</td> 
                                <td>".$row['blood']."</td>
                                <td>".$row['password']."</td> 
                                <td>".$row['c_password']."</td>
                                <td>
                                    <button type='button' class='btn-edit'>Edit</button>
                                    <button type='button' class='btn-delete' onclick=\"event.stopPropagation(); fillStudentForm('".$row['name']."', '".$row['email']."', '".$row['phonenumber']."', '".$row['blood']."', '".$row['password']."', '".$row['c_password']."', 'delete')\">Delete</button>
                                </td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="../JS/manage_students.js"></script>