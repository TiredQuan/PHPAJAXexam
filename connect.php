<?php 
$connect = new mysqli("localhost","root","","php_demo_2");

if(!$connect){
    die(mysqli_error($connect));
}