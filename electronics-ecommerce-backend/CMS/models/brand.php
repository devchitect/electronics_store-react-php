<?php
    require_once("../database_connection.php");

    class Brand extends Database_Connection {
        public $data = null;

        function __construct()
        {
            parent::__construct();
            
        }
    // Brand Related
    
        function getSpecificBrand($id){
            $sql = "SELECT * FROM brand WHERE id = ?";
            $param = [$id];
            $result = $this -> queryStatement($sql,$param);
            if ($result == true) {
                $this -> data = $this -> pdo_statement -> fetch();
            }
            return $result;
        } 

        function getAllBrand(){
            $sql = "SELECT * FROM brand";
            $result = $this -> queryStatement($sql);
            if ($result == true){
                $this -> data = $this -> pdo_statement -> fetchAll(); 
            }
            return $result;
        }

        function addNewBrand($id,$name){
            $sql = "INSERT INTO brand VALUES (?,?)";
            $param = [$id,$name];
            $result = $this -> queryStatement($sql,$param);
            return $result;
        }

        function deleteBrand($id){
            $sql = "DELETE FROM brand WHERE id =?";
            $param = [$id];
            $result = $this -> queryStatement($sql,$param);
            return $result;
        }    

        function getAllProductsWithBrand($id){
            $sql = "SELECT * FROM product WHERE brand_id = ?";
            $param = [$id];
            $result = $this -> queryStatement($sql,$param);
            if ($result == true) {
                $this -> data = $this -> pdo_statement -> fetchAll();
            }
            return $result;
        } 
    }
?>