<?php
include 'connect.php';

extract($_POST); // don't need to write variables separately due to AJAX   e.g. $name = $_POST['cname]

if(isset($_POST['n']) && isset($_POST['e']) && isset($_POST['m']) && isset($_POST['p'])){ 
    // variables are AJAX function sent_data (not the adduser() inputs; Don't worry if declare same names like here)  
    
    $sql = "INSERT INTO `crud`(`Name`, `Email`, `Mobile`, `Place`) VALUES ('$n','$e','$m','$p')" ;

    $result= mysqli_query($con, $sql);
    
}

?>