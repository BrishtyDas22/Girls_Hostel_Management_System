<?php
session_start();
include('../MODEL/db1.php');
$conn = openConn();

if ($_SERVER["REQUEST_METHOD"] == "POST")
     {
    $f_id = $_POST['f_id'];
    $reply = $_POST['reply'];

    if (isset($_POST['update'])) {
        if ($f_id == "") {
            $_SESSION['error'] = "Please select a feedback row first!";
        } else 
        {
            updateFeedbackReply($conn, $f_id, $reply);
        }
    } 
    elseif (isset($_POST['delete'])) 
        {
        deleteFeedback($conn, $f_id);
    }

    header("Location: ../VIEW/manage_feedback.php");
    exit();
}
?>