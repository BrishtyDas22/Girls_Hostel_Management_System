<?php
session_start();
include("../MODEL/db.php");

if (!isset($_SESSION["username"])) {
    header("Location: ../VIEW/Login.php");
    exit();
}

$conn = openConn();
$username = $_SESSION['username'];

if (isset($_POST['submit_feedback'])) {
    $category = mysqli_real_escape_string($conn, $_POST['feedback_category']); 
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);          
    $sql_find_room = "SELECT room_number FROM payment WHERE username = '$username' LIMIT 1";
    $res_room = $conn->query($sql_find_room);
    
    if($res_room && $res_room->num_rows > 0) {
        $row_room = $res_room->fetch_assoc();
        $room_number = $row_room['room_number'];
    } else {
        $room_number = 'N/A';
    }

    
    $sql_insert = "INSERT INTO feedback_table (username, room_number, feedback, comment) 
                   VALUES ('$username', '$room_number', '$category', '$comment')";

    if ($conn->query($sql_insert)) {
        header("Location: ../VIEW/feedback.php?msg=submitted");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

if (isset($_GET['delete_id'])) {
    $fid = $_GET['delete_id'];
    

    $sql_delete = "DELETE FROM feedback_table WHERE feedback_id = '$fid' AND username = '$username'";
    
    if ($conn->query($sql_delete)) {
        header("Location: ../VIEW/feedback.php?msg=deleted");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
if (isset($_POST['update_feedback'])) {
    $fid = $_POST['feedback_id'];
    $category = mysqli_real_escape_string($conn, $_POST['feedback_category']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);

 
    $sql_update = "UPDATE feedback_table 
                   SET feedback = '$category', comment = '$comment' 
                   WHERE feedback_id = '$fid' AND username = '$username'";

    if ($conn->query($sql_update)) {
        header("Location: ../VIEW/feedback.php?msg=updated");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
    }

$conn->close();
?>