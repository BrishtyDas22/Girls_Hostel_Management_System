<?php
session_start();
include '../MODEL/db1.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = openConn();
    
   
    $email = trim($_SESSION["email"]); 
    $name = trim($_POST['admin_name']);
    $phone = trim($_POST['admin_phone']);
    $blood = trim($_POST['admin_blood']);
    $new_pass = $_POST['new_password'];
    $confirm_pass = $_POST['confirm_password'];

   
    $file_name = $_SESSION["profile_pic"];

   
    if (!empty($_FILES["fileToUpload"]["name"])) {
        $folder = "../IMAGES/uploads/";
if (!file_exists($folder)) { 
    mkdir($folder); 
}
        $file_name = time() . "_" . $_FILES["fileToUpload"]["name"];
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $folder . $file_name);
        $_SESSION["profile_pic"] = $file_name;
    }

    $isUpdated = false;

    if (!empty($new_pass)) {
        if ($new_pass === $confirm_pass) {
            $isUpdated = updateAdminProfile($conn, $name, $phone, $blood, $file_name, $email, $new_pass, $confirm_pass);
        } else {
        echo '<script>alert("Passwords do not match!"); window.history.back();</script>';
            exit();
        }
    } else {
        $isUpdated = updateAdminProfile($conn, $name, $phone, $blood, $file_name, $email);
    }

   
    if ($isUpdated === true) {
       
        $_SESSION["username"] = $name;
        $_SESSION["phonenumber"] = $phone;
        $_SESSION["blood"] = $blood;
        
      $_SESSION['update_msg'] = "Profile Updated Successfully!";
        session_write_close(); 
        
        header("Location: ../VIEW/adminprofile.php");
        exit();
    } else {
        echo "Update Failed! SQL Error: " . $conn->error;
    }

    $conn->close();
}
?>