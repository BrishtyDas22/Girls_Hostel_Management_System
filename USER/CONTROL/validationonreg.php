<?php

include '../MODEL/db.php';

$name = "";
$email = "";
$phonenumber = "";
$password = "";
$c_password = "";
$blood = "";


$name_error = "";
$email_error = "";
$phonenumber_error = "";
$password_error = "";
$c_password_error = "";
$blood_error = "";

$success_msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {



    if(empty($_POST["name"])){
        $name_error="Name is required";
       
       
    }
    else{
        $name= trim($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $name_error = "Only letters and spaces allowed in here!!";
        }

    }
    if(empty($_POST["email"])){
        $email_error="Email is required";
        
       
    }
    else{
        $email= trim($_POST["email"]);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = "Invalid email format";
        }

    }
     if (empty($email_error)) {
        $conn = openConn();
        if (isEmailExists($conn, $email)) {
            $email_error = "Email already exists! Please try another one.";
        }
        $conn->close();
    }


    if(empty($_POST["phonenumber"])){
        $phonenumber_error="Phone number is required";
        
       
    }
    else{
        $phonenumber= trim($_POST["phonenumber"]);
        if(!preg_match("/^[0-9]{11}$/", $_POST["phonenumber"])){
            $phonenumber_error="Invalid phone number format";

        }

    }
    if(empty($_POST["password"])){
        $password_error="Password is required";
        
       
    }
    else{
        if(strlen($_POST["password"]) < 6){
            $password_error="Password must be at least 6 characters long";
           
       
        }
        $password= trim($_POST["password"]);

    }
    if(empty($_POST["c_password"])){
        $c_password_error="Confirm your password";
     
       
    }
    else{
        $c_password= trim($_POST["c_password"]);

    }
    if($password !== $c_password){
        $password_error="Passwords do not match";
        $c_password_error="Passwords do not match";
       
    }
    if(empty($_POST["blood"]) || $_POST["blood"] == "Select group"){
        $blood_error="Please select your blood group";
        
           }
    else{
        $blood= trim($_POST["blood"]);

    }

    if(empty($name_error) && empty($email_error) && empty($phonenumber_error) && empty($password_error) && empty($blood_error)){
           $conn = openConn();
        

       $hashed_password = password_hash($password, PASSWORD_DEFAULT);
          $result = addUser($conn, $name, $email, $phonenumber, $hashed_password, $hashed_password, $blood);
    if ($result === TRUE) {
        $success_msg="Registration successful!";
     $name = "";
        $email = "";
        $phonenumber = "";
        $password = "";
        $c_password = "";
        $blood = "";  
        
        header("Location: ../VIEW/Login.php");
        exit();

      
    } else {
        $success_msg = "Error: " . $conn->error;
    }
       
        
    


 $conn->close();
}


}

?>
