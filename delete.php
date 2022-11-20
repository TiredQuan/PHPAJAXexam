<?php 
    session_start();
    if (empty($_SESSION['teacher'])) {
        die("Not a Teacher/Admin");
    }
    include 'connect.php';
    if(isset($_GET['deleteid'])){
        $id = $_GET['deleteid'];
        $sql = "DELETE FROM sinhvien WHERE id=$id";
        $result = mysqli_query($connect,$sql);
        if($result){
            header('location:dashboard.php');
        } else{
            die(mysqli_error($connect));
        }
    }