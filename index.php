<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Bootstrap Model CRUD</title>
    <!-- Bootstrap CSS link below -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <!-- New User Modal -->
    <div class="modal fade" id="newUserModal" tabindex="-1" aria-labelledby="newUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="newUserModalLabel">New User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="nname">Name</label>  <!-- 'n' in nname is for New User -->
                <input type="text" class="form-control" id="nname" placeholder="Enter your name">
            </div>
            <div class="mb-3">
                <label for="nemail">Email Address</label>
                <input type="email" class="form-control" id="nemail" placeholder="Enter your email">
            </div>
            <div class="mb-3">
                <label for="nno">Mobile</label>
                <input type="text" class="form-control" id="nno" placeholder="Enter your mobile number">
            </div>
            <div class="mb-3">
                <label for="nplace">Place</label>
                <input type="text" class="form-control" id="nplace" placeholder="Enter your place">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="adduser()">Submit</button>    
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> 
        </div>
        </div>
    </div>
    </div>

    <!-- Update details Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="updateModalLabel">Update Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="uname">Name</label> <!-- 'u' in nname is for Updated User -->
                <input type="text" class="form-control" id="uname" placeholder="Enter your name">
            </div>
            <div class="mb-3">
                <label for="uemail">Email Address</label>
                <input type="email" class="form-control" id="uemail" placeholder="Enter your email">
            </div>
            <div class="mb-3">
                <label for="uno">Mobile</label>
                <input type="text" class="form-control" id="uno" placeholder="Enter your mobile number">
            </div>
            <div class="mb-3">
                <label for="uplace">Place</label>
                <input type="text" class="form-control" id="uplace" placeholder="Enter your place">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="updateDetails()">Update</button>    
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> 
            <input type='hidden' id='hiddenData' >
        </div>
        </div>
    </div>
    </div>

    <div class="container my-5">
        <header>
            <h1 class="text-center">PHP CRUD operations using Bootstrap Model</h1>
        </header>
        <button type="button" class="btn  btn-primary my-3" data-bs-toggle="modal" data-bs-target="#newUserModal">Add New Users</button>
        <div id="displayDataTable" >

        </div>
    </div>

    <!-- Bootstrap JavaScript link below -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
    
    <script>
        // to keep table data whenever refreshing the page
        $(document).ready(function(){
            displayDataFunction();
        });

        //display function
        function displayDataFunction(){
            var displaydata='true';
            $.ajax({
               url:'display.php',
               type:'post',
               data:{
                usersDataReceive: displaydata
               },
               success: function(data, status){
                $('#displayDataTable').html(data)
               }
            });
        }

        // adding user's data function
        function adduser(){
            var n= $('#nname').val();
            var e= $('#nemail').val();
            var m= $('#nno').val();   //mobile no.
            var p= $('#nplace').val();

            $.ajax({ // ajax take 4 parameters
                url: 'insert.php', 
                type: 'post',
                data: { 
                    n:n, e:e, m:m, p:p // send_data : add_data (e.g. sent_n: n)
                }, 
                success: function(data, status){
                    //console.log(status);
                    $('#newUserModal').modal('hide');
                    displayDataFunction(); // function to display data
                }
            });
        }

        // delete user's record
        function deleteUser(del_id){ // input
            $.ajax({
                url:"delete.php",
                type:'post',
                data: {
                    del_send : del_id  
                },
                success:function(data,status){
                    displayDataFunction();
                }
            })
        }

        // Update: get details function
        function getDetails(upd_id){
            $('#hiddenData').val(upd_id); // id saved in hidden*** input
            
            // 'Post' method includes 3 parameters url, data, function DIRECTLY instead of 'Ajax' method
            $.post("update.php",      // url
                    {id_send: upd_id}, // data
                    function(data, status){
                        var userid=JSON.parse(data); // parsing data to javascript object (so we get data in 'name:value' pair)
                        $('#uname').val(userid.Name); // 'Name' is from database column name
                        $('#uemail').val(userid.Email);
                        $('#uno').val(userid.Mobile);
                        $('#uplace').val(userid.Place);
            });

            $('#updateModal').modal("show");
        }

        // Update user's record (onclick) function
        function updateDetails(){
            var uname= $('#uname').val();
            var uemail= $('#uemail').val();
            var uno= $('#uno').val();
            var uplace= $('#uplace').val();
            var hiddenData= $('#hiddenData').val();

            $.post("update.php",
                { //data
                    uname:uname, uemail:uemail, uno:uno, uplace:uplace, hiddenData:hiddenData
                }, function(data, status){
                    $('#updateModal').modal('hide');
                    displayDataFunction();
                }

            )
        }


    </script>
</body>
</html>