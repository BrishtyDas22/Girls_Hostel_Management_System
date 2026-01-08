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
           <button type="submit" id="dashboard" onclick="window.location.href='Admindashboard.php'">Dashboard</button>

           <img src="../IMAGES/management.png" alt="managestudentlogo" id="managestudentlogo">
           <button type="submit" id="manageusers" onclick="window.location.href='ManageUsers.php'">Manage Users</button>

           <img src="../IMAGES/engineer.png" alt="stafflogo" id="stafflogo">
           <button type="submit" id="assignstaff" onclick="window.location.href='ManageHostels.php'">Assign staff</button>

              <img src="../IMAGES/home-office.png" alt="roombookinglogo" id="roombookinglogo">
           <button type="submit" id="managebookings" onclick="window.location.href='ManageBookings.php'">Room & Bookings</button>

           <img src="../IMAGES/complaint.png" alt="complaintslogo" id="complaintslogo">
           <button type="submit" id="complaints" onclick="window.location.href='ManageComplaints.php'">Complaints</button>

              <img src="../IMAGES/bell.png" alt="noticeslogo" id="noticeslogo">
           <button type="submit" id="notices" onclick="window.location.href='ManageNotices.php'">Notices</button>


                <img src="../IMAGES/review.png" alt="studentfeedbacklogo" id="studentfeedbacklogo">
           <button type="submit" id="Student-feedback" onclick="window.location.href='ManageFeedback.php'">Student Feedback</button>

              <img src="../IMAGES/exit.png" alt="logoutlogo" id="logoutlogo">
              <button type="submit" id="logout" onclick="window.location.href='Login.php'">Logout</button>
        </ul>
    </nav>

    </div>
    <div class="content">
        <h1>Welcome to the Admin Dashboard</h1>

</div>



    
</body>
</html>