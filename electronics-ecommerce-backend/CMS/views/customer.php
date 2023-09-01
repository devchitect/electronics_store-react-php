<?php 
    $customer = new Customer();
   
    $result = $customer -> getAllCustomer();
    if($result == true){
        $customers = $customer -> data;
        $customer_count = count($customers);
    }

?>


<!DOCTYPE html>
<html lang="en">
<body>
    <div> 
        <div class="laptop-wrapper">
            <div class="laptop-layout">
                <h3 class="laptop-title">Customer</h3>
                <h4><?= $customer_count ?> Customer(s) Accounts.</h4>
                <div>
                    <a href="?act=customer" class="laptop-btn">View All</a>
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
            <?php if(count($customers) == 0 ){ ?>
            <div style="text-align: center; color:red;">Found none Customer.</div>
            <?php }else{ ?>
            <table style="width: 80% ;" class="laptop-table">
                <tr>
                    <td >Username</td>
                    <td >First Name</td>
                    <td >Last Name</td>
                    <td >Phone</td>
                    <td >Address</td>
                    <td >Email</td>
                    <td>Email status</td>
                </tr>

                <?php foreach($customers as $c){ ?>
                <tr>
                    <td><b><?=$c["username"]?></b></td>
                    <td><?=$c["firstname"]?></td>
                    <td><?=$c["lastname"]?></td>
                    <td><?=$c["phone"]?></td>
                    <td><?=$c["address"]?></td>
                    <td><?=$c["email"]?></td>
                    <td><?=$c["verify_status"] == true ? 'Verify' : 'Unverify'?></b></td>
                </tr>
                <?php } }?>
                
            </table>          

            </div>
        </div>

    </div>
</body>
</html>