<?php
    require("models/category-model.php");

    $category = new Category();

    $method = $_SERVER['REQUEST_METHOD'];
    
    switch($method){
        
        case "GET":
            $temp = null;
            $result = $category -> getAllCategories();
            if($result){
                $temp = $category -> data;
                echo json_encode($temp);
            }
        break;
    }

?>