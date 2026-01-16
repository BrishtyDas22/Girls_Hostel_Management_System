<?php
session_start();
include("../MODEL/db.php");
$conn = openConn();

if (isset($_GET['delete_id'])) {
    $id = (int)$_GET['delete_id'];
    $userId = $_SESSION['user_id'];
    
    $sql = "DELETE FROM complaint_table WHERE complaint_id = $id AND ID = $userId";
    if ($conn->query($sql)) {
        $_SESSION['complaint_ok'] = "Complaint #$id deleted.";
    }
    header("Location: ../VIEW/complaint.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $conn->real_escape_string($_POST['category']);
    $description = $conn->real_escape_string($_POST['description']);
    
    if (isset($_POST['update_complaint'])) {
       
        $cid = (int)$_POST['complaint_id'];
        $sql = "UPDATE complaint_table SET category='$category', Complaintdescription='$description' WHERE complaint_id = $cid";
        $msg = "Complaint #$cid updated successfully!";
    } else {
        
        $userId = $_SESSION["user_id"];
        $name = $_SESSION["username"];
        $sql = "INSERT INTO complaint_table (ID, name, Complaintdescription, category, status) 
                VALUES ($userId, '$name', '$description', '$category', 'pending')";
        $msg = "Complaint submitted successfully!";
    }

    if ($conn->query($sql)) {
        $_SESSION['complaint_ok'] = $msg;
    }
    header("Location: ../VIEW/complaint.php");
    exit();
}
?>