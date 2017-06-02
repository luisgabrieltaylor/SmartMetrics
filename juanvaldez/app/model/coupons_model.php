<?php

namespace App\Model;

use App\Lib\Database;
use App\Lib\Response;

if(!defined("SPECIALCONSTANT")) die ("Accesso denegado");



class CouponsModel
{
    private $db;
    private $table = 'jv_coupons';
    private $response;
    
    public function __CONSTRUCT()
    {
        $this->db = Database::StartUp();
        $this->response = new Response();
    }
    
    public function GetAll($id)
    {
		try
		{
			$result = array();

			$stm = $this->db->prepare("SELECT * FROM $this->table");
			$stm->execute();
            
			$this->response->setResponse(true);
            $this->response->result = $stm->fetchAll();
            
            return $this->response;
		}
		catch(Exception $e)
		{
			$this->response->setResponse(false, $e->getMessage());
            return $this->response;
		}
    }
    
    public function Get($id)
    {
		try
		{
			$result = array();

			$stm = $this->db->prepare("SELECT * FROM $this->table WHERE jv_Id = ?");
			$stm->execute(array($id));

			$this->response->setResponse(true);
            $this->response->result = $stm->fetch();
            
            return $this->response;
		}
		catch(Exception $e)
		{
			$this->response->setResponse(false, $e->getMessage());
            return $this->response;
		}  
    }
    
    public function InsertOrUpdate($data)
    {
		try 
		{
            if(isset($data['jv_Id_Facebook']))
            {
                $sql = "UPDATE $this->table SET 
                            jv_Name          = ?, 
                            jv_Birthday      = ?,
                            jv_Gender        = ?,
                            jv_ImageUrl      = ?,
                            jv_DateTime      = ?
                            
                        WHERE jv_Id_Facebook = ?";
                
                $this->db->prepare($sql)
                     ->execute(
                        array(
                            $data['jv_Name'], 
                            $data['jv_Birthday'],
                            $data['jv_Gender'],
                            $data['jv_ImageUrl'],
                            $data['jv_DateTime'],
                            $data['jv_Id_Facebook']
                        )
                    );
            }
            else
            {
                $sql = "INSERT INTO $this->table
                            (jv_Id_Facebook, jv_Email, jv_Name, jv_Birthday, jv_Gender, jv_ImageUrl, jv_DateTime)
                            VALUES (?,?,?,?,?,?,?,?)";
                
                $this->db->prepare($sql)
                     ->execute(
                        array(
                            $data['jv_Id_Facebook'],
                            $data['jv_Email'],
                            $data['jv_Name'], 
                            $data['jv_Birthday'],
                            $data['jv_Gender'],
                            $data['jv_ImageUrl'],
                            $data['jv_DateTime']
                        )
                    ); 
            }
            
			$this->response->setResponse(true);
            return $this->response;
		}catch (Exception $e) 
		{
            $this->response->setResponse(false, $e->getMessage());
		}
    }
    
    public function Delete($id)
    {
		try 
		{
			$stm = $this->db
			            ->prepare("DELETE FROM $this->table WHERE jv_Id_Facebook = ?");			          

			$stm->execute(array($id));
            
			$this->response->setResponse(true);
            return $this->response;
		} catch (Exception $e) 
		{
			$this->response->setResponse(false, $e->getMessage());
		}
    }

    public function generateApiKey(){

        try 
        {
            $this->response->setResponse(true);
            $this->response->result = md5(uniqid(rand(), true));
            return $this->response;
        } catch (Exception $e) 
        {
            $this->response->setResponse(false, $e->getMessage());
        }
    }
}