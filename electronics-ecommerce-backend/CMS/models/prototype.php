<?php
    require_once("../database_connection.php");

    class Prototype extends Database_Connection {
        public $data = null;

        function __construct()
        {
            parent::__construct();
            
        }
    // Brand Related
    
        function getSpecificPrototype($id){
            $sql = "SELECT * FROM smartphone_tablet_prototypes WHERE id = ?";
            $param = [$id];
            $result = $this -> queryStatement($sql,$param);
            if ($result == true) {
                $this -> data = $this -> pdo_statement -> fetch();
            }
            return $result;
        } 

        function getAllPhonePrototypes(){
            $sql = "SELECT * FROM smartphone_tablet_prototypes WHERE category_id = 2";
            $result = $this -> queryStatement($sql);
            if ($result == true){
                $this -> data = $this -> pdo_statement -> fetchAll(); 
            }
            return $result;
        }

        function getAllPhonePrototypesByKey($key){
            $sql = "SELECT * FROM smartphone_tablet_prototypes WHERE category_id = 2 AND prototype LIKE ?";
            $temp = trim($key);
            $param = ["%$temp%"];
            $result = $this -> queryStatement($sql, $param);
            if ($result == true){
                $this -> data = $this -> pdo_statement -> fetchAll(); 
            }
            return $result;
        }

        function getAllTabletPrototypes(){
            $sql = "SELECT * FROM smartphone_tablet_prototypes WHERE category_id = 3";
            $result = $this -> queryStatement($sql);
            if ($result == true){
                $this -> data = $this -> pdo_statement -> fetchAll(); 
            }
            return $result;
        }

        function getAllTabletPrototypesByKey($key){
            $sql = "SELECT * FROM smartphone_tablet_prototypes WHERE category_id = 3 AND prototype LIKE ?";
            $temp = trim($key);
            $param = ["%$temp%"];
            $result = $this -> queryStatement($sql, $param);
            if ($result == true){
                $this -> data = $this -> pdo_statement -> fetchAll(); 
            }
            return $result;
        }

        function addNewPrototype($prototype, $category_id ,$os, $cpu, $gpu, $length, $width, $depth, $battery, $charge, $screen, $front_cam, $back_cam, $video, $features, $weight){
           $sql = "INSERT INTO smartphone_tablet_prototypes (prototype, category_id, os, cpu, gpu, length, width, depth, battery, charge, screen, front_camera, back_camera, video, features, weight) 
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ";

            $params = [$prototype, $category_id, $os, $cpu, $gpu, $length, $width, $depth, $battery, $charge, $screen, $front_cam, $back_cam, $video, $features, $weight];
            $result = $this -> queryStatement($sql, $params);
            return $result;
        }

        function updatePrototype($id, $prototype, $category_id, $os, $cpu, $gpu, $length, $width, $depth, $battery, $charge, $screen, $front_cam, $back_cam, $video, $features, $weight){
            $sql = "UPDATE smartphone_tablet_prototypes SET prototype=?, os =?, category_id=?, cpu=?, gpu=?, length=?, width=?, depth=?, battery=?, 
                    charge=?, screen=?, front_camera=?, back_camera=?, video=?, features=?, weight=?
                    WHERE id = ?";
            $param = [$prototype, $os, $category_id, $cpu, $gpu, $length, $width, $depth, $battery, $charge, $screen, $front_cam, $back_cam, $video, $features, $weight, $id];
            $result = $this -> queryStatement($sql,$param);
            return $result;
        }

        function deletePrototype($id){
            $sql = "DELETE FROM smartphone_tablet_prototypes WHERE id =?";
            $param = [$id];
            $result = $this -> queryStatement($sql,$param);
            if ($result == true) {
                $this -> data = $this -> pdo_statement -> fetch();
            }
            return $result;
        }    


        function getAllProductsByPrototypesKey($key){
            $sql = "SELECT * FROM smartphone_tablet_specs WHERE prototype LIKE ?";
            $temp = trim($key);
            $param = ["%$temp%"];
            $result = $this -> queryStatement($sql, $param);
            if ($result == true){
                $this -> data = $this -> pdo_statement -> fetchAll(); 
            }
            return $result;
        }

    }
?>