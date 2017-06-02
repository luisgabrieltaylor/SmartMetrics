<?php
define ("SERVER", "localhost");
define ("USER", "nasryarg_gb");
define ("PASSWORD", "GalaxyBowling2016");
define ("DATABASE", "nasryarg_gbCRM");

$link = mysql_connect(SERVER,
		 			  USER, 
		 			  PASSWORD) or die("ERROR CONNECT: ".mysql_error());
mysql_select_db(DATABASE, $link) or die ("ERROR SELECT_DB: ".mysql_error());

if(isset($_GET["estado"])){
	$status = $_GET["estado"];	
}

$datos = explode(",",$status);
if($datos[1] == "Si"){
	$sql = "UPDATE jv_photos SET jv_Status = 'A' WHERE jv_IdPhoto = ".$datos[0];
	mysql_query($sql, $link) or die(mysql_error());
	header("Location: index.php");
}else{
	$sql = "UPDATE jv_photos SET jv_Status = 'I' WHERE jv_IdPhoto = ".$datos[0];
	mysql_query($sql, $link)or die(mysql_error());
	header("Location: index.php");
}

/*if($status == 'No'){
	$sql = "SELECT * FROM jv_photos ORDER BY jv_DateTime DESC";
			$resp = mysql_query($sql, $link);
}
$sql = "";*/

?>