<?php
    require_once '../vendor/autoload.php';
    require_once 'models/order-model.php';

    $env = parse_ini_file('.env');
    $stripe_secret_key = $env["STRIPE_SECRET_KEY"];

    $method = $_SERVER['REQUEST_METHOD'];

    $stripe = new \Stripe\StripeClient($stripe_secret_key);

    $order = new Order();

    switch($method){

        case "POST":
            $data = json_decode(file_get_contents('php://input'), true);     
            //method, amount, client info

            //Stripe payment
            if(isset($_REQUEST['stripe'])){


                if(isset($_REQUEST['get_public_key'])){

                }

                if(isset($_REQUEST['create_payment_intent'])){

                    $intent = $stripe -> paymentIntents->create([
                        'amount' => $data,
                        'currency' => 'usd',
                        'automatic_payment_methods' => ['enabled' => true],
                    ]);

                    echo json_encode($intent->client_secret);
                }

                if(isset($_REQUEST['success'])){

                    $total = $data["total"];
                    $amount = $data["amount"];
                    $datetime = new DateTime();
                    $created_date = $datetime -> format("Y-m-d H:i:s");
                    $id = $datetime -> getTimestamp();
                    $payment_method = $data["method"];
                    $payment_status = $data["status"];
                    $username =  $data["username"];
                    $cart_items = $data["cartItems"];
                    $customer = $data["customer"];
                    $fullname = $customer['firstname'] . " " . $customer['lastname'];

                    $result = $order -> createOrder($id, $total, $amount, $created_date, $payment_method, $payment_status,  
                                                $username, $fullname,  $customer['address'], $customer['phone'], $customer['email'], $cart_items);

                    if($result){
                        http_response_code(200);
                        echo json_encode($id);
                    }
                    
                }
            }

            if(isset($_REQUEST['cash'])){

                $total = $data["total"];
                $amount = $data["amount"];
                $datetime = new DateTime();
                $created_date = $datetime -> format("Y-m-d H:i:s");
                $id = $datetime -> getTimestamp();
                $payment_method = $data["method"];
                $payment_status = $data["status"];
                $username =  $data["username"];
                $cart_items = $data["cartItems"];
                $customer = $data["customer"];
                $fullname = $customer['firstname'] . " " . $customer['lastname'];

                // id, total, amount, created_date, payment_method, status, username, fullname, address, phone 
                $result = $order -> createOrder($id, $total, $amount, $created_date, $payment_method, $payment_status,  
                                                $username, $fullname,  $customer['address'], $customer['phone'], $customer['email'], $cart_items);

                if($result){
                    http_response_code(200);
                    echo json_encode($id);
                }                                             

            }
    }      

?>


