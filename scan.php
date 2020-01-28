<?php
session_start();
if(!isset($_POST["fare"]))
	echo "<script>window.location.href='index.php';</script>";
$fare=$_POST["fare"];
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
<script src="https://kit.fontawesome.com/2ae58b001f.js" crossorigin="anonymous"></script>
	<title>Scan QR Code</title>
	<style>
		body,
		input {
			font-size: 14pt;
		}
		
		input,
		label {
			vertical-align: middle;
		}
		
		.qrcode-text {
			padding-right: 1.7em;
			margin-right: 0;
		}
		
		.qrcode-text-btns {
			display: inline-block;
			background: url("images/qr_icon.svg") 50% 50% no-repeat;
			height: 5em;
			width: 5em;
			cursor: pointer;
			box-shadow: 10px 10px 5px grey;
		}
		
		.qrcode-text-btns> input[type=file] {
			position: absolute;
			overflow: hidden;
			width: 1px;
			height: 1px;
			opacity: 0;
		}
		.myForm>input[type=submit]{
			background-color:#989898;
			width:100px !important;
		}
	</style>

	<script>
		function openQRCamera( node ) {
			var reader = new FileReader();
			reader.onload = function () {
				node.value = "";
				qrcode.callback = function ( res ) {
					if ( res instanceof Error ) {
						alert( "No QR code found. Please make sure the QR code is within the camera's frame and try again." );
					} else 
					{
						document.getElementById("ORDER_ID").value=res;
						document.getElementById("submit").removeAttribute("disabled");
						document.getElementById("submit").style.backgroundColor="aqua";
					}
				};
				qrcode.decode( reader.result );
			};
			reader.readAsDataURL( node.files[ 0 ] );
		}

		function showQRIntro() {
			return confirm( "Use your camera to take a picture of a QR code." );
		}
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
      <a class="navbar-brand" href="index.php">Quedicate</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
	<div class="container" align="center">
		<h1>Click here/कृपया इस बटन को दबाएं</h1><br>
		<!--<i class="fas fa-arrow-down"></i>-->
		<img src="images/downarrow.gif" height="50" alt="down-pointing-arrow">
		<br><br>
		
		<!--<input type=text size=16 placeholder="Tracking Code" class=qrcode-text>-->
		<label class=qrcode-text-btns>
			<input type=file accept="image/*" capture=environment onchange="openQRCamera(this);" tabindex=-1>
		</label>
		
		<form method="post" action="./Paytm/PaytmKit/pgRedirect.php" class="myForm">
		<br>
			<input type="submit" id="submit" name="submit" class="form-control" value="Pay" disabled>
			
		<!--Starts-->
			<input type="hidden" id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off">
			
			<input type="hidden" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="CUST001">
			
			<input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail">
			
			<input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
			
			<input type="hidden" title="TXN_AMOUNT" tabindex="10" type="text" name="TXN_AMOUNT" value="<?php echo $_POST["fare"]; ?>">
			
	</form>
	</div>
	
</body>
<script src="javascript/qr_packed.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="javascript/bootstrap.min.js"></script>
</html>
