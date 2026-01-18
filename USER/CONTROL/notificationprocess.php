<?php
session_start();
include("../MODEL/db.php");
$conn = openConn();

if (isset($_GET['action']) && $_GET['action'] == 'mark_read') {
   
    $conn->query("UPDATE notice SET status = 'read' WHERE status = 'received'");

    $sql = "SELECT * FROM notice ORDER BY notification_id DESC";
    $result = $conn->query($sql);
    
    $data = ["unread" => 0, "notices" => []];
    while($row = $result->fetch_assoc()) {
        $data['notices'][] = $row;
        if($row['status'] == 'received') { $data['unread']++; }
    }
    
    
    file_put_contents('../JS/JSON/get_notification.json', json_encode($data));
    
    header("Location: ../VIEW/notification.php");
}
$conn->close();
?>