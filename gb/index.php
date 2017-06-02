<html>
<head>
<title>Promocion Cumpleaños</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style>
body {
  /* Location of the image */
  
  
  /* Image is centered vertically and horizontally at all times */
  background-position: center center;
  
  /* Image doesn't repeat */
  background-repeat: no-repeat;
  
  /* Makes the image fixed in the viewport so that it doesn't move when 
     the content height is greater than the image height */
  background-attachment: fixed;
  
  /* This is what makes the background image rescale based on its container's size */
  background-size: cover;
  
  /* Pick a solid background color that will be displayed while the background image is loading */
  background-color:#000;
  
  /* SHORTHAND CSS NOTATION
   * background: url(background-photo.jpg) center center cover no-repeat fixed;
   */
}

.centrar
  {
    position: absolute;
    /*nos posicionamos en el centro del navegador*/
    top:50%;
    left:50%;
    /*determinamos una anchura*/
    width:600px;
    /*indicamos que el margen izquierdo, es la mitad de la anchura*/
    margin-left:-300px;
    /*determinamos una altura*/
    height:311px;
    /*indicamos que el margen superior, es la mitad de la altura*/
    margin-top:-155px;
    
    padding:5px;
  }


  .centrar_2
  {
    position: absolute;
    /*nos posicionamos en el centro del navegador*/
    top:115%;
    left:50%;
    /*determinamos una anchura*/
    width:1275px;
    /*indicamos que el margen izquierdo, es la mitad de la anchura*/
    margin-left:-637px;
    /*determinamos una altura*/
    height:1650px;
    /*indicamos que el margen superior, es la mitad de la altura*/
    margin-top:-825px;
    
    padding:5px;
  }

  .centrar_3
  {
    position: absolute;
    /*nos posicionamos en el centro del navegador*/
    top:50%;
    left:50%;
    /*determinamos una anchura*/
    width:505px;
    /*indicamos que el margen izquierdo, es la mitad de la anchura*/
    margin-left:-300px;
    /*determinamos una altura*/
    height:768px;
    /*indicamos que el margen superior, es la mitad de la altura*/
    margin-top:-550px;
    
    padding:5px;
  }

  @font-face {
    font-family: "CodeFont";
    font-style: normal;
    font-weight: normal;
    src: local("?"), url("fonts/big_noodle_titling.wof") format("wof"), url("fonts/big_noodle_titling.ttf") format("truetype");
  }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="md5.js"></script>
<script type="text/javascript">
  var dispositivo = navigator.userAgent.toLowerCase();
    
</script>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?php include_once("analiticstracking.php"); ?>

<script>
  // This is called with the results from from FB.getLoginStatus().

  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '1711409385755467',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.5' // use graph api version 2.5
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me?fields=id,name,email,gender,birthday', function(response) {
      //alert(JSON.stringify(response));
      var md5_code;
      md5_code = hex_md5(response.email);
      $("#code_complete").html("<h1>" + md5_code.substring(1,7).toUpperCase() + "</h1>");
      $("#table_login").hide();
      if( dispositivo.search(/iphone|ipod|ipad|android/) <= -1 ){
        $("#table_promotion").show();
      }else{
        $("#table_mobile").show();
        $("#code_complete_mobile").html("<h1>" + md5_code.substring(1,7).toUpperCase() + "</h1>");
      }
      

      $.get("save_data_facebook.php",{ id:response.id, name: response.name, email: response.email, gender: response.gender, code: md5_code, birthday: response.birthday}, function(data){
        console.log(data);
      });
      /*console.log('Successful login for: ' + response);

      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';*/
    });
  }
</script>
<!-- Save for Web Slices (LoggInFBOffer (2).psd) -->
<div id="table_login">
  <table id="Tabla_01" width="600" height="311" border="0" cellpadding="0" cellspacing="0" class="centrar">
	 <tr>
		<td colspan="3">
			<img src="imagenes/LoggInFBOffer_01.png" width="600" height="200" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="imagenes/LoggInFBOffer_02.png" width="210" height="111" alt=""></td>
		<td height="35" style="background-image: url('imagenes/LoggInFBOffer_03.png');">
			
      <fb:login-button scope="public_profile,email" onlogin="checkLoginState();" data-size="large">Ingresa con Facebook</fb:login-button>
    </td>
		<td rowspan="2">
			<img src="imagenes/LoggInFBOffer_04.png" width="211" height="111" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="imagenes/LoggInFBOffer_05.png" width="179" height="76" alt=""></td>
	</tr>
  </table>
</div>

<div id="table_promotion" style="display:none;" class="centrar_2">
<table id="Tabla_02" width="1275" height="1650" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3">
      <img src="imagenes/50off_01.jpg" width="1275" height="275" alt=""></td>
  </tr>
  <tr>
    <td rowspan="2">
      <img src="imagenes/50off_02.jpg" width="11" height="1375" alt=""></td>
    <td height="65" style="background-image: url('imagenes/50off_03.png');" align="center">
      <div id="code" border="1">
      
        <div border="1" id="code_complete" style="position: absolute; font-family: codeFont; font-size: 26px; top: 250px; left: 120px;"></div>
      </div>
    </td>
    <td rowspan="2">
      <img src="imagenes/50off_04.jpg" width="916" height="1375" alt=""></td>
  </tr>
  <tr>
    <td>
      <img src="imagenes/50off_05.jpg" width="348" height="1310" alt=""></td>
  </tr>
</table>
</div>

<div id="table_mobile" style="display:none;">
<table id="Tabla_03" width="505" height="768" border="0" cellpadding="0" cellspacing="0" class="centrar_3">
  <tr>
    <td colspan="3">
      <img src="imagenes/50_mobile_off_01.png" width="505" height="146" alt=""></td>
  </tr>
  <tr>
    <td rowspan="2">
      <img src="imagenes/50_mobile_off_02.png" width="7" height="622" alt=""></td>
    <td style="background-image: url('imagenes/50_mobile_off_03.png')" align="center">

      <div id="code_mobile" style="padding: 0 0 0 0;" >
        <div id="code_complete_mobile" style="font-family: codeFont; font-size: 8px; position: relative;"></div>
      </div>
      </td>
    <td rowspan="2">
      <img src="imagenes/50_mobile_off_04.png" width="348" height="622" alt=""></td>
  </tr>
  <tr>
    <td>
      <img src="imagenes/50_mobile_off_05.png" width="150" height="596" alt=""></td>
  </tr>
</table>
</div>



<!-- End Save for Web Slices -->
</body>
</html>