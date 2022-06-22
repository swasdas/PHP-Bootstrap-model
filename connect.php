<?php 

//database connection
$con = new mysqli('localhost','root','','bootstrap_crud'); // $server, $user, $password, $database_name

if(!$con){ // if not connected
    die(mysqli_error($con));
}

?>