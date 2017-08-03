
<?php
session_start();

error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);
$con = mysqli_connect("localhost", "root", "", "fun");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_SESSION['user'])) {
	echo '<script>window.location.href = "complete.php";</script>';
}
else{
	?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>	
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>



	<div class="container">
		<div class="row">

		    		
    		<div class="col-md-12" style="margin-top:5%;">
    		<div class="text-primary  h1" style="margin-bottom:2%; text-align: center;">Login</div>

    			
    			
    			<form method="POST">

				<div class="form-group">
			    <input type="email" class="form-control" name="email" placeholder="Email-ID">
			    </div>	
			    <div class="form-group">
			    <input type="password" class="form-control" name="password" placeholder="Password">
			    </div>
			    <div class="form-group">
			    <button type="submit"  name='Submit' class="btn btn-lg btn-primary">Submit</button>	
			    </div>	
				</form>

				
				<?php 

				if(isset($_POST['Submit'])){
					$email=$_POST['email'];
					$password=$_POST['password'];

					$sql = "SELECT * FROM login_user WHERE email='".$email."' AND password='".$password."'";
					$result=mysqli_query($con,$sql);
					if($result){
						$row=mysqli_num_rows($result);
						if($row==1){
						$_SESSION['user']= $email;
						echo $_SESSION['user'];
						header("location: complete.php");
					}
						else{
							echo "<div style='margin-left:35%; margin-top:5%;' class='text-danger h3'>Wrong Credentials Try Again</div>";
						}
					}
					else{
						echo mysqli_error($con);
					}
					
					
				/*	
					if($email!='RoshanJha2095@gmail.com'){

						if($password!='abcdefg'){
							echo "<div style='margin-left:35%; margin-top:5%;' class='text-danger h3'>Wrong Credentials Try Again</div>";
						}

					}
					else if($password!='abcdefg'){
							echo "<div style='margin-left:35%; margin-top:5%;' class='text-danger h3'>Wrong Password Try Again</div>";
						}

					else{
						$_SESSION['user']= $email;
						echo $_SESSION['user'];
						header("location: complete.php");
					} */
				}
}
			
?>
