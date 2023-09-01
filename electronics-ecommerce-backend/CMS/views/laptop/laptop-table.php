<?php
    $laptop = new Laptop();
    $brand = new Brand();

    $brand_id = isset($_REQUEST["brand_search"]) ? $_REQUEST["brand_search"] : "";
    
    if($brand_id == "" || !isset($brand_id)){
        $result = $laptop -> getAllLatopJoinBrand();
        if($result == true){
            $viewlist = $laptop -> data;
        }
    }else{
        $result = $laptop -> getAllLatopJoinBrandonSpecificBrand($brand_id);
        if($result == true){
            $viewlist = $laptop -> data;
        }

        $result = $brand -> getSpecificBrand($brand_id);
        if($result == true){
            $brand = $brand -> data;
        }
    }
   
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <?php if(count($viewlist) == 0 ){ ?>
        <div style="text-align: center; color:red;">Found none laptop.</div>
    <?php } else { ?>
    <table class="laptop-table">
        <?php if($brand_id != ""){?>
            <h4 style="text-align: center; padding: 6px 0 20px">All laptops with brand : <span style="color:#1d6dbc"><?=$brand["name"]?></span> </h4>
        <?php } ?>
        
        <tr>
            <td >ID</td>
            <td >Model</td>
            <td >Brand</td>
            <td >Stock</td>
            <td >Views</td>
            <td >Sales</td>
            <td >Buy/Discount Price</td>
            <td >Original Price</td>
        </tr>
           <?php foreach($viewlist as $l){ ?>
        <tr>
            <td><a href="?act=laptop&task=details&id=<?=$l["id"]?>" title="To Details" class="id-link"><?=$l["id"]?></a></td>
            <td><?=$l["name"]?></td>
            <td><?=$l["brand"]?></td>
            <td><?=$l["stock"]?></td>
            <td><?=$l["views"]?></td>
            <td><?=$l["sales"]?></td>
            <td><?=isset($l["buy_price"]) && $l["buy_price"] > 0 ?$l["buy_price"] . " " . "$": "-";?></td>
            <td><?=$l["original_price"] . " " . "$"?></td>
        </tr>

        <?php } }?>
    </table>               
</body>
</html>