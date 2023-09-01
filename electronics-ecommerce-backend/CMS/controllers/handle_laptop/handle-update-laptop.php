<?php
$brand = new Brand();
$laptop = new Laptop();

if(isset($_POST["update"])){
        $brand -> getAllBrand();
        $brand_list = $brand -> data;

        $id = $_POST["id"];
        $brand_id = $_POST["brand"];
        $name = $_POST["name"];
        $cpu = $_POST["cpu"];
        $ram = $_POST["ram"];
        $vga = $_POST["vga"];
        $screen = $_POST["screen"];
        $storage_drive = $_POST["harddrive"];
        $ports = $_POST["ports"];
        $webcam = $_POST["webcam"];
        $audio = $_POST["audio"];
        $battery = $_POST["battery"];
        $weight = $_POST["weight"];
        $color = $_POST["color"];
        $wifi = $_POST["wifi"];
        $bluetooth = $_POST["bluetooth"];
        $buy_price =  $_POST["buy_price"];
        $original_price = $_POST["original_price"];
        $stock =  $_POST["stock"];

        $file_names = array_filter($_FILES['images']['name']);
        $overview = isset($_FILES['overview']['name']) ? $_FILES['overview']['name'] : "";

        $file_params = "";
        $overview_image = "";
        
        foreach($brand_list as $b){
            if($brand_id == $b["id"]){
                $brand_name = $b["name"];
                break;
            }  
        }
           
        {   //still remaining old images files after update
            $target_dir = "../resources/laptop/$brand_name/$id";
         
            if(file_exists($target_dir)){
                $images = array_diff(scandir($target_dir), array('.', '..'));
                foreach($images as $i){
                    $file_path = "laptop/$brand_name/$id/";
                    $file_params .= $file_path.$i.";";
                }
            }
        }

        {   //still remaining old images files after update
            $target_dir = "../resources/overview/$id";
         
            if(file_exists($target_dir)){
                $images = array_diff(scandir($target_dir), array('.', '..'));
                foreach($images as $i){
                    $file_path = "overview/$id/";
                    $overview_image .= $file_path.$i;
                }
            }
        }
         

        //add new images if upload
        if(!empty($file_names)){

            //Create a folder that match laptop brand
            if(!file_exists("../resources/laptop/$brand_name")){
                mkdir("../resources/laptop/$brand_name");
            };
            // Create a folder that match laptop id 
            if(!file_exists("../resources/laptop/$brand_name/$id")){
                mkdir("../resources/laptop/$brand_name/$id");
            };

            $target_dir = "../resources/laptop/$brand_name/$id/";
            $allow_types = array("jpg","png","jpeg");
     

            foreach($_FILES['images']['name'] as $key => $value){ 

                //file upload path
                $file_name = basename($_FILES['images']['name'][$key]); 
                $target_filePath = $target_dir . $file_name; 

                //Check whether file type is valid 
                $file_type = strtolower(pathinfo($target_filePath, PATHINFO_EXTENSION));  //get file extension .jpg .png or .jpeg
                if(in_array($file_type, $allow_types)){
                    if(move_uploaded_file($_FILES["images"]["tmp_name"][$key], $target_filePath)){ 
                        
                        //set up names for images to pass to SQL
                        $file_path = "laptop/$brand_name/$id/";
                        $file_params .= "$file_path"."$file_name; ";
                        
                    }
                }else{
                    $error_msg = "Failed to update image! Invalid images type! Only JPG, PNG, JPEG are allowed!";
                    break;
                }
            }
        }

        if(!empty($overview)){
            $overview_image = "";
            
            if(!file_exists("../resources/overview/$id")){
                mkdir("../resources/overview/$id");
            };

            $target_dir = "../resources/overview/$id/";
            $allow_types = array("jpg","png","jpeg");

            

            $temp = basename($_FILES['overview']['name']); 
            $target_file = $target_dir . $temp; 

            $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            if(in_array($file_type, $allow_types)){

                   //delete old overview image
                   $target_dir = "../resources/overview/$id";
                   if(file_exists($target_dir)){
                       array_map('unlink', glob("$target_dir/*.*"));
                   }

                if(move_uploaded_file($_FILES["overview"]["tmp_name"], $target_file)){ 
                    //set up names for images to pass to SQL
                    $file_path = "overview/$id/";
                    $overview_image .= "$file_path"."$temp";              
                }
            }else{
                $error_msg = "Failed to update image! Invalid images type for Overview image! Only JPG, PNG, JPEG are allowed!";
            }

        }    


        $result = $laptop -> updateLaptop($id, (int)$brand_id, $name, $cpu, $ram, $vga, $screen, $storage_drive, $ports, $webcam, $audio, $battery, $weight, 
                                            $color, $wifi, $bluetooth, $buy_price, $original_price, $stock, $file_params, $overview_image);
        if($result == true){
            $success_msg = "Update Successful!";
        }else{
            $error_msg = "Failed to Update Data";
        }  
    }

?>