<?php 
 
function Connect()
{
 $dbhost = "localhost";
 $dbuser = "nasryarg_wifipro";
 $dbpass = "AdminADO2016";
 $dbname = "nasryarg_wifipro";
 
 // Create connection
 $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die($conn->connect_error);
 
 return $conn;
}
 
?>
