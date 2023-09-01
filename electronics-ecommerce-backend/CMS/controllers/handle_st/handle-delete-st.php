<?php
    if(isset($_REQUEST["id"])){ 
        $brand = new Brand();
        $phone = new Phone();
        $tablet = new Tablet();

        $brand -> getAllBrand();
        $brand_list = $brand -> data;

        switch ($flexible){
            case "smartphone":
                $phone -> getPhoneWithIDnBrand($_REQUEST["id"]);
                $product_details = $phone -> data;
                break;

            case "tablet":    
               $tablet -> getTabletWithIDnBrand($_REQUEST["id"]);
               $product_details = $tablet -> data;
                break;
        }

        $brand_id = $product_details["brand_id"];

        foreach($brand_list as $b){
            if($brand_id == $b["id"]){
                $product_brand = $b["name"];
                break;
            }  
        }

        $images_folder = "../resources/$flexbile/".$$product_brand."/".$_REQUEST["id"];
        $images_folder2 = "../resources/overview/".$_REQUEST["id"];

        switch ($flexible){
            case "smartphone":
                $result = $phone -> deletePhone($_REQUEST["id"]);
                break;

            case "tablet":    
                $result = $tablet -> deleteTablet($_REQUEST["id"]);
                break;
        }

        if($result == true){
            $success_msg = "Deleted $flexible info successful!";
            
            if(file_exists($images_folder)){
                array_map('unlink', glob("$images_folder/*.*"));
                $del_files = rmdir($images_folder);
                if($del_files){
                    $success_msg .= " Also deleted product gallery !";
                }
            }

            if(file_exists($images_folder2)){
                array_map('unlink', glob("$images_folder2/*.*"));
                $del_files = rmdir($images_folder2);
                if($del_files){
                    $success_msg .= " and overview image !";
                }
            }

        }else{
            $error_msg = "Deleted failed!";
        }
    }
?>