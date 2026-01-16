<?php
session_start();
include('../MODEL/db1.php');
$conn = openConn();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $blood = $_POST['blood'];
    $pass = $_POST['password'];
    $c_pass = $_POST['c_password'];

    $error = "";

    if (isset($_POST['add']) || isset($_POST['update'])) {
        if ($name=="" || $email=="" || $phone=="" || $blood=="" || $pass=="" || $c_pass=="") {
            $error = "Error: All fields are required!";
        } 
        elseif (strlen($pass) < 6) {
            $error = "Error: Password must be 6 characters!";
        } 
        elseif ($pass !== $c_pass) {
            $error = "Error: Passwords do not match!";
        }
    }

    if ($error == "") {
        if (isset($_POST['add'])) {
            addStudent($conn, $name, $email, $phone, $pass, $blood);
        } elseif (isset($_POST['update'])) {
            updateStudent($conn, $name, $email, $phone, $pass, $c_pass, $blood);
        } elseif (isset($_POST['delete'])) {
            deleteStudent($conn, $email);
        }
    } else {
        $_SESSION['error'] = $error ;
    }

    header("Location: ../VIEW/manage_students.php");
    exit();
}
?>