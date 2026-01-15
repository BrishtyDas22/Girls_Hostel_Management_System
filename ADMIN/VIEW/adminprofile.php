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
            <div class="left-section">
                <div class="profile-circle">
                    <img src="../IMAGES/dp.png" alt="Profile">
                </div>
                <button type="button" class="side-btn">Choose Image</button>
                <button type="button" class="side-btn">Update Profile</button>
            </div>

            <div class="right-section">
                <h3 class="section-label">Profile Management</h3>
                <div class="divider"></div>
                
<form action="" method="POST">
                    <div class="input-field">
                      Name:
                        <input type="text" name="admin_name">
                    </div>

                    <div class="input-field">
                       Email:
                        <input type="email" name="admin_email">
                    </div>

                    <div class="input-field">
                        Phone number:
                        <input type="text" name="admin_phone">
                    </div>

                    <div class="input-field">
                        Blood group:
                        <input type="text" name="admin_blood">
                    </div>

                    <div class="input-field">
                       New Password:
                        <input type="password" name="new_password">
                    </div>
                    
                    <div class="input-field">
                     Confirm Password:
                        <input type="password" name="confirm_password">
                    </div>

                    <div class="below-buttons">
                        <button type="submit" class="btn">Update</button>
                        <button type="button" class="btn">Logout</button>
                    </div>
                </form>
                </div>
        </div>

    </div>

</body>
</html>