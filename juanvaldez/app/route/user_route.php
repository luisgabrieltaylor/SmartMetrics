<?php
use App\Model\UserModel;

$app->group('/user/', function () {
    
    $this->get('test', function ($req, $res, $args) {
        return $res->getBody()
                   ->write('Hello Users');
    });

    $this->get('getAll/{id}', function ($req, $res, $args) {
        $um = new UserModel();
        
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->GetAll($args['id'])
            )
        );
    });

    $this->get('generateApiKey', function ($req, $res, $args) {
        $um = new UserModel();
        
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->generateApiKey(
                    $req->getParsedBody()
                )
            )
        );
    });

    $this->post('save', function ($req, $res) {
        $um = new UserModel();
        
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->InsertOrUpdate(
                    $req->getParsedBody()
                )
            )
        );
    });
    
    
});