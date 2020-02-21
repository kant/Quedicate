<?php
$con=mysqli_connect("localhost:3307","root","","quedicate");

//$con=mysqli_connect("fdb25.awardspace.net","2979936_temp1","Temporary1","2979936_temp1");
function permit(){
	date_default_timezone_set("Asia/Kolkata");
	$nowdate=time();
	$edate=strtotime("Feb 02, 2020 10:59:58");
	if($nowdate>$edate)
	{
		echo "<h1>Get Permission From Ghazali</h1>";
		echo "<form method='post' action='#'>";
		echo "<label>Password</label>";
		echo "</form>";
	}
}
?>