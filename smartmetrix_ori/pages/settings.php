<?php 
  session_start();

	include("../config/config.inc.php");
  include("../includes/class_application.php");
  include_once($WEB->apiFacebook."/vendor/autoload.php");
  include_once($WEB->apiInstagram.'/src/Instagram.php');

  //Sessions::sec_session_start();
  //$fb = new Facebook();

  /*use MetzWeb\Instagram\Instagram;
  // initialize class
  $instagram = new Instagram(array(
    'apiKey' => 'd111e1472bec4663b76b0251814cd9a8',
    'apiSecret' => '50ff1e70b1344e4f81fdeac38067ecc0',
    'apiCallback' => 'https://localhost/smartmetrix/pages/settings.php?type=instagram' // must point to success.php
  ));*/

  $fb = new Facebook\Facebook([
    'app_id' => '1711409385755467',
    'app_secret' => '3e51a13f207ef51765cf3bb249d9d690',
    'default_graph_version' => 'v2.5',
  ]);

  //$session = $fb->getSession();
  $app = Application::getInstance($WEB);
  $fb->setDefaultAccessToken($WEB->accessTokenFacebook);

  $helper = $fb->getJavaScriptHelper();

  if(isset($_GET["type"])){
    if($_GET["type"] == "instagram"){
      $_SESSION["ig_access_token"] = "";
      if(empty($_SESSION["ig_access_token"])){
        $code = $_GET['code'];  
        //echo $_SERVER["PHP_SELF"];
        //$_SESSION["ig_access_token"] = "799873284.d111e14.0173b45f0a234d6bac77b9dc3a290588";
        if (isset($code)) {
          // receive OAuth token object
          $data = $instagram->getOAuthToken($code, true);
          //var_dump($data);
          $instagram->setAccessToken($data);
          $_SESSION["ig_access_token"] = $data;
          recursiveGetDataInstagram('https://api.instagram.com/v1/users/self/media/recent?access_token='.$_SESSION["ig_access_token"].'&count=-1');
        } else {
          // check whether an error occurred
          if (isset($_GET['error'])) {
            echo 'An error occurred: ' . $_GET['error_description'];
          }
        }
      }else if($_GET["type"] == "pinterest"){
        if(empty($_SESSION["pi_access_token"])){
          $_SESSION["pi_access_token"] = $_GET["access_token"];
        }  
      }
    }
  }
  
  

  function recursiveGetDataInstagram($url){
    $follow_info = file_get_contents($url);

    //https://api.instagram.com/v1/users/self/feed?min_id=1178382781851588144_799873284
    //799873284.d111e14.230aa2b870a14c52a59242b6df6fede6
    $follow_info = @json_decode($follow_info, true);
    //var_dump($follow_info);  
    foreach($follow_info["data"] as $index=>$data){
      var_dump($data["id"]);
    }
    foreach($follow_info["pagination"] as $index=>$data){
      echo $min_id = $data;  
    }
    //echo $min_id;
    //recursiveGetDataInstagram('https://api.instagram.com/v1/users/self/media/recent?access_token='.$_SESSION["ig_access_token"]."&count=-1&min_id=".$min_id);
  }
  /*try {
    $accessToken = $helper->getAccessToken();
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }

  if (! isset($accessToken)) {
    echo 'No cookie set or no OAuth data could be obtained from cookie.';
    exit;
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
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Settings
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Settings</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo "Setting Account"; ?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1"><?php echo "Name Account:"; ?></label>
                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1"><?php echo "Language:"; ?></label>
                      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="English Example">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1"><?php echo "Country:"; ?></label>
                      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Mexico Example">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1"><?php echo "Email Notifications:"; ?></label>
                      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="test@admin.com Example">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1"><?php echo "Currency Symbol:"; ?></label>
                      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="$ Example">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1"><?php echo "Currency Format:"; ?></label>
                      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="AAAA-MM-DD Example">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1"><?php echo "Country:"; ?></label>
                      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    
                    <div class="checkbox">
                      <label>
                        <input type="checkbox"> Check me out
                      </label>
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->
            </div>



            <div class="col-md-4">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo "Setting Social Networks"; ?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-4 control-label"><?php echo "facebook:"; ?></label>
                      <div class="col-sm-8">
                        <div id="click_facebook">
                          <a class="btn btn-block btn-social btn-facebook">
                            <i class="fa fa-facebook"></i> <div id='content_facebook'>Sign in with Facebook</div>
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label"><?php echo "twitter:"; ?></label>
                      <div class="col-sm-8">
                        <a class="btn btn-block btn-social btn-twitter">
                          <i class="fa fa-twitter"></i> Sign in with Twitter
                        </a>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label"><?php echo "instagram:"; ?></label>
                      <div class="col-sm-8">
                         <div id="click_instagram">
                            <a class="btn btn-block btn-social btn-instagram">
                              <i class="fa fa-instagram"></i> Sign in with Instagram
                            </a>
                          </div>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label"><?php echo "pinterest:"; ?></label>
                      <div class="col-sm-8">
                        <div id="click_pinterest">
                          <a class="btn btn-block btn-social btn-google">
                            <i class="fa fa-pinterest"></i> Sign in with Pinterest
                          </a>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label"><?php echo "LinkedIn:"; ?></label>
                      <div class="col-sm-8">
                        <a class="btn btn-block btn-social btn-linkedin">
                          <i class="fa fa-linkedin"></i> Sign in with LinkedIn
                        </a>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label"><?php echo "YouTube:"; ?></label>
                      <div class="col-sm-8"> 
                        <a class="btn btn-block btn-social btn-google">
                          <i class="fa fa-youtube"></i> Sign in with YouTube
                        </a>
                      </div>
                    </div>

                  </div><!-- /.box-body -->
                </form>
              </div><!-- /.box -->
            </div>
            


            <div class="col-md-4">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo "Setting PayPal"; ?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      
                      <div class="col-sm-12">
                        <!-- PayPal Logo --><table border="0" cellpadding="10" cellspacing="0" align="center"><tr><td align="center"></td></tr><tr><td align="center"><a href="https://www.paypal.com/webapps/mpp/paypal-popup" title="How PayPal Works" onclick="javascript:window.open('https://www.paypal.com/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;"><img src="https://www.paypalobjects.com/webstatic/mktg/logo/bdg_now_accepting_pp_2line_w.png" border="0" alt="Now Accepting PayPal"></a><div style="text-align:center"><a href="https://www.paypal.com/webapps/mpp/how-paypal-works"><font size="2" face="Arial" color="#0079CD">How PayPal Works</font></a></div></td></tr></table><!-- PayPal Logo -->
                      </div>
                    </div>
                    


                  </div><!-- /.box-body -->
                </form>
              </div><!-- /.box -->
            </div>

            <img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/cc-badges-ppppcmcvdam.png" alt="Pay with PayPal, PayPal Credit or any major credit card" />



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
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <script src="<?php echo $WEB->assetsJSDirServ."/api_facebook.js"; ?>"></script>
    
  </body>
 </html>
