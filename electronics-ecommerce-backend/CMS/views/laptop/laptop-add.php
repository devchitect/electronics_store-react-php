<?php
    $laptop = new Laptop();
    $brand = new Brand();
    $result = $brand -> getAllBrand();
    if($result == true){
        $brands = $brand -> data;
    }
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <div class="laptop-add">
        <h3>Add new laptop</h3>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="act" value="laptop">
            <input type="hidden" name="task" value="handle_add">
            <table class="laptop-add-table">
                <tr>
                    <th width=20%>ID <span class="required">*</span></th>
                    <td><input type="text" name="id" id="" placeholder="Input ID" required></td>
                </tr>
                <tr>
                    <th>Brand <span class="required">*</span></th>
                    <td>
                        <select name="brand" id="brand" required>
                            <option disabled selected hidden ></option>
                            <option disabled hidden >Choose the Brand correctly (This can't be update later!)</option>
                            <?php foreach($brands as $brand){ ?>
                                <option value="<?= $brand["id"]?>"><?= $brand["name"]?></option>
                            <?php } ?> 
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Name / Model <span class="required">*</span></th>
                    <td><input type="text" name="name" id="" placeholder="Input Name/Model" required ></td>
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
                    <th>CPU <span class="required">*</span></th>
                    <td><input type="text" name="cpu" id="" placeholder="Input CPU" required></td>
                </tr>
                <tr>
                    <th>RAM <span class="required">*</span></th>
                    <td><input type="text" name="ram" id="" placeholder="Input RAM" required></td>
                </tr>
                <tr>
                    <th>VGA <span class="required">*</span></th>
                    <td><input type="text" name="vga" id="" placeholder="Input VGA" required></td>
                </tr>
                <tr>
                    <th>Screen <span class="required">*</span></th>
                    <td><input type="text" name="screen" id="" placeholder="Input Screen" required></td>
                </tr>
                <tr>
                    <th>Hard Drive <span class="required">*</span></th>
                    <td><input type="text" name="harddrive" id="" placeholder="Input Hard Drive details" required></td>
                </tr>
                <tr>
                    <th>Ports</th>
                    <td><textarea name="ports" id="" rows="10" placeholder="Input Ports Details (Separate each port detail with ';')"></textarea></td>
                </tr>
                <tr>
                    <th>Webcam</th>
                    <td><input type="text" name="webcam" id="" placeholder="Input Webcam"></td>
                </tr>
                <tr>
                    <th>Audio</th>
                    <td><input type="text" name="audio" id="" placeholder="Input Audio"></td>
                </tr>
                <tr>
                    <th>Battery <span class="required">*</span></th>
                    <td><input type="text" name="battery" id="" placeholder="Input Battery" required></td>
                </tr>
                <tr>
                    <th>Weight <span class="required">*</span></th>
                    <td><input type="text" name="weight" id="" placeholder="Input Weight" required></td>
                </tr>
                <tr>
                    <th>Color <span class="required">*</span></th>
                    <td><input type="text" name="color" id="" placeholder="Input Color" required></td>
                </tr>
                <tr>
                    <th>Wifi</th>
                    <td><input type="text" name="wifi" id="" placeholder="Input WIFI"></td>
                </tr>
                <tr>
                    <th>Bluetooth</th>
                    <td><input type="text" name="bluetooth" id="" placeholder="Input Bluetooth"></td>
                </tr>
                <tr>
                    <th>Overview Image</th>
                    <td>
                        <input type="file" name="overview">
                        <div class="required" style="margin-left: 10px">Only upload one overview image</div>
                    </td>
                    
                </tr>
                <tr>
                    <th>Product Gallery</th>
                    <td>
                        <input type="file" name="images[]" multiple>
                        <div class="required" style="margin-left: 10px">You can upload multiple images for product gallery</div>
                    </td>
                </tr>
            </table>     
            <p style="text-align: center; margin:20px 0;"><span class="required">*</span> is required!</p>          
            <input type="submit" name="add" value="Add this laptop info to DB">
        </form>
    </div>    
</body>
</html>