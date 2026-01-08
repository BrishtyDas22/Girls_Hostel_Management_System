<!DOCTYPE html>
<html>
<head>
    <title>Happy Life</title>
    <link rel="stylesheet" href="../CSS/frontpagedesign1.css">
</head>

<body>
    <div id="header_div">

    <img src="../images/machine.png" alt="logo" id="header_logo">
       
    <h1>Welcome to Happy-Life</h1>
    </div>
    <div id="header_image_div">
    <img src="../images/hostel-g.jpg" alt="header image" id="header_image">
    <h1 id="header_image_h1">Find your HOME!</h1>
    <p>Comfortable, Secure, and Affordable Student Accommodation</p>
    </div>



    <button type="submit" id="register" onclick="location.href='registration1.php'">Register Now</button>
    <button type="submit" id="login" onclick="location.href='Login.php'">Login</button>
    <button type="submit" id="Alogin" onclick="adminpress()">Admin Login</button>

    <script src="../JS/alertifadminpress.js"></script>

    <h2>Available Rooms</h2>


     <div id="room_box">


    <img src="../images/2bed.jpg" alt="room image " id="room_image"> 

    <div class="room_info"><h3>Room Info:</h3>
        <p class="room_no">Room No:101 </p>
    <p class="price">Price: 10000tk/month</p>
<button type="submit" class="book_btn" onclick="notallowed()">Book Now</button>
<script src="../JS/alertinbookwithoureg.js"></script>

     </div> </div> 

     <div id="room_box1">


    <img src="../images/1.jpg" alt="room image" id="room_image">

    <div class="room_info1"><h3>Room Info:</h3>
        <p class="room_no">Room No:102 </p>
    <p class="price">Price: 10000tk/month</p>
<button type="submit" class="book_btn" onclick="notallowed()">Book Now</button>
<script src="../JS/alertinbookwithoureg.js"></script>

     </div> </div>

        <div id="room_box2">

    <img src="../images/img3.jpg" alt="room image" id="room_image">
    <div class="room_info2"><h3>Room Info:</h3>
        <p class="room_no">Room No:103 </p>
    <p class="price">Price: 8000tk/month</p>
<button type="submit" class="book_btn" onclick="notallowed()">Book Now</button>
<script src="../JS/alertinbookwithoureg.js"></script>

     </div> </div> 

         <div id="room_box3">

    <img src="../images/img4.jpg" alt="room image" id="room_image">
    <div class="room_info3"><h3>Room Info:</h3>
        <p class="room_no">Room No:104 </p>
    <p class="price">Price: 12000tk/month</p>
<button type="submit" class="book_btn" onclick="notallowed()">Book Now</button>
<script src="../JS/alertinbookwithoureg.js"></script>

     </div> </div> 


        <div id="room_box4">
    <img src="../images/img5.png" alt="room image" id="room_image">
    <div class="room_info4"><h3>Room Info:</h3>
        <p class="room_no">Room No:105 </p>
    <p class="price">Price: 9000tk/month</p>
<button type="submit" class="book_btn" onclick="notallowed()">Book Now</button>
<script src="../JS/alertinbookwithoureg.js"></script>
     </div> </div> 

        <div id="room_box5">
    <img src="../images/3bed.avif" alt="room image" id="room_image">
    <div class="room_info5"><h3>Room Info:</h3>
        <p class="room_no">Room No:106 </p>
    <p class="price">Price: 11000tk/month</p>
<button type="submit" class="book_btn" onclick="notallowed()">Book Now</button>
<script src="../JS/alertinbookwithoureg.js"></script>

     </div> </div> 




    <footer>
        <pre>© 2025 Happy Life Hostel Management System. All rights reserved.</pre>
        <pre>© Created by Happy Life Team</pre>
    </footer>

    
</body>
</html>