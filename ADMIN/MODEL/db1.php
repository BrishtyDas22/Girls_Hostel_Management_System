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
?>