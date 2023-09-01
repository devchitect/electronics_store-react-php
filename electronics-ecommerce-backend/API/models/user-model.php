<?php
    require_once("../database_connection.php");

    class User extends Database_Connection {
        public $data = null;

        function __construct()
        {
            parent::__construct();
            
        }

        function findUser($username){
            $sql = "SELECT * FROM user WHERE username = ?";
            $params = [$username];
            $result = $this -> queryStatement($sql, $params);
            if($result){
                $this -> data = $this -> pdo_statement -> fetch();
            }
            return $result;
        }

        function checkUserAndGetDetails($username, $password){
            $sql = "SELECT * FROM user WHERE username = ? AND password = ? AND role = 'customer' ";
            $params = [$username, md5($password)];

            $result = $this -> queryStatement($sql, $params);
            if($result){
                $this -> data = $this -> pdo_statement -> fetch(PDO::FETCH_OBJ);
            }
            return $result;
        }

        function getUserDetails($username){
            $sql = "SELECT username, firstname, lastname, email, phone, address, verify_code, verify_status FROM user WHERE username = ?";
            $params = [$username];

            
            $result = $this -> queryStatement($sql, $params);
            if($result){
                $this -> data = $this -> pdo_statement -> fetch(PDO::FETCH_OBJ);
            }
            return $result;
        }
        
        function createUser($username, $password, $firstname, $lastname, $phone, $email, $address,$otp,$verify){
            $sql = "INSERT INTO user(username, password, firstname, lastname, phone, email, address, verify_code, verify_status) VALUE (?,?,?,?,?,?,?,?,?)";
            $params = [$username, md5($password), $firstname, $lastname, $phone, $email, $address,$otp,$verify];
            $result = $this -> queryStatement($sql, $params);
            return $result;
        }


        function verifyEmail($username, $code){
            $verify_result = false;
            
            $sql = "UPDATE user SET verify_status = true WHERE username = ? AND verify_code = ?";
            $param = [$username, $code];
            $verify_result = $this -> queryStatement($sql,$param);
            if($verify_result){
                $verify_result = $this -> pdo_statement -> rowCount();
            }
            
            return $verify_result;
        }
    }
?>