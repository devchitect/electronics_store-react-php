<!DOCTYPE html>
<html lang="en">

    <div>

    <?php if(count($orders) == 0 ){ ?>
    <div style="text-align: center; color:red;">Found none Order.</div>
    <?php }else{ ?>
    <table style="width: 90% ;" class="laptop-table">
        <tr>
            <td >Order ID</td>
            <td >Total</td>
            <td >Product amount</td>
            <td >Created at</td>
            <td >Username</td>
            <td >Customer name</td>
            <td >Phone</td>
            <td>Adrress</td>
            <td>Email</td>
            <td >Payment method</td>
            <td>Payment status</td>
            <td>Action</td>
        </tr>
        <?php foreach($orders as $c){ ?>
        <tr>
            <td><b><?=$c["id"]?></td>
            <td><?=$c["total"]?></td>
            <td><?=$c["amount"]?></td>
            <td><?=$c["created_date"]?></td>
            <td><?=!$c["username"] ? '-' : $c["username"] ?></td>
            <td><?=$c["fullname"]?></td>
            <td><?=$c["phone"]?></td>
            <td><?=$c["address"]?></td>
            <td><?=$c["email"]?></td>
            <td><?=$c["payment_method"] ?></td>
            <td><?=$c["status"]?></td>
            <td width=8%><a href="?act=order&task=details&id=<?= $c['id'] ?>"><i class="bi bi-search"></i>Details</a></td>
        </tr>

        <?php } }?>
    </table>          

    </div>
</html>