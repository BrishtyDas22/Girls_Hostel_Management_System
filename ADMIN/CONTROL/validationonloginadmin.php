<?php
include '../MODEL/db1.php';
//  Prothome Cookie theke value check kora
$stored_name = isset($_COOKIE['remember_name']) ? $_COOKIE['remember_name'] : "";
$stored_email = isset($_COOKIE['remember_email']) ? $_COOKIE['remember_email'] : "";
//Initialize variables
$name="";
$email="";
$password="";
// Jodi cookie thake, tobe variable e cookie-r value set kora
if (!empty($stored_name)) {
    $name = $stored_name;
}
if (!empty($stored_email)) {
    $email = $stored_email;
}
$success_msg="";

$name_error="";
$email_error="";
$password_error="";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name=trim($_POST["name"]);
    $email=trim($_POST["email"]);
    $password=trim($_POST["password"]);

    $isValid=true;

    if(empty($name)){
        $name_error="Name is required";
        $isValid=false;
    }

    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_error="Email is required and must be a valid email address";
        $isValid=false;
    }

    if(empty($password) || strlen($password)<6){
        $password_error="Password is required and must be at least 6 characters long";
        $isValid=false;
    }

  
     if($isValid){
        $conn = openConn();
        $result = getuserforlogin1($conn, $name, $email);
if ($result->num_rows > 0) {
    
  $row = $result->fetch_assoc();
        $db_password = $row['password'];
    

    if ($password === $db_password) {
        session_start();
    

        $_SESSION["username"]    = $row['name'];
        $_SESSION["email"]       = $row['email'];
        $_SESSION["phonenumber"] = $row['phonenumber'];
        $_SESSION["blood"]       = $row['blood'];
        $_SESSION["profile_pic"] = $row['profile_pic'];
    //  cookie set korar code  
                if (isset($_POST['remember'])) {
                    // 30 diner jonno name ar email save korlam
                    setcookie("remember_name", $name, time() + (86400 * 30), "/", "", false, true);
                    setcookie("remember_email", $email, time() + (86400 * 30), "/", "", false, true);
                } else {
                    // User jodi checkbox click na kore, purono cookie thakle delete kore dao
                    setcookie("remember_name", "", time() - 3600, "/");
                    setcookie("remember_email", "", time() - 3600, "/");
                }
                // ------------------------------
           $success_msg="Login successful!";

    } else {
        $password_error="Invalid password.";
    }

}
else {
    $success_msg="No user found with the provided name and email.";
}

$conn->close();
}


}






?>