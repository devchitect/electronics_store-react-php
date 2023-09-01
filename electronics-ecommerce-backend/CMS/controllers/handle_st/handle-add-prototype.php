<?php
    $category = new Category();
    $prototype_obj = new Prototype();

    if(isset($_POST["add"]) && isset($_POST["category"])){

        $category -> getAllCategories();
        $categories = $category -> data;

        $os = $_POST["os"];
        $category_id = $_POST["category"];
        $prototype = $_POST["prototype"];
        $cpu = $_POST["cpu"];
        $gpu = $_POST["gpu"];

        $screen = $_POST["screen"];
        $battery = $_POST["battery"];
        $features = $_POST["features"];
        $front_cam = $_POST["front_cam"];
        $back_cam = $_POST["back_cam"];
        $video = $_POST["video"];
        $charge = $_POST["charge"];
        $weight = $_POST["weight"];
        $length = $_POST["length"];
        $width = $_POST["width"];
        $depth = $_POST["depth"];
        
        
        $result = $prototype_obj -> addNewPrototype($prototype,(int)$category_id ,$os, $cpu, $gpu, $length, $width, $depth, $battery, 
                                                $charge, $screen, $front_cam, $back_cam, $video, $features, $weight);
        if($result == true){
            $success_msg = "Added Successful!";
        }else{
            $error_msg = "Failed to Add Data";
        }  
    }else{
        $error_msg = "Something went wrong! All required fields must be filled!";
    }

?>