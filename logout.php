<?php 
session_start();


if (isset($_SESSION['student'])) {
	unset($_SESSION['student']);
	header("Location:index.php");
}else if(isset($_SESSION['teacher'])){
	unset($_SESSION['teacher']);
	header("Location:index.php");
}



 ?>