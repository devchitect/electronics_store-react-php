<?php
    if(isset($_REQUEST["id"])){
        $prototype = new Prototype();
        $prototype -> getSpecificPrototype($_REQUEST["id"]);
        $p = $prototype -> data;

        $prototype -> getAllProductsByPrototypesKey($p["prototype"]);
        $temp = count($prototype -> data);

        if($temp == 0){
            $result = $prototype -> deletePrototype($_REQUEST["id"]);       
            if($result == true){
                $success_msg = "Deleted prototype info successful!";
            }else{
                $error_msg = "Deleted failed!";
            }
        }else{
            $error_msg = "Prototype is in use! Can not Delete!";
        }
        
    
    }
?>