<?php
    $id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : ""; 

    $order = new Order();
   
    $result = $order -> getOrderDetails($id);
    if($result == true){
        $basic = $order -> basic;
        $details = $order -> details;
    }

?>

<!DOCTYPE html>
<html lang="en">

    <div style="width: 40%; margin: 0 auto 100px; border:1px solid black; padding: 30px 50px;">     
        <div>
            <div>
                Order ID: <?= $basic -> id?>
            </div>
            <div>
                Created At: <?= $basic -> created_date?>
            </div>     
            <div>
                Product(s): <?= $basic -> amount?>
            </div>
        </div>
        <hr>
        <div>
            <h3>Customer</h3>
            <div>
                Fullname: <?= $basic -> fullname?>
            </div>
            <div>
                Phone: <?= $basic -> phone?>
            </div>
            <div>
                Address: <?= $basic -> address?>
            </div>
            <div>
                Email: <?= $basic -> email?>
            </div>
            <?php
                if($basic -> username){?>
                <div>
                    Username: <?= $basic -> username?>
                </div>
            <?php } ?>
        </div>
        <hr>
        <div>
            <h3>Order Details</h3>
            <div >
                <?php
                    foreach($details as $d){
                ?>
                <div  style='display: flex; justify-content: space-between;'>
                    <div>
                        <?= $d -> product_name ?> 
                        <div>
                            x <?= $d -> amount ?>  
                        </div>       
                    </div>
                    <div>
                        $<?= $d -> price ?>
                    </div>
                </div>
                 
                <?php 
                }
                ?>
            </div>
        </div>
        <hr>
        <div style='display: flex; justify-content: space-between;'>
            Total:
            <div>
                $<?= $basic -> total?>
            </div> 
         </div>
       
    </div>
</html>