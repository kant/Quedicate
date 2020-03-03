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
<link rel="stylesheet" href="css/style.css">
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
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			
				<a class="navbar-brand" href="#">Quedicate</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="active"><a href="station.php">Home <span class="sr-only">(current)</span></a>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="home.php">Refresh</a>
					</li>
				</ul>
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container-fluid -->
	</nav>
	
	<div class="myBackground">
		<div class="myForeground" style="top:30%!important;" align="center">
			<h1>Enter Station Detail</h1><hr>
			<form method="post" action="#" class="station">
				<label>Station Name: </label><br>
				<input type="text" name="name"><br>
				<br>
				<input type="submit" class="blue form-control" name="go" value="Submit">
			</form>
		</div>
	</div>
	</div>
    <?php
    include("common/footer.php");
    ?>
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