
<?php
session_start();
include("../MODEL/db.php");

if (!isset($_SESSION["username"])) {
    header("Location: Login.php");
    exit();
}

$conn = openConn();

$payment_status = "";
$booked_room_num = "";
$user_check = $_SESSION["username"];
$status_query = "SELECT status, room_number FROM payment WHERE username='$user_check' ORDER BY booking_id DESC LIMIT 1";
$status_result = $conn->query($status_query);

if ($status_result && $status_result->num_rows > 0) {
    $row = $status_result->fetch_assoc();
    $payment_status = $row['status'];
    $booked_room_num = $row['room_number'];
}
$result = getRoomDetails($conn);
$rooms = [];

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $rooms[] = $row; 
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
    <head>
    
    <title>Welcome to Hostel</title>
</head>
<link rel="stylesheet" href="../CSS/afterlogindesign.css">
<body>



    <div id="header_design">
    <h1 id="header_text">Room Your Book</h1>

    <a href="../VIEW/editprofile.php">
        <img src="<?php echo $_SESSION['profile_pic'] ?? '../images/user.png'; ?>" alt="user-logo" id="user_logo">
    </a>
    <img src="../images/machine.png" alt="logo" id="header_logo">
    <h2>Welcome <?= $_SESSION["username"] ?></h2>
</div>




    <div id="room_info">
        <form method="get" action="paymentmethod.php" id="booking-form">
            <img src="../images/2bed.jpg" alt="room1.png" id="room1_img">
            <h3>Room Info:</h3>
            <label id="r1">Room No: <?php echo $rooms[0]['room_num']; ?></label>
            <label id="p1">Price: <?php echo $rooms[0]['price']; ?></label>

            <input type="hidden" name="room" value="<?php echo $rooms[0]['room_num']; ?>">


            
            <p id ="r1_info"><b><i>Fully furnished with cleaning services provided twice a week. Includes high-speed internet and access to the common room.</i></b></p>
            <button type="submit" id="book_now1">Book Now!</button>

            <?php 
            if ($booked_room_num == $rooms[0]['room_num']): 
            if ($payment_status == 'approved'): ?>
                <a href="dashboard.php" id="gotodashboard">Open your dashboard</a>
            <?php elseif ($payment_status == 'pending'): ?>
                <span id="approval">Payment Pending Approval</span>
            <?php endif; 
            endif; ?>

        </form>


    </div>

    <div id="room_info2">
        <form method="get" action="paymentmethod.php" id="booking-form2">
            <img src="../images/1.jpg" alt="room2.png" id="room2_img">
            <h3>Room Info:</h3>
            <label id="r2">Room No: <?php echo $rooms[1]['room_num']; ?></label>
            <label id="p2">Price: <?php echo $rooms[1]['price']; ?></label>

            <input type="hidden" name="room" value="<?php echo $rooms[1]['room_num']; ?>">
            <p id ="r2_info"><b><i>A comfortable, ready-to-occupy room with scheduled cleaning services, reliable high-speed internet, and access to shared common areas.</i></b></p>
            <button type="submit" id="book_now2">Book Now!</button>

            <?php 
            if ($booked_room_num == $rooms[1]['room_num']): 
            if ($payment_status == 'approved'): ?>
                <a href="dashboard.php" id="gotodashboard">Open your dashboard</a>
            <?php elseif ($payment_status == 'pending'): ?>
                <span id="approval">Payment Pending Approval</span>
            <?php endif; 
            endif; ?>


        </form>


    </div>


    <div id="room_info3">
        <form method="get" action="paymentmethod.php" id="booking-form3">
            <img src="../images/img3.jpg" alt="room3.png" id="room3_img">
            <h3>Room Info:</h3>
            <label id="r3">Room No: <?php echo $rooms[2]['room_num']; ?></label>
            <label id="p3">Price: <?php echo $rooms[2]['price']; ?></label>

             <input type="hidden" name="room" value="<?php echo $rooms[2]['room_num']; ?>">


            <p id ="r3_info"><b><i>Well-prepared living space with biweekly cleaning, dependable internet connectivity, and shared common room privileges with air conditioning.</i></b></p>
            <button type="submit" id="book_now3">Book Now!</button>

             
            <?php 
            if ($booked_room_num == $rooms[2]['room_num']): 
            if ($payment_status == 'approved'): ?>
                <a href="dashboard.php" id="gotodashboard">Open your dashboard</a>
            <?php elseif ($payment_status == 'pending'): ?>
                <span id="approval">Payment Pending Approval</span>
            <?php endif; 
            endif; ?>

        </form>


    </div>


    <div id="room_info4">
        <form method="get" action="paymentmethod.php" id="booking-form4">
            <img src="../images/img4.jpg" alt="room4.png" id="room4_img">
            <h3>Room Info:</h3>
            <label id="r4">Room No: <?php echo $rooms[3]['room_num']; ?></label>
            <label id="p4">Price: <?php echo $rooms[3]['price']; ?></label>

            <input type="hidden" name="room" value="<?php echo $rooms[3]['room_num']; ?>">
            <p id ="r4_info"><b><i>Comfortable living space offered with regular twice-weekly cleaning, fast and reliable internet, and use of shared communal areas.</i></b></p>
            <button type="submit" id="book_now4">Book Now!</button>

             
            <?php 
            if ($booked_room_num == $rooms[3]['room_num']): 
            if ($payment_status == 'approved'): ?>
                <a href="dashboard.php" id="gotodashboard">Open your dashboard</a>
            <?php elseif ($payment_status == 'pending'): ?>
                <span id="approval">Payment Pending Approval</span>
            <?php endif; 
            endif; ?>


        </form>


    </div>

    <div id="room_info5">
        <form method="get" action="paymentmethod.php" id="booking-form5">
            <img src="../images/img5.png" alt="room5.png" id="room5_img">
            <h3>Room Info:</h3>
            <label id="r5">Room No: <?php echo $rooms[4]['room_num']; ?></label>
            <label id="p5">Price: <?php echo $rooms[4]['price']; ?></label>

            <input type="hidden" name="room" value="<?php echo $rooms[4]['room_num']; ?>">
            <p id ="r5_info"><b><i>Comfortable living space offered with regular twice-weekly cleaning, fast and reliable internet, and use of shared communal areas.</i></b></p>
            <button type="submit" id="book_now5">Book Now!</button>

            
            <?php 
            if ($booked_room_num == $rooms[4]['room_num']): 
            if ($payment_status == 'approved'): ?>
                <a href="dashboard.php" id="gotodashboard">Open your dashboard</a>
            <?php elseif ($payment_status == 'pending'): ?>
                <span id="approval">Payment Pending Approval</span>
            <?php endif; 
            endif; ?>


        </form>


    </div>

    <div id="room_info6">
        <form method="get" action="paymentmethod.php" id="booking-form6">
            <img src="../images/3bed.avif" alt="room6.png" id="room6_img">
            <h3>Room Info:</h3>
            <label id="r6">Room No: <?php echo $rooms[5]['room_num']; ?></label>
            <label id="p6">Price: <?php echo $rooms[5]['price']; ?></label>

            <input type="hidden" name="room" value="<?php echo $rooms[5]['room_num']; ?>">

            <p id ="r6_info"><b><i>Comfortable living space offered with regular twice-weekly cleaning, fast and reliable internet, and use of shared communal areas.</i></b></p>
            <button type="submit" id="book_now6">Book Now!</button>

            
            <?php 
            if ($booked_room_num == $rooms[5]['room_num']): 
            if ($payment_status == 'approved'): ?>
                <a href="dashboard.php" id="gotodashboard">Open your dashboard</a>
            <?php elseif ($payment_status == 'pending'): ?>
                <span id="approval">Payment Pending Approval</span>
            <?php endif; 
            endif; ?>


        </form>


    </div>


    <br>
    <a href="../CONTROL/logout.php">Logout</a>
</body>
</html>
