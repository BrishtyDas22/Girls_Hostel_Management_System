<?php
session_start();

include("../MODEL/db.php");

if(!isset($_SESSION['user_id'])){

	header("Location: ../VIEW/login.php");
    exit();

}

if($_SERVER['REQUEST_METHOD']=="POST"){

$conn=openConn();
$id = (int)$_SESSION["user_id"]; 
    
    $name  = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phonenumber"]);
    $blood = trim($_POST["blood"]); 
    $newPass = trim($_POST['password'] ?? "");

    $hashedPass = ($newPass !== '') ? password_hash($newPass, PASSWORD_DEFAULT) : null;

   
    if (isEmailtakenbysomeoneelse($conn, $email, $id)) {
        $_SESSION['update_err'] = 'That email is already used by another account.';
    } else {
      
        if (updateUser($conn, $id, $name, $email, $phone, $blood, $hashedPass)) {
    $_SESSION['username'] = $name; 
    $_SESSION['email'] = $email;
    $_SESSION['phonenumber'] = $phone;
    $_SESSION['blood'] = $blood;
    
    $_SESSION['update_ok'] = 'Profile updated successfully!';
    
    header("Location: ../VIEW/editprofile.php"); 
    exit();
        } else {
    $_SESSION['update_err'] = 'Database Error: ' . $conn->error;
    header("Location: ../VIEW/editprofile.php");
    exit();
    }
    $conn->close();
}
}
header("Location: ../VIEW/editprofile.php");
exit();

?>
