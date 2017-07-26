<!DOCTYPE html>
<html>
<head>
	<title></title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

</head>
<body>
	<div class="container">
		<div class="row">
		    		<div class="col-md-4">
		    		</div>
    		<div class="col-md-4" style="margin-top:10%;">
    		<div class="text-primary h1">Registration Form</div>

    		<form method="POST" action="first.php" style="margin-top:10%;">
			  <div class="form-group">
			    <input type="text" class="form-control" name="name" placeholder="Name" required>
			  </div>
			  <div class="form-group">
			    <input type="text" class="form-control" name="contactno" placeholder="Contact No." required>
			  </div>
			  <div class="form-group">
			    <input type="text" class="form-control" name="address" placeholder="Address" required>
			  </div>
			  <button type="submit" class="btn btn-primary">Submit</button>

			  <?php
				$con = mysqli_connect("localhost", "root", "", "fun");

				if (!$con) {
   				die("Connection failed: " . mysqli_connect_error());
				}

				$sql = "SELECT * FROM user";
				$result = mysqli_query($con,$sql);
				$row=mysqli_num_rows($result);
				if($row>0){
					echo '<a href="second.php"><button type="button" class="btn btn-primary">Records</button></a>';
				}

				mysqli_close($con);
				?>

			  



			</form>

			</div>
    		</div>
    	</div>
	</div>
</body>

<?php
$con = mysqli_connect("localhost", "root", "", "fun");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$name=$_POST['name'];
    $contactno=$_POST['contactno'];
    $address=$_POST['address'];

$sql = "INSERT INTO user (name, contactno, address)
VALUES ('$name', '$contactno', '$address')";

if (mysqli_query($con, $sql)) {
    echo "<div style='margin-left:35%; margin-top:5%;' class='text-success h3'>Record Created Successfully...!!!</div>";
} else {
	$error=mysqli_error($con);
	echo "<div style='margin-left:35%; margin-top:5%;' class='text-danger h3'>Error: $error</div>";
}
header('Refresh: 2');
	}
mysqli_close($con);
?>
</html>