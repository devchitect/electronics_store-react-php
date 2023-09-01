<?php 
    class Database_Connection {

        public $connection = null;
        public $pdo_statement = null;
        
        function __construct()
        {
            // $this->conn=NULL;
            // $this->pdo_stm=NULL;
            $servername =  $_SERVER['SERVER_NAME']; 
            $port= "3306";
            $dbname = "electronics_ecommerce";
            $user = "root";
            $pass = "";

            try{
                $this -> connection = new PDO("mysql:host=$servername:$port;dbname=$dbname",$user,$pass);
                $this -> connection -> query("SET NAMES UTF8");
            }
            catch(PDOException $e){
                echo "<p margin-left:300px>" . $e -> getMessage() . "</p>";
                die ("<p>Connect to database failed!</p>");    
            }
        }

        function queryStatement($sql, $param = NULL)
        {
            $result = FALSE;

            if($this -> connection == NULL){
                return FALSE;
            }

            $this-> pdo_statement = $this -> connection -> prepare($sql);
            
            if($param==NULL){
                $result = $this-> pdo_statement -> execute(); 
            }else{
                $result = $this-> pdo_statement -> execute($param);
            }
            return $result;
        }
    }

?>