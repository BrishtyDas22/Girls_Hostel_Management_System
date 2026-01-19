<?php
session_start();
include('../MODEL/db1.php');
$conn = openConn();

// Jodi JavaScript theke kono 'action' namer POST request ashe
if (isset($_POST['action'])) {
    
    // Jodi action er man 'fetch' hoy, mane user notification gulo dekhte chay
    if ($_POST['action'] == 'fetch') {
        // Model file theke shob notification niye asha hocche
        $result = getUnreadNotis($conn); 
        $data = [];
        
        // Database er data gulu ke ekta array te dhukano hocche
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        
        // Browser ke bola hocche je amra JSON format e data pathacchi
        header('Content-Type: application/json');
        // Array ta ke JSON banay print kora hocche jate JS ota dorte pare
        echo json_encode($data);
    }

    // Jodi user notification bell e click kore (mark_read)
    if ($_POST['action'] == 'mark_read') {
        // Database e 'is_read' status update korar function call kora hoise
        if (updateNotiStatus($conn)) {
            // Success hoile ekta JSON response pathano hocche
            header('Content-Type: application/json');
            echo json_encode(["status" => "success"]);
        }
    }
    // Shob kaj shesh hole script bondho kora hoise
    exit();
}
?>