<?php 
    $task = isset($_REQUEST["task"]) ? $_REQUEST["task"] : "display"; 

    $laptop = new Laptop();
    $brand = new Brand();

    $result = $laptop -> getAllLatop();
    if($result == true){
        $laptop_count = count($laptop -> data);
    }

    $result = $brand -> getAllBrand();
    if($result == true){
        $brands = $brand -> data;
    }

    if($task == "handle_add"){
        require("controllers/handle_laptop/handle-add-laptop.php");
    }
    if($task == "handle_delete"){
        require("controllers/handle_laptop/handle-delete-laptop.php");
    }
    if($task == "handle_update"){
        require("controllers/handle_laptop/handle-update-laptop.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <div> 
        <div class="laptop-wrapper">
            <div class="laptop-layout">
                <h3 class="laptop-title">&#x1F4BB Laptop</h3>
                <h4><?= $laptop_count ?> Laptop(s) in the Store.</h4>
                <div>
                    <a href="?act=laptop&task=display" class="laptop-btn">View All</a>
                    <a href="?act=laptop&task=create" class="laptop-btn">Add New</a>
                </div>
                <form class="laptop-searchbox" action="?act=laptop&task=details" method="get">
                    <select name="brand_search" id="brand_search" required>
                            <option disabled selected hidden >All Brand</option>
                            <?php foreach($brands as $brand){ ?>
                                <option value="<?= $brand["id"]?>"><?= $brand["name"]?></option>
                            <?php } ?> 
                        </select>
                    <input type="text" name="id" id="id" placeholder="ID of the Laptop">
                    <input type="hidden" name="act" value="laptop">
                    <input type="hidden" name="task" value="search">
                    <input type="submit" value="Search">
                </form>
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
                            require("views/laptop/laptop-table.php");
                            break;
                        case "search":                         
                            require("views/laptop/laptop-details.php");
                            break;
                        case "details":                         
                            require("views/laptop/laptop-details.php");
                            break;
                        case "create":
                            require("views/laptop/laptop-add.php");
                            break;
                        case "update":
                            require("views/laptop/laptop-update.php");
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