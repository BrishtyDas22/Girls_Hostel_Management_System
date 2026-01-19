<?php
include("../MODEL/db.php");

$error_msg = "";
$success_msg = "";

if (isset($_POST['reset_btn'])) {
    $conn = openConn();

    $username = mysqli_real_escape_string($conn, $_POST['name']);
    $new_pass = $_POST['new_password'];
    $confirm_pass = $_POST['confirm_password'];

    if (empty($username) || empty($new_pass) || empty($confirm_pass)) {
        $error_msg = "All fields are mandatory!";
    } 
    elseif ($new_pass !== $confirm_pass) {
        $error_msg = "Passwords do not match!";
    } 
    elseif (strlen($new_pass) < 5) {
        $error_msg = "Password must be at least 5 characters long.";
    }
    else {
        
        $user_check = "SELECT * FROM user_registration WHERE name = '$username'";
        $result = $conn->query($user_check);

        if ($result && $result->num_rows > 0) {
            
           
            $hashed_password = password_hash($new_pass, PASSWORD_DEFAULT);
            
            $update_sql = "UPDATE user_registration SET password = '$hashed_password', c_password = '$hashed_password' WHERE name = '$username'";
            
            if ($conn->query($update_sql)) {
                $success_msg = "Password updated successfully! Login now😊";
            } else {
                $error_msg = "Database Error: " . $conn->error;
            }
        } else {
            $error_msg = "User '$username' does not exist.";
        }
    }
    $conn->close();
}
?>