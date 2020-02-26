<?php
session_start();
if(isset($_SESSION["data"]))
	echo "<script>window.location.href='destroy.php';</script>";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="description" content="">	
<meta name="author" content="Ghazali||Md Kasif">
<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
<title>Quedicate: Ticket Info</title>
<link rel="icon" href="images/icon.png" type="image/x-icon" />
<link rel="stylesheet" href="css/bootstrap.min.css">
<style>
	.blue{
		background-color: aqua;
	}
	.myForm>select{
		background-color: #f1f1f1;
	}
	.myForm>select,.myForm>label,.myForm>input[type=submit]{
		width:100px !important;
	}
</style>
<script type="text/javascript">
	function calc(){
		var fare=document.getElementById("number").value*10;
		document.getElementById("fare_disp").innerHTML="&#8377; "+fare;
		document.getElementById("fare").value=fare;
	};
</script>
</head>

<body>
	<div class="container" align="center">
		<h1>Welcome to Quedicate: E-Platform ticketing</h1>
		
			<form method="post" action="scan.php" class="myForm">
				<label>Person(s):</label>

				<!--Using event onChange causes the fare to updated only when option is changed if back button is pressed and the same value is selected the fare doesn't get updated as the value is not changed -->
				<select id="number" class="form-control" style=""  onchange="calc();" required>
					<option value="" selected="true">---Select---</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select>

				<br>

				<label>Ticket Fare:</label>

				<label id="fare_disp" class="form-control"></label>
				<input type="hidden" id="fare" name="fare" value="0">

				<br>
				<input type="submit" class="blue form-control" value="Next">
			</form>
	</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="javascript/bootstrap.min.js"></script>
</html>