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

 

    $sql = "INSERT INTO user_registration (name, email, phonenumber, password, c_password, blood) 
            VALUES ('$name', '$email', '$phone', '$hashedPass', '$c_pass', '$blood')";
    return $conn->query($sql);
}


function getuserforlogin($conn, $name, $email) {
   
    $sql = "SELECT * FROM user_registration WHERE name='$name' AND email='$email'";
    return $conn->query($sql);
}
function isEmailExists($conn, $email) {
    $sql = "SELECT * FROM user_registration WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        return true;
    }
    return false;
}


?>