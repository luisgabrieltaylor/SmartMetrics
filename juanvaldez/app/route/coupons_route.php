<?php
use App\Model\CouponsModel;

$app->get("/coupons/getall", function($req, $res, $args){
  $sth = $this->db->prepare("SELECT * FROM jv_coupons");
  $sth->execute();
  $todos = $sth->fetchAll();
  return $this->response->withJson($todos);
});


/*==============================================================================*/
/*      USUARIOS     */
$app->post("/users/add", function($req, $res) use ($app){

  verifyRequiredParams(array("Name", "Password", "Email", "Method", "Cellphone", "Gender", "DateTime", "Status", "Birthday", "GCMRegistration"));

  $input = $req->getParsedBody();
  $userData = [];
  $userData["Name"]      = filter_var($input['Name'], FILTER_SANITIZE_STRING);
  $userData["Password"]  = filter_var($input['Password'], FILTER_SANITIZE_STRING);
  $userData["Email"]     = filter_var($input['Email'], FILTER_SANITIZE_STRING);
  $userData["Method"]    = filter_var($input['Method'], FILTER_SANITIZE_STRING);
  $userData["Cellphone"] = filter_var($input['Cellphone'], FILTER_SANITIZE_STRING);
  $userData["Gender"]    = filter_var($input['Gender'], FILTER_SANITIZE_STRING);
  $userData["DateTime"]  = filter_var($input['DateTime'], FILTER_SANITIZE_STRING);
  $userData["Status"]    = filter_var($input['Status'], FILTER_SANITIZE_STRING);
  $userData["Birthday"]  = filter_var($input['Birthday'], FILTER_SANITIZE_STRING);
  $userData["GCMRegistration"]  = filter_var($input['GCMRegistration'], FILTER_SANITIZE_STRING);
  
  //$arrRtn['token'] = bin2hex(openssl_random_pseudo_bytes(16)); //generate a random token

  $sql = "INSERT INTO jv_users (jv_UserName, jv_Password, jv_Email, jv_Method, jv_Cellphone, jv_Gender, jv_DateTime, jv_Status, jv_Birthday) 
            VALUES (:Name, :Password, :Email, :Method, :Cellphone, :Gender, :Fecha, :Status, :Birthday)";
  $sth = $this->db->prepare($sql);
  //================================================================
  $sth->bindParam(":Name", $userData['Name']);
  $sth->bindParam(":Password", $userData['Password']);
  $sth->bindParam(":Email", $userData['Email']);
  $sth->bindParam(":Method", $userData['Method']);
  $sth->bindParam(":Cellphone", $userData['Cellphone']);
  $sth->bindParam(":Gender", $userData['Gender']);
  $sth->bindParam(":Fecha", $userData['DateTime']);
  $sth->bindParam(":Status", $userData['Status']);
  $sth->bindParam(":Birthday", $userData['Birthday']);
  //$sth->bindParam(":Token", $arrRtn['token']);

  //================================================================
  $sth->execute();
  $input['id'] = $this->db->lastInsertId();
  return $this->response->withJson($input, 200);
  
});


$app->post("/users/login", function($req, $res) use($app){

  verifyRequiredParams(array("UserName", "Password"));

  $input = $req->getParsedBody();
  $userData = [];

  $userData["user"] = filter_var($input['UserName'], FILTER_SANITIZE_STRING);
  $userData["pass"] = filter_var($input['Password'], FILTER_SANITIZE_STRING);

  //validateEmail($userData["user"]);

  $sth = $this->db->prepare("SELECT * FROM jv_users WHERE jv_Email = '".$userData["user"]."' AND jv_Password = '".$userData["pass"]."' AND jv_Status = 'A'");

  $sth->execute();
  $todos = $sth->fetchAll();

  $respuesta = array();
  if($sth->rowCount() > 0)
  {
    foreach($todos as $data){
      array_push($respuesta, ["error" => false, 
                            "status" => 200, 
                            "msg" => "Logueado con exito!",
                            "Id" => $data["jv_Id"],
                            "Name" => $data["jv_UserName"],
                            "Email" => $data["jv_Email"],
                            "Gender" => $data["jv_Gender"],
                            "Age" => $data["jv_Age"],
                            "Birthday" => $data["jv_Birthday"],
                            "Cellphone"=> $data["jv_Cellphone"]]);  
    }
  }else
  {
    array_push($respuesta, ["error" => true, 
                            "status" => 300, 
                            "msg" => "Ha ocurrido un error con la autenticación, intentelo más tarde."]); 
  }

  echo json_encode($respuesta);

});


/**
 * Verifying required params posted or not
 */
function verifyRequiredParams($required_fields) {
    $error = false;
    $error_fields = "";
    $request_params = array();
    $request_params = $_REQUEST;
    // Handling PUT request params
    if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
        $app = \Slim\Slim::getInstance();
        parse_str($app->request()->getBody(), $request_params);
    }
    foreach ($required_fields as $field) {
        if (!isset($request_params[$field]) || strlen(trim($request_params[$field])) <= 0) {
            $error = true;
            $error_fields .= $field . ', ';
        }
    }

    if ($error) {
        // Required field(s) are missing or empty
        // echo error json and stop the app
        $response = array();
        $app = \Slim\Slim::getInstance();
        $response["error"] = true;
        $response["message"] = 'Required field(s) ' . substr($error_fields, 0, -2) . ' is missing or empty';
        echoRespnse(400, $response);
        $app->stop();
    }
}

function validateEmail($email) {
    $app = \Slim\Slim::getInstance();
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response["error"] = true;
        $response["status"] = 400;
        $response["msg"] = 'Email address is not valid';
        echoRespnse(400, $response);
        $app->stop();
    }
}

function echoRespnse($status_code, $response) {
    $app = \Slim\Slim::getInstance();
    // Http response code
    $app->status($status_code);

    // setting response content type to json
    $app->contentType('application/json');

    echo json_encode($response);
}


?>