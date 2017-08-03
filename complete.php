
<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);
$con = mysqli_connect("localhost", "root", "", "fun");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
if(isset($_SESSION['user'])) {?>

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
    		<form method="POST">
    		<div class="text-primary" style="margin-right:2%; font-size: 150%; text-align: right;">Welcome <?php echo $_SESSION['user']; ?>&nbsp;
    		<button type="submit" name='logout' class="btn btn-danger">LogOut</button></div>
    		
    		<div class="text-primary  h1" style="margin-bottom:2%; text-align: center;">Records</div>

    			
    			<table class='table'>
    			
				<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Contact No.</th>
				<th>Address</th>
				<th>Operation</th>
				</tr>
				<tr>
				<td></td>
				<td><div class="form-group">
			    <input type="text" class="form-control" name="name" placeholder="Name">
			    </div></td>
				<td><div class="form-group">
			    <input type="text" id="ctc" class="form-control" name="contactno" placeholder="Contact No.">
			    </div></td>
				<td><div class="form-group">
			    <input type="text" class="form-control" name="address" placeholder="Address">
			    </div></td>
				<td><button type="submit" name='Add' class="btn btn-primary">Add</button></td>
				</tr>
				</form>

				
				<?php 
				$sql = "SELECT * FROM user";
				$result = mysqli_query($con,$sql);
				$nrow=mysqli_num_rows($result);
				if($nrow>0){
				while($row = mysqli_fetch_array($result))
				{
				echo " <td>". $row['userid'] . "</td>";
				echo" <td>" . $row['name'] . "</td>";
				echo" <td>" . $row['contactno'] . "</td>";
				echo" <td>" . $row['address'] . "</td>";
				echo"<td>";?> 

				<button type="button" class="btn btn-sm btn-warning" style='margin-right:2%;'  data-toggle="modal" data-target="#message<?php echo $row['userid'];?>">Modify</button>
				<div class="modal fade" id="message<?php echo $row['userid'];?>"  role="dialog">
			    <div class="modal-dialog modal-lg">
			      <div class="modal-content">
			        <div class="modal-header">
			          <h4 class="modal-title">Edit Here</h4>
			        </div>
			        <div class="modal-body">
			          <form method="POST">
			          		<div class="form-group">
			          		<label for="id">UserId:</label>
						    <input type="text" class="form-control" name="id" value="<?php echo $row['userid'];?>" readonly>
						    </div>
							<div class="form-group">
						    <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>">
						    </div>
							<div class="form-group">
						    <input type="text" id="ctc" class="form-control" name="contactno" value="<?php echo $row['contactno'];?>">
						    </div>
							<div class="form-group">
						    <input type="text" class="form-control" name="address" value="<?php echo $row['address'];?>">
						    </div>
							<button type="submit" name='Edit' class="btn btn-success">Modify</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
							</form>
					</div>
			        		
			      </div>
			    </div>
			  </div>
				<?php
				echo" <a class='btn btn-sm btn-danger'  style='margin-right:2%;' href='complete.php?id=". $row['userid']."&action=Delete'>Delete</a>
				<a class='btn btn-sm btn-success' style='margin-right:2%;' href='complete.php?id=". $row['userid']."&action=Download'>Download</a>
				</td>";
				echo" </tr>";
				}
				}
				?>
				</table>
				

			</div>
    	</div>
    </div>
</body>
</html>


  

<?php
if($_SERVER['REQUEST_METHOD']=="POST"){

	if (isset($_POST['Add'])) {
  	$name=$_POST['name'];
	$address=$_POST['address'];
    $contactno=$_POST['contactno'];

    if((!is_numeric($contactno))||(strlen($contactno)!=10)){
	echo "<script type='text/javascript'>
		  document.getElementById('ctc').placeholder='Error:Enter Number Format and Length 10';
		  
		  </script>";
    	//echo "<div style='margin-left:35%; margin-top:5%;' class='text-danger h3'>Error: Enter Number Format and Length 10</div>";
    }
	else{
		$sql = "INSERT INTO user (name, contactno, address) VALUES ('$name', '$contactno', '$address')";
		if (mysqli_query($con, $sql)) {
		//  echo "<div style='margin-left:35%; margin-top:5%;' class='text-success h3'>Record Created Successfully...!!!</div>";
			echo '<script>window.location.href = "complete.php";</script>';
		} 
		else {
			$error=mysqli_error($con);
			echo "<div style='margin-left:35%; margin-top:5%;' class='text-danger h3'>Error: $error</div>";
			echo '<script>window.location.href = "complete.php";</script>';
			}
		}

    }

    else if (isset($_POST['Edit'])) {
    $id=$_POST['id'];
  	$name=$_POST['name'];
	$address=$_POST['address'];
    $contactno=$_POST['contactno'];
    $sql = "UPDATE user SET name='".$name."', contactno='".$contactno."', address='".$address."' WHERE userid=".$id;
    if(mysqli_query($con,$sql)){
    	//echo "<div style='margin-left:35%; margin-top:5%;' class='text-success h3'>Record Modified Successfully...!!!</div>";
    	echo '<script>window.location.href = "complete.php";</script>';
    }
    else{
    	$error=mysqli_error($con);
		echo "<div style='margin-left:35%; margin-top:5%;' class='text-danger h3'>Error: $error</div>";
		echo '<script>window.location.href = "complete.php";</script>';
    }
    
	}

	else if (isset($_POST['logout'])) {
		//session_start();
		session_destroy();
		echo '<script>window.location.href = "login.php";</script>';		
	}
    
}



if($_SERVER['REQUEST_METHOD']=="GET"){
	if (isset($_GET['id'])){
	$id=$_GET['id'];

  	if ($_GET['action'] == 'Delete'){
    $sql = "DELETE FROM user WHERE userid=".$id;
	mysqli_query($con,$sql);
	echo '<script>window.location.href = "complete.php";</script>';
	}

 	else if ($_GET['action'] == 'Download'){
    $sql = "SELECT * FROM user WHERE userid=".$id;
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result);
    ?>
    		<div id="table">
    		<div class="text-primary h1">Records</div>
    		<table class='table'>
				<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Contact No.</th>
				<th>Address</th>
				</tr>
				<tr>
				<td><?php echo $row['userid']; ?></td>
				<td><?php echo $row['name']; ?></td>
				<td><?php echo $row['address']; ?></td>
				<td><?php echo $row['contactno']; ?></td>
				</tr>
			</table>
			</div>

    <script  type="text/javascript">
	
	var pdf = new jsPDF('p', 'pt', 'letter');
	var x = document.getElementById('table');
	
	pdf.canvas.height = 72 * 11;
	pdf.canvas.width = 72 * 8.5;
	pdf.fromHTML(document.getElementById("table"));
	pdf.save('Records.pdf');
    x.style.display = 'none';
	</script>
    <?php
 	}
	
}


}
mysqli_close($con);
}

else{

   
	echo '<script>window.alert("Login First");</script>';
	echo '<script>window.location.href = "login.php";</script>';
}
?>
