<?php
seesion_start();

include("../MODEL/db.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){

$conn=openConn();

    $username = $_POST['name'];
    $room_num = $_POST['room_num'];
    $phone    = $_POST['phonenumber'];
    $trans_id = $_POST['transactionid'];

    $method = isset($_POST['payment_method']) ? $_POST['payment_method'] : "";

    if (addPayment($conn, $username, $room_num, $phone, $method, $trans_id)) {
        $_SESSION['payment_msg'] = "Payment Submitted! Status: Pending.";
        header("Location: ../VIEW/afterlogin.php"); 
    } else {
        echo "Error: " . $conn->error;
    }
    
    $conn->close();
}



}


?>