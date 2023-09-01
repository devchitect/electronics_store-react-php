<?php
    $laptop = new Laptop();
    $brand = new Brand();
    
    $id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : "";
    
    $laptop_details = null;

    $result = $laptop -> getLaptopWithIDnBrand($id);

    if($result == true){
        $laptop_details = $laptop -> data;

        if($laptop_details != null){
            $result = $brand -> getSpecificBrand($laptop_details["brand_id"]);
            if($result == true){
                $laptop_brand = $brand -> data["name"];
            }
            $images_folder = "../resources/laptop/".$laptop_brand."/".$id;
            $images = explode(";",$laptop_details["images"]);
        }
        $ports = json_encode($laptop_details["ports"]);
    } 
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <div class="laptop-update">
        <h3 class="laptop-update-title">Update laptop with ID: <span><?= $id ?></span></h3>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="act" value="laptop">
            <input type="hidden" name="task" value="handle_update">
            <table class="laptop-update-table">
                <tr>
                    <th width=20%>ID</th>
                    <td><input type="text" name="id" id="" value="<?= $laptop_details["id"] ?>" readonly></td>
                </tr>
                <tr>
                    <th>Brand</th>
                    <td>
                        <select name="" id="brand" required disabled>
                            <option disabled selected >Choose the Brand</option>
                            <option value="1">Macbook</option>
                            <option value="2">Lenovo</option>
                            <option value="3">HP</option>
                            <option value="4">Acer</option>
                            <option value="5">Asus</option>
                            <option value="6">Dell</option>
                        </select>
                        <input type="hidden" name="brand" value="<?= $laptop_details["brand_id"] ?>">
                    </td>
                </tr>
                <tr>
                    <th>Name / Model</th>
                    <td><input type="text" name="name" id="" value="<?= $laptop_details["name"] ?>" required></td>
                </tr>
                <tr>
                    <th>Stock <span class="required">*</span></th>
                    <td><input type="number" name="stock" id="" value="<?= $laptop_details["stock"] ?>" required></td>
                </tr>
                <tr>
                    <th>Discount Price</th>
                    <td><input type="number" name="buy_price" id="" value="<?= $laptop_details["buy_price"] ?>" ></td>
                </tr>
                <tr>
                    <th>Price <span class="required">*</span></th>
                    <td><input type="number" name="original_price" id="" value="<?= $laptop_details["original_price"] ?>" required></td>
                </tr>
                <tr>
                    <th style="border: none;" colspan="2">Specifications</th>
                </tr>
                <tr>
                    <th>CPU</th>
                    <td><input type="text" name="cpu" id="" value="<?= $laptop_details["cpu"] ?>" ></td>
                </tr>
                <tr>
                    <th>RAM</th>
                    <td><input type="text" name="ram" id="" value="<?= $laptop_details["ram"] ?>" ></td>
                </tr>
                <tr>
                    <th>VGA</th>
                    <td><input type="text" name="vga" id="" value="<?= $laptop_details["vga"] ?>" ></td>
                </tr>
                <tr>
                    <th>Screen</th>
                    <td><input type="text" name="screen" id="" value="<?= $laptop_details["screen"] ?>" ></td>
                </tr>
                <tr>
                    <th>Hard Drive</th>
                    <td><input type="text" name="harddrive" id="" value="<?= $laptop_details["storage_drive"] ?>" ></td>
                </tr>
                <tr>
                    <th>Ports</th>
                    <td><textarea name="ports" id="ports"  rows="10"></textarea></td>
                </tr>
                <tr>
                    <th>Webcam</th>
                    <td><input type="text" name="webcam" id="" value="<?= $laptop_details["webcam"] ?>"></td>
                </tr>
                <tr>
                    <th>Audio</th>
                    <td><input type="text" name="audio" id="" value="<?= $laptop_details["audio"] ?>"></td>
                </tr>
                <tr>
                    <th>Battery</th>
                    <td><input type="text" name="battery" id="" value="<?= $laptop_details["battery"] ?>"></td>
                </tr>
                <tr>
                    <th>Weight</th>
                    <td><input type="text" name="weight" id="" value="<?= $laptop_details["weight"] ?>"></td>
                </tr>
                <tr>
                    <th>Color</th>
                    <td><input type="text" name="color" id="" value="<?= $laptop_details["color"] ?>"></td>
                </tr>
                <tr>
                    <th>Wifi</th>
                    <td><input type="text" name="wifi" id="" value="<?= $laptop_details["wifi"] ?>"></td>
                </tr>
                <tr>
                    <th>Bluetooth</th>
                    <td><input type="text" name="bluetooth" id="" value="<?= $laptop_details["bluetooth"] ?>"></td>
                </tr>
                <tr>
                    <th>Overview Image</th>
                    <td>
                        <input type="file" name="overview">
                        <?php if(!empty($laptop_details["overview_image"])){ ?>
                            <div class="laptop-update-images-wrapper-title">Current overview image:</div>
                            <img style="width:50%" src="../resources/<?= trim($laptop_details["overview_image"])?>" alt="">
                        <?php } ?>
                        
                    </td>
                    
                </tr>
                <tr>
                    <th>Product Gallery</th>
                    <td>
                        <input type="file" name="images[]" multiple>
                        <?php if(isset($images) && $images != null){echo '<p class="laptop-update-images-wrapper-title">Already exist images:</p>';} ?>
                        <div class="laptop-update-images-wrapper">                    
                            <?php if(isset($images)) {foreach($images as $i){ ?>
                                <img src="../resources/<?= trim($i) ?>" alt="">
                            <?php } }?>
                        </div>                   
                    </td>
                </tr>
            </table>               
            <input type="submit" name="update" value="Update this laptop">
        </form>
    </div>
    
    <script type="text/javascript">
        console.log("test");
        document.getElementById("brand").value = <?= $laptop_details["brand_id"] ?>;
        document.getElementById("ports").value = <?= $ports ?>;
    </script>

</body>
</html>