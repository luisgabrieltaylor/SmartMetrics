<?php
	setlocale(LC_ALL, 'es_MX');

/* VARIABLES GLOBALES */
  class web_object{};
  $WEB = new web_object();

/* Rutas Globales para el Sistema */
	$WEB->rootDir 			            = "/home/nasryarg/public_html/smartmetrix";
	$WEB->documentos_XLS            = $WEB->rootDir."/documentos/xls";
	$WEB->includesDir		            = $WEB->rootDir."/includes";
  $WEB->apiPaypal                 = $WEB->includesDir."/lib/api_paypal";
  $WEB->apiGraficos               = $WEB->includesDir."/lib/api_higthchart";
  $WEB->apiGoogle                 = $WEB->includesDir."/lib/api_google";
  $WEB->apiFacebook               = $WEB->includesDir."/lib/api_facebook";
  $WEB->apiInstagram               = $WEB->includesDir."/lib/api_instagram";
  $WEB->ftpDir                    = $WEB->rootDir."/ftp";
  $WEB->assetsDir                 = $WEB->rootDir."/assets";
  $WEB->distDir                   = $WEB->rootDir."/dist";
  $WEB->assetsJSDir               = $WEB->assetsDir."/js";
  $WEB->assetsCSSDir              = $WEB->assetsDir."/css";
  $WEB->distCSSDir                = $WEB->distDir."/css";
  $WEB->distJSDir                 = $WEB->distDir."/js";
  $WEB->pluginsDir                = $WEB->rootDir."/plugins";
  $WEB->libDir			              = $WEB->includesDir."/lib";
  $WEB->adodbDir                  = $WEB->includesDir."/lib/adodb_lite";
  $WEB->fpdfDir                   = $WEB->includesDir."/lib/fpdf";
  $WEB->funciones_PHPExcelReader  = $WEB->libDir."/PHPExcelReader";
	$WEB->funciones_GoogleExcel     = $WEB->libDir."/GoogleExcel";
	$WEB->funciones_phpFPDF         = $WEB->libDir."/fpdf";
	$WEB->tiempoSesion              = 6000;	//expresado en segundos

	$WEB->modulesDir		= $WEB->rootDir."/modules";
  
	

  $WEB->rootDirServ 			         = "https://inhousesv.com/smartmetrix";
	$WEB->includesDirServ            = $WEB->rootDirServ."/includes";
  $WEB->apiFacebookServ            = $WEB->includesDirServ."/lib/api_facebook";
  $WEB->apiPaypalServ              = $WEB->includesDirServ."/lib/api_paypal";
  $WEB->apiGraficosServ            = $WEB->includesDirServ."/lib/api_higthchart";
  $WEB->apiGoogleServ              = $WEB->includesDirServ."/lib/api_google";
  $WEB->apiInstagramServ           = $WEB->includesDirServ."/lib/api_instagram";
  $WEB->ftpDirServ                 = $WEB->rootDirServ."/ftp";
  $WEB->assetsDirServ              = $WEB->rootDirServ."/assets";
  $WEB->distDirServ                = $WEB->rootDirServ."/dist";
  $WEB->assetsJSDirServ            = $WEB->assetsDirServ."/js";
  $WEB->assetsCSSDirServ           = $WEB->assetsDirServ."/css";
  $WEB->distCSSDirServ             = $WEB->distDirServ."/css";
  $WEB->distJSDirServ              = $WEB->distDirServ."/js";
  $WEB->pluginsDirServ             = $WEB->rootDirServ."/plugins";
  $WEB->funciones_phpDirServ		   = $WEB->rootDirServ."/includes/php";
	$WEB->funciones_phpGrid			     = $WEB->rootDirServ."/includes/lib/phpgrid";
  $WEB->funciones_jQueryEasyUI	   = $WEB->rootDirServ."/includes/lib/jquery-easyui-1.3.1";			
	$WEB->documents_XLS              = $WEB->rootDirServ."/documentos/xls";
  $WEB->pages                      = $WEB->rootDirServ."/pages";
	
  
  $WEB->ftpDirServ					       = $WEB->rootDirServ."/ftp";
  $WEB->cerrarSesion				      = $WEB->rootDirServ."/includes/php/cerrarSesion.php"; 

/* Variables para la Configuraci�n General de la base de datos */
  $WEB->mydbase 		= "mysqli"; 		// manejador
  $WEB->mydbhost 		= "localhost";		// host --192.168.10.195:5000
  $WEB->mydbname		= "smartmetrix";		// nombre de la base de datos
  $WEB->user 			  = "smartmetrix";		// usuario
  $WEB->passwd			= "9SXhhr8mptawSpfZ";		// contrase�a
  
/* datos aplicacion */
  $WEB->titulo	 		   = "smartMetriX :: Social Analizer";// titulo app
  $WEB->keywords 		   = "red social, facebook, twitter, linkedIn, pinterest, analizador, mercadeo, marketing"; //keywords  
  $WEB->descripcion		 = "smartMetrix"; 		// titulo app  
  $WEB->distribucion	 = "global"; 
  $WEB->robots			   = "follow,all"; 		
  $WEB->language	 	   = "es";
  
 /* Datos del autor */
  $WEB->nameAutor		     = "ProacIT S.A. de C.V."; 
  $WEB->enterpriseAutor  = "ProacIT S.A. de C.V."; 
  $WEB->anioAutor		     = "2016"; 
  $WEB->webAutor  		   = "https://www.proacit.com.mx";
  $WEB->celAutor		     = "+503 72081429";
  $WEB->copyright		     = "2016 &copy; <strong>ProacIT S.A. de C.V.</strong>  Todos los derechos reservados."; 		  
  $WEB->framework		     = "smartMetrix"; 
  
  
    
/******************************/
//require_once($WEB->adodbDir."/adodb.inc.php");
//require_once($WEB->funciones_phpDir."/sql.php");
//require_once($WEB->funciones_phpDir."/seguridad.php");
//require_once($WEB->funciones_phpDir."/mycrypt.php");
//require_once($WEB->funciones_phpDir."/connect.class.php");

//$mcrypt = new mycrypt('aes');
//$mcrypt->setKey($WEB->empresa);


if($_SERVER['REMOTE_ADDR']=="00.00.00.00")
  ini_set('display_errors','On');
else
  ini_set('display_errors','Off');

ini_set('display_errors','On');

define("CAN_REGISTER", "any");
define("DEFAULT_ROLE", "member");
 
define("SECURE", FALSE);    


$WEB->accessTokenFacebook = "CAACEdEose0cBAJedVjHYgykAIGIbyDOaDCBmq4fLQWB0t1Qj9YXKT8ZBSyJGs4YgxZAPviZANxOZB1RFqfmFLNptccQpclswKxHXGupbtNVQ33quWvAQROVyR7UB5HBUfyGiyQX4OhxH6lUZAeB4l2AXKIyigXJqjIw76V4DNkVTkHR05b49cqr2ZAAJAHxOssg8nyTZATJkgZDZD";
 

//$conn = ADONewConnection($WEB->mydbase);

//$conn_ibase = ADONewConnection("ibase") or die ("Error de conexion");
//$conn_ibase->Connect('192.168.12.5:C:\Microsip datos\COMIMSA PRUEBAS.FDB','sysdba','matusa');
	
/*if(empty($conn))
	die("Cannot create ADONewConnection");
if(!$conn->Connect($WEB->mydbhost, $WEB->user, $WEB->passwd, $WEB->mydbname)){
	print 'Error creating connection to DB: <br><b>'.$conn->ErrorMsg().'</b>';
	die;
}else{
	//print 'Connected to DB, Congratulations!';
}*/

?>