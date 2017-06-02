<?php
define('FACEBOOK_SDK_V4_SRC_DIR', __DIR__ . '/Facebook/');
require_once __DIR__ . '/Facebook/autoload.php';

if(!session_id()) {
    session_start();
}


$fb = new Facebook\Facebook([
  'app_id' => '1577747375852865', // Replace {app-id} with your app id
  'app_secret' => '6e653267ed9ba416cf42bd92835540b8',
  'default_graph_version' => 'v2.5',

  ]);

$helper = $fb->getRedirectLoginHelper();

$url = $_GET["uri"];
$mac = $_GET["mac"];

$permissions = ['email', 'public_profile']; // Optional permissions
//'user_birthday','publish_actions', 'user_location'
$url = 'https://inhousesv.com/login-callback.php?uri='.$url.'&mac='.$mac;
$loginUrl = $helper->getLoginUrl($url, $permissions);


error_reporting(0);

$arp = "/usr/sbin/arp";

$mac = shell_exec("$arp -a ".$_SERVER["REMOTE_ADDR"]);
preg_match('/..:..:..:..:..:../',$mac , $matches);
@$mac = $matches[0];

$url = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
//echo $mac;
?>
<!DOCTYPE html>
<html class="full" lang="en">
<!-- Make sure the <html> tag is set to the .full CSS class. Change the background image in the full.css file. -->

<head>
	<title>ADO Movil | ADO ¡Siempre contigo!</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<meta name="keywords" content="ADO Movil | ADO ¡Siempre contigo!" />

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/full.css" rel="stylesheet">
	<link href="css/font-awesome.css" rel="stylesheet">	
    <link href="css/logo-nav.css" rel="stylesheet">	
	<link href="css/sticky-footer.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<!-- FAVICON -->
	<link rel="shortcut icon" href="images/favicon.ico"/>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand">
					<img src="images/ado_logo.png" alt="">
				</a>	
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse nav navbar-nav navbar-right" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a class ="btn btn-lg" data-toggle="modal" data-target="#AcercaDe">Acerca de</a>						 
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
	
    <!-- Put your page content here! -->
	<!-- Page content ends here! -->
		<div class="container">		 
			<div class="page-header">
				<h1>¡Navega ya!<br><h2>Ingresa tu nombre y tu email o conectate mediante una de tus redes sociales</h2></h1>
			</div>
			<br>
			<!-- Login with Social Buttons - START -->
			<?php
                            $activo = $_GET["active"];
                            $uri = $_GET["url"];
                            if($activo != "yes"){
			?>
			<div class="container">
				<form class="col-md-2">
				</form>

				<form class="col-md-8" action="php/connectme.php" method="post" name="formADO" id="formADO">
					<form class="col-md-8" action="php/connectme.php" method="post" onsubmit="return validateData();";>
						<input type='hidden' name='mac' id="mac" value="<?php echo $mac; ?>" />
						<input type="hidden" name="url" id="url" value="<?php echo $url; ?>" />
						<div class="form-group">
							<div class="error"></div>
						</div>
						<div class="form-group">
	                    	<input type="text" class="form-control input-lg" name ="name" placeholder="Nombre" required>
	                    </div>
	                    <div class="form-group">
	                    	<input type="text" class="form-control input-lg" name = "firstname" placeholder = "Apellido Paterno" required />
	                    </div>
	                    <div class="form-group">
	                        <input type="text" class="form-control input-lg" name = "lastname" placeholder="Apellido Materno" required>
	                    </div>
	                    <div class="form-group">
	                        <input type="email" class="form-control input-lg" name = "email" placeholder="Email" required>
	                    </div>
						<div class="form-group">
	                        <label>¿Hacia donde viajas?</label>
	                        <select class="form-control" id="destino" placeholder="Hacia donde te diriges?" name="destino" required>
	                            <option value="-1">-- Seleccione un destino --</option>
	                            <option value="1">CDMX</option>
	                            <option value="2">Villahermosa</option>
	                            <option value="3">Veracruz</option>
	                            <option value="4">Cancún</option>
	                        </select>
	                    </div>
						<!--<div class="form-group">
							<input type="password" class="form-control input-lg" placeholder="Password">
						</div>-->   
						<div class="form-group">
							<input class="btn btn-lg btn-block btn-danger" name="submit" id="submit" type="submit">
						</div>
						<div class="form-group">
						   <p><input type="checkbox" aria-label="..."><a class ="btn btn-lg" data-toggle="modal" data-target="#Terminos" style="color: #fff;">HE LEIDO Y ACEPTO ESTOS TERMINOS Y CONDICIONES</a></p>
						</div>
						<br>
						<div class="row text-center">
							<div class="col-md-3">
							</div>
							<div class="col-md-6 col-sm-6">
								<a class="btn btn-primary btn-block btn-social btn-facebook" href="<?php echo htmlspecialchars($loginUrl); ?>">
									<span class="fa fa-facebook"></span> Ingresa con Facebook
								</a>
								<br>
							</div>
							<div class="col-md-3">
							</div>
							<!--<div class="col-md-4 col-sm-12">
								<a class="btn btn-block btn-social btn-twitter">
									<span class="fa fa-twitter"></span> Sign in with Twitter
								</a>
								<br>
							</div>
							<div class="col-md-4 col-sm-12">
								<a class="btn btn-primary btn-block btn-social btn-danger btn-google">
									<span class="fa fa-google"></span> Sign in with Google
								</a>
								<br>
							</div>-->
						</div>
					</form>
				</form>					
			</div>
                        <?php
			}else{
                        ?>
			<div class="container">
			<h2>Se ha logueado con exito</h2>
			<?php
                          echo "<script>window.location='http://".$uri."';</script>";
                        ?>
			</div>
			<?php
			}
			?>

			<!-- Login with Social Buttons - END -->			
		</div>
		<div class="container">
			<h5 class="text-center">&copy; 2016 Autobuses de Oriente ADO, S.A de C.V. Todos los derechos reservados. </h5>
		</div>	
		<div class="clear"></div>		
						<!-- Modal -->
						  <div class="modal fade" id="AcercaDe" role="dialog">
							<div class="modal-dialog">
							
							  <!-- Modal content-->
							  <div class="modal-content">
								<div class="modal-header">
								  <!--<button type="button" class="btn btn-primary btn-block close" data-dismiss="modal">&times;</button>-->
								  <h2 class="modal-title text-danger">Acerca de</h4>
								</div>
								<div class="modal-body">
								  <p><div align="center"><img src="images/logo.png" width="20%" height="20%" /></div></p>
								  <p style="color:#000;"><strong>Wifi Social para restaurantes, bares, esteticas y mucho más.</strong></p>
								  <p style="color:#000;"><strong>Versión 1.00.00.0RC</strong></p>
								  <p style="color:#000;"><strong>Copyright &copy; ProacIT 2016 Todos los derechos reservados.</strong></p>

								  <p style="color:#000;"> Este producto fue creado por ProacIT, empresa 100% mexicana.</p>
								  <p style="color:#000;" align="justify"> Este producto está protegido por las leyes de marca registrada y otros derechos de propiedad intelectuales y pendientes en Estados Unidos y otro paises.</p>
								</div>
								<div class="modal-footer">
								  <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
								</div>
							  </div>
							  
							</div>
						  </div>	
						<!-- End modal -->
						<!-- Modal -->
						  <div class="modal fade" id="Terminos" role="dialog">
							<div class="modal-dialog">							
							  <!-- Modal content-->
							  <div class="modal-content">
								<div class="modal-header">
								  <!--<button type="button" class="btn btn-primary btn-block close" data-dismiss="modal">&times;</button>-->
								  <h2 class="modal-title text-danger">Términos y condiciones</h4>
								</div>
								<div class="modal-body">
								  <p style="color: #000;" align="center"><strong>Términos y Condiciones de Uso</strong></p>
								  <p style="color: #000;" align="justify">
								  	WiFiPro - WiFi Social es una herramienta de publicidad que convierte el servicio WiFi de los
									negocios a uno totalmente mas efectivo. Otorga la posibilidad al comercio que provee el servicio
									WiFi a sus clientes, obtener un beneficio reciproco de que este lo utilice; ya que este para acceder
									al servicio debe ingresar con sus redes sociales y/o completar un formulario, para luego visualizar
									contenidos de publicidad que el comercio proveedor desee.
								  </p>
								  <p style="color: #000;" align="center">
								  	<strong>LEA CUIDADOSAMENTE LOS TÉRMINOS Y CONDICIONES DEL PRESENTE DOCUMENTO.</strong>
								  </p>
								  <p style="color: #000;">
								  	DESCRIPCION DEL SERVICIO
									<div align="justify" style="color: #000;">
										El usuario podrá conectarse a la Red Wi-fi Personalizada del CLIENTE-LOCAL. Para ello la red Wi-fi ofrecida, le dirigirá a la web de acceso del CLIENTE-LOCAL en la que se reflejarán esas condiciones generales y las formas de acceso a la conexión a Internet.

										Para poder acceder a la conexión a Internet se facilitarán dos opciones de acceso:
										<ul>
											<li>Mediante LOGIN en la red social Facebook y su aplicación <strong>AnalisisMarket</strong>.</li>
											<li>Mediante formulario de registro donde se señalarán unos datos como obligatorios.</li>
										</ul>
										La realización del registro implica el tratamiento de datos personales de los usuarios.

										Si el registro se realiza a través de Facebook se consultarán y tratarán: edad, lugar de procedencia, idioma así como el sistema operativo que se utilice para la conexión y la ubicación así como el tiempo empleado en la conexión. El registro mediante red social implicará la opción de ME GUSTA o CHECK IN en la red social.

										Si el registro se realiza mediante formulario se tratarán:
										El usuario deberá marcar la casilla HE LEIDO Y ACEPTO ESTOS TERMINOS Y CONDICIONES para poder acceder a la navegación, con ello presta su consentimiento para el tratamiento de sus datos.
									</div>
								  </p>

								  <p style="color: #000;">
								  	OBLIGACIONES DEL USUARIO
									<div align="justify" style="color: #000;">
										El usuario se compromete a facilitar datos veraces en el registro de acceso a la red wi-fi personalizada ofrecida por el LOCAL-CLIENTE, comprometiéndose a no facilitar datos de terceros. En caso de registro por correo electrónico puede realizar la modificación de sus datos en la siguiente dirección de correo electrónico: hola@wifan.ad

										El usuario se compromete a no utilizar el acceso wifi para realizar practicas contrarias a la ley, a la moral o al orden publico o aquellas que puedan ser lesivas de intereses de terceros.

										Con carácter enunciativo que no limitativo el usuario se compromete a no realizar conductas tales como:
										<ul>
											<li>Mal uso por parte de los usuarios de la conexión ofrecida por la red Wi-fi personalizada del cliente entendiéndose como tal con carácter enunciativo que no limitativo.</li>
											<li>El uso de programas de intercambio de archivos.</li>
											<li>Uso o descarga de programas por parte de usuarios que pueda producir la interrupción del servi
										cio.</li>

											<li>Descarga de ficheros que puedan contener virus.</li>
											<li>Páginas web con contenido pornográfico.</li>
											<li>Comisión de ciberdelitos.</li>
											<li>Hacking.</li>
										</ul>
										EL usuario será responsable de todo daño o perjuicio que cause a terceros.
									</div>
								  </p>
								  <p style="color: #000;">
								  	BAJA DE COMUNICACIONES COMERCIALES
									<div align="justify" style="color: #000;">
										Si el usuario quiere darse de baja de las comunicaciones comerciales relativas por correo electrónico, dispondrá de la opción de UNSUSCRIBE en cada correo electrónico recibido lo que implicará la cancelación de todos sus datos de los ficheros. Como medio alternativo se ofrece la siguiente dirección de correo electrónico:

										Si el usuario quiere dejar de recibir comunicaciones vía red social, debe cambiar el estado de ME GUSTA a NO ME GUSTA en su red social FACEBOOK.
									</div>
								  </p>
								</div>
								<div class="modal-footer">
								  <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
								</div>
							  </div>
							  
							</div>
						  </div>	
						<!-- End modal -->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"></script>
	<script type="text/javascript">
		function validateData(){
			nombre = document.getElementById("name").value;
			if( nombre == null || nombre.length == 0 || /^\s+$/.test(nombre) ) {
  				return false;
			}

			email = document.getElementById("campo").value;
			if( !(/\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)/.test(email)) ) {
  				return false;
			}	
		}
		
	</script>
</body>

</html>
