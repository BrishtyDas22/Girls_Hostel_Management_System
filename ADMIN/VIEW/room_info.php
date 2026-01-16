<?php 
include('forallpages.php'); 
include('../MODEL/db1.php');
include('../CONTROL/roomvalidation.php'); 

$conn = openConn();

$error = "";
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']); 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_no = $_POST['room_no'];
    $price = $_POST['price'];
    $aircon = isset($_POST['aircon']) ? $_POST['aircon'] : '';
    $capacity = $_POST['capacity'];
    $p_student = $_POST['present_student'];

    if (isset($_POST['add'])) {
        $msg = validateRoomData($conn, $room_no, $capacity, $p_student, "add");
        if ($msg == "") { 
            addRoom($conn, $room_no, $price, $aircon, $capacity, $p_student);
            header("Location: room_info.php"); 
            exit();
        } else {
            $_SESSION['error'] = $msg; 
            header("Location: room_info.php"); 
            exit();
        }
    } elseif (isset($_POST['update'])) {
        $msg = validateRoomData($conn, $room_no, $capacity, $p_student, "update");
        if ($msg == "") { 
            updateRoom($conn, $room_no, $price, $aircon, $capacity, $p_student);
            header("Location: room_info.php");
            exit();
        } else {
            $_SESSION['error'] = $msg; 
            header("Location: room_info.php");
            exit();
        }
    } elseif (isset($_POST['delete'])) {
        deleteRoom($conn, $room_no);
        header("Location: room_info.php");
        exit();
    }
}
?>

<link rel="stylesheet" href="../CSS/room_info.css">

<div id="room-management-box">
    
    <div class="form-section-container">
        <?php if($error != "") 
            {
                 echo "<div class='error-box'>$error</div>"; 
                 }
                  ?>

        <form action="" method="post">
            <div class="field">
                <label>Room number :</label>
                <input type="text" name="room_no" id="room_no">
            </div>
            <div class="field">
                <label>Price :</label>
                <input type="text" name="price" id="price">
            </div>
            <div class="field">
                <label>AC/Non-AC :</label>
                <div class="radio-options">
                    <input type="radio" name="aircon" id="ac" value="AC"> AC 
                    <input type="radio" name="aircon" id="non_ac" value="Non-AC"> Non-AC
                </div>
            </div>
            <div class="field">
                <label>Capacity :</label>
                <input type="text" name="capacity" id="capacity">
            </div>
            <div class="field">
                <label>Present Student :</label>
                <input type="text" name="present_student" id="present_student">
            </div>

            <div class="button-group">
                <button type="submit" name="add" id="add-btn" class="action-btn add-btn">Add Room</button>
                <button type="button" id="cancel-btn" class="action-btn" onclick="window.location.reload()">Cancel</button>

                <button type="submit" name="update" id="update-btn" class="action-btn update-btn" style="display:none;" onclick="return validateAction('update')">Update Room</button>
                <button type="submit" name="delete" id="delete-btn" class="action-btn delete-btn" style="display:none;" onclick="return validateAction('delete')">Delete Room</button>
            </div>
        </form>
    </div>

    <div class="table-section-container">
        <h3>Room Info Table:</h3>
        <div id="database-table-container">
            <?php
            $result = getAllRooms($conn);
            if ($result && $result->num_rows > 0) {
                echo "<table id='info-table'>
                        <thead>
                            <tr>
                                <th>Room ID</th> <th>Room No</th> <th>Price</th>
                                <th>Type</th> <th>Capacity</th> <th>Students</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["room_id"] . "</td> <td>" . $row["room_num"] . "</td> 
                            <td>" . $row["price"] . "</td> <td>" . $row["ac/non-ac"] . "</td> 
                            <td>" . $row["capacity"] . "</td> <td>" . $row["present_student"] . "</td>
                            <td>
                                <button type='button' class='table-edit-btn' onclick=\"fillForm('".$row['room_num']."', '".$row['price']."', '".$row['ac/non-ac']."', '".$row['capacity']."', '".$row['present_student']."', 'update')\">Edit</button>
                                <button type='button' class='table-delete-btn' onclick=\"fillForm('".$row['room_num']."', '".$row['price']."', '".$row['ac/non-ac']."', '".$row['capacity']."', '".$row['present_student']."', 'delete')\">Delete</button>
                            </td>
                          </tr>";
                }
                echo "</tbody></table>";
            } else
             {
                 echo "<p class='no-data'>No data found!</p>"; 
                 }
            ?>
        </div>
    </div>
</div>

<script src="../JS/room_info.js"></script>