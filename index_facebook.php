
<?php
$server_name = "192.168.1.4/";
$domain_name = "social/";


$arp = "/usr/sbin/arp";
$users = "/var/lib/users";

$mac = shell_exec("$arp -a ".$_SERVER['REMOTE_ADDR']);
preg_match('/..:..:..:..:..:../',$mac , $matches);
@$mac = $matches[0];
$id  = 1000;
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$active = $_GET["active"];
if($active != "yes"){
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>ADO Movil | ADO ¡Siempre contigo!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	
	<link rel="shortcut icon" href="images/favicon.ico"/>
    <style type="text/css">
        .loader{
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('images/loading.gif') 50% 50% no-repeat rgb(249,249,249);
        }
    </style>
	<script type="text/javascript"> 
    var totalTiempo=5;    
    var ip = java.net.InetAddress.getLocalHost().getHostAddress ();

    function updateReloj()
    {
        var url="https://inhousesv.com?id=<?php echo $id;?>&mac=<?php echo $mac;?>&url=<?php echo $url;?>"; 
        document.getElementById('countDown').innerHTML = "Redireccionando en "+totalTiempo+" segundos";
        if(totalTiempo==0)
        {
            window.location=url;
        }else{
            /* Restamos un segundo al tiempo restante */
            totalTiempo-=1;
            /* Ejecutamos nuevamente la función al pasar 1000 milisegundos (1 segundo) */
            setTimeout("updateReloj()",1000);
        }
    }
 
	</script>
</head>
<body>
<h3 align="center" id='title'>WiFi-SOCIAL</h3>
<br>
<h4 align="center" id='countDown'></h3>
<div class="loader"></div>
<br><br><br><br>
</html>
<?php
}else{
echo "Gracias a Dios estas logueado";
}
?>
<script type="text/javascript">
	updateReloj();
</script>
