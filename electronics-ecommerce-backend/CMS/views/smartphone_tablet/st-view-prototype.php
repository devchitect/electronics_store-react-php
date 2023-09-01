<?php
    $prototype = new Prototype();
    $key = isset($_REQUEST["key"]) ? $_REQUEST["key"] : "" ;

    switch($flexible){
        case "smartphone":
            $result = $prototype -> getAllPhonePrototypes();
            if($result == true){
                $viewlist = $prototype -> data;
            }

            if($key != ""){
                $result = $prototype -> getAllPhonePrototypesByKey($key);
                if($result == true){
                    $viewlist = $prototype -> data;
                }
            }
            break;

        case "tablet":
            $result = $prototype -> getAllTabletPrototypes();
            if($result == true){
                $viewlist = $prototype -> data;
            }

            if($key != ""){
                $result = $prototype -> getAllTabletPrototypesByKey($key);
                if($result == true){
                    $viewlist = $prototype -> data;
                }
            }
            break;
    }
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <div style="text-align: center;">
        <a href="?act=<?= $flexible ?>&task=create-prototype" style="margin-top:0px" class="st-btn">Create new Prototype</a>
        <form action="" style="margin-bottom: 30px;">
            <input  type="hidden" name="act" value="<?=$flexible ?>">
            <input  type="hidden" name="task" value="view-prototype">
            <input style="padding: 5px;" type="text" name="key">
            <input style="padding: 5px;" type="submit" value="Seach Prototype">
        </form>
    </div>

    <?php if(count($viewlist) == 0 ){ ?>
        <div style="text-align: center; color:red;">Found none Prototype.</div>
    <?php } else { ?>
    <table class="st-table">
        <?php  if($key != ""){?>
            <div style="text-align: center; margin: 20px">All Prototype with keyword : <span class="required"><?= $key ?></span></div>
        <?php } ?>
        <tr>
            <td >Prototype</td>
            <td >OS</td>
            <td >CPU</td>
            <td >GPU</td>
            <td >Screen</td>
            <td >Front Camera</td>
            <td >Back Camera</td>
            <td >Video</td>
        </tr>
           <?php foreach($viewlist as $l){ ?>
        <tr>
            <td><a href="?act=<?= $flexible ?>&task=details-prototype&&id=<?= $l["id"]?>" class="id-link"><?=$l["prototype"]?></a></td>
            <td><?=$l["os"]?></td>
            <td><?=$l["cpu"]?></td>
            <td><?=$l["gpu"]?></td>
            <td><?=$l["screen"]?></td>
            <td><?=$l["front_camera"]?></td>
            <td><?=$l["back_camera"]?></td>
            <td><?=$l["video"]?></td>
        </tr>

        <?php } }?>
    </table>               
</body>
</html>