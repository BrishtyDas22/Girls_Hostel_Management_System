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
?>