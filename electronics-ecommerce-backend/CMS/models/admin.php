<?php
    require("../database_connection.php");
    class SignIn extends Database_Connection {
        public $data = null;
        
        function __construct()
        {
            parent::__construct();   
        }

        function getAdmin($user,$pass){
            $sql = "SELECT * FROM user WHERE username = ? && password = ? AND role = 'admin' ";
            $param = [$user,md5($pass)];
            $result = $this -> queryStatement($sql,$param);
            
            if($result == true){
                $this -> data = $this -> pdo_statement -> fetch();
            }
            return $result;
        }
    }
?>