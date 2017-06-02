<?php 
 
function Connect()
{
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "mxctzvr10*";
 $dbname = "colector_ado";
 
 // Create connection
 $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die($conn->connect_error);
 
 return $conn;
}
 
?>