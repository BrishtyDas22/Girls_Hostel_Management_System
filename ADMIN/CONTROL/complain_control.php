<?php
session_start();
include('../MODEL/db1.php');
$conn = openConn();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['input_id'];
    $status = isset($_POST['status_option']) ? $_POST['status_option'] : "";

    if (isset($_POST['update_btn'])) {
        if (empty($id)) {
            $_SESSION['error'] = "Error: Please select a row first!";
        } elseif (empty($status)) {
            $_SESSION['error'] = " Error: Please select a status!";
        } else {
            updateComplain($conn, $id, $status);
        }
    } 
    elseif (isset($_POST['delete_btn'])) {
        if (empty($id)) {
            $_SESSION['error'] = " Error: No row selected to delete!";
        } else {
            deleteComplain($conn, $id);
        }
    }

    header("Location: ../VIEW/manage_complain.php");
    exit();
}
?>