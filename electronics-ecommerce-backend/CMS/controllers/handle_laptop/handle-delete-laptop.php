<?php
    if(isset($_REQUEST["id"])){
        $brand = new Brand();
        $laptop = new Laptop();

        $brand -> getAllBrand();
        $brand_list = $brand -> data;

        $laptop -> getLaptopWithIDnBrand($_REQUEST["id"]);
        $laptop_details = $laptop -> data;
        $brand_id = $laptop_details["brand_id"];

        foreach($brand_list as $b){
            if($brand_id == $b["id"]){
                $laptop_brand = $b["name"];
                break;
            }  
        }

        $images_folder = "../resources/laptop/".$laptop_brand."/".$_REQUEST["id"];
        $images_folder2 = "../resources/overview/".$_REQUEST["id"];
        $result = $laptop -> deleteLaptop($_REQUEST["id"]);

       
        $brand_list = $brand -> data;


        if($result == true){
            $success_msg = "Deleted laptop info successful!";

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