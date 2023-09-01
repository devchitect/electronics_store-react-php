<?php 
    $task = isset($_REQUEST["task"]) ? $_REQUEST["task"] : "display"; 

    $laptop = new Laptop();
    $brand = new Brand();
   
    $result = $brand -> getAllBrand();
    if($result == true){
        $brands = $brand -> data;
        $brand_count = count($brands);
    }

    if($task == "handle_add"){
        require("controllers/handle_brand/handle-add-brand.php");
    }
    if($task == "delete"){
        require("controllers/handle_brand/delete-brand.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<body>
    <div> 
        <div class="laptop-wrapper">
            <div class="laptop-layout">
                <h3 class="laptop-title">Brands</h3>
                <h4><?= $brand_count ?> Brand(s) in the Store.</h4>
                <div>
                    <a href="?act=brand&task=display" class="laptop-btn">View All</a>
                    <a href="?act=brand&task=create" class="laptop-btn">Add New</a>
                </div>
            </div>
            
            <?php if($error_msg != ""){ ?>
                    <div style="color: red; text-align: center; margin:20px 0; font-weight:bold;">
                        <span><i class="bi bi-exclamation-circle"></i></span><span><?= $error_msg ?></span>
                    </div>
                <?php } ?>

                <?php if($success_msg != ""){ ?>
                    <div style="color: green; text-align: center; margin:20px 0; font-weight:bold;">
                        <span><i class="bi bi-check2-circle"></i></span><span><?= $success_msg ?></span>
                    </div>
                <?php } ?>
           
            <div>
                <?php
                    switch($task){
                        case "display":
                            require("views/brand/brand-table.php");
                            break;
                        case "create":
                            require("views/brand/brand-add.php");
                            break;
                        default:
                            //require("views/laptop/laptop-table.php");
                            break;
                    }               
                ?>
            </div>
        </div>

    </div>
</body>
</html>