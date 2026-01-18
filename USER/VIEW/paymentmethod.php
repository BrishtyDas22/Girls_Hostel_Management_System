<?php

session_start(); 
include("../MODEL/db.php"); 


if (!isset($_SESSION["username"])) {
    header("Location: Login.php");
    exit();
}
$conn = openConn(); 
$selected_room = isset($_GET['room']) ? $_GET['room'] : "";


if (!empty($selected_room)) {
    $room_num = mysqli_real_escape_string($conn, $selected_room);
    
    
    $check_query = "SELECT capacity, present_student FROM room_info_table WHERE room_num = '$room_num'";
    $check_res = $conn->query($check_query);
    
    if ($check_res && $check_res->num_rows > 0) {
        $room_data = $check_res->fetch_assoc();
        
       
        if ($room_data['present_student'] >= $room_data['capacity']) {
            echo "<script>
                    alert('This room (No: $room_num) is already full. Please select another room.');
                    window.location.href='afterlogin.php';
                  </script>";
            exit();
        }
    }
}
$conn->close();


?>
<!DOCTYPE html>
<head>
    <title>Payment Method</title>
    <link rel="stylesheet" href="../CSS/paymentmethoddesign.css">
</head>
<body>
    
     <div id="header_design">

    <h1 id="header_text">Payment Method</h1>

        <img src="../images/machine.png" alt="logo" id="header_logo">

    
    </div>

    <div id="payment">
        <form method="post" action="../CONTROL/paymentprocess.php" id="paymentform">
            <label>Payment Form</label>
            <hr>
            <label>Username:</label><br/>
             <input type="text" id="name" name="name" value="<?php echo $_SESSION["username"]; ?>">
             <hr>
             <label for="roomnum">Room Number:</label>
             <input type="text" name="room_num" id="room_num" value="<?php echo $selected_room; ?>" readonly>
              <hr>
             <label for="payment">Payment Method:</label>
             <input type="radio" name="payment_method" value="bkash" required> Bkash
             <input type="radio" name="payment_method" value="nagad" required> Nagad

             <hr>
             <label for="phonenum">Transition Number:</label>
             <input type="text" id="phone_num" name="phonenumber" value="01615663862" readonly>
               <hr>
             <label for="transaction_id">Transaction ID:</label>
             <input type="text" id="transid" name="transactionid" required>

             <button type="submit" id="submit-btn" name="submit">Confirm Payment </button> 


        </form>
    </div>

    
</body>
</html>