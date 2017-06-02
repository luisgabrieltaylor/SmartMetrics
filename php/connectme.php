<?php
$ip = $_SERVER["REMOTE_ADDR"];

require 'db_connection.php';
$conn    = Connect();
$name    = $conn->real_escape_string($_POST['name']);
$firstname = $conn->real_escape_string($_POST['firstname']);
$lastname = $conn->real_escape_string($_POST['lastname']);
$email   = $conn->real_escape_string($_POST['email']);
$destino = $conn->real_escape_string($_POST['destino']);
$mac     = $conn->real_escape_string($_POST['mac']);
$url     = $conn->real_escape_string($_POST['url']);


$query   = "INSERT into wifi_customers (wifi_Name,wifi_Email, wifi_Mac, wifi_Birthday) VALUES('".$name." ".$firstname." ".$lastname."','".$email."','".$mac."','".$url."')";
$success = $conn->query($query);

if (!$success) {
    die("Couldn't enter data: ".$conn->error);

}
echo "<script>window.location=\"http://192.168.10.1?active=yes&url=$url\";</script>";
/*enable_address($mac, $ip);
sleep(1);
//header("Location: redirect.php?url=".$url);
//echo "<script>location.reload();</script>";
$conn->close();
echo "<script>window.location=\"http://192.168.10.1?active=yes&url=$url\";</script>";
//$conn->close();

function enable_address($mac, $ip){
  //echo "sudo /sbin/iptables -t mangle -A wlan0_Outgoing -m mac --mac-source ".$mac." -j MARK --set-mark 2";
  exec("sudo /sbin/iptables -t mangle -A wlan0_Outgoing -m mac --mac-source ".$mac." -j MARK --set-mark 2");
  exec("sudo rmtrack ".$ip);*/

?>