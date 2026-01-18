<?php
session_start();
include('../MODEL/db1.php');
$conn = openConn();

if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
    $id = $_POST['notice_id'];
    $username = $_POST['username'];
    $description = $_POST['description'];
    $error = "";

    if (isset($_POST['add']) || isset($_POST['update'])) 
        {
        if ($username == "" || $description == "")
             {
                 $error = "Error: All fields are required!";
                  }
    }

    if ($error == "") {
        if (isset($_POST['add'])) { 
            addNotice($conn, $username, $description); 
            }
        elseif (isset($_POST['update'])) {
             updateNotice($conn, $id, $username, $description); 
             }
        elseif (isset($_POST['delete'])) { 
            deleteNotice($conn, $id);
             }
    } else {
         $_SESSION['error'] = $error;
          }

    header("Location: ../VIEW/managenotice.php");
    exit();
}
?>