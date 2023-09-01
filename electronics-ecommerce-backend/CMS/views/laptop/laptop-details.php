<?php
    $laptop = new Laptop();
    $brand = new Brand();

    $id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : "";
    $brand_id = isset($_REQUEST["brand_search"]) ? $_REQUEST["brand_search"] : "";

    $laptop_details = null;
   
    if($brand_id != "" && $id != ""){
        $result = $laptop -> getLaptopWithIDnBrand($id,$brand_id);
    }else if($brand_id == "" && $id != ""){
        $result = $laptop -> getLaptopWithIDnBrand($id);
    }

    if($result == true){
        $laptop_details = $laptop -> data;

        if($laptop_details){
            $result = $brand -> getSpecificBrand($laptop_details["brand_id"]);
            if($result == true){
                $laptop_brand = $brand -> data["name"];
            }

            $ports = explode(";",$laptop_details["ports"]);
            $images = explode(";",$laptop_details["images"]);
        }
    }  

?>

<!DOCTYPE html>
<html lang="en">
<body>
    <div style="margin-bottom:60px"> 
        <?php if($laptop_details != null ){?>
        <h3 class="laptop-details-title">Details of Laptop with ID: <span style="color: red;"><?= $laptop_details["id"] ?></span></h3>
        
        <div class="laptop-details-menu">
            <a class="laptop-details-menu-btn laptop-details-menu-btn-update" href="?act=laptop&task=update&id=<?= $laptop_details["id"] ?>">Update laptop info</a>
            <a class="laptop-details-menu-btn laptop-details-menu-btn-delete" href="?act=laptop&task=handle_delete&id=<?= $laptop_details["id"] ?>" id="confirm">Delete laptop</a>
        </div>

        <div>
            <table class="laptop-details">
                <tr>
                    <th>Brand</th>
                    <td><?= $laptop_brand ?></td>
                </tr>
                <tr>
                    <th width=20%>Model</th>
                    <td><?= $laptop_details["name"] ?></td>
                </tr>
                <tr>
                    <th>Stock</th>
                    <td><b><?= $laptop_details["stock"] ?></b></td>
                </tr>
                <tr>
                    <th>Sales</th>
                    <td><b><?= $laptop_details["sales"] ?></b></td>
                </tr>
                <tr>
                    <th>Views</th>
                    <td><b><?= $laptop_details["views"] ?></b></td>
                </tr>
                <tr>
                    <th>Current/Discount Price</th>
                    <td><?= $laptop_details["buy_price"] ?> $</td>
                </tr>
                <tr>
                    <th>Original Price</th>
                    <td><?= $laptop_details["original_price"] ?> $</td>
                </tr>
                <tr>
                    <th style="border: none;" colspan="2">Specifications</th>
                </tr>
                <tr>
                    <th>CPU</th>
                    <td><?= $laptop_details["cpu"] ?></td>
                </tr>
                <tr>
                    <th>RAM</th>
                    <td><?= $laptop_details["ram"] ?></td>
                </tr>
                <tr>
                    <th>VGA</th>
                    <td><?= $laptop_details["vga"] ?></td>
                </tr>
                <tr>
                    <th>Screen</th>
                    <td><?= $laptop_details["screen"] ?></td>
                </tr>
                <tr>
                    <th>Hard Drive</th>
                    <td><?= $laptop_details["storage_drive"] ?></td>
                </tr>
                <tr>
                    <th>Ports</th>
                    <td>
                        <?php foreach($ports as $p){ ?>
                            <div><?= $p ?></div>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <th>Webcam</th>
                    <td><?= $laptop_details["webcam"] ?></td>
                </tr>
                <tr>
                    <th>Audio</th>
                    <td><?= $laptop_details["audio"] ?></td>
                </tr>
                <tr>
                    <th>Battery</th>
                    <td><?= $laptop_details["battery"] ?></td>
                </tr>
                <tr>
                    <th>Weight</th>
                    <td><?= $laptop_details["weight"] ?></td>
                </tr>
                <tr>
                    <th>Color</th>
                    <td><?= $laptop_details["color"] ?></td>
                </tr>
                <tr>
                    <th>Wifi</th>
                    <td><?= $laptop_details["wifi"] ?></td>
                </tr>
                <tr>
                    <th>Bluetooth</th>
                    <td><?= $laptop_details["bluetooth"] ?></td>
                </tr>
                <tr>
                    <th>Overview Image</th>
                    <td>
                        <img style="width:50%" src="../resources/<?= trim($laptop_details["overview_image"])?>" alt="">
                    </td>
                </tr>
                <tr>
                    <th>Product Gallery</th>
                    <td class="laptop-details-image-wrapper">
                        <?php if(isset($images)){foreach($images as $i){;?>
                            
                            <img class="laptop-details-image" src="../resources/<?= trim($i) ?>" alt="">
                        <?php } ?>
                    </td>
                </tr>
            </table>               
        </div>

        <?php 
        }}else if ($id == ""){ require("views/laptop/laptop-table.php"); }else{ ?>
            <div style="text-align: center; color:red;">
                No Laptop Details Found.
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