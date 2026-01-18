<?php
session_start();
include("../MODEL/db.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $conn=openConn();

    $username = $_POST['name'];
    $room_num = $_POST['room_num'];
    $phone = "01615663862";
    $trans_id = $_POST['transactionid'];
    $method = isset($_POST['payment_method']) ? $_POST['payment_method'] : "";

    $check_sql = "SELECT capacity, present_student FROM room_info_table WHERE room_num = '$room_num'";
    $check_res = $conn->query($check_sql);
    
    if ($check_res && $check_res->num_rows > 0) {
        $room_data = $check_res->fetch_assoc();
        
        if ($room_data['present_student'] >= $room_data['capacity']) {
            echo "<script>
                    alert('Transaction Failed! This room just reached full capacity.');
                    window.location.href='../VIEW/afterlogin.php';
                  </script>";
            exit();
        }
    }

    if (addPayment($conn, $username, $room_num, $phone, $method, $trans_id)) {
        
    
        $update_query = "UPDATE room_info_table SET present_student = present_student + 1 WHERE room_num = '$room_num'";
        $conn->query($update_query);

        $_SESSION['payment_msg'] = "Payment Submitted! Status: Please wait for approval.";
        header("Location: ../VIEW/afterlogin.php"); 
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
    
    $conn->close();
}
?>