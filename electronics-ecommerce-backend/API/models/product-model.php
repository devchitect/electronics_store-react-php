<?php
    require_once("../database_connection.php");

    class Product extends Database_Connection {
        public $data = null;

        function __construct()
        {
            parent::__construct();
            
        }

        function getTopViewsProduct(){
            $sql = "SELECT product.*,
                    category.name as category_name, brand.name as brand_name
                    FROM product
                    LEFT JOIN brand ON product.brand_id = brand.id
                    LEFT JOIN category ON product.category_id = category.id
                    ORDER BY product.views DESC LIMIT 1
                    "; 
            $result =  $this -> queryStatement($sql);
            if($result == true){
                $this -> data = $this -> pdo_statement -> fetch(PDO::FETCH_OBJ);
            }
            return $result;
        }

        function getLimitProductByMostViews($limit,$offset){
            $sql = "SELECT product.*, 
                    category.name as category_name, brand.name as brand_name
                    FROM product
                    LEFT JOIN brand ON product.brand_id = brand.id
                    LEFT JOIN category ON product.category_id = category.id
                    ORDER BY views DESC LIMIT $limit "; 
            if(is_int($offset)){
                $sql.= "OFFSET $offset";
            }
            $result =  $this -> queryStatement($sql);
            if($result == true){
                $this -> data = $this -> pdo_statement -> fetchAll(PDO::FETCH_OBJ);
            }
            return $result;
        }

        function getLimitProductByMostSales($limit){
            $sql = "SELECT product.*, 
            category.name as category_name, brand.name as brand_name
            FROM product
            LEFT JOIN brand ON product.brand_id = brand.id
            LEFT JOIN category ON product.category_id = category.id
            ORDER BY sales DESC LIMIT $limit "; 
            $result =  $this -> queryStatement($sql);
            if($result == true){
                $this -> data = $this -> pdo_statement -> fetchAll(PDO::FETCH_OBJ);
            }
            return $result;
        }

        function getProductDetails($id, $category){
            $result = false;

            if($category == "laptop"){
                $sql = "SELECT l.*,
                p.original_price, p.buy_price,p.views, p.name as name, p.stock,
                c.name as category,
                b.name as brand
                FROM laptop_specs as l
                JOIN product as p on p.product_id = l.product_id
                JOIN category as c on p.category_id = c.id
                JOIN brand as b on p.brand_id = b.id
                WHERE l.product_id = ?
                ";
                $param = [$id];
                $result = $this -> queryStatement($sql, $param);
                if($result == true){
                    $this -> data = $this -> pdo_statement -> fetch(PDO::FETCH_OBJ);
                }

            }

            if($category == "smartphone" || $category == "tablet"){
                $sql = "SELECT sts.ram, sts.color, sts.storage, sts.product_id, sts.images,
                stp.*,
                p.original_price, p.buy_price,p.views, p.name as name, p.stock,
                c.name as category,
                b.name as brand
                FROM smartphone_tablet_specs as sts
                JOIN smartphone_tablet_prototypes as stp on sts.prototype = stp.prototype
                JOIN product as p on p.product_id = sts.product_id
                JOIN category as c on p.category_id = c.id
                JOIN brand as b on p.brand_id = b.id
                WHERE sts.product_id = ?
                ";
                $param = [$id];
                $result = $this -> queryStatement($sql, $param);
                if($result == true){
                    $this -> data = $this -> pdo_statement -> fetch(PDO::FETCH_OBJ);
                }
            }

            return $result;
        }


        function getAllProductWithSpecs($category, $min_price = null, $max_price = null, $brand =null, $limit = null ){
            $sql = "SELECT p.*,
                    c.name as category_name,
                    b.name as brand_name
                    FROM product as p 
                    JOIN category as c ON c.id = p.category_id
                    JOIN brand as b ON b.id = p.brand_id
            ";
            $params = array();

            if($brand || $min_price || $max_price){
                $sql .= " WHERE ";
                //price range
                if($min_price && $max_price || $min_price == 0){
                    $sql .= " p.buy_price BETWEEN ? AND ? ";
                    array_push($params,$min_price);
                    array_push($params,$max_price);
                }

                //brand
                if(is_array($brand)){

                    if(count($brand) == 1){
                        $sql .= "AND b.name = ? ";
                        array_push($params, reset($brand));
                    }else{
                        foreach ($brand as $value) {
                            if($value == reset($brand)){
                                $sql .= "AND b.name = ? OR ";
                            }else if($value == end($brand)){
                                $sql .= " b.name = ? ";
                            }else{
                                $sql .= " b.name = ? OR ";
                            }
                            array_push($params, $value);
                        }    
                    }   
                }
            }

            $sql .= ' HAVING c.name = ? ';
            array_push($params, $category);

            if($limit){
                $sql .= ' LIMIT ' . $limit;

            }

            $result = $this -> queryStatement($sql, $params);

            if($result == true){
                 $this -> data = $this -> pdo_statement -> fetchAll(PDO::FETCH_OBJ);
             }
            return $result;
        }

        function getProductsByKeyword($keyword,$category){
            $sql = 'SELECT p.*, c.name as category_name 
            FROM product as p
            JOIN category as c ON p.category_id = c.id
            WHERE p.name like ?';
            $param = ['%'.$keyword.'%'];
            if($category){
                $sql .= ' AND p.category_id = ?';
                $param = ['%'.$keyword.'%',$category];
            }

            $result = $this -> queryStatement($sql, $param);

            if($result == true){
                 $this -> data = $this -> pdo_statement -> fetchAll(PDO::FETCH_OBJ);
             }
            return $result;
        }

    }
?>