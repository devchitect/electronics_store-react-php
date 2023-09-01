<?php
    require_once("../database_connection.php");

    class Category extends Database_Connection {
        public $data = null;

        function __construct()
        {
            parent::__construct();
            
        }

        function getAllCategories(){
            $sql = "SELECT * FROM category";
            $result = $this -> queryStatement($sql);
            if ($result == true){
                $this -> data = $this -> pdo_statement -> fetchAll(); 
            }
            return $result;
        }
    }
 ?>