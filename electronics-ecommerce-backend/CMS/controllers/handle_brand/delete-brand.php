<?php
    $brand = new Brand();

    if(isset($_REQUEST["id"])){
        $id = $_REQUEST["id"];
        $result = $brand -> getAllProductsWithBrand($id);  
        if($result == true){
            $temp = count($brand -> data);
        }

        if($temp == 0){
            $result = $brand -> deleteBrand($id);
             if($result){    
                $success_msg = "Add Successfully";
                }else{
                    $error_msg = "Added Failed";
                } 
        }else{
            $error_msg = "This brand contains products! Can not delete!";
        }
    }
?>