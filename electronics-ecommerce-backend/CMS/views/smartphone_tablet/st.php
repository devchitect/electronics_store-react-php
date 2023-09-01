<?php 
    $task = isset($_REQUEST["task"]) ? $_REQUEST["task"] : "display"; 
    $act = isset($_REQUEST["act"]) ? $_REQUEST["act"] : ""; 

    $flexible = $act == "smartphone" ? "smartphone" : "tablet";

    $phone = new Phone();
    $tablet = new Tablet();
    $brand = new Brand();
    $prototype = new Prototype();

    switch($flexible){
        case "smartphone":
        $result = $phone -> getAllPhone();
        if($result == true){
            $product_count = count($phone -> data);
        }
        break;

        case "tablet":
            $result = $tablet -> getAllTablet();
            if($result == true){
                $product_count = count($tablet -> data);
            }
        break;
    }
    
    $result = $brand -> getAllBrand();
    if($result == true){
        $brands = $brand -> data;
    }

    if($task == "handle_add"){
        require("controllers/handle_st/handle-add-st.php");
    }
    if($task == "handle_delete"){
        require("controllers/handle_st/handle-delete-st.php");
    }
    if($task == "handle_update"){
        require("controllers/handle_st/handle-update-st.php");
    }
    if($task == "handle_add_prototype"){
        require("controllers/handle_st/handle-add-prototype.php");
    }
    if($task == "handle_update_prototype"){
        require("controllers/handle_st/handle-update-prototype.php");
    }
    if($task == "handle_delete_prototype"){
        require("controllers/handle_st/handle-delete-prototype.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <div> 
        <div class="st-wrapper">
            <div class="st-layout">
                <h3 class="st-title">
                    <span><?= $act == "smartphone" ? "📱" : "&#x1F4DF"; ?></span>
                    <span><?= ucfirst($flexible) ?></span>
                </h3>
                <h4><?= $product_count. " " .ucfirst($flexible) ?>(s) in the Store.</h4>
                <div>
                    <a href="?act=<?=$flexible?>&task=display" class="st-btn">View All</a>
                    <a href="?act=<?=$flexible?>&task=create-basic" class="st-btn">Add New</a>
                    <a href="?act=<?=$flexible?>&task=view-prototype" class="st-btn">View Prototypes</a>
                </div>
                <form class="st-searchbox" action="?act=<?=$flexible?>&task=details" method="get">
                    <select name="brand_search" id="brand_search">
                            <option disabled selected hidden >All Brand</option>
                            <?php foreach($brands as $brand){ ?>
                                <option value="<?= $brand["id"]?>"><?= $brand["name"]?></option>
                            <?php } ?> 
                    </select>
                   
                    <input type="text" name="id" id="id" placeholder="ID of the <?= $flexible ?>">
                    <input type="hidden" name="act" value="<?= $flexible ?>">
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
                            require("views/smartphone_tablet/st-table.php");
                            break;
                        case "search":                         
                            require("views/smartphone_tablet/st-details.php");
                            break;
                        case "details":                         
                            require("views/smartphone_tablet/st-details.php");
                            break;
                        case "create-basic":
                            require("views/smartphone_tablet/st-add-basic.php");
                            break;
                        case "view-prototype":
                            require("views/smartphone_tablet/st-view-prototype.php");
                            break;
                        case "create-prototype":
                            require("views/smartphone_tablet/st-add-prototype.php");
                            break;
                        case "details-prototype":
                            require("views/smartphone_tablet/st-details-prototype.php");
                            break;
                        case "update-prototype":
                            require("views/smartphone_tablet/st-update-prototype.php");
                             break;
                        case "update-basic":
                            require("views/smartphone_tablet/st-update-basic.php");
                            break;
                        default:
                            
                            break;
                    }               
                ?>
            </div>
        </div>

    </div>
</body>
</html>