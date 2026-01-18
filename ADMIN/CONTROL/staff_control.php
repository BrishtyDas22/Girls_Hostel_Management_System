<?php
session_start();
include('../MODEL/db1.php');
$conn = openConn();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $staff_id = $_POST['staff_id'];
    $staff_name = $_POST['staff_name'];
    $complain_id = $_POST['complain_id'];
    $error = "";
    if (isset($_POST['add']) || isset($_POST['update']))
         {
        if ($staff_name == "" || $complain_id == "") { $error = "Error: All fields are required!"; 
        }
    }
    if ($error == "") {
        if (isset($_POST['add'])) { 
            addStaff($conn, $staff_name, $complain_id); $_SESSION['success'] = "Assigned!";
             }
        elseif (isset($_POST['update'])) { 
            updateStaff($conn, $staff_id, $staff_name, $complain_id); $_SESSION['success'] = "Updated!"; 
            }
        elseif (isset($_POST['delete'])) {
             deleteStaff($conn, $staff_id); $_SESSION['success'] = "Deleted!";
              }
    } 
    else {
         $_SESSION['error'] = $error; 
         }
    header("Location: ../VIEW/assign_staff.php");
    exit();
}
?>