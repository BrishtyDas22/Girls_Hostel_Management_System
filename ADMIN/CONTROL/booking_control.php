<?php
session_start();
include('../MODEL/db1.php');
$conn = openConn();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $b_id = $_POST['booking_id']; 
    $u_name = $_POST['username'];
    $r_num = $_POST['room_num']; 
    $t_num = $_POST['t_num'];
    $p_method = $_POST['p_method']; 
    $t_id = $_POST['t_id']; 
    $status = $_POST['status'];
    $error = "";

    // Validation for Add and Update operations
    if (isset($_POST['add']) || isset($_POST['update']))
         {
        if (empty($u_name) || empty($r_num) || empty($t_num) || empty($t_id))
             { 
            $error = "Error: All fields required!"; 
        } 
        else {
            $user = getUserId($conn, $u_name); 
            $room = getRoomData($conn, $r_num);
            
            if (!$user)
                 { 
                $error = "Error: Invalid Username!"; 
            }
             elseif (!$room) 
                { 
                $error = "Error: Invalid Room!"; 
            } elseif (isset($_POST['add'])) 
            {
                // Check if user already has an existing booking
                if (isAlreadyBooked($conn, $user['ID'])) 
                    { 
                    $error = "Error: User already has a booking!"; 
                } 
                // Check if room has reached its maximum capacity
                elseif ($room['present_student'] >= $room['capacity']) 
                    { 
                    $error = "Error: Room full!"; 
                }
            }
        }
    }

    if ($error == "") {
        // Handling Add Student Logic
        if (isset($_POST['add'])) {
            if (addBooking($conn, $user['ID'], $room['room_id'], $t_num, $p_method, $t_id, $status)) {
                // Increase room count only if initially added as 'Approved'
                if ($status == 'Approved') {
                    updateRoomCount($conn, $room['room_id'], 'increase');
                }
            }
        } 
        // Handling Update Student Logic
        elseif (isset($_POST['update']))
             {
            // Fetch old status and room_id before updating
            $sql = "SELECT status, room_id FROM book_table WHERE booking_id = '$b_id'";
            $res = $conn->query($sql);
            $old_data = $res->fetch_assoc();

            if (updateBooking($conn, $b_id, $t_num, $p_method, $t_id, $status)) 
                {
                // Logic: If status changed from Pending to Approved -> Increase count
                if ($old_data['status'] == 'Pending' && $status == 'Approved') 
                    {
                    updateRoomCount($conn, $old_data['room_id'], 'increase');
                }
                // Logic: If status changed from Approved to Pending -> Decrease count
                elseif ($old_data['status'] == 'Approved' && $status == 'Pending') 
                    {
                    updateRoomCount($conn, $old_data['room_id'], 'decrease');
                }
            }
        } 
        // Handling Delete Student Logic
        elseif (isset($_POST['delete'])) 
            {
            // Fetch status before deletion
            $sql = "SELECT status, room_id FROM book_table WHERE booking_id = '$b_id'";
            $res = $conn->query($sql);
            $booking = $res->fetch_assoc();

            if (deleteBooking($conn, $b_id))
                 {
                // Decrease room count only if the deleted booking was 'Approved'
                if ($booking['status'] == 'Approved') 
                    {
                    updateRoomCount($conn, $booking['room_id'], 'decrease');
                }
            }
        }
    } 
    else 
        { 
        $_SESSION['error'] = $error; 
    }

    header("Location: ../VIEW/room_bookings.php"); 
    exit();
}
?>