
<!-- https://www.youtube.com/watch?v=1R9iHaZoE2Q WATCH THIS THEN REFACTOR YOUR CODE TO ACOMODATE JQUERY -->
<?php 
session_start();
  include("connect.php");

   
   $output = "";

  if (isset($_POST['login'])) {
  	   
  	   $uname = $_POST['uname'];
  	   $role = $_POST['role'];
  	   $pass = $_POST['pass'];

  	   if (empty($uname)) {
  	   	
  	   }else if(empty($role)){

  	   }else if(empty($pass)){

  	   }else{

         $query = "SELECT * FROM user WHERE username='$uname' AND role='$role' AND password='$pass'";
         $res = mysqli_query($connect,$query);

         if (mysqli_num_rows($res) == 1) {

         	  if ($role == "student") {

         	  	$_SESSION['student'] = $uname;
         	  	header("Location: dashboardStudent.php");
         	  	
         	  }else if($role == "teacher"){
                
                $_SESSION['teacher'] = $uname;
                header("Location: dashboard.php");


         	  }
         	 $output .= "you have logged-In";
         }else{
             $output .= "Failed to login";
         }

  	   }
  }




 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Multilogin System</title>

</head>
<body>
	<?php include("includes/header.php"); ?>



<div class="container">
    <div class="col-md-12">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 shadow-sm" style="margin-top:100px;">
                <form method="post">
                    <h3 class="text-center my-3">Login</h3>
                    <div class="text-center"><?php echo $output; ?></div>
                    <label>Username</label>
                    <input type="text" name="uname" class="form-control my-2" placeholder="Enter Username" autocomplete="off">
                        
                        <label>Select Role</label>
                    <select name="role" class="form-control my-2">
                        <option value="">Selete Role</option>
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                    </select>

                    <label>Password</label>
                    <input type="password" name="pass" class="form-control my-2" placeholder="Enter Password">

                    <input type="submit" name="login" class="btn btn-success" value="Login">
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>