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
        if (empty($name) || empty($email)) {
            $_SESSION['update_err'] = 'Name and Email cannot be empty.';
            header("Location: ../VIEW/editprofile.php");
            exit();
        }


        
       $profile_pic_path = $_SESSION['profile_pic'] ?? '../images/user.png';
       if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
            $target_dir = "../images/uploads/";
            
            if (!file_exists($target_dir)) { mkdir($target_dir, 0777, true); }

            $file_extension = pathinfo($_FILES["profile_image"]["name"], PATHINFO_EXTENSION);
            $new_filename = "user_" . $id . "_" . time() . "." . $file_extension; 
            $target_file = $target_dir . $new_filename;

            if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
                $profile_pic_path = $target_file;
            }
        }
      
        if (updateUser($conn, $id, $name, $email, $phone, $blood, $hashedPass, $profile_pic_path)) {
    $_SESSION['username'] = $name; 
    $_SESSION['email'] = $email;
    $_SESSION['phonenumber'] = $phone;
    $_SESSION['blood'] = $blood;
    $_SESSION['profile_pic'] = $profile_pic_path;
    
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
