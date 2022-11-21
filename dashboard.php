<?php
    session_start();

    
if (empty($_SESSION['teacher'])) {
	header('location: index.php');
}


    include 'connect.php';

$sql = "SELECT * FROM sinhvien";
$result = mysqli_query($connect,$sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
    <?php include("includes/header.php"); ?>
    <div class="d-grid"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudent">Add Student</button></div>
        
        <!-- Modal -->
        <div class="modal fade" id="addStudent" tabindex="-1" aria-labelledby="formModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content p-5">
            <div class="model-body">
                <div>
                            <div class="mb-3">
                                <label for="fullname" class="form-label">Fullname</label>
                                <input type="text" class="form-control" id="fullname" placeholder="Nguyễn Văn A" name="fullname" autocomplete="off">
                            </div>
                            <div class="row">
                                <div class="mb-3 col-4">
                                    <label for="class" class="form-label">Class</label>
                                    <input type="text" class="form-control" id="class" placeholder="5a5" name="class" autocomplete="off">
                                </div>
                                <div class="mb-3 col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="nam" value="0" checked>
                                        <label class="form-check-label" for="nam">Male</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="nu" value="1">
                                        <label class="form-check-label" for="nu">Female</label>
                                    </div>
                                </div>
                                <div class="mb-3 col-4">
                                <label for="birthday" class="form-label">Birthday</label>
                                <input type="date" placeholder="dd-mm-yyyy" class="form-control" id="birthday" name="birthday">
                            </div>
                            </div>
                            <button name="submit" class="btn btn-primary" onclick="adduser()">Add Student</button>
                            <button class="btn btn-danger" data-bs-dismiss='modal'>Close</button>
                        </div>
            </div>
            </div>
          </div>
        </div>
        <!-- Edit student Modal -->
        <div class="modal fade" id="editStudent" tabindex="-1" aria-labelledby="formModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content p-5">
            <div class="model-body">
                <div>
                            <div class="mb-3">
                                <label for="fullname" class="form-label">Fullname</label>
                                <input type="text" class="form-control" id="updatefullname" placeholder="Nguyễn Văn A" name="fullname" autocomplete="off">
                            </div>
                            <div class="row">
                                <div class="mb-3 col-4">
                                    <label for="class" class="form-label">Class</label>
                                    <input type="text" class="form-control" id="updateclass" placeholder="5a5" name="class" autocomplete="off">
                                </div>
                                <div class="mb-3 col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="updategender" id="nam" value="0" checked>
                                        <label class="form-check-label" for="nam">Male</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="nu" value="1">
                                        <label class="form-check-label" for="nu">Female</label>
                                    </div>
                                </div>
                                <div class="mb-3 col-4">
                                <label for="birthday" class="form-label">Birthday</label>
                                <input type="date" placeholder="dd-mm-yyyy" class="form-control" id="updatebirthday" name="birthday">
                            </div>
                            </div>
                            <button name="submit" class="btn btn-primary" onclick="edituser()">Edit Student</button>
                            <button class="btn btn-danger" data-bs-dismiss='modal'>Close</button>
                            <input type="hidden" id="hiddenData">
                        </div>
            </div>
            </div>
          </div>
        </div>
        <div id="dataTable"></div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            displayData()
        })

        function displayData(){
            var displayData=true;
            $.ajax({
                type: "POST",
                url: "display.php",
                data: {
                    displaySend:displayData
                },
                success: function (data,status) {
                    $('#dataTable').html(data);
                }
            });
        }

        function adduser(){
            let addName=$('#fullname').val()
            let addClass=$('#class').val()
            let addGender=$('input[name="gender"]:checked').val()
            let addBirthday=$('#birthday').val()

            $.ajax({
                type: "POST",
                url: "add.php",
                data: {
                    sendName: addName,
                    sendClass: addClass,
                    sendGender: addGender,
                    sendBirthday: addBirthday,
                },
                success: function (data,status) {
                    displayData()
                }
            });
        }
        function deleteStudent(studentid){  
            $.ajax({
                url:"delete.php",
                type:"post",
                data:{
                    deleteSend:studentid,

                },
                success:function(data,status){
                    displayData();
                }
            })
        }
        function getDetails(studentid){
            $('#hiddenData').val(studentid);
            $.post("edit.php",{updateid:studentid},function(data,status){
                var userid=JSON.parse(data
                )
                $('#updatefullname').val(userid.fullname)
                $('#updateclass').val(userid.class)
                $('input[name="updategender"]').val(userid.gender)
                $('#updatebirthday').val(userid.birthday)
            })
            $('#editStudent').modal('show')
        }
        function edituser(){
            var updateFullname=$('updatefullname').val()
            var updateClass=$('updateclass').val()
            var updateGender=$('input[name="updategender"]:checked').val()
            var updateBirthday=$('updatebirthday').val()
            var hiddenData=$('#hiddenData').val()

            $.post('edit.php',{
                updatefullname:updateFullname,
                updateclass:updateClass,
                updategender:updateGender,
                updatebirthday:updateBirthday,
                hiddendata:hiddenData,

            },function(data,status){
                displayData()
            })
        }
    </script>
</body>
</html>