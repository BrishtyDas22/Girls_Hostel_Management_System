<?php

session_start();
if(!isset($_SESSION["user_id"])){
    header("Location: ../VIEW/Login.php");
    exit();
}
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
        <form method="post" id="paymentform">
            <label>Payment Form</label>
            <hr>
            <label>Username:</label><br/>
             <input type="text" id="name" name="name" value="<?php echo $_SESSION["username"]; ?>">
             <hr>
             <label for="roomnum">Room Number:</label>
             <input type="text" id="room_num">
              <hr>
             <label for="payment">Payment Method:</label>
             <input type="radio" id="bkash" name="bkash" value="bkash">Bkash
             <input type="radio" id="Naagad" name="nagad" value="nagad">Nagad

             <hr>
             <label for="phonenum">Transition Number:</label>
             <input type="text" id="phone_num" name="phonenumber">
               <hr>
             <label for="transaction_id">Transaction ID:</label>
             <input type="text" id="transid" name="transactionid">

             <button type="submit" id="submit-btn" name="submit">Confirm Payment </button> 


        </form>
    </div>

    
</body>
</html>