<?php
	session_start();
	if(!isset($_SESSION["station_name"]))
	{
		header("location: station.php");
	}
	
	$station=$_SESSION["station_name"];
	$id=rand().rand();
	require("common/connection.php");
	$sql="insert into qr_code (qr_id,station) values ('$id','$station')";
	mysqli_query($con,$sql);
	mysqli_close($con);

	$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = 'temp/';

    include "qrlib.php";    
    
    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    
    $filename = $PNG_TEMP_DIR.'test.png';
    
    //processing form input
    //remember to sanitize user input in real-life solution !!!
    $errorCorrectionLevel = 'H';

    /*if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
        $errorCorrectionLevel = $_REQUEST['level'];    */

    $matrixPointSize = 10;
    /*if (isset($_REQUEST['size']))
        $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);*/


    if (isset($id))
	{ 
		//it's very important!
        if (trim($id) == '')
            die('data cannot be empty! <a href="?">back</a>');
		
        // user data
        $filename =
		$PNG_TEMP_DIR.'test'.md5($id.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($id, $filename, $errorCorrectionLevel, $matrixPointSize, 2);        
    } 
	else 
	{ 
		//default data
        echo 'You can provide data in GET parameter: <a href="?data=like_that">like that</a><hr/>';    
        QRcode::png('PHP QR Code :)', $filename, $errorCorrectionLevel, $matrixPointSize, 2);       
    }    
        
    //display generated file
    $image_path=$PNG_WEB_DIR.basename($filename); 
?>
<!doctype html>
<html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="description" content="">	
<meta name="author" content="Ghazali||Md Kasif">
<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- Favicons
================================================== -->
<link rel="icon" href="img/favicon/favicon-32x32.png" type="image/x-icon" />
<link rel="stylesheet" href="css/bootstrap.min.css">

<title>Scan This</title>
<script type="text/javascript">
	var val;
	var inter;
	function startz(){
		val=<?php echo json_encode($id); ?>;
		inter=setInterval(checker, 1000);
	};
	
	function checker() {
		var xhttp;
		xhttp = new XMLHttpRequest();
		xhttp . onreadystatechange = function () {
			if ( this . readyState == 4 && this . status == 200 ) {
				if(this . responseText=="1")
				{
					clearInterval(inter);
					document.getElementById("load").removeAttribute("hidden");
					document.getElementById("qr_display").style.visibility="hidden";
					inter=setTimeout(function(){ window.location.href="home.php" }, 5000);
				}
			}
		};
		xhttp . open( "GET", "checker.php?qr_id=" + val, true );
		xhttp . send();
	};
</script>
	
<style>
.centered {
  position: fixed;
  top: 50%;
  left: 50%;
  /* bring your own prefixes */
  transform: translate(-50%, -50%);
}
	
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
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
	
	<div id="load" class="centered" hidden="true">
		<div class="loader"></div>	
	</div>
	
	<div id="qr_display" class="container" align="center">
		<img src="<?php echo $image_path ; ?>">
		<hr>
	</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="javascript/bootstrap.min.js"></script>
</body>
</html>
	
	<?php
	echo "<script>startz();</script>";
	?>