<?php  
    require_once("config_header.php");
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    //because i'm not use root direc for this API, i need correct direc path of this direc for routing
    $host_directory = "/electronics-ecommerce-backend/API";

    //parse_url return both path and query parameter, we need to get only path for routing
    $request_uri =parse_url($_SERVER['REQUEST_URI'])["path"];
   
    $routes = [
        $host_directory . '/category' => 'controllers/category-controller.php',
        $host_directory . '/product' => 'controllers/product-controller.php',
        $host_directory . '/user' => 'controllers/user-controller.php',
        $host_directory . '/checkout' => 'controllers/checkout-controller.php',
        $host_directory . '/order' => 'controllers/order-controller.php',
    ];

    if(array_key_exists($request_uri, $routes)){
        require($routes[$request_uri]); 
    }

?>