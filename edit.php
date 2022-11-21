<?php 
    session_start();
    if (empty($_SESSION['teacher'])) {
        header('location: index.php');
    }
    include 'connect.php';
    if(isset($_POST['updateid'])){
        $updateid = $_POST['updateid'];
        $sql = "SELECT * FROM sinhvien WHERE id=$updateid";
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
        $fullname=$_POST['updatefullname'];
        $class=$_POST['updateclass'];
        $gender=$_POST['updategender'];
        $birthday=$_POST['updatebirthday'];


        $sql="UPDATE sinhvien SET fullname=$fullname ,class=$class ,gender=$gender ,birthday=$birthday WHERE id=$id";
        $result=mysqli_query($connect,$sql2);
    }
    ?>
