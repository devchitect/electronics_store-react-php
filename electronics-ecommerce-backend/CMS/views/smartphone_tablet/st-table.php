<?php
    $phone = new Phone();
    $tabet = new Tablet();
    $brand = new Brand();

    $brand_id = isset($_REQUEST["brand_search"]) ? $_REQUEST["brand_search"] : "";
    
    if($brand_id == "" || !isset($brand_id)){

        switch($flexible){
            case "smartphone":
                $result = $phone -> getAllPhoneJoinBrand();
                if($result == true){
                    $viewlist = $phone -> data;
                }
                break;
            case "tablet":
                $result = $tablet -> getAllTabletJoinBrand();
                if($result == true){
                    $viewlist = $tablet -> data;
                }
                break;
        }
      
    }else{
        $result = $brand -> getSpecificBrand($brand_id);
        if($result == true){
            $brand = $brand -> data;
        }

        switch($flexible){
            case "smartphone":
                $result = $phone -> getAllPhoneJoinBrandonSpecificBrand($brand_id);
                if($result == true){
                    $viewlist = $phone -> data;
                }
                break;
            case "tablet":
                $result = $tablet -> getAllTabletJoinBrandonSpecificBrand($brand_id);
                if($result == true){
                    $viewlist = $tablet -> data;
                }
                break;
        }
       
    }
   
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <?php if(count($viewlist) == 0 ){ ?>
        <div style="text-align: center; color:red;">Found none <?= ucfirst($flexible) ?>.</div>
    <?php } else { ?>
    <table class="laptop-table">
        <?php if($brand_id != ""){?>
            <h4 style="text-align: center; padding: 6px 0 20px">All <?=$flexible?>s with brand : <span style="color:#1d6dbc"><?=$brand["name"]?></span> </h4>
        <?php } ?>
        
        <tr>
            <td >ID</td>
            <td >Name</td>
            <td >Brand</td>
            <td >RAM</td>
            <td >Color</td>
            <td >Storage</td>
            <td >Stock</td>
            <td >Views</td>
            <td >Sales</td>
            <td >Buy/Discount Price</td>
            <td >Original Price</td>
        </tr>
           <?php foreach($viewlist as $l){ ?>
        <tr>
            <td><a href="?act=<?= $flexible ?>&task=details&id=<?=$l["id"]?>" class="id-link"><?=$l["id"]?></a></td>
            <td><?=$l["name"]?></td>
            <td><?=$l["brand"]?></td>
            <td ><?=$l["ram"]?></td>
            <td ><?=$l["color"]?></td>
            <td ><?=$l["storage"]?></td>
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