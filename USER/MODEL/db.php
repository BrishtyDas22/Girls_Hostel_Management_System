<?php
function openConn() {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "wt_project";
    $conn = new mysqli($host, $user, $pass, $dbname);
    if ($conn->connect_error) { die("Connection Fail: ". $conn->connect_error); }
    return $conn;
}

function addUser($conn, $name, $email, $phone, $hashedPass, $c_pass, $blood) {

    $name = $conn->real_escape_string($name);
    $email = $conn->real_escape_string($email);
    $phone = $conn->real_escape_string($phone);

    $sql = "INSERT INTO user_registration (name, email, phonenumber, password, c_password, blood) 
            VALUES ('$name', '$email', '$phone', '$hashedPass', '$c_pass', '$blood')";
    return $conn->query($sql);
}


function getuserforlogin($conn, $name, $email) {
    $name = $conn->real_escape_string($name);
    $email = $conn->real_escape_string($email);
   
    $sql = "SELECT * FROM user_registration WHERE name='$name' AND email='$email'";
    return $conn->query($sql);
}
function isEmailExists($conn, $email) {
    $email = $conn->real_escape_string($email);
    $sql = "SELECT * FROM user_registration WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        return true;
    }
    return false;
}

function isEmailtakenbysomeoneelse($conn, $email, $myId){

$email= $conn->real_escape_string($email);
$myId=(int)$myId;

$sql="SELECT * FROM user_registration WHERE email='$email' AND ID!=$myId";
$res=$conn->query($sql);
return ($res && $res->num_rows > 0);



}

function updateUser($conn, $id, $name, $email, $phone, $blood, $hashedPass = null, $profile_pic = null) {
    $name = $conn->real_escape_string($name);
    $email = $conn->real_escape_string($email);
    $phone = $conn->real_escape_string($phone);
    $blood = $conn->real_escape_string($blood);
    $profile_pic = $conn->real_escape_string($profile_pic);
    $id = (int)$id;

    if($hashedPass === null) {
        $sql = "UPDATE user_registration SET name='$name', email='$email', phonenumber='$phone', blood='$blood', profile_pic='$profile_pic' WHERE ID=$id";
    }
    else {
        $sql = "UPDATE user_registration SET name='$name', email='$email', phonenumber='$phone', password = '$hashedPass', blood='$blood', profile_pic='$profile_pic' WHERE ID=$id";
    }

    return $conn->query($sql);
}

function getRoomDetails($conn) {
    $sql = "SELECT * FROM room_info_table";
    return $conn->query($sql);
}

function addPayment($conn, $username, $room_number, $phone, $payment_method, $trans_id){
    $username = $conn->real_escape_string($username);
    $room_number = $conn->real_escape_string($room_number);
    $phone = $conn->real_escape_string($phone);
    $method = $conn->real_escape_string($payment_method);
    $trans_id = $conn->real_escape_string($trans_id);

    $sql="INSERT INTO payment (username, room_number, transition_number, payment_method, transition_id, status) 
            VALUES ('$username', '$room_number', '$phone', '$method', '$trans_id', 'pending')";
            
    return $conn->query($sql);

}

function addComplaint($conn, $userId, $name, $description, $category) {
    $userId = (int)$userId;
    $name = $conn->real_escape_string($name);
    $description = $conn->real_escape_string($description);
    $category = $conn->real_escape_string($category);
    
    $sql = "INSERT INTO complaint_table (ID, name, Complaintdescription, category, status) 
            VALUES ($userId, '$name', '$description', '$category', 'pending')";
    return $conn->query($sql);
}

function getUserComplaints($conn, $userId) {
    $userId = (int)$userId;
    $sql = "SELECT * FROM complaint_table WHERE ID = $userId ORDER BY complaint_id DESC";
    return $conn->query($sql);
}


function deleteComplaint($conn, $complaint_id, $user_id) {
    $complaint_id = (int)$complaint_id;
    $user_id = (int)$user_id;
  
    $sql = "DELETE FROM complaint_table WHERE complaint_id = $complaint_id AND ID = $user_id";
    return $conn->query($sql);
}


function updateComplaint($conn, $complaint_id, $category, $description) {
    $complaint_id = (int)$complaint_id;
    $category = $conn->real_escape_string($category);
    $description = $conn->real_escape_string($description);
    
    $sql = "UPDATE complaint_table SET category='$category', Complaintdescription='$description' WHERE complaint_id = $complaint_id";
    return $conn->query($sql);
}
function refreshNotificationJson($conn) {
    $sql = "SELECT * FROM notice ORDER BY notification_id DESC";
    $result = $conn->query($sql);
    $data = ["unread" => 0, "notices" => []];
    
    while($row = $result->fetch_assoc()) {
        $data['notices'][] = $row;
        if($row['status'] == 'received') { $data['unread']++; }
    }
   
    file_put_contents(__DIR__ . '/../JS/JSON/get_notification.json', json_encode($data));
}




?>