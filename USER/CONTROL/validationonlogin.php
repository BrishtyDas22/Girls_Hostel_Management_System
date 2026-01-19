<?php
include '../MODEL/db.php';
$name="";
$email="";
$password="";

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
        $name_error="Name is required 🙂";
        $isValid=false;
    }

    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_error="Email is required and must be a valid email address 🙂";
        $isValid=false;
    }

    if(empty($password) || strlen($password)<6){
        $password_error="Password is required and must be at least 6 characters long 😪";
        $isValid=false;
    }

    if($isValid){
        $conn = openConn();
        $result = getuserforlogin($conn, $name, $email);
if ($result->num_rows > 0) {
    $db_password = "";
    foreach ($result as $row) {
        $db_password = $row['password'];
    }

    if (password_verify($password, $db_password)) {
        session_start();
    
 foreach ($result as $row) {
        $_SESSION["user_id"]      = $row['ID'];
        $_SESSION["username"]    = $row['name'];
        $_SESSION["email"]       = $row['email'];
        $_SESSION["phonenumber"] = $row['phonenumber'];
        $_SESSION["blood"]       = $row['blood'];
        if (!empty($row['profile_pic'])) {
            
            $_SESSION["profile_pic"] = $row['profile_pic'];
        } else {
        
            $_SESSION["profile_pic"] = "../images/user.png";
        }
    }
           $success_msg="Login successful!";
           header("location: ../VIEW/afterlogin.php");
           exit();

    } else {
        $password_error="Invalid password 😞.";
    }

}
else {
    $success_msg="No user found with the provided name and email.😵‍💫";
}

$conn->close();
}


}
?>