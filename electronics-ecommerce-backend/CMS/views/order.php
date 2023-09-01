<?php 

    $task = isset($_REQUEST["task"]) ? $_REQUEST["task"] : "display"; 

    $order = new Order();
   
    $result = $order -> getAllOrders();
    if($result == true){
        $orders = $order -> data;
        $order_count = count($orders);
    }

?>


<!DOCTYPE html>
<html lang="en">
<body>
    <div> 
        <div class="laptop-wrapper">
            <div class="laptop-layout">
                <h3 class="laptop-title">Order</h3>
                <h4><?= $order_count ?> Order(s).</h4>
                <div>
                    <a href="?act=order" class="laptop-btn">View All</a>
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
                            require("views/order-table.php");
                            break;
                        case "details":
                            require("views/order-details.php");
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