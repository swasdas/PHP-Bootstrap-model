<?php
include 'connect.php';

if(isset($_POST['del_send']) ){ 
    
    $unique= $_POST['del_send'];

    $sql = "DELETE FROM `crud` WHERE `ID`=$unique" ;

    $result= mysqli_query($con, $sql);
    
}

?>