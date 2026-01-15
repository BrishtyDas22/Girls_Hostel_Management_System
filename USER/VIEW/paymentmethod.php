<?php
session_start();
if(!isset($_SESSION["user_id"])){
    header("Location: ../VIEW/Login.php");
    exit();
}

$selected_room = isset($_GET['room']) ? $_GET['room'] : "";
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