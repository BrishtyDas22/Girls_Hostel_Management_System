<?php
session_start();
include('../CONTROL/dashboard_logic.php');

if (!isset($_SESSION["username"])) {
    header("Location: adminLogin.php");
    exit();
}
$img = !empty($_SESSION["profile_pic"]) ? "../IMAGES/uploads/".$_SESSION["profile_pic"] : "../IMAGES/dp.png";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../CSS/admindashboard.css">
</head>
<body>
    <div class="panel">

    <h2>HMS Admin</h2>

</div>
<div class="sidebar">
    <nav class="links"></nav>
        <ul id="navlist">
            <img src="../IMAGES/layout.png" alt="dasboardlogo" id="dashboardlogo">
           <button type="button" id="dashboard">Dashboard</button>

<img src="../IMAGES/roominfo.png" alt="roominfologo" id="roominfologo">
    <button type="button" id="roominfo">Room Info</button>

<img src="../IMAGES/home-office.png" alt="roombookinglogo" id="roombookinglogo">
    <button type="button" id="managebookings">Room Bookings</button>

           <img src="../IMAGES/management.png" alt="managestudentlogo" id="managestudentlogo">
           <button type="button" id="manageusers" >Manage Students</button>

           <img src="../IMAGES/complaint.png" alt="complaintslogo" id="complaintslogo">
           <button type="button" id="complaints" >Complaints</button>
                         <img src="../IMAGES/bell.png" alt="noticeslogo" id="noticeslogo">
           <button type="button" id="notices" >Notices</button>

                <img src="../IMAGES/review.png" alt="studentfeedbacklogo" id="studentfeedbacklogo">
           <button type="button" id="Student-feedback" >Student Feedback</button>

           <img src="../IMAGES/engineer.png" alt="stafflogo" id="stafflogo">
           <button type="button" id="assignstaff" >Assign staff</button>

 <img src="../IMAGES/exit.png" alt="logoutlogo" id="logoutlogo">
              <button type="button" id="logout" onclick="gotologout()">Logout</button>
        </ul>
    </nav>

    </div>
    <div class="content">
        <h2><?php echo $_SESSION['username']; ?>, Welcome to Happy Life!</h2>
          <div id="profilebox">
            
          <div id="noti-wrapper" onclick="showNoti()">
        <img src="../IMAGES/noti icon.png" id="noti-icon" alt="notification">
        <div id="noti-badge">0</div>
        
        <div id="noti-popup" class="hidden">
            <div class="noti-header">New Notifications</div>
            <div id="noti-list">No new notifications.</div>
        </div>
    </div> 
        <img src="<?php echo $img; ?>" id="profileicon" alt="profile" onclick="location.href='../VIEW/adminprofile.php'">
    </div>

</div>


<div id="insidecontent">
    <form method="post" id="roomcounts">
        <Label id="roomnum"><?php echo $totalRoomsCount; ?></Label>
        <br>
        <label id="infoofroom">Total Rooms</label>
        <img src="../IMAGES/bed.png" alt="bedlogo" id="bedlogo">
        </form>



        <form method="post" id="studentcounts">
       

<Label id="studentnum"><?php echo $totalStudentsCount; ?></Label> 
    <br>
        <label id="infoofstudents">Total Students</label>
        <img src="../IMAGES/teamwork.png" alt="userslogo" id="userslogo">

    </form>

    <form method="post" id="pendingcomplaints">

<Label id="pendingcomplaintnum"><?php echo $pendingComplaintsCount; ?></Label>
    <br>
        <label id="infoofcomplaints">Pending Complaints</label>
        <img src="../IMAGES/project-deadline.png" alt="complaintlogo" id="complaintlogo">
    </form>

    
    <form method="post" id="revenue">
     
<Label id="revenuenum"><?php echo $totalRevenueSum; ?> TK</Label>
    <br>
        <label id="infoofrevenue">Revenue</label>
        <img src="../IMAGES/money.png" alt="revenuelogo" id="revenuelogo">
    </form>




</div>
<div id="recentbookingtable">
   
        <h2 id="recentbookingsheading">Recent Bookings</h2>
        

    <table class="dashboard-table">
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>User ID</th>
                <th>Room ID</th>
                <th>Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php 
           
            if ($bookingTableData && $bookingTableData->num_rows > 0) {
                while($row = $bookingTableData->fetch_assoc()) { 
            ?>
            <tr>
                <td><?php echo $row['booking_id']; ?></td>
                <td><?php echo $row['ID']; ?></td>
                <td><?php echo $row['room_id']; ?></td>
                <td><?php echo $row['amount']; ?> TK</td>
                <td class="status-column <?php echo strtolower($row['status']); ?>">
                    <?php echo $row['status']; ?>
                </td>
            </tr>
            <?php 
                } 
            } else {
                echo "<tr><td colspan='5' class='no-data'>No records found.</td></tr>";
            }
            ?>
        </tbody>
    </table>



</div>
     <script src="../JS/gotologout.js"></script>
     <script src="../JS/notification.js"></script>
     <script src="../JS/sidebar.js"></script>
 
</body>
</html>