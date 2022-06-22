<?php
include 'connect.php';
if(isset($_POST['usersDataReceive'])){
    // table headings below
    $table='<table class="table">
    <thead class="table-primary">
        <tr>
            <th scope="col">Sr. No.</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Mobile</th>
            <th scope="col">Place</th>
            <th scope="col">Operations</th>
        </tr>
    </thead>';

    $sql="SELECT * FROM `crud`"; //sql is querry and crud is table in database
    $result= mysqli_query($con,$sql);
    $number=1;

    while($row= mysqli_fetch_assoc($result)){ //access data from database
        $id= $row['ID'];
        $name= $row['Name'];
        $email= $row['Email'];
        $mobile= $row['Mobile'];
        $place= $row['Place'];
        // concatenation using '.'
        $table.='<tr> 
            <td scope="row">'.$number.'</td>
            <td>'.$name.'</td>
            <td>'.$email.'</td>
            <td>'.$mobile.'</td>
            <td>'.$place.'</td>
            <td> 
                <button class="btn btn-success" onclick="getDetails('.$id.')">Update</button>
                <button class="btn btn-danger" onclick="deleteUser('.$id.')"> Delete </button>
            </td>
        </tr>';
        $number++;
    }
    $table.= '</table>';
    echo $table;

}


?>