<?php
session_start();
include('../MODEL/db1.php');

$connection = openConn();

// Total Rooms Count 
$roomTableData = getAllDataFromTable($connection, 'room_info_table');
$totalRoomsCount = $roomTableData->num_rows; 

//  Total Students Count 
$bookingTableData = getAllDataFromTable($connection, 'book_table');
$totalStudentsCount = $bookingTableData->num_rows; 

// Pending Complaints Count 
$complaintTableData = getAllDataFromTable($connection, 'complain_table');
$pendingComplaintsCount = 0;

while ($complaintRow = $complaintTableData->fetch_assoc()) {
    if ($complaintRow['status'] == 'Pending') { 
        $pendingComplaintsCount = $pendingComplaintsCount + 1;
    }
}

// Total Revenue 
$revenueTableData = getAllDataFromTable($connection, 'book_table'); 
$totalRevenueSum = 0;

while ($bookingRow = $revenueTableData->fetch_assoc()) {
    if ($bookingRow['status'] == 'Approved') { 
        $totalRevenueSum = $totalRevenueSum + (float)$bookingRow['amount']; 
    }
}
?>