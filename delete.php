<?php 
    session_start();
    if (empty($_SESSION['teacher'])) {
        die("Not a Teacher/Admin");
    }
    include 'connect.php';
    if(isset($_POST['deleteSend'])){
        $id = $_POST['deleteSend'];
        $sql = "DELETE FROM sinhvien WHERE id=$id";
        $result = mysqli_query($connect,$sql);
        if($result){
            header('location:dashboard.php');
        } else{
            die(mysqli_error($connect));
        }
    }