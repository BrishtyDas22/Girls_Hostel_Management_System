<?php
session_start();
include("../MODEL/db.php");

if (isset($_GET['action']) && $_GET['action'] == 'mark_read') {
    $conn = openConn();
    
    
    $sql = "UPDATE notice SET status = 'read' WHERE status = 'received'";
    
    if ($conn->query($sql)) {
        
        header("Location: ../VIEW/notification.php");
        exit();
    } else {
        echo "Error updating status: " . $conn->error;
    }
    $conn->close();
}
?>