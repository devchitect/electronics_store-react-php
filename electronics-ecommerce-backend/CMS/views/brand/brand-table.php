<?php
    $brand = new Brand();

    $brand -> getAllBrand();
    $brands = $brand -> data;
   
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <?php if(count($brands) == 0 ){ ?>
        <div style="text-align: center; color:red;">Found none Brand.</div>
    <?php } else { ?>
    <h4 style="text-align: center; margin:20px;">Can not delete Brand that still contains products!</h4>   
    <table style="width: 60% ;" class="laptop-table">
        <tr>
            <td >ID</td>
            <td width = 70%>Name</td>
            <td >Action</td>
        </tr>
           <?php foreach($brands as $b){ ?>
        <tr>
            <td><?=$b["id"]?></td>
            <td><b><?=$b["name"]?></b></td>
            <td><a href="?act=brand&task=delete&id=<?=$b["id"]?>" class="confirm"><span style="color: red;">Delete</span></a></td>
        </tr>

        <?php } }?>
    </table>          
    
    <script>
        document.querySelectorAll('.confirm').forEach(item => {
            item.addEventListener('click', event => {
                let x = confirm("Confirm Delete?!");

                if (x == false){
                event.preventDefault();
                }
            })
        })
    </script>
</body>
</html>