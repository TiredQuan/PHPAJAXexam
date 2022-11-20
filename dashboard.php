<?php
    session_start();

    
if (empty($_SESSION['teacher'])) {
	header('location: index.php');
}


    include 'connect.php';
    include 'add.php';

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
        <div class="modal-dialog modal-xl">
        <div class="modal-content p-5">
            <div class="model-body">
                <form method="POST">
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
                            <div class="d-grid"><button type="submit" name="submit" class="btn btn-primary" onclick="adduser()">Add Student</button></div>
                        </form>
            </div>
        </div>
        </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Full name</th>
                <th scope="col">Class</th>
                <th scope="col">Gender</th>
                <th scope="col">Birthday</th>
                <th scope="col" colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if($result){
                while($row=mysqli_fetch_assoc($result)){
                    $id=$row['id'];
                    $fullname=$row['fullname'];
                    $class=$row['class'];
                    $gender=$row['gender'];
                    $birthday=$row['birthday'];
                    $genderStr = $gender ? 'Female' : 'Male';
                    echo "<tr>
                    <th scope='row'>$id</th>
                    <td>$fullname</td>
                    <td>$class</td>
                    <td>$genderStr</td>
                    <td>$birthday</td>
                    <td><button class='btn btn-primary'><a class='text-light text-decoration-none' href='./edit.php?editid=$id'>Edit</a></button></td>
                    <td><button class='btn btn-danger'><a class='text-light text-decoration-none' href='./delete.php?deleteid=$id'>Delete</a></button></td>
                    </tr>";
                }
            } else{
                die(mysqli_error($connect));
            }
            ?>
                
            </tbody>
        </table>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>


        function displayData(){
            //Finish this
            $.ajax({
                type: "method",
                url: "url",
                data: "data",
                dataType: "dataType",
                success: function (response) {
                    
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
                dataType: "dataType",
                success: function (data,status) {
                    console.log(status)
                }
            });
        }
    </script>
</body>
</html>