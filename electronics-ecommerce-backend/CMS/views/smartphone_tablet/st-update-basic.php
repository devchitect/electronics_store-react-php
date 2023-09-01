<?php
    $id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : ""; 

    $phone = new Phone();
    $tablet = new Tablet();
    $brand = new Brand();
    $prototype = new Prototype();
    $category = new Category();

    if($brand -> getAllBrand()){
        $brands = $brand -> data;
    }
    

    if($category -> getAllCategories()){
        $categories = $category -> data;
    }
    

    switch($flexible){
        case "smartphone":
            $result = $prototype -> getAllPhonePrototypes();
            if($result == true){
                $prototypes = $prototype -> data;
            }
        break;
        case "tablet":
            $result = $prototype -> getAllTabletPrototypes();
            if($result == true){
                $prototypes = $prototype -> data;
            }
        break;
    }

    if($id != ""){
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

    if(isset($product_details["images"])){
        $category_name =  $product_details["category_name"];
        $brand_name = $product_details["brand_name"];
        $prototype_name =  $product_details["prototype"];
        $color = $product_details["color"];
    
        $images_path = "../resources/$$flexible/$brand_name/$id";
        if(file_exists($images_path)){
            $images = explode(";",$product_details["images"]);
        }
    }
   
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <div class="st-add">
        <h3>Update <?= $flexible ?> with ID: <span class="required"><?= $product_details["id"] ?></span></h3>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="st-add-table">
                <tr>
                    <th width=22%>Brand</th>
                    <td>
                        <select id="brand" disabled>
                            <option disabled hidden >Choose the Brand correctly (This can't be update later!)</option>
                            <?php foreach($brands as $brand){ ?>
                                <option value="<?= $brand["id"]?>"><?= $brand["name"]?></option>
                            <?php } ?> 
                        </select>
                        <input type="hidden" name="brand" value="<?= $product_details["brand_id"] ?>">
                    </td>
                </tr>
                <tr>
                    <th>Name <span class="required">*</span></th>
                    <td><input type="text" name="name" id="" value="<?= $product_details["name"] ?>" required ></td>
                </tr>
                <tr>
                    <th>Stock <span class="required">*</span></th>
                    <td><input type="number" name="stock" id="" value="<?= $product_details["stock"] ?>" required></td>
                </tr>
                <tr>
                    <th>Discount Price</th>
                    <td><input type="number" name="buy_price" id="" value="<?= $product_details["buy_price"] ?>" ></td>
                </tr>
                <tr>
                    <th>Price <span class="required">*</span></th>
                    <td><input type="number" name="original_price" id="" value="<?= $product_details["original_price"] ?>" required></td>
                </tr>
                <tr>
                    <th style="border: none;" colspan="2">Specifications</th>
                </tr>
                <tr>
                    <th>RAM <span class="required">*</span></th>
                    <td><input type="text" name="ram" id=""value="<?= $product_details["ram"] ?>" required></td>
                </tr>
                <tr>
                    <th>Color <span class="required">*</span></th>
                    <td><input type="text" name="color" id=""value="<?= $product_details["color"] ?>" required></td>
                </tr>
                <tr>
                    <th>Storage <span class="required">*</span></th>
                    <td><input type="text" name="storage" id="" value="<?= $product_details["storage"] ?>" required></td>
                </tr>
                <tr>
                    <th>Prototype <span class="required">*</span></th>
                    <td>
                        <select name="prototype" id="prototype" style="font-weight: bold;" required>
                            <?php foreach($prototypes as $p){?>
                                <option value="<?= $p["prototype"]?>"><?= $p["prototype"]?></option>
                            <?php } ?> 
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Overview Image</th>
                    <td>
                        <input type="file" name="overview">
                        <?php if(isset($product_details["overview_image"])){?>
                            <img style="width:50%" src="../resources/<?= $product_details["overview_image"] ?>" alt="">
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <th>Images</th>
                    <td>
                        <input type="file" name="images[]" multiple>
                        <?php if(isset($images) && $images != null){echo '<p class="laptop-update-images-wrapper-title">Already exist images:</p>';} ?>
                        <div class="st-update-images-wrapper">                    
                            <?php if(isset($images)) {foreach($images as $i){ ?>
                                <img src="../resources/<?= trim($i) ?>" alt="">
                            <?php } }?>
                        </div>                   
                    </td>
                </tr>
            </table>     

            <input type="hidden" name="act" value="<?= $flexible ?>">
            <input type="hidden" name="task" value="handle_update">
            <input type="hidden" name="category" value="<?= $product_details["category_id"] ?>">   
            <input type="hidden" name="id" value="<?= $id  ?>">   
            <input type="submit" name="update" value="Update this <?= $flexible ?> info">
        </form>
    </div>
    
    <script type="text/javascript">
        document.getElementById("brand").value = "<?= $product_details["brand_id"] ?>";
        document.getElementById("prototype").value = <?= json_encode($product_details["prototype"])?>;
    </script>
</body>
</html>