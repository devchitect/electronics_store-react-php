<?php
    require_once("../database_connection.php");

    class Laptop extends Database_Connection {
        public $data = null;

        function __construct()
        {
            parent::__construct();
            
        }

    // Laptop Product Related
        function addNewLaptop($id, $brand_id, $name, $cpu, $ram, $vga, $screen, $storage_drive, $ports, $webcam, $audio, $battery, 
                                $weight, $color, $wifi, $bluetooth, $buy_price, $original_price, $stock, $images, $overview, $category_id = 1){
            $result = true;
            
            if($buy_price == "" || $buy_price == 0){
                $buy_price = $original_price;
            }                            
            
            $add_product = "INSERT INTO product(product_id, name, category_id, brand_id, stock, buy_price, original_price, overview_image) VALUE(?,?,?,?,?,?,?,?)";
            $product_info = [$id, $name, $category_id, $brand_id, $stock, $buy_price, $original_price, $overview];

            $add_product_details = "INSERT INTO laptop_specs
                                    (product_id, cpu, ram, vga, screen, storage_drive, ports, webcam,  audio, battery, weight, color, wifi, bluetooth, images)
                                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
            $laptop_info = [$id, $cpu, $ram, $vga, $screen, $storage_drive, $ports, $webcam, $audio, $battery, $weight, $color, $wifi, $bluetooth, $images];

            try {
                $this -> connection ->  beginTransaction();
                $stm1 = $this -> connection -> prepare($add_product);
                $stm1 -> execute($product_info);

                $stm2 = $this -> connection -> prepare($add_product_details);
                $stm2 -> execute($laptop_info);
                
                $this -> connection -> commit();
            }catch(Exception $e){
                $this -> connection -> rollBack();
                $result = false;
                echo "<p> Failed: ".$e -> getMessage()."</p>";
            }

            return $result;
        }
        
        function deleteLaptop($id){
            $param = [$id];
            $result = true;
            try {
                $this -> connection ->  beginTransaction();

                $stm1 = $this -> connection -> prepare("DELETE FROM laptop_specs WHERE product_id=?");
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

        function updateLaptop($id, $brand_id, $name, $cpu, $ram, $vga, $screen, $storage_drive, $ports, $webcam, $audio, $battery, 
                                $weight, $color, $wifi, $bluetooth, $buy_price, $original_price, $stock, $images, $overview, $category_id = 1){                           
            $result = true;

            if($buy_price == "" || $buy_price == 0){
                $buy_price = $original_price;
            }    
            
            $update_product_details = "UPDATE laptop_specs
                                        SET cpu =?, ram=?, vga=?, screen=?, storage_drive=?, ports=?, webcam=?,  audio=?, battery=?, weight=?, color=?, wifi=?, bluetooth=?, images=?
                                        WHERE product_id = ?";
                $laptop_info = [$cpu, $ram, $vga, $screen, $storage_drive, $ports, $webcam, $audio, $battery, $weight, $color, $wifi, $bluetooth,$images, $id];
                
                $update_product = "UPDATE product SET name =?, category_id=?, brand_id=?, stock=?, buy_price=?, original_price=?, overview_image=? WHERE product_id = ?";
                $product_info = [$name, $category_id, $brand_id, $stock, $buy_price, $original_price, $overview, $id];

                try {
                    $this -> connection ->  beginTransaction();
                    $stm1 = $this -> connection -> prepare($update_product_details);
                    $stm1 -> execute($laptop_info);

                    $stm2 = $this -> connection -> prepare($update_product);
                    $stm2 -> execute($product_info);
                    
                    $this -> connection -> commit();
                }catch(Exception $e){
                    $this -> connection -> rollBack();
                    $result = false;
                    echo "<p> Failed: ".$e -> getMessage()."</p>";
                }
                return $result;
        }


        function getAllLatop(){
            $sql = "SELECT * FROM product WHERE category_id = 1";
            $result = $this -> queryStatement($sql);
            if ($result == true){
                $this -> data = $this -> pdo_statement -> fetchAll(); 
            }
            return $result;
        }

        //Get all laptop with details by join table    
        function getAllLatopJoinBrand(){
            $sql = 'SELECT p.product_id as id, p.name as name, b.name as brand, p.stock, p.buy_price, p.original_price, p.views, p.sales
            FROM product as p
            JOIN brand as b ON p.brand_id = b.id
            JOIN category as c ON p.category_id = c.id
            WHERE c.name = "laptop"
            ';

            $result = $this -> queryStatement($sql);
            if ($result == true){
                $this -> data = $this -> pdo_statement -> fetchAll(); 
            }
            return $result;
        }

        //Get all laptop with details with specific brand by join table 
        function getAllLatopJoinBrandonSpecificBrand($brand_id){
            $sql = 'SELECT p.product_id as id, p.name as name, b.name as brand, p.stock, p.buy_price, p.original_price, p.views, p.sales
            FROM product as p
            JOIN brand as b ON p.brand_id = b.id
            JOIN category as c ON p.category_id = c.id
            WHERE c.name = "laptop"
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
        function getLaptopWithIDnBrand($id,$brand_id = null){
            $sql = 'SELECT p.product_id as id, p.name as name, p.stock, p.buy_price, p.original_price, p.views, p.sales, p.overview_image,
            b.name as brand_name, b.id as brand_id,
            l.cpu, l.ram, l.storage_drive, l.vga, l.screen, l.weight, 
            l.battery, l.color, l.ports, l.webcam, l.wifi, l.bluetooth,   
            l.audio, l.images
            FROM laptop_specs as l 
            JOIN product as p ON p.product_id = l.product_id
            JOIN brand as b ON b.id = p.brand_id
            WHERE l.product_id = ?   
            ';
            
            $id = trim($id);
            
            if($brand_id != null){
                $sql .= "AND b.id = ?";
                $params = [$id,$brand_id];
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