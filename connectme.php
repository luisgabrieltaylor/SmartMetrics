<?php
 
require 'db/db_connection.php';
$conn    = Connect();
$name    = $conn->real_escape_string($_POST['name']);
$email   = $conn->real_escape_string($_POST['email']);
$query   = "INSERT into connections (name,email) VALUES('" . $name . "','" . $email . "')";
$success = $conn->query($query);
 
if (!$success) {
    die("Couldn't enter data: ".$conn->error);
 
}

echo "Bienvenido <br>";
$conn->close();



 
?>