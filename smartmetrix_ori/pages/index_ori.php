<?php 
	require_once("../config/config.inc.php");
	require_once("../includes/class_application.php");
  //include_once($WEB->apiFacebook."/vendor/autoload.php");

  session_start();
	$app = Application::getInstance();

  /*$fb = new Facebook\Facebook([
    'app_id' => '1711409385755467',
    'app_secret' => '3e51a13f207ef51765cf3bb249d9d690',
    'default_graph_version' => 'v2.5',
  ]);

  $helper = $fb->getJavaScriptHelper();
  $fb->setDefaultAccessToken($WEB->accessTokenFacebook);

  try {
    $accessToken = $helper->getAccessToken();
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    //echo 'Graph returned an error: ' . $e->getMessage();
    //exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    //echo 'Facebook SDK returned an error: ' . $e->getMessage();
    //exit;
  }

  if (! isset($accessToken)) {
    header("Location: settings.php");
    //echo 'No cookie set or no OAuth data could be obtained from cookie.';
    //exit;
  }

  $_SESSION['fb_access_token'] = (string) $accessToken;*/


?>
<!DOCTYPE html>
<html>
  	<head>
  	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $WEB->titulo; ?></title>

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
    <link rel="stylesheet" href="<?php echo $WEB->distCSSDirServ."/skins/_all-skins.min.css";?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo $WEB->pluginsDirServ."/iCheck/flat/blue.css";?>">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo $WEB->pluginsDirServ."/morris/morris.css";?>">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo $WEB->pluginsDirServ."/jvectormap/jquery-jvectormap-1.2.2.css";?>">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo $WEB->pluginsDirServ."/datepicker/datepicker3.css";?>">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo $WEB->pluginsDirServ."/daterangepicker/daterangepicker-bs3.css";?>">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo $WEB->pluginsDirServ."/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css";?>">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

   
  	</head>
  	<body class="hold-transition skin-blue sidebar-mini">
    
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>s</b>MX</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>smart</b>MetriX</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <?php 
        	echo $app->topNavigationBar(); 
        ?>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <?php echo $app->leftNavigationBar(); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="height: 700px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            
            <div class="col-xs-12">
              
                
                  <?php
                    if (isset($accessToken)) {
                      ?>
                        <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                          <li class="active"><a href="#fa_data" data-toggle="tab">facebook</a></li>
                          <?php
                          if(!empty($_SESSION["ig_access_token"])){
                            ?>
                            <li><a href="#ig_data" data-toggle="tab">instagram</a></li>
                            <?php
                          }
                          if(!empty($_SESSION["pi_access_token"])){
                            ?>
                            <li><a href="#pi_data" data-toggle="tab">pinterest</a></li>
                            <?php
                          }
                          ?>
                        </ul>
                        <div class="tab-content">
                        <!-- Font Awesome Icons -->
                          <div class="tab-pane active" id="fa_data">
                            <section id="new">
                              <p>
                              <div class='row'>
                                <div class="col-xs-8">
                                <div class="margin">
                                  <div class="btn-group">
                                    <select class="form-control select2" id='list_pages' style="width: 100%;">
                                      <div = "id_loading">
                                        <div class="overlay">
                                          <i class="fa fa-refresh fa-spin"></i>
                                        </div>
                                      </div>
                                    </select>
                                  </div>
                                </div>
                                </div>

                                <div class="col-xs-4">
                                <div class="margin">
                                  <div class="input-group">
                                    <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="reservation">
                                  </div><!-- /.input group -->
                                </div>
                                </div>
                              </div>
                                
                              <div class="row">
                                <div class="box box-primary">
                                  
                                  <div class="col-xs-4"><h3>People</h3>
                                    <div class="box-body">
                                      <h1>
                                        <div id="gender_facebook">
                                        </div>
                                        <small id="subtext_facebook"></small>
                                      </h1>  

                                      <h1>
                                        <div id="devices_facebook">
                                        Mobile Devices
                                        </div>
                                        <small id="subtext_devices_facebook">Most Common Device</small>
                                      </h1>
                                    </div>
                                  </div>
                                  
                                  <div class="col-xs-4"><h3>AVG. Reach</h3>
                                    <div class="box-body">
                                      <h1>
                                        <div id="reach_facebook">
                                        </div>
                                        <small id="subtext_reach_facebook">People reached</small>
                                      </h1>

                                      <h1>
                                        <div id="postengagement_facebook">
                                          3,465
                                        </div>
                                        <small id="subtext_engagement_facebook">Post Engagement</small>
                                      </h1>  
                                    </div>
                                  </div>
                                  
                                  <div class="col-xs-4"><h3>Total Page Likes</h3>
                                    <div class="box-body">
                                      <h1>
                                        <div id="likes_facebook">
                                        </div>
                                        <small id="subtext_likes_facebook">Page likes</small>
                                      </h1>
                                    </div>
                                  </div>
                                </div>
                              </div>
                                
                                <div class="row">
                                  <div class="col-xs-2">
                                    <div class="box box-primary">
                                      <div class="box-header with-border">
                                        <h3 class="box-title">Total Post</h3>
                                        <div class="box-tools pull-right">
                                          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                          <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                        </div>
                                      </div>
                                      <div class="box-body">
                                        <div class="chart">
                                          <h1><div id="total_posts_facebook" style="font-size:54px;" class="text-center"></div></h1>
                                          <small><div id="subtext_total_post"></div></small>
                                        </div>
                                      </div><!-- /.box-body -->
                                    </div><!-- /.box -->
                                  </div>

                                  <div class="col-xs-5">
                                    <div class="box box-primary">
                                      <div class="box-header with-border">
                                        <h3 class="box-title">Type Posts</h3>
                                        <div class="box-tools pull-right">
                                          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                          <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                        </div>
                                      </div>
                                      <div class="box-body">
                                        <div class="chart">
                                          <div id="graph_type_posts" style="width: auto; height: height: 300px;"></div>
                                          <!--<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>-->
                                        </div>
                                      </div><!-- /.box-body -->
                                    </div><!-- /.box -->
                                  </div>

                                  <div class="col-xs-5">
                                    <div class="box box-primary">
                                      <div class="box-header with-border">
                                        <h3 class="box-title">Posts by Days</h3>
                                        <div class="box-tools pull-right">
                                          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                          <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                        </div>
                                      </div>
                                      <div class="box-body">
                                        <div class="chart">
                                          <div id="graph_days_posts" style="width: auto; height: auto;"></div>
                                        </div>
                                      </div><!-- /.box-body -->
                                    </div><!-- /.box -->
                                  </div>


                                </div>

                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="box box-primary">
                                      <div class="box-header with-border">
                                        <h3 class="box-title">Total Post</h3>
                                        <div class="box-tools pull-right">
                                          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                          <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                        </div>
                                      </div>
                                      <div class="box-body" id="ids_tops_posts">
                                     
                                      </div>
                                    </div><!-- /.box -->
                                  <!-- Widget: user widget style 1 -->
                                  </div><!-- /.col -->
                                </div>
                                
                                <br><br><br><br><br><br><br><br><br><br><br><br>
                              </p>
                            </section>
                          </div><!-- /.info-box -->

                                     
                              <!--<div  id="container_facebook" style="width: 600px;">
                                
                              </div>
                              <div  id="container_facebook" style="width: 600px;">
                                
                              </div>-->
                            
                        <!--<li><a href="#glyphicons" data-toggle="tab">Glyphicons</a></li>-->
                      <?php 
                    }
                  ?>
                  
                  <div class="tab-pane active" id="ig_data"></div>
                  <div class="tab-pane active" id="pi_data"></div>
                </div>
              </div>
            </div>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version </b> 2.3.0
        </div>
        <strong><?=$WEB->copyright; ?>
      </footer>

      
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->
    
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo $WEB->pluginsDirServ."/jQuery/jQuery-2.1.4.min.js"; ?>"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo $WEB->assetsJSDirServ."/bootstrap.min.js"; ?>"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="<?php echo $WEB->pluginsDirServ."/morris/morris.min.js"; ?>"></script>
    <!-- Sparkline -->
    <script src="<?php echo $WEB->pluginsDirServ."/sparkline/jquery.sparkline.min.js"; ?>"></script>
    <!-- jvectormap -->
    <script src="<?php echo $WEB->pluginsDirServ."/jvectormap/jquery-jvectormap-1.2.2.min.js"; ?>"></script>
    <script src="<?php echo $WEB->pluginsDirServ."/jvectormap/jquery-jvectormap-world-mill-en.js"; ?>"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo $WEB->pluginsDirServ."/knob/jquery.knob.js"; ?>"></script>
    <!-- Inputs -->
    <script src="<?php echo $WEB->pluginsDirServ."/input-mask/jquery.inputmask.js"; ?>"></script>
    <script src="<?php echo $WEB->pluginsDirServ."/input-mask/jquery.inputmask.date.extensions.js"; ?>"></script>
    <script src="<?php echo $WEB->pluginsDirServ."/input-mask/jquery.inputmask.extensions.js"; ?>"></script>
    
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="<?php echo $WEB->pluginsDirServ."/daterangepicker/daterangepicker.js"; ?>"></script>
    <!-- datepicker -->
    <script src="<?php echo $WEB->pluginsDirServ."/datepicker/bootstrap-datepicker.js"; ?>"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo $WEB->pluginsDirServ."/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"; ?>"></script>
    <!-- Slimscroll -->
    <script src="<?php echo $WEB->pluginsDirServ."/slimScroll/jquery.slimscroll.min.js"; ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo $WEB->pluginsDirServ."/fastclick/fastclick.min.js"; ?>"></script>
    <!-- AdminLTE App -->

    <script src="<?php echo $WEB->distJSDirServ."/app.min.js"; ?>"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo $WEB->distJSDirServ."/pages/dashboard.js"; ?>"></script>
    <script src="<?php echo $WEB->assetsJSDirServ."/api_facebook.js"; ?>"></script>
    
    
    <!-- Para cargar la API de graficas de google -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- Para cargar las graficas de higcharts -->
    
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="<?php echo $WEB->distJSDirServ."/demo.js"; ?>"></script>

    
    <!-- AdminLTE for demo purposes -->
    

  </body>
 </html>





