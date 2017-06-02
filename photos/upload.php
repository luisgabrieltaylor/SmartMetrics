<?php

/*define ("SERVER", "localhost");
define ("USER", "nasryarg_gb");
define ("PASSWORD", "GalaxyBowling2016");
define ("DATABASE", "nasryarg_gbCRM");*/

define ("SERVER", "localhost");
define ("USER", "nasryarg_gb");
define ("PASSWORD", "GalaxyBowling2016");
define ("DATABASE", "nasryarg_gbCRM");


$link = mysql_connect(SERVER,
		 			  USER, 
		 			  PASSWORD) or die("ERROR CONNECT: ".mysql_error());
mysql_select_db(DATABASE, $link) or die ("ERROR SELECT_DB: ".mysql_error());

if($_POST["descripcion"]){
	$descripcion = $_POST["descripcion"];
}

if($_POST["nombre"]){
    $nombre = $_POST["nombre"];
}

if($_POST["correo"]){
    $email = $_POST["correo"];
}

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fotografia"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fotografia"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $error = "Lo sentimos, la foto no es una imagen.";
        //header("Location: index.php?error=");
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    $error = "Lo sentimos, la foto que intentas subir ya existe.";
    //header("Location: index.php?error=".$error);
    $uploadOk = 0;
}
// Check file size
/*if ($_FILES["fotografia"]["size"] > 5000000) {
    $error = "Lo sentimos, la foto que intentas subir es demasiado grande.";
	header("Location: index.php?error=".$error);
    $uploadOk = 0;
}*/
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG"
&& $imageFileType != "GIF") {
    $error = "Lo sentimos, solamente fotos JPG, JPEG, PNG & GIF son permitidos.";
	//header("Location: index.php?error=".$error);
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	header("Location: index.php?error=".$error);
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fotografia"]["tmp_name"], $target_file)) {
    	$sql = "INSERT INTO jv_photos(jv_image, jv_comment, jv_Nombre, jv_Email, jv_DateTime, jv_Status) VALUES('".$target_file."','".$descripcion."','".$nombre."','".$email."',NOW(),'N')";
    	mysql_query($sql, $link) or die(mysql_error());
    	header("Location: index.php?success=Felicidades!!! Tu foto ha sido cargada exitosamente, Gracias por tu participacion. Tu imagen sera revisada por el moderador antes de ser publicada.");
    } else {
    	header("Location: index.php?error=Lo sentimos, hay un error al cargar tu foto..");
    }
}
?>