<?php
session_start();      
session_destroy();  


header("Location: ../VIEW/adminLogin.php"); 
exit();           
?>