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
?>