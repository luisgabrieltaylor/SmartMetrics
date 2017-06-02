<?php
if(isset($_GET["error"])){
	$error = $_GET["error"];
}

if(isset($_GET["success"])){
	$success = $_GET["success"];
}

define ("SERVER", "localhost");
define ("USER", "nasryarg_gb");
define ("PASSWORD", "GalaxyBowling2016");
define ("DATABASE", "nasryarg_gbCRM");

$link = mysql_connect(SERVER,
		 			  USER, 
		 			  PASSWORD) or die("ERROR CONNECT: ".mysql_error());
mysql_select_db(DATABASE, $link) or die ("ERROR SELECT_DB: ".mysql_error());
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="URF-8">
		<title>Concursos Selfies :: Juan Valdez</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script type="text/javascript"src="js/bootstrap.min.js"></script>
		<script src="js/fileinput.js" type="text/javascript"></script>
		<script src="js/photo-gallery.js" type="text/javascript"></script>
		<script>

  			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  			})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  			ga('create', 'UA-63343129-4', 'auto');

  			ga('send', {
           hitType: 'pageview',
            page: location.pathname
        });

        ga('send',{
          hitType: 'event',
          eventCategory: 'Views',
          eventAction: 'visto',
          eventLabel: 'Selfies Campaign'
        })

        ga('send', {
          hitType: 'social',
          socialNetwork: 'Facebook',
          socialAction: 'like',
          socialTarget: 'http://www.facebook.com/JuanValdezCafeElSalvador'
        });

        ga('send', {
          hitType: 'social',
          socialNetwork: 'Facebook',
          socialAction: 'share',
          socialTarget: 'http://www.facebook.com/JuanValdezCafeElSalvador'
        });
		</script>
	</head>
	<body>

		<div id="fb-root"></div>
			<script>(function(d, s, id) {
  				var js, fjs = d.getElementsByTagName(s)[0];
  				if (d.getElementById(id)) return;
  				js = d.createElement(s); js.id = id;
  				js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6&appId=1711409385755467";
  				fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
			</script>
			<div style="position: absolute; top: 155px">
			<div class="fb-like" data-href="http://inhousesv.com/photos/index.php?utm_source=http%3A%2F%2Finhousesv.com%2Fphotos%2Findex.php&amp;utm_medium=facebook&amp;utm_content=vaso%20gigante&amp;utm_campaign=selfies" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
			</div>


	<header id="main-header">
	<br>
	<br>
		<div align="center" style="top: 500px;"><img src="images/logo.png" /></div>
			<a id="logo-header" href="#">
			
		</a> <!-- / #logo-header -->
 
		<nav>
			<ul>
				<li><a href="#" data-toggle="modal" data-target="#uploadPhoto" id="fontUpload">Subir Foto</a></li>
				<li><a href="#" data-toggle="modal" data-target="#aboutDialog" id="fontAbout">Acerca de</a></li>
			</ul>
		</nav><!-- / nav -->
 
	</header><!-- / #main-header -->
	<?php
	if(!empty($error))
	{
	?>
	<div class="alert alert-danger" role="alert"><?=$error;?></div>
	<?php
	}
	?>
	<?php
	if(!empty($success))
	{
	?>
	<div class="alert alert-success" role="alert"><?=$success;?></div>
	<?php
	}
	?>
	<div id="wrapper">
	<div id="columns">
		<?php

    $random[0] = 22;
    $random[1] = 7;
    $random[2] = 16;
    $random[3] = 24;
    $random[4] = 6;

			$sql = "SELECT * FROM jv_photos WHERE jv_Status = 'A' ORDER BY jv_DateTime DESC";
			$resp = mysql_query($sql, $link);
			while($row = mysql_fetch_array($resp)){
        if($random[0] == $row[0]){
          echo "<div class='pin' id='winner'>";
          echo "<img src='".$row[1]."' />";
          echo "<p id='_name'><strong>".$row[3]."</strong></p><p>".$row[2]."</p>";
          echo "</div>";
        }elseif($random[1] == $row[0]){
          echo "<div class='pin' id='winner'>";
          echo "<img src='".$row[1]."' />";
          echo "<p id='_name'><strong>".$row[3]."</strong></p><p>".$row[2]."</p>";
          echo "</div>";
        }elseif($random[2] == $row[0]){
          echo "<div class='pin' id='winner'>";
          echo "<img src='".$row[1]."' />";
          echo "<p id='_name'><strong>".$row[3]."</strong></p><p>".$row[2]."</p>";
          echo "</div>";
        }elseif($random[3] == $row[0]){
          echo "<div class='pin' id='winner'>";
          echo "<img src='".$row[1]."' />";
          echo "<p id='_name'><strong>".$row[3]."</strong></p><p>".$row[2]."</p>";
          echo "</div>";
        }elseif($random[4] == $row[0]){
          echo "<div class='pin' id='winner'>";
          echo "<img src='".$row[1]."' />";
          echo "<p id='_name'><strong>".$row[3]."</strong></p><p>".$row[2]."</p>";
          echo "</div>";
        }
        else
        {
          echo "<div class='pin'>";
          echo "<img src='".$row[1]."' />";
          echo "<p id='_name'><strong>".$row[3]."</strong></p><p>".$row[2]."</p>";
          echo "</div>";
        }

				
			}
		?>
	</div>
	</div>

<div class="modal fade" id="mainDialog" tabindex="-1" role="dialog" aria-labelledby="mainDialogLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body" align="center"> 
          	<img src="images/Post-Dinamica-Web.jpg" width="100%" height="100%" /><br><br>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->	


<div class="modal fade" id="aboutDialog" tabindex="-1" role="dialog" aria-labelledby="aboutDialogLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
        	<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="aboutDialogLabel">Acerca de</h4>
      		</div>         
          <div class="modal-body" align="center"> 
          	<img src="images/logoJPG.jpg" /><br><br>
          	<p><div align="left">Aplicaci&oacute;n desarrollada por ProacIT S.A. de C.V.</div></p>
          	<p><div align="left"><strong>Soporte:  jslaraestudillo@gmail.com, lahernandezr@outlook.com</strong></div></p>
          	
          	<p><div align="left"><strong>Horarios de atenci&oacute;n: Lunes a Domingo/24H.</strong></div></p>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->	

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">         
          <div class="modal-body" align="center">                
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->	

<!-- Modal -->
<div class="modal fade" id="uploadPhoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Subir Foto</h4>
      </div>
      <div class="modal-body">
      <form action="upload.php" method="post" enctype="multipart/form-data" name="formularioFoto" id="formularioFoto">
        <div class="col-lg-12 col-sm-12 col-12">
            <div class="input-group">
                <label class="input-group-btn">
                    <span class="btn btn-primary">
                        Buscar Archivo&hellip; <input accept="images/*" type="file" style="display: none;" name="fotografia" capture>
                    </span>
                </label>
                <input type="text" class="form-control" readonly>
               
            </div>
            <div class="form-group">
            	<label for="email">Nombre Completo:</label>
    			<input type="textarea" class="form-control" id="nombre" name="nombre">
    			<label for="email">Correo Electr&oacute;nico:</label>
    			<input type="textarea" class="form-control" id="correo" name="correo">
    			<label for="email">Descripci&oacute;n:</label>
    			<input type="textarea" class="form-control" id="descripcion" style="height: 80px;" name="descripcion">
  			</div>
            <span class="help-block">
                Intenta seleccionar un archivo .png o .jpg.
            </span>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="guardar">Guardar Foto</button>
      </div>
    </div>
  </div>
</div>
	
	<script type="text/javascript">
	    $('#mainDialog').modal('show');

		$('#guardar').click(function () {
  			$('#formularioFoto').submit();	
		});

		$(document).on('change', ':file', function() {
    		var input = $(this),
        	numFiles = input.get(0).files ? input.get(0).files.length : 1, label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    		input.trigger('fileselect', [numFiles, label]);
  		});

  		// We can watch for our custom `fileselect` event like this
  	
      	$(':file').on('fileselect', function(event, numFiles, label) {
         	 var input = $(this).parents('.input-group').find(':text'),
              	log = numFiles > 1 ? numFiles + ' files selected' : label;

          	if( input.length ) {
              	input.val(log);
          	} else {
              	if( log ) alert(log);
          	}
      	});

      	
      	
  	
	</script>


	</body>
</html>