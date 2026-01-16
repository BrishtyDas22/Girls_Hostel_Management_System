<?php
session_start();
include("../MODEL/db.php");

if (!isset($_SESSION["username"])) {
    header("Location: Login.php");
    exit();
}

$user_check = $_SESSION["username"];
$conn = openConn();

$query = "SELECT status, room_number, payment_method, transition_id FROM payment 
          WHERE username='$user_check' AND status='approved' 
          ORDER BY booking_id DESC LIMIT 1";
$res = $conn->query($query);
$booking = $res->fetch_assoc();

if (!$booking) {
    header("Location: afterlogin.php"); 
    exit();
}

$room_num = $booking['room_number'];


$room_query = "SELECT * FROM room_info_table WHERE room_num = '$room_num'";
$room_res = $conn->query($room_query);
$room_details = $room_res->fetch_assoc();

$room_images = [
    "101" => "2bed.jpg",
    "102" => "1.jpg",
    "103" => "img3.jpg",
    "104" => "img4.jpg",
    "105" => "img5.png",
    "106" => "3bed.avif"
];


$display_img = $room_images[$room_num] ?? 'default_room.jpg'; 

$conn->close();
?>
<!DOCTYPE html>

<head>
   
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../CSS/dashboarddesign.css">
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
    <a href="notification.php" id="notification"><img src="../images/new-message.gif" alt="notification" id="notificationimg">Notifications</a>
    <a href="afterlogin.php" id="booknewroom"><img src="../images/add.gif" alt="newroom"id="booknewroomimg">New Room</a>
</div>

<div id="my_dashboard">
    <label for="mydashboard">My Dashboard - Overview</label>
    <hr>

    <div class="booking-container">
        <div class="room-preview">
            <img src="../images/<?php echo $display_img; ?>" alt="Room <?php echo $room_num; ?>">
        </div>

        <div class="room-data">
            <h3>Booked Room Details</h3>
            <p><b>Room Number:</b> <?php echo $room_num; ?></p>
            <p><b>Status:</b> <span style="color: green; font-weight: bold;">Confirmed & Approved</span></p>
            <p><b>Price:</b> <?php echo $room_details['price'] ?? '10000'; ?></p>
            <hr>
            <h3>Payment Information</h3>
            <p><b>Method:</b> <?php echo $booking['payment_method']; ?></p>
            <p><b>Transaction ID:</b> <?php echo $booking['transition_id']; ?></p>
        </div>
    </div>
</div>
 
    
</body>
</html>