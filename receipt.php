<?php
require( "common/connection.php" );
if ( isset( $_COOKIE[ "id_data" ] ) ) {
	//This will run if page is refreshed
	$qr_id = $_COOKIE[ "id_data" ];
	$flag = true;
} else {
	//This will run when the receipt page is generated for the first time
	$qr_id = $_REQUEST[ "data" ];
	$person = ( $_REQUEST[ "txn_amt" ] ) / 10;
	$flag = false;
}
$sql = "select * from qr_code where qr_id='$qr_id'";
$result = mysqli_query( $con, $sql );
if ( $row = mysqli_fetch_array( $result ) ) {
	if ( $row[ "counter" ] == 0 || $flag == true ) {

		$station = $row[ "station" ];
		date_default_timezone_set( "Asia/Kolkata" );

		if ( $flag == false ) {
			$time = time();
			$time = date( "M d, Y H:i:s", $time );
			$expire_time = strtotime( $time ) + 7200;

			$sql = "update qr_code set counter='1', time='$expire_time', person='$person' where qr_id='$qr_id'";
			mysqli_query( $con, $sql );
			setcookie( "id_data", $qr_id, $expire_time, "/" );
			$expire_time = date( "M d, Y H:i:s", $expire_time );
		} else {
			$expire_time = $row[ "time" ];
			$person = $row[ "person" ];
			$expire_time = date( "M d, Y H:i:s", $expire_time );
		}
	} else {

		if ( $row[ "counter" ] == 1 ) {
			echo "<script>alert('Error: Used QR Code');</script>";
			echo "<script>window.location.href='destroy.php';</script>";
		} else {
			echo "<script>alert('Error: Invalid Response. Try Again');</script>";
			echo "<script>window.location.href='destroy.php';</script>";
		}
	}
} else {
	echo "<script>alert('Error: Invalid Response. Try Again');</script>";
	echo "<script>window.location.href='destroy.php';</script>";
}
mysqli_close( $con );
?>
<!DOCTYPE html>
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
	<link rel="icon" href="images/icon.png" type="image/x-icon"/>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/receipt-style.css">
	<link rel="stylesheet" href="css/style.css">
	<title>Receipt</title>
	<script>
		var deadline = new Date( <?php echo json_encode($expire_time); ?> ).getTime();
		var x = setInterval( function () {

			var now = new Date().getTime();
			var t = deadline - now;
			var hours = Math.floor( ( t % ( 1000 * 60 * 60 * 24 ) ) / ( 1000 * 60 * 60 ) );
			var minutes = Math.floor( ( t % ( 1000 * 60 * 60 ) ) / ( 1000 * 60 ) );
			var seconds = Math.floor( ( t % ( 1000 * 60 ) ) / 1000 );
			document.getElementById( "hour" ).innerHTML = hours;
			document.getElementById( "minute" ).innerHTML = minutes;
			document.getElementById( "second" ).innerHTML = seconds;
			if ( t < 0 ) {
				clearInterval( x );
				document.getElementById( "demo" ).innerHTML = "Ticket Expired";
				document.getElementById( "hour" ).innerHTML = '0';
				document.getElementById( "minute" ).innerHTML = '0';
				document.getElementById( "second" ).innerHTML = '0';
			}
		}, 1000 );
	</script>

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
					<li class="active"><a href="receipt.php">Ticket <span class="sr-only">(current)</span></a>
					</li>
					<li><a href="index.php">Get New Ticket</a>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="destroy.php">Delete Ticket</a>
					</li>
				</ul>
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container-fluid -->
	</nav>
	<div class="myBackground">
		<div class="myForeground" style="top:65%!important;" align="center">
			<div id="clockdiv">
				<h1> Ticket valid at station: </h1>
				<div>
					<span><b><?php echo $station; ?></b></span>
				</div>

				<h1> Ticket valid for person(s): </h1>
				<div>
					<span><b><?php echo $person; ?></b></span>
				</div>

				<h1> Ticket valid for: </h1>

				<div>
					<span class="hours" id="hour"></span>
					<div class="smalltext">Hours</div>
				</div>
				<div>
					<span class="minutes" id="minute"></span>
					<div class="smalltext">Minutes</div>
				</div>
				<div>
					<span class="seconds" id="second"></span>
					<div class="smalltext">Seconds</div>
				</div>
			</div>
			<p id="demo"></p>
		</div>
	</div>
	<div style="margin-top: 200px;">
		<?php
		include("common/footer.php");
		?>
	</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="javascript/bootstrap.min.js"></script>
</html>