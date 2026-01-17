<?php
include('forallpages.php');
include('../MODEL/db1.php');
$conn = openConn();
$error = isset($_SESSION['error']) ? $_SESSION['error'] : "";
unset($_SESSION['error']);
?>

<link rel="stylesheet" href="../CSS/manage_bookings.css">

<div class="main-body-container">
    <div class="booking-section-box">
        
       <?php
if (!empty($error)) 
    {
    echo '<div class="error-box">' . htmlspecialchars($error) . '</div>';
}
?>

        <form action="../CONTROL/booking_control.php" method="post">
            <input type="hidden" name="booking_id" id="booking_id">
            
            <div class="form-row">
                <label>Username :</label>
                <input type="text" name="username" id="username">
            </div>
            
            <div class="form-row">
                <label>Room Number :</label>
                <input type="text" name="room_num" id="room_num">
            </div>
            
            <div class="form-row">
                <label>Trans No :</label>
                <input type="text" name="t_num" id="t_num">
            </div>
            
           
            <div class="form-row">
                <label>Payment :</label>
                <input type="radio" name="p_method" id="bkash" value="Bkash"> Bkash
                <input type="radio" name="p_method" id="nagad" value="Nagad"> Nagad
            </div> 
            
            
            
            <div class="form-row">
                <label>Trans ID :</label>
                <input type="text" name="t_id" id="t_id">
            </div>
            
            <div class="form-row">
                <label>Status :</label>
                <input type="radio" name="status" id="pending" value="Pending"> Pending
                <input type="radio" name="status" id="approved" value="Approved"> Approved
            </div>
            
            <div class="btn-group">
                <button type="submit" name="add" id="add-btn" class="btn-green">Add Student</button>
                <button type="button" class="btn-orange" onclick="window.location.reload()">Cancel</button>
                <button type="submit" name="update" id="update-btn" class="btn-blue" style="display:none;">Update</button>
                <button type="submit" name="delete" id="delete-btn" class="btn-red" style="display:none;">Delete</button>
            </div>
        </form>
    </div>

    <div class="table-section-box">
<h3 class="booking-title">Booking Students Table:</h3>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>booking_id</th>
                    <th>User Name</th>
                    <th>Room No</th>
                    <th>Trans No</th>
                    <th>Payment</th>
                    <th>Trans ID</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $result = getAllBookings($conn); 
                while($row = $result->fetch_assoc()) 
                    { 
                    $u_name = getNameFromId($conn, $row['ID']); 
                    $r_num = getRoomNumFromId($conn, $row['room_id']); 
                ?>
                <tr>
                    <td><?php echo $row['booking_id']; ?></td>
                    <td><?php echo $u_name; ?></td>
                    <td><?php echo $r_num; ?></td>
                    <td><?php echo $row['transaction_number']; ?></td>
                    <td><?php echo $row['payment_method']; ?></td>
                    <td><?php echo $row['transaction_id']; ?></td>
                    <td class="<?php echo ($row['status'] == 'Pending') ? 'status-pending' : 'status-approved'; ?>">
                        <?php echo $row['status']; ?>
                    </td>
                    <td>
                        <button class="btn-edit" onclick="fillBooking(this, 'update')">Edit</button>
                        <button class="btn-delete" onclick="fillBooking(this, 'delete')">Delete</button>
                    </td>
                </tr>
                <?php
                 }
                  ?>
            </tbody>
        </table>
    </div>
</div>

<script src="../JS/room_bookings.js"></script>