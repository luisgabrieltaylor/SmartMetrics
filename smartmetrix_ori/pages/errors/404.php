<?php

  require_once("../../config/config.inc.php");
  require_once($WEB->includesDir."/class_sessions.php");

  Sessions::sec_session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | 404 Page not found</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo $WEB->assetsCSSDirServ."/bootstrap.min.css";?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $WEB->distCSSDirServ."/AdminLTE.min.css";?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo $WEB->distCSSDirServ."/skins/_all-skins.min.css"; ?> ">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    
  <div id="logo" class="hoverButton">
    <a href="/">
      <img class="hover" src="/img/logo_hover.png" width="98" height="23" />
      <img src="/img/logo.png" width="98" height="23" />
    </a>
  </div>

  <div id="mWrapper">
    <img class="fullScreen" src="/errorPages/img/404.jpg" width="1200" height="800" alt="error 404 - file not found">
  </div>
  
  
    <a class="h2" href="/">Ooops!</a>
    <a class="p"  href="/"><strong>Error 404</strong> – the page you are looking for doesn't exist.</a>
  </body>
</html>
