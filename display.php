<?php 
include 'connect.php';
if(isset($_POST['displaySend'])){
    $table = '<table class="table">
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
    <tbody>';
    $sql = "SELECT * FROM sinhvien";
    $result = mysqli_query($connect,$sql);
    while($row=mysqli_fetch_assoc($result)){
        $id=$row['id'];
        $fullname=$row['fullname'];
        $class=$row['class'];
        $gender=$row['gender'];
        $birthday=$row['birthday'];
        $genderStr = $gender ? 'Female' : 'Male';
        $table.="<tr>
        <th scope='row'>$id</th>
        <td>$fullname</td>
        <td>$class</td>
        <td>$genderStr</td>
        <td>$birthday</td>
        <td><button class='btn btn-primary'><a class='text-light text-decoration-none' onclick='getDetails($id)'>Edit</a></button></td>
        <td><button class='btn btn-danger'><a class='text-light text-decoration-none' onclick='deleteStudent($id)'>Delete</a></button></td>
        </tr>";
    } //change the EDIT button aswell as the DELETE
    $table.="</tbody>
    </table>";
    echo $table;
}