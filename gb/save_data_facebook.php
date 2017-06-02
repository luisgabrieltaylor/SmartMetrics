<?php

define ("SERVER", "localhost");
define ("USER", "nasryarg_gb");
define ("PASSWORD", "GalaxyBowling2016");
define ("DATABASE", "nasryarg_gbCRM");

$link = mysql_connect(SERVER,
		 			  USER, 
		 			  PASSWORD) or die("ERROR CONNECT: ".mysql_error());
mysql_select_db(DATABASE, $link) or die ("ERROR SELECT_DB: ".mysql_error());

$id     = $_GET["id"];
$name   = $_GET["name"];
$email  = $_GET["email"];
$gender = $_GET["gender"];
$code   = $_GET["code"];
$bd     = $_GET["birthday"];

$query_Str = "SELECT * FROM customers WHERE crm_Email = '$email'";

$response = mysql_query($query_Str, $link) or die("ERROR EXECUTION QUERY: ".mysql_error());
$num_filas = mysql_num_rows($response);
echo $num_filas;
if($num_filas <= 0){
	$insert_Str = "INSERT INTO customers(crm_IdFacebook, 
										crm_NameFacebook ,
										crm_Email ,
										crm_Gender ,
										crm_Birthday ,
										crm_CODE ,
										crm_DateTime
									) VALUES('$id', '$name', '$email', '$gender', '$bd', '$code', NOW())";
	mysql_query($insert_Str, $link) or die("ERROR EXECUTION QUERY: ".mysql_error());
}else{
	echo "DUPLICADO: Usted ya ha obtenido un codigo con anterioridad!";
}






?>