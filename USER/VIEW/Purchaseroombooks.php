<!DOCTYPE html>
<html>
<head>
    <title>Booking</title>
</head>
<link rel="stylesheet" href="../CSS/purchaseroom.css">
<body>
    <div id="header">
        <img src="../images/building-vector-icon-white-background_855620-52.avif" alt="Logo" id="logo">

        
        <h1><b><i>Purchase Room</i></b></h1>


    </div>
    <br>
    <img src="../../images/back.png" alt="back logo" width="40px" height="40px" id="back_logo" onclick="location.href='frontpage.php'">

    <form action=""method="post">

    <div id="list">
    <div id="room_box">
    <img src="../images/2bed.jpg" alt="room image " class="room_image">

    <div class="room_info">
        <h3>Room Info:</h3>
        <p>Room No:101 </p>
        <p id="price">Price: 10000tk/month</p>
        <p><i>Fully furnished with cleaning services provided twice a week. Includes high-speed internet and access to the common room.</i></p>
        <label>Pay-Amount:</label>
        <input type="number" id="amount" name="amount" >
        <button type="submit" class="book_btn">Purchase Now</button>

 
       
</div>
</div>
    </form>
</body>
</html>