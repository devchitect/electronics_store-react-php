<?php
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
        <h3>Add new brand</h3>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="act" value="brand">
            <input type="hidden" name="task" value="handle_add">
            <table class="laptop-add-table">
                <tr>
                    <th width=20%>ID <span class="required">*</span></th>
                    <td><input type="number" name="id" id="" value="<?= count($brands) + 1?>" readonly></td>
                </tr>
                <tr>
                    <th>Name <span class="required">*</span></th>
                    <td><input type="text" name="name" id="" placeholder="Input Brand Name" required ></td>
                </tr>
            </table>      
            <input type="submit" name="add" value="Add this brand to DB">
        </form>
    </div>    

    <script></script>
</body>
</html>