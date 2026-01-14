<?php
function openConn() {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "wt_project";
    $conn = new mysqli($host, $user, $pass, $dbname);
    if ($conn->connect_error) { die("Connection Fail: ". $conn->connect_error); }
    return $conn;
}

function addUser($conn, $name, $email, $phone, $hashedPass, $c_pass, $blood) {

    $name = $conn->real_escape_string($name);
    $email = $conn->real_escape_string($email);
    $phone = $conn->real_escape_string($phone);

    $sql = "INSERT INTO user_registration (name, email, phonenumber, password, c_password, blood) 
            VALUES ('$name', '$email', '$phone', '$hashedPass', '$c_pass', '$blood')";
    return $conn->query($sql);
}


function getuserforlogin($conn, $name, $email) {
    $name = $conn->real_escape_string($name);
    $email = $conn->real_escape_string($email);
   
    $sql = "SELECT * FROM user_registration WHERE name='$name' AND email='$email'";
    return $conn->query($sql);
}
function isEmailExists($conn, $email) {
    $email = $conn->real_escape_string($email);
    $sql = "SELECT * FROM user_registration WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        return true;
    }
    return false;
}

function isEmailtakenbysomeoneelse($conn, $email, $myId){

$email= $conn->real_escape_string($email);
$myId=(int)$myId;

$sql="SELECT * FROM user_registration WHERE email='$email' AND ID!=$myId";
$res=$conn->query($sql);
return ($res && $res->num_rows > 0);



}

function updateUser($conn, $id, $name, $email, $phone, $blood, $hashedPass = null, $profile_pic = null) {
    $name = $conn->real_escape_string($name);
    $email = $conn->real_escape_string($email);
    $phone = $conn->real_escape_string($phone);
    $blood = $conn->real_escape_string($blood);
    $profile_pic = $conn->real_escape_string($profile_pic);
    $id = (int)$id;

    if($hashedPass === null) {
        $sql = "UPDATE user_registration SET name='$name', email='$email', phonenumber='$phone', blood='$blood', profile_pic='$profile_pic' WHERE ID=$id";
    }
    else {
        $sql = "UPDATE user_registration SET name='$name', email='$email', phonenumber='$phone', password = '$hashedPass', blood='$blood', profile_pic='$profile_pic' WHERE ID=$id";
    }

    return $conn->query($sql);
}

function getRoomDetails($conn) {
    $sql = "SELECT * FROM room_info_table";
    return $conn->query($sql);
}





?>