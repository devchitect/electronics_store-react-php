<?php
    $id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : "";

    $category = new Category();
    $category -> getAllCategories();
    $categories = $category -> data;
    $prototype = new Prototype();

    $result = $category -> getAllCategories();
    if($result == true){
        $categories = $category -> data;
    }

    $prototype -> getSpecificPrototype($id);
    $p = $prototype -> data;    

    foreach($categories as $c){
        if($c["id"] == $p["category_id"]){
            $category_value = $c["name"];
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<body>
    <div class="st-add">
        <div style="text-align: center; padding: 0 0 20px;">
            <h4>Update Prototype</h4>
            <h5 style="color: grey">
                <div>Prototype is a the specifications that many product have in common!</div> 
                <div>Example: Iphone 7 32GB have the same other specification with Iphone 7 64GB</div>
            </h5>
        </div>
       
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="act" value="<?= $flexible ?>">
            <input type="hidden" name="task" value="handle_update_prototype">
            <table class="st-add-table">
                <tr>
                    <th width=20%>Prototype <span class="required">*</span></th>
                    <td><input type="text" name="prototype" id="" value="<?= $p["prototype"] ?>" required></td>
                </tr>
                <tr>
                    <th>Category</th>
                    <td>
                        <select name="" id="category" disabled>
                            <?php foreach($categories as $c){ ?>
                                <option value="<?= $c["id"] ?>"><?= $c["name"] ?></option>
                             <?php }?>                   
                        </select>
                        <input type="hidden" name="category" value=" <?= $p["category_id"] ?>">
                    </td>
                </tr>
                <tr>
                    <th>Operating system <span class="required">*</span></th>
                    <td><input type="text" name="os" id="" value="<?= $p["os"] ?>" required></td>
                </tr>
                <tr>
                    <th>CPU </th>
                    <td><input type="text" name="cpu" id="" value="<?= $p["cpu"] ?>" ></td>
                </tr>
                <tr>
                    <th>GPU</th>
                    <td><input type="text" name="gpu" id="" value="<?= $p["gpu"] ?>"></td>
                </tr>
                <tr>
                    <th>Screen </th>
                    <td><textarea name="screen" id="screen" rows="3"></textarea></td>
                </tr>
                <tr>
                    <th>Front Camera </th>
                    <td><textarea name="front_cam" id="front_cam" rows="3"></textarea></td>
                </tr>
                <tr>
                    <th>Back Camera </th>
                    <td><textarea name="back_cam" id="back_cam" rows="4"></textarea></td>
                </tr>
                </tr>
                <tr>
                    <th>Video</th>
                    <td><textarea name="video" id="video" rows="5" ></textarea></td>
                </tr>
                <tr>
                    <th>Battery </th>
                    <td><input type="text" name="battery" id="" value="<?= $p["battery"] ?>" ></td>
                </tr>
                <tr>
                    <th>Charge </th>
                    <td><input type="text" name="charge" id="" value="<?= $p["charge"] ?>" ></td>
                </tr>
                <tr>
                    <th>Features</th>
                    <td><textarea name="features" id="features" rows="10" ></textarea></td>
                </tr>
                <tr>
                    <th>Weight </th>
                    <td><input type="text" name="weight" id="" value="<?= $p["weight"] ?>" ></td>
                </tr>
                <tr>
                    <th>Length</th>
                    <td><input type="text" name="length" id="" value="<?= $p["length"] ?>"></td>
                </tr>
                <tr>
                    <th>Width</th>
                    <td><input type="text" name="width" id=""value="<?= $p["width"] ?>"></td>
                </tr>
                <tr>
                    <th>Depth</th>
                    <td><input type="text" name="depth" id="" value="<?= $p["depth"] ?>"></td>
                </tr>
            </table>     
            <input type="hidden" name="id" value="<?= $p["id"] ?>">
            <p style="text-align: center; margin:20px 0;"><span class="required">*</span> is required!</p>          
            <input type="submit" name="update" value="Update this prototype">
        </form>
    </div>
    
    <script type="text/javascript">
        document.getElementById("category").value = <?= $p["category_id"] ?>;
        document.getElementById("screen").value =   <?=json_encode($p["screen"])?>;
        document.getElementById("features").value =  <?=json_encode($p["features"])?>;
        document.getElementById("video").value =  <?=json_encode($p["video"])?>;
        document.getElementById("back_cam").value =  <?=json_encode($p["front_camera"])?>;
        document.getElementById("front_cam").value =  <?=json_encode($p["back_camera"])?>;
    </script>
</body>
</html>