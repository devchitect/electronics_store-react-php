<?php
    require_once("../database_connection.php");

    class Tablet extends Database_Connection {
        public $data = null;

        function __construct()
        {
            parent::__construct();
            
        }

        
        function addNewTablet( $id, $ram, $storage, $color, $prototype, $images, $overview,
                                $name, $brand_id, $stock, $buy_price, $original_price, $category_id = 3){
            $result = true;
            
            if($buy_price == "" || $buy_price == 0){
                $buy_price = $original_price;
            }    

            $add_product = "INSERT INTO product(product_id, name, category_id, brand_id, stock, buy_price, original_price, overview_image) VALUE(?,?,?,?,?,?,?,?)";
            $product_info = [$id, $name, $category_id, $brand_id, $stock, $buy_price, $original_price , $overview];

            $add_product_details = "INSERT INTO smartphone_tablet_specs
                                    (product_id, ram, storage, color, prototype, images)
                                    VALUES (?,?,?,?,?,?);";
            $phone_info = [$id, $ram, $storage, $color, $prototype, $images];

            try {
                $this -> connection ->  beginTransaction();
                $stm1 = $this -> connection -> prepare($add_product);
                $stm1 -> execute($product_info );
        
                $stm2 = $this -> connection -> prepare($add_product_details);
                $stm2 -> execute($phone_info);
                
                $this -> connection -> commit();
            }catch(Exception $e){
                $this -> connection -> rollBack();
                $result = false;
                echo "<p> Failed: ".$e -> getMessage()."</p>";
            }
        
            return $result;                
        }

        function updateTablet( $id, $ram, $storage, $color, $prototype, $images, $overview,
            $name, $brand_id, $stock, $buy_price, $original_price, $category_id = 3){
            $result = true;

            if($buy_price == "" || $buy_price == 0){
                $buy_price = $original_price;
            }    

            $update_product = "UPDATE product SET name = ?, category_id = ?, brand_id = ?, stock = ?, buy_price = ?, original_price = ?, overview_image = ? WHERE product_id = ?";
            $product_info = [$name, $category_id, $brand_id, $stock, $buy_price, $original_price,$overview, $id];

            $add_product_details = "UPDATE smartphone_tablet_specs 
                                    SET ram = ?, storage = ?, color = ?, prototype = ?, images = ? 
                                    WHERE product_id = ?";
            $phone_info = [$ram, $storage, $color, $prototype, $images, $id];

            try {
            $this -> connection ->  beginTransaction();
            $stm1 = $this -> connection -> prepare($update_product);
            $stm1 -> execute($product_info );

            $stm2 = $this -> connection -> prepare($add_product_details);
            $stm2 -> execute($phone_info);

            $this -> connection -> commit();
            }catch(Exception $e){
            $this -> connection -> rollBack();
            $result = false;
            echo "<p> Failed: ".$e -> getMessage()."</p>";
            }

            return $result;                
        }


        function deleteTablet($id){
            $param = [$id];
            $result = true;
            try {
                $this -> connection ->  beginTransaction();

                $stm1 = $this -> connection -> prepare("DELETE FROM smartphone_tablet_specs WHERE product_id=?");
                $stm1 -> execute($param);
                
                $stm2 = $this -> connection -> prepare("DELETE FROM product WHERE product_id=?");
                $stm2 -> execute($param);

                
                
                $this -> connection -> commit();
            }catch(Exception $e){
                $this -> connection -> rollBack();
                $result = false;
                echo "<p> Failed: ".$e -> getMessage()."</p>";
            }
            return $result;
        }

        function getAllTablet(){
            $sql = "SELECT * FROM product WHERE category_id = 3";
            $result = $this -> queryStatement($sql);
            if ($result == true){
                $this -> data = $this -> pdo_statement -> fetchAll(); 
            }
            return $result;
        }

        //Get all laptop with details by join table    
        function getAllTabletJoinBrand(){
            $sql = 'SELECT p.product_id as id, p.name as name, b.name as brand, p.stock, p.buy_price, p.original_price, p.views, p.sales, p.overview_image,
                    st.ram, st.storage, st.color
                    FROM product as p
                    JOIN brand as b ON p.brand_id = b.id
                    JOIN category as c ON p.category_id = c.id
                    JOIN smartphone_tablet_specs as st on p.product_id = st.product_id
                    WHERE c.name = "tablet"
            ';

            $result = $this -> queryStatement($sql);
            if ($result == true){
                $this -> data = $this -> pdo_statement -> fetchAll(); 
            }
            return $result;
        }

        //Get all laptop with details with specific brand by join table 
        function getAllTabletJoinBrandonSpecificBrand($brand_id){
            $sql = 'SELECT p.product_id as id, p.name as name, b.name as brand, p.stock, p.buy_price, p.original_price, p.views, p.sales, p.overview_image,
                    st.ram, st.storage, st.color
                    FROM product as p
                    JOIN brand as b ON p.brand_id = b.id
                    JOIN category as c ON p.category_id = c.id
                    JOIN smartphone_tablet_specs as st on p.product_id = st.product_id
                    WHERE c.name = "tablet"
                    AND b.id = ?
            ';

            $params = [$brand_id];
            $result = $this -> queryStatement($sql,$params);
            if ($result == true){
                $this -> data = $this -> pdo_statement -> fetchAll(); 
            }
            return $result;
        }

        //Get a specific laptop with specific brand by join table
        function getTabletWithIDnBrand($id,$brand_id = null){
            $sql =' SELECT p.product_id as id, p.name as name, p.stock, p.buy_price, p.original_price, p.views, p.sales, p.category_id, p.overview_image,
                    b.name as brand_name, b.id as brand_id,
                    c.name as category_name,
                    st.color, st.ram, st.storage, st.images, st.prototype,
                    stp.os, stp.cpu, stp.gpu, stp.length, stp.width, stp.depth, stp.battery, 
                    stp.charge, stp.screen, stp.front_camera, stp.back_camera, stp.video, stp.features, stp.weight
                    FROM smartphone_tablet_specs as st
                    JOIN product as p ON p.product_id = st.product_id
                    JOIN brand as b ON b.id = p.brand_id
                    JOIN category as c on c.id = p.category_id
                    JOIN smartphone_tablet_prototypes as stp on st.prototype = stp.prototype
                    WHERE st.product_id = ?
            ';

            $id = trim($id);
            
            if($brand_id != null){
                $sql .= "AND b.id = ?";
                $params = ["$id",$brand_id];
            }else{
                $params = [$id];
            }

            $result =  $this -> queryStatement($sql,$params);
            if ($result == true){
                $this-> data = $this -> pdo_statement -> fetch();
            }
            return $result;
        }
        
    }
 
?>