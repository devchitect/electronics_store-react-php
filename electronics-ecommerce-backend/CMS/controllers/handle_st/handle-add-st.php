<?php
    $brand = new Brand();
    $category = new Category();
    $phone = new Phone();
    $tablet = new Tablet();

    if(isset($_POST["add"])){
        $brand -> getAllBrand();
        $brand_list = $brand -> data;
        $category -> getAllCategories();
        $categories = $category -> data;

        $id = $_POST["id"];
        $brand_id = $_POST["brand"];
        $name = $_POST["name"];
        $ram = $_POST["ram"];
        $storage = $_POST["storage"];
        $color = $_POST["color"];
        $prototype_val = $_POST["prototype"];
        $buy_price =  $_POST["buy_price"];
        $original_price = $_POST["original_price"];
        $stock =  $_POST["stock"];

        $category_id = $_POST["category"];
        
        
        $file_names = array_filter($_FILES['images']['name']);
        $overview = isset($_FILES['overview']['name']) ? $_FILES['overview']['name'] : "";

        $file_params = "";
        $overview_image = "";

        if(!empty($file_names)){

            foreach($categories as $c){
                if($category_id == $c["id"]){
                    $category_name = $c["name"];
                    break;
                }  
            }

            foreach($brand_list as $b){
                if($brand_id == $b["id"]){
                    $brand_name = $b["name"];
                    break;
                }  
            }

            //Create a folder 
            if(!file_exists("../resources/$flexible/$brand_name")){
                mkdir("../resources/$flexible/$brand_name");
            };
            // Create 
            if(!file_exists("../resources/$flexible/$brand_name/$id")){
                mkdir("../resources/$flexible/$brand_name/$id");
            };

            $target_dir = "../resources/$flexible/$brand_name/$id/";
            $allow_types = array("jpg","png","jpeg");
        
            
            

            foreach($_FILES['images']['name'] as $key => $value){ 

                //file upload path
                $file_name = basename($_FILES['images']['name'][$key]); 
                $target_filePath = $target_dir . $file_name; 

                //Check whether file type is valid 
                $file_type = pathinfo($target_filePath, PATHINFO_EXTENSION);  //get file extension .jpg .png or .jpeg
                if(in_array($file_type, $allow_types)){
                    if(move_uploaded_file($_FILES["images"]["tmp_name"][$key], $target_filePath)){ 
                        $file_path = "$flexible/$brand_name/$id/";
                        $file_params .= $file_path."$file_name;";
                        
                    }
                }else{
                    $error_msg = "Failed to add images! Invalid images type for gallery! Only JPG, PNG, JPEG are allowed!";
                    break;
                }
            }
        }

        if(!empty($overview)){
            
            if(!file_exists("../resources/overview/$id")){
                mkdir("../resources/overview/$id");
            };

            $target_dir = "../resources/overview/$id/";
            $allow_types = array("jpg","png","jpeg");

            $temp = basename($_FILES['overview']['name']); 
            $target_file = $target_dir . $temp; 

            $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            if(in_array($file_type, $allow_types)){
                if(move_uploaded_file($_FILES["overview"]["tmp_name"], $target_file)){ 
                    $file_path = "overview/$id/";
                    $overview_image .= "$file_path"."$temp";              
                }
            }else{
                $error_msg = "Failed to add image! Invalid images type for Overview image! Only JPG, PNG, JPEG are allowed!";
            }
        }
        
        switch($flexible){
            case "smartphone":
                $result = $phone -> addNewPhone($id, $ram, $storage, $color, $prototype_val, $file_params, $overview_image,
                                                $name,(int)$brand_id, $stock, $buy_price, $original_price);
                break;
            case "tablet":
                $result = $tablet -> addNewTablet($id, $ram, $storage, $color, $prototype_val, $file_params, $overview_image,
                                                 $name, (int)$brand_id, $stock, $buy_price, $original_price);
                break;
        }

        if($result == true){
            $success_msg = "Added Successful!";
        }else{
            $error_msg = "Failed to Add Data";
        }  
    }else{
        $error_msg = "Something went wrong! All required fields must be filled!";
    }

?>