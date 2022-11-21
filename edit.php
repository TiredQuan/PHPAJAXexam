<?php 
    session_start();
    if (empty($_SESSION['teacher'])) {
        header('location: index.php');
    }
    include 'connect.php';
    if(isset($_POST['updateid'])){
        $id = $_POST['updateid'];
        $sql = "SELECT * FROM sinhvien WHERE id=$id";
        $result = mysqli_query($connect,$sql);
        $responce=array();
        while($row = mysqli_fetch_assoc($result)){
            $responce=$row;
        } 
        echo json_encode($responce); 
    } else{
        $responce['status']=200;
        $responce['message']="Doesn't work";
    }


    if(isset($_POST['hiddendata'])){
        $id=$_POST['hiddendata'];
        $updateFullname=$_POST['updatefullname'];
        $updateClass=$_POST['updateclass'];
        $updateGender=$_POST['updategender'];
        $updateBirthday=$_POST['updatebirthday'];


        $sql="update sinhvien set fullname=$updateFullname ,class=$updateClass ,gender=$updateGender ,birthday=$updateBirthday where id=$id";
        $result=mysqli_query($connect,$sql);
    }
    ?>
