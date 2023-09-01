<?php
    require("models/product-model.php");

    $product = new Product();

    $method = $_SERVER['REQUEST_METHOD'];
    
    switch($method){
        case "GET":
           
            if(isset($_GET["key"])){
                $key = $_GET["key"];
                if($key == "views"){
                    $limit = (isset($_GET["limit"])) ? (int)$_GET["limit"] : "";
                    $offset = (isset($_GET["offset"])) ? (int)$_GET["offset"] : "";

                    if($limit == 1){
                        $result = $product -> getTopViewsProduct();
                    }else{
                        $result = $product -> getLimitProductByMostViews($limit, $offset);
                    }
                      
                    if($result == true){
                        $list = $product -> data;
                    }
                    echo json_encode($list);
                }
    
                if($key == "sales"){
                    $limit = (isset($_GET["limit"])) ? (int)$_GET["limit"] : "";
                    $offset = (isset($_GET["offset"])) ? (int)$_GET["offset"] : "";

                    $result = $product -> getLimitProductByMostSales($limit,$offset);
                    if($result == true){
                        $list = $product -> data;
                    }
                    echo json_encode($list);
                }

                if($key == "details"){
                    $id = (isset($_GET["id"])) ? $_GET["id"] : "";
                    $category = (isset($_GET["category"])) ? $_GET["category"] : "";

                    $result = $product -> getProductDetails($id,$category);
                    if($result == true){
                        $list = $product -> data;

                        if($list){
                            $list_array = (array)$list;
                            $images = array_filter(explode(";",$list_array["images"]));
                            $list_array["images"] = $images;
    
                            echo json_encode($list_array);
                            http_response_code(200);
                        }else{
                            http_response_code(400);
                            echo json_encode("Failed!");
                        }
                      
                    }else{
                        http_response_code(400);
                        echo json_encode("Failed!");
                    }
                   
                }


                if($key == "productlist"){
                    //get all product by category
                    $category = (isset($_GET["category"])) ? $_GET["category"] : "";
                    $brand = (isset($_GET["brand"])) ? $_GET["brand"] : "";
                    $min = (isset($_GET["min_price"])) ? (int)$_GET["min_price"] : "";
                    $max = (isset($_GET["max_price"])) ? (int)$_GET["max_price"] : "";
                    $limit = (isset($_GET["limit"])) ? (int)$_GET["limit"] : "";
    
                    $result = $product -> getAllProductWithSpecs($category,$min,$max,$brand,$limit);
                    if($result){
                        $list = $product -> data;
    
                        if($list){
                            echo json_encode($list);
                            http_response_code(200);
                        }else{
                            http_response_code(201);
                            echo json_encode("Not Found!");
                        }
                    }
                }
            }         


            if(isset($_REQUEST['search_by_keyword'])){
                $keyword = $_GET['search_by_keyword'];
                $category = $_GET['category'];

                $result = $product -> getProductsByKeyword($keyword,$category);
                if($result){
                    $list = $product -> data;
                    echo json_encode($list);
                    http_response_code(200);
                }
            }
      
        break;

    }

?>