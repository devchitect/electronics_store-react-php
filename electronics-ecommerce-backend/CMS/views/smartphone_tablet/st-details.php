<?php
    $phone = new Phone();
    $tablet = new Tablet();
    $brand = new Brand();
    $category = new Category();

    $id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : "";

    $brand_id = isset($_REQUEST["brand_search"]) ? $_REQUEST["brand_search"] : "";
   
    $product_details = null;

    if($brand_id != "" && $id != ""){
        switch($flexible){
            case "smartphone":
                $result = $phone -> getPhoneWithIDnBrand($id,$brand_id);
                break;
            case "tablet":
                $result = $tablet -> getTabletWithIDnBrand($id,$brand_id);
                break;
        }
       
    }else if($brand_id == "" && $id != ""){
        switch($flexible){
            case "smartphone":
                $result = $phone -> getPhoneWithIDnBrand($id);
                if($result == true){
                    $product_details = $phone -> data;
                }
                
                break;
            case "tablet":
                $result = $tablet -> getTabletWithIDnBrand($id);
                if($result == true){
                    $product_details = $tablet -> data;
                }
                break;
        }
    }

    if($product_details){
        $prototype = $product_details["prototype"];
        $color = $product_details["color"];

        if($product_details != null){
            $brand -> getSpecificBrand($product_details["brand_id"]);
            $product_brand = $brand -> data["name"];

            $images = explode(";",$product_details["images"]);
            $features = explode(";",$product_details["features"]);      
            $screens = explode(";",$product_details["screen"]);     
            $videos = explode(";",$product_details["video"]);
        }
    }
   

?>

<!DOCTYPE html>
<html lang="en">
<body>
    <div style="margin-bottom:60px"> 
        <?php if($product_details){?>
        <h3 class="laptop-details-title">Details of <?= ucfirst($flexible) ?> with ID: <span style="color: red;"><?= $product_details["id"] ?></span></h3>
        
        <div class="laptop-details-menu">
            <a class="laptop-details-menu-btn laptop-details-menu-btn-update" href="?act=<?= $flexible ?>&task=update-basic&id=<?= $product_details["id"] ?>">Update <?= $flexible ?> info</a>
            <a class="laptop-details-menu-btn laptop-details-menu-btn-delete" href="?act=<?= $flexible ?>&task=handle_delete&id=<?= $product_details["id"] ?>"id="confirm">Delete <?= $flexible ?></a>
        </div>

        <div>
            <table class="laptop-details">
            <tr>
                    <th width=30%>ID</th>
                    <td><?= $product_details["id"]?></td>
                </tr>
                <tr>
                    <th>Brand</th>
                    <td><?= $product_details["brand_name"]?></td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td><?= $product_details["name"]?></td>
                </tr>
                <tr>
                    <th>Stock</th>
                    <td><?= $product_details["stock"]?></td>
                </tr>
                <tr>
                    <th>Discount Price</th>
                    <td><?= $product_details["buy_price"]?></td>
                </tr>
                <tr>
                    <th>Price</th>
                    <td><?= $product_details["original_price"]?></td>
                </tr>
                <tr>
                    <th style="border: none;" colspan="2">Specifications</th>
                </tr>
                <tr>
                    <th>RAM </th>
                    <td><?= $product_details["ram"]?></td>
                </tr>
                <tr>
                    <th>Color</th>
                    <td><?= $product_details["color"]?></td>
                </tr>
                <tr>
                    <th>Storage</th>
                    <td><?= $product_details["storage"]?></td>
                </tr>
                <tr>
                    <th colspan="2" style="border: none;">Prototype </th>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center; font-weight: bold; color:red"><?= $product_details["prototype"]?></td>
                </tr>
                <tr>
                    <th>CPU</th>
                    <td><?= $product_details["cpu"]?></td>
                </tr>
                <tr>
                    <th>GPU</th>
                    <td><?= $product_details["gpu"]?></td>
                </tr>
                <tr>
                    <th>Screen</th>
                    <td>
                        <?php if($product_details["screen"] != "" || $product_details["screen"] != null){foreach($screens as $s){ ?>
                            <div><?= $s ?></div>
                        <?php }} ?>
                    </td>
                </tr>
                <tr>
                    <th>Video</th>
                    <td>
                        <?php if($product_details["video"] != "" || $product_details["video"] != null){foreach($videos as $v){ ?>
                            <div><?= $v ?></div>
                        <?php }} ?>
                    </td>
                </tr>
                <tr>
                    <th>Operating System</th>
                    <td><?= $product_details["os"] ?></td>
                </tr>
                <tr>
                    <th>Front Camera</th>
                    <td><?= $product_details["front_camera"] ?></td>
                </tr>
                <tr>
                    <th>Back Camera</th>
                    <td><?= $product_details["back_camera"] ?></td>
                </tr>
                <tr>
                    <th>Length</th>
                    <td><?= $product_details["length"] ?></td>
                </tr>
                <tr>
                    <th>Width</th>
                    <td><?= $product_details["width"] ?></td>
                </tr>
                <tr>
                    <th>Depth</th>
                    <td><?= $product_details["depth"] ?></td>
                </tr>
                <tr>
                    <th>Weight</th>
                    <td><?= $product_details["weight"] ?></td>
                </tr>
                <tr>
                    <th>Battery</th>
                    <td><?= $product_details["battery"] ?></td>
                </tr>
                <tr>
                    <th>Charge</th>
                    <td><?= $product_details["charge"] ?></td>
                </tr>
                <tr>
                    <th>Features</th>
                    <td>
                        <?php if($product_details["features"] != "" || $product_details["features"] != null){foreach($features as $f){ ?>
                            <div><?= $f ?></div>
                        <?php }} ?>
                    </td>
                </tr>
                <tr>
                    <th>Overview Image</th>
                    <td >
                        <?php if(isset($product_details["overview_image"])){?>
                            <img style="width:50%" src="../resources/<?= $product_details["overview_image"] ?>" alt="">
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <th>Gallery</th>
                    <td class="laptop-details-image-wrapper">
                        <?php if(isset($images)){foreach($images as $i){?>
                            <img class="laptop-details-image" src="../resources/<?= trim($i) ?>" alt="">
                        <?php } ?>
                    </td>
                </tr>
            </table>               
        </div>

        <?php 
        }}else if ($id == ""){ require("views/smartphone_tablet/st-table.php"); }else{ ?>
            <div style="text-align: center; color:red;">
                No <?= ucfirst($flexible) ?> Details Found.
            </div>
        <?php }?>
        
    </div>

    <script>
        document.getElementById("confirm").addEventListener("click", function(e){
            let x = confirm("Confirm Delete?!");
            if(x == false){
                e.preventDefault();
            }
        })
    </script>
</body>
</html>
