<?php 
    session_start();
    if (empty($_SESSION['teacher'])) {
        header('location: index.php');
    }
    include 'connect.php';
    if(isset($_GET['editid'])){
        $id = $_GET['editid'];
        $sql = "SELECT * FROM sinhvien WHERE id=$id";
        $result = mysqli_query($connect,$sql);
        $row = mysqli_fetch_assoc($result);

        $fullnameOg = $row['fullname'];
        $classOg = $row['class'];
        $genderOg = $row['gender'];
        $birthdayOg = $row['birthday'];
        

	if(isset($_POST['submit'])){
		$fullnameUpdate=$_POST['fullname'];
		$classUpdate=$_POST['class'];
		$genderUpdate=$_POST['gender'];
		$birthdayUpdate=$_POST['birthday'];

		$sql = "UPDATE `sinhvien` SET id='$id', fullname='$fullnameUpdate', class='$classUpdate', gender=$genderUpdate, birthday='$birthdayUpdate' WHERE id=$id";
		$result=mysqli_query($connect,$sql);
		if($result){
			echo "Updated Student";
            header('location:dashboard.php');
		} else{
			echo "Failed to Update student";
			die(mysqli_error($connect));
		}
	}
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <?php include("includes/header.php"); ?>
    <form method='POST'>
        <div class='mb-3'>
            <label for='fullname' class='form-label'>Fullname</label>
            <input type='text' class='form-control' id='fullname' value="<?=$fullnameOg?>" name='fullname' autocomplete='off'>
        </div>
        <div class='row'>
            <div class='mb-3 col-4'>
                <label for='class' class='form-label'>Class</label>
                <input type='text' class='form-control' id='class' value="<?=$classOg?>" name='class' autocomplete='off'>
            </div>
            <div class='mb-3 col-4'>
                <div class='form-check'>
                    <input class='form-check-input' type='radio' name='gender' id='nam' value="0" <?=$genderOg ? "" : "checked"?>>
                    <label class='form-check-label' for='nam'>Male</label>
                </div>
                <div class='form-check'>
                    <input class='form-check-input' type='radio' name='gender' id='nu' value="1" <?=$genderOg ? "checked" : ""?>>
                    <label class='form-check-label' for='nu'>Female</label>
                </div>
            </div>
            <div class='mb-3 col-4'>
            <label for='birthday' class='form-label'>Birthday</label>
            <input type='date' value="<?=$birthdayOg?>" class='form-control' id='birthday' name='birthday'>
        </div>
        </div>
        <div class='d-grid'><button type='submit' name='submit' class='btn btn-primary'>Add Student</button></div>
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
                