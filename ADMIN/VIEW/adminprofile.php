<?php
session_start();
if (!isset($_SESSION["username"]))
     {
         header("Location: adminLogin.php"); 
         exit();
          }

if (!empty($_SESSION["profile_pic"])) {
  
    $current_pic = "../IMAGES/uploads/" . $_SESSION["profile_pic"];
} else {

    $current_pic = "../IMAGES/dp.png";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Profile</title>
    <link rel="stylesheet" href="../CSS/adminprofile.css">
</head>
<body>

<div class="page-container">
        
        <div class="top-bar">
            <img src="../IMAGES/logo.avif" alt="Logo" class="logo">
            <h2 class="title">Edit your Profile</h2>
        </div>

        <div class="main-content">
            <form action="../CONTROL/upload_logic.php" method="POST" enctype="multipart/form-data">
            <div class="left-section">
                <div class="profile-circle">
                    <img src="<?php echo $current_pic; ?>" alt="Profile">
                </div>
                <br>
                <label for="fileToUpload" class="custom-file-upload">Choose Your DP:</label>
                <input type="file" name="fileToUpload" id="fileToUpload">
            </div>

            <div class="right-section">
                <h3 class="section-label">Profile Management</h3>
                <div class="divider"></div>
                

                    <div class="input-field">
                      Name:
         <input type="text" name="admin_name" value="<?php echo $_SESSION['username']; ?>">
                    </div>

                    <div class="input-field">
                       Email:
                        <input type="email" name="admin_email" value="<?php echo $_SESSION['email'];?>" readonly class="readonly-field">
                    </div>

                    <div class="input-field">
                        Phone number:
                        <input type="text" name="admin_phone" value="<?php echo $_SESSION['phonenumber'];?>">
                    </div>

                    <div class="input-field">
                        Blood group:
                        <input type="text" name="admin_blood" value="<?php echo $_SESSION['blood'];?>">
                    </div>

                    <div class="input-field">
                       New Password:
                        <input type="password" name="new_password"  >
                    </div>
                    
                    <div class="input-field">
                     Confirm Password:
                        <input type="password" name="confirm_password">
                    </div>

                    <div class="below-buttons">
                       <button type="submit" class="btn">Update Profile</button>
                        <button type="button" class="btn" onclick="location.href='Admindashboard.php'">Back</button>
                    </div>
                </form>
                </div>
        </div>

    </div>
<script src="../JS/password_alert.js"></script>

    <?php
    if (isset($_SESSION['update_msg'])) {
       
        echo "<script>showSuccessAlert('" . $_SESSION['update_msg'] . "');</script>";
        
     
        unset($_SESSION['update_msg']);
    }
    ?>
</body>
</html>
