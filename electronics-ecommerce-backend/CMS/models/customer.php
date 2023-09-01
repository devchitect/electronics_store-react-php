<?php
    require_once("../database_connection.php");

    class Customer extends Database_Connection {
        public $data = null;

        function __construct()
        {
            parent::__construct();
            
        }

        function getAllCustomer(){
            $sql = "SELECT u.*
            FROM user as u 
            WHERE u.role = 'customer'
            ";
            $result = $this -> queryStatement($sql);
            if($result){
                $this -> data = $this -> pdo_statement -> fetchAll();
            }
            return $result;
        }

    }
?>