<?php
if(!session_id()) {
    session_start();
}
?>
<html>
<head>
<meta charset="UTF-8">
</head>
<?php
define('FACEBOOK_SDK_V4_SRC_DIR', __DIR__ . '/Facebook/');
require_once __DIR__ . '/Facebook/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '1577747375852865',
  'app_secret' => '6e653267ed9ba416cf42bd92835540b8',
  'default_graph_version' => 'v2.5',
  'persistent_data_handler'=>'session',
]);
$mac = $_GET["mac"];
$url = $_GET["uri"];
$_SESSION['FBRLH_state']=$_GET['state'];
$helper = $fb->getRedirectLoginHelper();

try {
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

if (isset($accessToken)) {
  // Logged in!
  $_SESSION['facebook_access_token'] = (string) $accessToken;
}elseif ( $helper->getError() ) {
 
  // The user denied the request
  // You could log this data . . .
  var_dump( $helper->getError() );
  var_dump( $helper->getErrorCode() );
  var_dump( $helper->getErrorReason() );
  var_dump( $helper->getErrorDescription() );
 
  // You could display a message to the user
  // being all like, "What? You don't like me?"
  http_response_code(400);
  exit;
}

/*try {
      
      $linkData = [
        'link' => 'http://www.desarrollolibre.net/blog/tema/50/html/uso-basico-del-canvas',
        'message' => "Hola Mundo",
      ];
      $fb->post('/feed', $linkData, $_SESSION['facebook_access_token']);
        
    } catch (Facebook\Exceptions\FacebookResponseException $e) {
      // When Graph returns an error
      echo 'Graph returned an error: ' . $e->getMessage();
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
      // When validation fails or other local issues
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
    }*/


try {
  // Returns a `Facebook\FacebookResponse` object
    $response = $fb->get('/me?fields=id,name,email,gender, first_name, last_name, age_range', $_SESSION['facebook_access_token']);
    //$response = $fb->get('/me?fields=id,name,email,location,birthday, currency, gender, first_name, last_name, middle_name, relationship_status, website, age_range', $_SESSION['facebook_access_token']);


    $user = $response->getGraphObject();
    $id_fb = $user->getProperty( 'id' );
    $name_fb = $user->getProperty( 'name' );
    $email_fb = $user->getProperty( 'email' );
    //$birthday_fb = $user->getProperty( 'birthday' )->format("Y-m-d");
    //$location_fb = $user->getProperty( 'location' );
    //$direccion = explode( ',', $location_fb['name']);
    //$municipio = $direccion[0];
    //$estado = $direccion[1];
    //$pais = $direccion[2];

    //$currency_fb = $user->getProperty( 'currency' )."<br>";
    $gender_fb = $user->getProperty( 'gender' );
    $firstname_fb = $user->getProperty( 'first_name' );
    $lastname_fb = $user->getProperty( 'last_name' );
    //$middle_fb = $user->getProperty( 'middle_name' )."<br>";
    //$relationship_fb = $user->getProperty( 'relationship_status' )."<br>";
    //$website_fb = $user->getProperty( 'website' )."<br>";
    $age = $user->getProperty( 'age_range' );
// 123
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }
  session_write_close();
?>
<script src="js/jquery.js"></script>
<script src="js/browser.js"></script>
<script type='text/javascript'>
   
      var fb_Id         = "<?php echo $id_fb; ?>";
      var fb_Name       = "<?php echo $name_fb; ?>";
      var fb_Email      = "<?php echo $email_fb; ?>";
      var fb_LastName   = "<?php echo $lastname_fb; ?>";
      var fb_Age        = "<?php echo $age; ?>";
      var fb_Gender     = "<?php echo $gender_fb; ?>";
      fb_Name += " " + fb_LastName;
     
      var mac           = "<?php echo $mac; ?>";
      var url           = "<?php echo $url; ?>";
      $.post( "php/connectme.php", { id_fb:fb_Id, 
                                      name: fb_Name, 
                                      email: fb_Email,  
                                      mac: mac, 
                                      url: url, 
                                      idhotspot:1, 
                                      age:fb_Age, 
                                      gender:fb_Gender }, function(response){
          window.location = "http://hotspot.localnet/test.php?mac="+mac+"&active=yes";
      } );

     
    </script>
</html>