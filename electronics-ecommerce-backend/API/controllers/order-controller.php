<?php
    require_once 'models/order-model.php';

    $method = $_SERVER['REQUEST_METHOD'];

    $order = new Order();

    switch($method){

        case "GET":     

            if(isset($_REQUEST['get_order'])){
                $id = $_GET['id'] ? $_GET['id'] : "";
                
                $data = $order -> getOrderDetails($id);
                if($data){
                    $res = array( "basic" => ($order -> basic), "details" => ($order -> details));
                    
                    http_response_code(200);
                    echo json_encode($res);
                }
            }

            if(isset($_REQUEST['get_user_order'])){
                $username = $_GET['get_user_order'] ? $_GET['get_user_order'] : "";
                
                $data = $order -> getAllOrdersByUsername($username);
                if($data){
                    $res = $order -> data;
                    
                    http_response_code(200);
                    echo json_encode($res);
                }
            }

            if(isset($_REQUEST['get_phone_order'])){
                $phone = $_GET['get_phone_order'] ? $_GET['get_phone_order'] : "";
                
                $data = $order -> getAllOrderByPhone($phone);
                if($data){
                    $res = $order -> data;
                    
                    http_response_code(200);
                    echo json_encode($res);
                }
            }

    }      

?>


