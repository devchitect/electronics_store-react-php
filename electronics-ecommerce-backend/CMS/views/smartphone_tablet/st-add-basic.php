<?php
    $phone = new Phone();
    $tablet = new Tablet();
    $brand = new Brand();
    $prototype = new Prototype();
    $category = new Category();

    $result = $brand -> getAllBrand();
    if($result == true){
        $brands = $brand -> data;
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

    $category -> getAllCategories();
    $categories = $category -> data;
    foreach($categories as $c){
        if($flexible == $c["name"]){
            $category_id = $c["id"];
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<body>
    <div class="st-add">
        <h3>Add new <?= $flexible ?></h3>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="act" value="<?= $flexible ?>">
            <input type="hidden" name="task" value="handle_add">
            <table class="st-add-table">
                <tr>
                    <th width=20%>ID <span class="required">*</span></th>
                    <td><input type="text" name="id" id="" placeholder="Input ID" required></td>
                </tr>
                <tr>
                    <th>Brand <span class="required">*</span></th>
                    <td>
                        <select name="brand" id="brand" required>
                            <option disabled selected hidden >Choose the Brand correctly (This can't be update later!)</option>
                            <?php foreach($brands as $brand){ ?>
                                <option value="<?= $brand["id"]?>"><?= $brand["name"]?></option>
                            <?php } ?> 
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Name <span class="required">*</span></th>
                    <td><input type="text" name="name" id="" placeholder="Input Name" required ></td>
                </tr>
                <tr>
                    <th>Stock <span class="required">*</span></th>
                    <td><input type="number" name="stock" id="" placeholder="Input Stock" required></td>
                </tr>
                <tr>
                    <th>Discount Price</th>
                    <td><input type="number" name="buy_price" id="" placeholder="Input Buy Price" ></td>
                </tr>
                <tr>
                    <th>Price <span class="required">*</span></th>
                    <td><input type="number" name="original_price" id="" placeholder="Input Price" required></td>
                </tr>
                <tr>
                    <th style="border: none;" colspan="2">Specifications</th>
                </tr>
                <tr>
                    <th>RAM <span class="required">*</span></th>
                    <td><input type="text" name="ram" id="" placeholder="Input RAM" required></td>
                </tr>
                <tr>
                    <th>Color <span class="required">*</span></th>
                    <td><input type="text" name="color" id="" placeholder="Input Color" required></td>
                </tr>
                <tr>
                    <th>Storage <span class="required">*</span></th>
                    <td><input type="text" name="storage" id="" placeholder="Input Storage" required></td>
                </tr>
                <tr>
                    <th>Prototype <span class="required">*</span></th>
                    <td>
                        <select name="prototype" id="protopye" style="font-weight: bold;" required>
                            <option disabled selected hidden></option>
                            <option disabled > Prototype is required!</option>
                            <option disabled > Create a prototype first if dont exist!!</option>
                            <?php foreach($prototypes as $p){ ?>
                                <option value="<?= $p["prototype"]?>"><?= $p["prototype"]?></option>
                            <?php } ?> 
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Overview Image</th>
                    <td><input type="file" name="overview"></td>
                </tr>
                <tr>
                    <th>Product Gallery</th>
                    <td><input type="file" name="images[]" multiple></td>
                </tr>

            </table>     
            <p style="text-align: center; margin:20px 0 0;">Create a prototype first if dont exist!</p>    
            <p style="text-align: center; margin:0 0 20px;"><span class="required">*</span> is required!</p> 
            <input type="hidden" name="category" value="<?= $category_id  ?>">         
            <input type="submit" name="add" value="Add this <?= $flexible ?> info to DB">
        </form>
    </div>    
</body>
</html>