<?php
    $id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : ""; 

    $prototype = new Prototype();

    $prototype -> getSpecificPrototype($id);
    $p = $prototype -> data;
    
    if($p["features"] != "" || $p["features"] != null){
        $features = explode(";",$p["features"]);
    }
    if($p["screen"] != "" || $p["screen"] != null){
        $screens = explode(";",$p["screen"]);
    }
    if($p["video"] != "" || $p["video"] != null){
        $videos = explode(";",$p["video"]);
    }

       
?>


<!DOCTYPE html>
<html lang="en">
<body>
    <div style="margin-bottom:60px"> 
        <?php if($p != null ){?>
        <h3 class="laptop-details-title">Details of Prototype: <span style="color: red;"><?= $p["prototype"] ?></span></h3>
        
        <div class="laptop-details-menu">
            <a class="laptop-details-menu-btn laptop-details-menu-btn-update" href="?act=<?=$flexible?>&task=update-prototype&id=<?= $p["id"] ?>">Update prototype info</a>
            <a class="laptop-details-menu-btn laptop-details-menu-btn-delete" href="?act=<?=$flexible?>&task=handle_delete_prototype&id=<?= $p["id"] ?>" id="confirm">Delete Prototype</a>
        </div>

        <div>
            <table class="laptop-details">
                <tr>
                    <th>Prototype</th>
                    <td><?= $p["prototype"] ?></td>
                </tr>
                <tr>
                    <th width=20%>OS</th>
                    <td><?= $p["os"] ?></td>
                </tr>
                <tr>
                    <th>CPU</th>
                    <td><b><?= $p["cpu"] ?></b></td>
                </tr>
                <tr>
                    <th>GPU</th>
                    <td><b><?= $p["gpu"] ?></b></td>
                </tr>
                <tr>
                    <th>Screen</th>
                    <td>
                        <?php if($p["screen"] != "" || $p["screen"] != null){foreach($screens as $s){ ?>
                            <div><?= $s ?></div>
                        <?php }} ?>
                    </td>
                </tr>
                <tr>
                    <th>Video</th>
                    <td>
                        <?php if($p["screen"] != "" || $p["screen"] != null){foreach($videos as $v){ ?>
                            <div><?= $v ?></div>
                        <?php }} ?>
                    </td>
                </tr>
                <tr>
                    <th>Front Camera</th>
                    <td><?= $p["front_camera"] ?></td>
                </tr>
                <tr>
                    <th>Back Camera</th>
                    <td><?= $p["back_camera"] ?></td>
                </tr>
                <tr>
                    <th>Length</th>
                    <td><?= $p["length"] ?></td>
                </tr>
                <tr>
                    <th>Width</th>
                    <td><?= $p["width"] ?></td>
                </tr>
                <tr>
                    <th>Depth</th>
                    <td><?= $p["depth"] ?></td>
                </tr>
                <tr>
                    <th>Weight</th>
                    <td><?= $p["weight"] ?></td>
                </tr>
                <tr>
                    <th>Battery</th>
                    <td><?= $p["battery"] ?></td>
                </tr>
                <tr>
                    <th>Charge</th>
                    <td><?= $p["charge"] ?></td>
                </tr>
                <tr>
                    <th>Features</th>
                    <td>
                        <?php if($p["features"] != "" || $p["features"] != null){foreach($features as $f){ ?>
                            <div><?= $f ?></div>
                        <?php }} ?>
                    </td>
                </tr>
            </table>               
        </div>
        <?php 
        }else if ($id == "" ){ header('Location:'.$_SERVER['PHP_SELF']. "?act=$flexible&task=view-prototype");  }else{ ?>
            <div style="text-align: center; color:red;">
                No Prototype Details Found.
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
