<?php
    $brand = new Brand();

    if(isset($_POST["add"])){
        $brand_id = $_POST["id"];
        $brand_name = $_POST["name"];

        $result = $brand -> addNewBrand($brand_id, $brand_name);
        if($result){    
            $success_msg = "Added Successfully";
        }else{
            $error_msg = "Added Failed";
        } 
    }
?>