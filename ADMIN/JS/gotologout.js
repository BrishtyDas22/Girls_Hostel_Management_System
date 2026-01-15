function gotologout() {
     var result = confirm("Are you sure you want to logout?");
       if (result === true) {
       
    window.location.href = "../CONTROL/adminlogout.php";
}

}