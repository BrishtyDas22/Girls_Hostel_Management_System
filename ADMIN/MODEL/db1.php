<?php
function openConn() {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "wt_project";
     $port = 3307;
    $conn = new mysqli($host, $user, $pass, $dbname, $port);
    if ($conn->connect_error) { die("Connection Fail: ". $conn->connect_error); }
    return $conn;
}


// Login-er jonno function
function getuserforlogin1($conn, $name, $email) {
   
    $sql = "SELECT * FROM admin_regi WHERE name='$name' AND email='$email'";
    return $conn->query($sql);
}
// Admin profile update-er jonno function
function updateAdminProfile($conn, $name, $phone, $blood, $file_name, $email, $password = null, $c_password = null) {
    
    $email = trim($email);
    $name = trim($name);
    
    if ($password !== null && $password !== "") {
      
        $sql = "UPDATE admin_regi SET name='$name', phonenumber='$phone', blood='$blood', profile_pic='$file_name', password='$password', c_password='$c_password' WHERE TRIM(email)='$email'";
    } else {
      
        $sql = "UPDATE admin_regi SET name='$name', phonenumber='$phone', blood='$blood', profile_pic='$file_name' WHERE TRIM(email)='$email'";
    }
    
    return $conn->query($sql);
}


//  Database theke sob room anar function
function getAllRooms($conn) {
    // Database image onujayi query
    $sql = "SELECT * FROM room_info_table"; 
    return $conn->query($sql);
}

//  Notun room add korar function
function addRoom($conn, $room_num, $price, $type, $capacity, $student) {
    $sql = "INSERT INTO room_info_table (room_num, price, `ac/non-ac`, capacity, present_student) 
            VALUES ('$room_num', '$price', '$type', '$capacity', '$student')";
    return $conn->query($sql);
}

//  Room update korar function
function updateRoom($conn, $room_num, $price, $type, $capacity, $student) {
    $sql = "UPDATE room_info_table SET price='$price', `ac/non-ac`='$type', capacity='$capacity', present_student='$student' 
            WHERE room_num='$room_num'";
    return $conn->query($sql);
}

//  Room delete korar function
function deleteRoom($conn, $room_num) {
    $sql = "DELETE FROM room_info_table WHERE room_num='$room_num'";
    return $conn->query($sql);
}

//manage students functions

function getAllStudents($conn) {
    return $conn->query("SELECT * FROM user_registration");
}

function addStudent($conn, $name, $email, $phone, $pass, $blood) {
    $sql = "INSERT INTO user_registration (name, email, phonenumber, password, c_password, blood) 
            VALUES ('$name', '$email', '$phone', '$pass', '$pass', '$blood')";
    return $conn->query($sql);
}

function updateStudent($conn, $name, $email, $phone, $pass, $c_pass, $blood) {
 
    $sql = "UPDATE user_registration SET name='$name', phonenumber='$phone', password='$pass', c_password='$c_pass', blood='$blood' WHERE email='$email'";
    return $conn->query($sql);
}

function deleteStudent($conn, $email) {
    return $conn->query("DELETE FROM user_registration WHERE email='$email'");
}




/////////////////////////////////////////////////////////////////////////////////////////////


function getUserId($conn, $u_name) {
    $sql = "SELECT ID FROM user_registration WHERE name = '$u_name'";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

function getRoomData($conn, $r_num) {
    $sql = "SELECT room_id, capacity, present_student FROM room_info_table WHERE room_num = '$r_num'";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

// ID theke Name ber kora
function getNameFromId($conn, $id) {
    $sql = "SELECT name FROM user_registration WHERE ID = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row ? $row['name'] : "";
}

// Room ID theke Room Number
function getRoomNumFromId($conn, $r_id) {
    $sql = "SELECT room_num FROM room_info_table WHERE room_id = '$r_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row ? $row['room_num'] : "";
}

// Duplicate User Validation
function isAlreadyBooked($conn, $u_id) {
    $sql = "SELECT * FROM book_table WHERE ID = '$u_id'";
    $result = $conn->query($sql);
    return ($result->num_rows > 0);
}

function updateRoomCount($conn, $r_id, $type) {
    $sql = ($type == 'increase') ? 
        "UPDATE room_info_table SET present_student = present_student + 1 WHERE room_id = '$r_id'" : 
        "UPDATE room_info_table SET present_student = present_student - 1 WHERE room_id = '$r_id'";
    return $conn->query($sql);
}

function getAllBookings($conn) {
    return $conn->query("SELECT * FROM book_table");
}

function addBooking($conn, $u_id, $r_id, $t_num, $p_method, $t_id, $status) {
    $sql = "INSERT INTO book_table (ID, room_id, transaction_number, payment_method, transaction_id, status) 
            VALUES ('$u_id', '$r_id', '$t_num', '$p_method', '$t_id', '$status')";
    return $conn->query($sql);
}

function updateBooking($conn, $b_id, $t_num, $p_method, $t_id, $status) {
    $sql = "UPDATE book_table SET transaction_number='$t_num', payment_method='$p_method', 
            transaction_id='$t_id', status='$status' WHERE booking_id='$b_id'";
    return $conn->query($sql);
}

function deleteBooking($conn, $b_id) {
    $sql = "DELETE FROM book_table WHERE booking_id = '$b_id'";
    return $conn->query($sql);
}

function getRoomIdFromBooking($conn, $b_id) {
    $sql = "SELECT room_id FROM book_table WHERE booking_id = '$b_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['room_id'];
}





//////////////////////////////////////////////////////////////////////////


// --- Feedback Management Functions ---

function getAllFeedback($conn) {
    return $conn->query("SELECT * FROM feedback_table");
}

function updateFeedbackReply($conn, $f_id, $reply) {
    $sql = "UPDATE feedback_table SET reply='$reply' WHERE feedback_id='$f_id'";
    return $conn->query($sql);
}

function deleteFeedback($conn, $f_id) {
    $sql = "DELETE FROM feedback_table WHERE feedback_id='$f_id'";
    return $conn->query($sql);
}

/////////////////////////////////////////////////////////////
function getAllComplains($conn) {
    return mysqli_query($conn, "SELECT * FROM complain_table");
}

function updateComplain($conn, $id, $status) {
    $sql = "UPDATE complain_table SET status = '$status' WHERE complain_id = '$id'";
    return mysqli_query($conn, $sql);
}

function deleteComplain($conn, $id) {
    $sql = "DELETE FROM complain_table WHERE complain_id = '$id'";
    return mysqli_query($conn, $sql);
}
?>