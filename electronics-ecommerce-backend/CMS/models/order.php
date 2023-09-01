<?php
    require_once("../database_connection.php");

    class Order extends Database_Connection {
        public $data = null;
        public $basic = null;
        public $details = null;


        function __construct()
        {
            parent::__construct();
            
        }
        
        function getOrderDetails($id){
            $order_basic = 'SELECT * FROM order_basic WHERE id= ? ';
            $order_details = 'SELECT * FROM order_details WHERE order_id = ?';
            $param = [$id];
            
            $result = $this -> queryStatement($order_basic, $param);

            if($result){
                $this -> basic = $this -> pdo_statement -> fetch(PDO::FETCH_OBJ);

                $result = $this -> queryStatement($order_details, $param);
                if($result){
                    $this -> details = $this -> pdo_statement -> fetchAll(PDO::FETCH_OBJ);
                }
            }
            return $result;
        }

        function getAllOrders(){
            $order_basic = 'SELECT * FROM order_basic';
            $result = $this -> queryStatement($order_basic);
            if($result){
                $this -> data = $this -> pdo_statement -> fetchAll();
            }
            return $result;
        }

    }
?>