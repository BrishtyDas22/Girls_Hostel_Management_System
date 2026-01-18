<?php
session_start();
include('../MODEL/db1.php');
$conn = openConn();
// Jodi JavaScript theke kono 'action' namer POST request ashe
if (isset($_POST['action'])) {
   // Jodi action er man 'fetch' hoy, mane notification data chaiche
    if ($_POST['action'] == 'fetch') {
        // Model file theke shob notification (read + unread) niye asha hocche
        $result = getUnreadNotis($conn); 
        $data = [];
        // Database er result gulu ke ekta array te dhukano hocche
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        // Browser ke bola hocche je amra JSON format e data pathacchi
        header('Content-Type: application/json');
        // Array ta ke JSON string e convert kore print kora hocche (AJAX rcv korbe)
        echo json_encode($data);
    }
//Jodi action er man 'mark_read' hoy, mane user bell icon e click korse
    if ($_POST['action'] == 'mark_read') {
        // // Database e 'is_read' status 0 theke 1 korar function call kora hoise
        if (updateNotiStatus($conn)) {
            // Success hole JSON response pathano hocche
            echo json_encode(["status" => "success"]);
        }
    }
    // Response deya shesh hole script ekhanei bondho kore deya hoise
    exit();
}
?>