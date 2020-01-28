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

<title>Untitled Document</title>
</head>

<body>
	<h1>Enter Station Detail</h1><hr>
	<form method="post" action="#">
		<label>Station Name: </label>
		<input type="text" name="name"><br>
		<input type="submit" name="go" value="go">
	</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="javascript/bootstrap.min.js"></script>
</body>
</html>
<?php
if(isset($_POST["go"]))
{
	$_SESSION["station_name"]=$_POST["name"];
	echo "<script>window.location.href='home.php';</script>";
}
?>