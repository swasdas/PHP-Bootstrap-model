<?php
include 'connect.php'; 

if(isset($_POST['id_send'])){ 
    $user_id= $_POST['id_send']; // user ID fetch from database (as it is unique and different than table)

    $sql = "SELECT * FROM `crud` WHERE ID= $user_id";

    $result= mysqli_query($con, $sql);

    $response= array();
    while($row= mysqli_fetch_assoc($result)){
        $response= $row;
    }
    echo json_encode($response); // convert php objects to json format

}else{
    $response['status']=200;
    $response['message']='Invalid or data is not found';
}

// update query
if(isset($_POST['hiddenData'])){
    $uniqueID= $_POST['hiddenData'];
    $name = $_POST['uname'];
    $mail = $_POST['uemail'];
    $no = $_POST['uno'];
    $place = $_POST['uplace'];

    $sql= "UPDATE `crud` SET Name='$name', Email='$mail', Mobile='$no', Place='$place' WHERE ID=$uniqueID ";
    $result = mysqli_query($con, $sql);

}


?>