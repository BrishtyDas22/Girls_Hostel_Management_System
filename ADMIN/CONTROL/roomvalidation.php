<?php

function validateRoomData($conn, $room_no, $capacity, $p_student, $action) {
    
    //Room no faka naki check kora
    if ($room_no == "") {
        return "Error: Room Number Must be Filled!";
    }

    // Add korar somoy check kora roomno database e agei ase naki seta dekha 
    if ($action == "add") {
        $check = "SELECT room_num FROM room_info_table WHERE room_num = '$room_no'";
        $result = $conn->query($check);
        if ($result->num_rows > 0) {
            return "Error: This Room Number is Already in Database!";
        }
    }

    // Student capacity er beshi naki check kora
    if ($p_student > $capacity) {
        return "Error: Already fill up!";
    }

    return ""; // No errors
}
?>