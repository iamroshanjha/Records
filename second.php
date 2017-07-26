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
    		<div class="col-md-6" style="margin-top:10%;">
    		<div class="text-primary h1">Records</div>


			<?php

				$con = mysqli_connect("localhost", "root", "", "fun");

				if (!$con) {
   				die("Connection failed: " . mysqli_connect_error());
				}

				$sql = "SELECT * FROM user";
				$result = mysqli_query($con,$sql);
				$row=mysqli_num_rows($result);
				if($row>0){
				echo '<table class="table">
				<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Contact No.</th>
				<th>Address</th>
				</tr>';

				while($row = mysqli_fetch_array($result))
				{
				echo "<tr>";
				echo "<td>" . $row['userid'] . "</td>";
				echo "<td>" . $row['name'] . "</td>";
				echo "<td>" . $row['contactno'] . "</td>";
				echo "<td>" . $row['address'] . "</td>";
				echo "</tr>";
				}
				echo "</table>";
				}

				mysqli_close($con);
			?>

			<script type="text/javascript">
			  function onClick() {
				  var pdf = new jsPDF('p', 'pt', 'letter');
				  pdf.canvas.height = 72 * 11;
				  pdf.canvas.width = 72 * 8.5;

				  pdf.fromHTML(document.body);

				  pdf.save('Records.pdf');
				};
			</script>
			<button type="button" onclick="onClick()" class="btn btn-primary">Download</button>


			</div>
    		</div>
    	</div>
	</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>	
</html>

