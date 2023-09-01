<?php
    $category = new Category();

    $result = $category -> getAllCategories();
    if($result == true){
        $categories = $category -> data;
    }

    foreach($categories as $c){
        if($flexible == $c["name"]){
            $category_val =  $c["id"];
        }
    }
    
   
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <div class="st-add">
        <div style="text-align: center; padding: 0 0 20px;">
            <h4>Create new Prototype</h4>
            <h5 style="color: grey">
                <div>Prototype is a the specifications that many product have in common!</div> 
                <div>Example: Iphone 7 32GB have the same other specification with Iphone 7 64GB</div>
            </h5>
        </div>
       
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="act" value="<?= $flexible ?>">
            <input type="hidden" name="task" value="handle_add_prototype">
            <table class="st-add-table">
                <tr>
                    <th width=20%>Prototype <span class="required">*</span></th>
                    <td><input type="text" name="prototype" id="" placeholder="Input Prototype, like IPHONE 7, IPHONE 14,.." required></td>
                </tr>
                <tr>
                    <th>Category</th>
                    <td>
                        <select name="" id="category" disabled>
                            <option disabled selected hidden >Choose the category correctly (This can't be update later!)</option>
                            <?php foreach($categories as $c){ ?>
                                <option value="<?= $c["id"]?>"><?= $c["name"]?></option>
                            <?php } ?> 
                        </select>
                        <input type="hidden" name="category" value="<?= $category_val ?>">
                    </td>
                </tr>
                <tr>
                    <th>Operating system <span class="required">*</span></th>
                    <td><input type="text" name="os" id="" placeholder="Input OS"  required></td>
                </tr>
                <tr>
                    <th>CPU </th>
                    <td><input type="text" name="cpu" id="" placeholder="Input CPU" ></td>
                </tr>
                <tr>
                    <th>GPU</th>
                    <td><input type="text" name="gpu" id="" placeholder="Input GPU "></td>
                </tr>
                <tr>
                    <th>Screen</th>
                    <td><textarea name="screen" id="" rows="3" placeholder="Input Screen Details (Separate each detail with ';')" ></textarea></td>
                </tr>
                <tr>
                    <th>Front Camera </th>
                    <td><textarea name="front_cam" id="" rows="3" placeholder="Input Front Camera Details (Separate each detail with ';')" ></textarea></td>
                </tr>
                <tr>
                    <th>Back Camera </th>
                    <td><textarea name="back_cam" id="" rows="4" placeholder="Input Back Camera Details (Separate each detail with ';')" ></textarea></td>
                </tr>
                <tr>
                    <th>Video </th>
                    <td><textarea name="video" id="" rows="5" placeholder="Input Video Details (Separate each detail with ';')" ></textarea></td>
                </tr>
                <tr>
                    <th>Battery</th>
                    <td><input type="text" name="battery" id="" placeholder="Input Battery" ></td>
                </tr>
                <tr>
                    <th>Charge </th>
                    <td><input type="text" name="charge" id="" placeholder="Input Charge details" ></td>
                </tr>
                <tr>
                    <th>Features</th>
                    <td><textarea name="features" id="" rows="10" placeholder="Input Features Details (Separate feature detail with ';')"></textarea></td>
                </tr>
                <tr>
                    <th>Weight </th>
                    <td><input type="text" name="weight" id="" placeholder="Input Weight" ></td>
                </tr>
                <tr>
                    <th>Length</th>
                    <td><input type="text" name="length" id="" placeholder="Input Heigth"></td>
                </tr>
                <tr>
                    <th>Width</th>
                    <td><input type="text" name="width" id="" placeholder="Input Width"></td>
                </tr>
                <tr>
                    <th>Depth</th>
                    <td><input type="text" name="depth" id="" placeholder="Input Depth"></td>
                </tr>
            </table>     
            <p style="text-align: center; margin:20px 0;"><span class="required">*</span> is required!</p>          
            <input type="submit" name="add" value="Add this prototype info to DB">
        </form>
    </div>    
    <script type="text/javascript">
        document.getElementById("category").value = <?= $category_val ?>
    </script>
</body>
</html>