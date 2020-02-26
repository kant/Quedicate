<?php
session_start();
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

<!-- Favicons
================================================== -->
<link rel="icon" href="images/icon.png" type="image/x-icon" />
<link rel="stylesheet" href="css/bootstrap.min.css">

<title>Station Info</title>
<style>
	.blue{
		background-color: aqua;
	}
	.station>input[type=text]{
		background-color: #f1f1f1;
		border-radius: 10px;
		padding: 4px 10px 4px 10px;
	}
	.station>label,.station>input[type=submit]{
		width:100px !important;
		border-radius: 10px;
	}
</style>
</head>

<body>
	<div class="container" align="center">
		<h1>Enter Station Detail</h1><hr>
		
			<form method="post" action="#" class="station">
				<label>Station Name: </label><br>
				<input type="text" name="name"><br>
				<br>
				<input type="submit" class="blue form-control" name="go" value="Submit">
			</form>
	</div>
	<!--
	<div class="container" align="center" class="station">
		<h1>Enter Station Detail</h1><hr>
		<form method="post" action="#">
			<label class="form-control">Station Name: </label>
			<input type="text" name="name"><br>
			<input type="submit" class="blue form-control" name="go" value="go">
		</form>
	</div>
-->
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="javascript/bootstrap.min.js"></script>
</html>
<?php
if(isset($_POST["go"]))
{
	$_SESSION["station_name"]=$_POST["name"];
	echo "<script>window.location.href='home.php';</script>";
}
?>