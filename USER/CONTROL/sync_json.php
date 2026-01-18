<?php
include("../MODEL/db.php");
$conn = openConn();

$sql = "SELECT * FROM notice ORDER BY notification_id DESC";
$result = $conn->query($sql);

$data = ["unread" => 0, "notices" => []];

while($row = $result->fetch_assoc()) {
    $data["notices"][] = $row;
    if($row['status'] == 'received') {
        $data["unread"]++;
    }
}


file_put_contents('../JS/JSON/get_notification.json', json_encode($data));

if(isset($_GET['ajax'])) {
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}
$conn->close();
?>