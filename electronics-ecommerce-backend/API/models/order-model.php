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

        function createOrder($id, $total, $amount, $created_date, $payment_method, $payment_status,  
                                $username, $fullname, $address, $phone, $email, $cart_items){
            $order_basics = 'INSERT INTO order_basic( id, total, amount, created_date, payment_method, status, username, fullname, address, phone, email) 
                                VALUES (?,?,?,?,?,?,?,?,?,?,?)';
            $basics = [$id, $total, $amount, $created_date, $payment_method, $payment_status, $username, $fullname, $address, $phone, $email];

            $order_details = 'INSERT INTO order_details(order_id, product_id, product_name, amount, price) 
                                VALUES (?,?,?,?,?)';

            try{
                $this -> connection -> beginTransaction();
                $this -> queryStatement($order_basics, $basics);
                foreach ($cart_items as $i){
                    $details = [$id, $i['id'], $i['name'], $i['amount'], $i['price']];
                    $this -> queryStatement($order_details, $details);
                }
                $this -> connection -> commit();
                $result = true;
            }catch(Exception $e){
                $this -> connection -> rollBack();
                $result = false;
            }

            return $result; 
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

        function getAllOrdersByUsername($username){
            $order_basic = 'SELECT * FROM order_basic WHERE username = ? ';
            $param = [$username];
            $result = $this -> queryStatement($order_basic, $param);
            if($result){
                $this -> data = $this -> pdo_statement -> fetchAll(PDO::FETCH_OBJ);
            }
            return $result;
        }

        function getAllOrderByPhone($phone){
            $order_basic = 'SELECT * FROM order_basic WHERE phone= ? ';
            $param = [$phone];
            $result = $this -> queryStatement($order_basic, $param);
            if($result){
                $this -> data = $this -> pdo_statement -> fetchAll(PDO::FETCH_OBJ);
            }
            return $result;
        }

    }
?>