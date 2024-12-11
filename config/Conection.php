<?php

class Conection
{
    protected $dbh;
    
    public function __construct()
    {
        
    }

    public function conectar_mysql()
    {
         try{
              $con = $this->dbh = new PDO('mysql:host=localhost;dbname=?', '?', '');
              return $con;
         } catch (Exception $e) {
            echo "Algo salio mal:" . $e->getMessage() ." <br/>";
            die();
         }
    }

    public function set_Name()
    {
        return "Probando libreria Psalm php";
    }
}