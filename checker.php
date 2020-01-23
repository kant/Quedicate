<?php
require("common/connection.php");
$val=$_GET["qr_id"];
$sql="select * from qr_code where qr_id='$val'";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_array($result);
if($row['counter']==1)
{
	echo "1";
}
mysqli_close($con);
?>
